<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaymentSettingRequest;
use App\Http\Requests\StorePaymentSettingRequest;
use App\Http\Requests\UpdatePaymentSettingRequest;
use App\Models\PaymentMethod;
use App\Models\PaymentSetting;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentSettings = PaymentSetting::with(['user', 'method'])->get();

        return view('admin.paymentSettings.index', compact('paymentSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.paymentSettings.create', compact('methods', 'users'));
    }

    public function store(StorePaymentSettingRequest $request)
    {
        $paymentSetting = PaymentSetting::create($request->all());

        return redirect()->route('admin.payment-settings.index');
    }

    public function edit(PaymentSetting $paymentSetting)
    {
        abort_if(Gate::denies('payment_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentSetting->load('user', 'method');

        return view('admin.paymentSettings.edit', compact('methods', 'paymentSetting', 'users'));
    }

    public function update(UpdatePaymentSettingRequest $request, PaymentSetting $paymentSetting)
    {
        $paymentSetting->update($request->all());

        return redirect()->route('admin.payment-settings.index');
    }

    public function show(PaymentSetting $paymentSetting)
    {
        abort_if(Gate::denies('payment_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentSetting->load('user', 'method');

        return view('admin.paymentSettings.show', compact('paymentSetting'));
    }

    public function destroy(PaymentSetting $paymentSetting)
    {
        abort_if(Gate::denies('payment_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentSettingRequest $request)
    {
        $paymentSettings = PaymentSetting::find(request('ids'));

        foreach ($paymentSettings as $paymentSetting) {
            $paymentSetting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
