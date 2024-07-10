@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paymentSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-settings.update", [$paymentSetting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.paymentSetting.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $paymentSetting->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentSetting.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="method_id">{{ trans('cruds.paymentSetting.fields.method') }}</label>
                <select class="form-control select2 {{ $errors->has('method') ? 'is-invalid' : '' }}" name="method_id" id="method_id" required>
                    @foreach($methods as $id => $entry)
                        <option value="{{ $id }}" {{ (old('method_id') ? old('method_id') : $paymentSetting->method->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentSetting.fields.method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.paymentSetting.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $paymentSetting->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentSetting.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.paymentSetting.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $paymentSetting->phone) }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentSetting.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="routing">{{ trans('cruds.paymentSetting.fields.routing') }}</label>
                <input class="form-control {{ $errors->has('routing') ? 'is-invalid' : '' }}" type="text" name="routing" id="routing" value="{{ old('routing', $paymentSetting->routing) }}">
                @if($errors->has('routing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('routing') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentSetting.fields.routing_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="account">{{ trans('cruds.paymentSetting.fields.account') }}</label>
                <input class="form-control {{ $errors->has('account') ? 'is-invalid' : '' }}" type="text" name="account" id="account" value="{{ old('account', $paymentSetting->account) }}">
                @if($errors->has('account'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentSetting.fields.account_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection