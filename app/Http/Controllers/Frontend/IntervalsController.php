<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIntervalRequest;
use App\Http\Requests\StoreIntervalRequest;
use App\Http\Requests\UpdateIntervalRequest;
use App\Models\Interval;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IntervalsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('interval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $intervals = Interval::all();

        return view('frontend.intervals.index', compact('intervals'));
    }

    public function create()
    {
        abort_if(Gate::denies('interval_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.intervals.create');
    }

    public function store(StoreIntervalRequest $request)
    {
        $interval = Interval::create($request->all());

        return redirect()->route('frontend.intervals.index');
    }

    public function edit(Interval $interval)
    {
        abort_if(Gate::denies('interval_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.intervals.edit', compact('interval'));
    }

    public function update(UpdateIntervalRequest $request, Interval $interval)
    {
        $interval->update($request->all());

        return redirect()->route('frontend.intervals.index');
    }

    public function show(Interval $interval)
    {
        abort_if(Gate::denies('interval_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.intervals.show', compact('interval'));
    }

    public function destroy(Interval $interval)
    {
        abort_if(Gate::denies('interval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interval->delete();

        return back();
    }

    public function massDestroy(MassDestroyIntervalRequest $request)
    {
        $intervals = Interval::find(request('ids'));

        foreach ($intervals as $interval) {
            $interval->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
