<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInboxRequest;
use App\Http\Requests\StoreInboxRequest;
use App\Http\Requests\UpdateInboxRequest;
use App\Models\Inbox;
use App\Models\Package;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InboxController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inbox_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inboxes = Inbox::with(['package', 'user'])->get();

        return view('admin.inboxes.index', compact('inboxes'));
    }

    public function create()
    {
        abort_if(Gate::denies('inbox_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.inboxes.create', compact('packages', 'users'));
    }

    public function store(StoreInboxRequest $request)
    {
        $inbox = Inbox::create($request->all());

        return redirect()->route('admin.inboxes.index');
    }

    public function edit(Inbox $inbox)
    {
        abort_if(Gate::denies('inbox_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packages = Package::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inbox->load('package', 'user');

        return view('admin.inboxes.edit', compact('inbox', 'packages', 'users'));
    }

    public function update(UpdateInboxRequest $request, Inbox $inbox)
    {
        $inbox->update($request->all());

        return redirect()->route('admin.inboxes.index');
    }

    public function show(Inbox $inbox)
    {
        abort_if(Gate::denies('inbox_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inbox->load('package', 'user');

        return view('admin.inboxes.show', compact('inbox'));
    }

    public function destroy(Inbox $inbox)
    {
        abort_if(Gate::denies('inbox_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inbox->delete();

        return back();
    }

    public function massDestroy(MassDestroyInboxRequest $request)
    {
        $inboxes = Inbox::find(request('ids'));

        foreach ($inboxes as $inbox) {
            $inbox->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
