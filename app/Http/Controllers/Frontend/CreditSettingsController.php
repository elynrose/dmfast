<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCreditSettingRequest;
use App\Http\Requests\StoreCreditSettingRequest;
use App\Http\Requests\UpdateCreditSettingRequest;
use App\Models\CreditSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreditSettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('credit_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creditSettings = CreditSetting::all();

        return view('frontend.creditSettings.index', compact('creditSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('credit_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.creditSettings.create');
    }

    public function store(StoreCreditSettingRequest $request)
    {
        $creditSetting = CreditSetting::create($request->all());

        return redirect()->route('frontend.credit-settings.index');
    }

    public function edit(CreditSetting $creditSetting)
    {
        abort_if(Gate::denies('credit_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.creditSettings.edit', compact('creditSetting'));
    }

    public function update(UpdateCreditSettingRequest $request, CreditSetting $creditSetting)
    {
        $creditSetting->update($request->all());

        return redirect()->route('frontend.credit-settings.index');
    }

    public function show(CreditSetting $creditSetting)
    {
        abort_if(Gate::denies('credit_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.creditSettings.show', compact('creditSetting'));
    }

    public function destroy(CreditSetting $creditSetting)
    {
        abort_if(Gate::denies('credit_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creditSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyCreditSettingRequest $request)
    {
        $creditSettings = CreditSetting::find(request('ids'));

        foreach ($creditSettings as $creditSetting) {
            $creditSetting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
