<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPageRequest;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Package;
use App\Models\Page;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = Page::with(['packages', 'media'])->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        abort_if(Gate::denies('page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::pluck('name', 'id');

        return view('admin.pages.create', compact('packages'));
    }

    public function store(StorePageRequest $request)
    {
        $page = Page::create($request->all());
        $page->packages()->sync($request->input('packages', []));
        if ($request->input('profile_photo', false)) {
            $page->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $page->id]);
        }

        return redirect()->route('admin.pages.index');
    }

    public function edit(Page $page)
    {
        abort_if(Gate::denies('page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::pluck('name', 'id');

        $page->load('packages');

        return view('admin.pages.edit', compact('packages', 'page'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->all());
        $page->packages()->sync($request->input('packages', []));
        if ($request->input('profile_photo', false)) {
            if (! $page->profile_photo || $request->input('profile_photo') !== $page->profile_photo->file_name) {
                if ($page->profile_photo) {
                    $page->profile_photo->delete();
                }
                $page->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_photo'))))->toMediaCollection('profile_photo');
            }
        } elseif ($page->profile_photo) {
            $page->profile_photo->delete();
        }

        return redirect()->route('admin.pages.index');
    }

    public function show(Page $page)
    {
        abort_if(Gate::denies('page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page->load('packages');

        return view('admin.pages.show', compact('page'));
    }

    public function destroy(Page $page)
    {
        abort_if(Gate::denies('page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page->delete();

        return back();
    }

    public function massDestroy(MassDestroyPageRequest $request)
    {
        $pages = Page::find(request('ids'));

        foreach ($pages as $page) {
            $page->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('page_create') && Gate::denies('page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Page();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
