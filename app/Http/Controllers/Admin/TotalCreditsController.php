<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTotalCreditRequest;
use App\Http\Requests\StoreTotalCreditRequest;
use App\Http\Requests\UpdateTotalCreditRequest;
use App\Models\TotalCredit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TotalCreditsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('total_credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalCredits = TotalCredit::with(['user'])->get();

        return view('admin.totalCredits.index', compact('totalCredits'));
    }

    public function create()
    {
        abort_if(Gate::denies('total_credit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.totalCredits.create', compact('users'));
    }

    public function store(StoreTotalCreditRequest $request)
    {
        $totalCredit = TotalCredit::create($request->all());

        return redirect()->route('admin.total-credits.index');
    }

    public function edit(TotalCredit $totalCredit)
    {
        abort_if(Gate::denies('total_credit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $totalCredit->load('user');

        return view('admin.totalCredits.edit', compact('totalCredit', 'users'));
    }

    public function update(UpdateTotalCreditRequest $request, TotalCredit $totalCredit)
    {
        $totalCredit->update($request->all());

        return redirect()->route('admin.total-credits.index');
    }

    public function show(TotalCredit $totalCredit)
    {
        abort_if(Gate::denies('total_credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalCredit->load('user');

        return view('admin.totalCredits.show', compact('totalCredit'));
    }

    public function destroy(TotalCredit $totalCredit)
    {
        abort_if(Gate::denies('total_credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalCredit->delete();

        return back();
    }

    public function massDestroy(MassDestroyTotalCreditRequest $request)
    {
        $totalCredits = TotalCredit::find(request('ids'));

        foreach ($totalCredits as $totalCredit) {
            $totalCredit->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
