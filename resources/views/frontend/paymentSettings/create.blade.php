@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.paymentSetting.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payment-settings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.paymentSetting.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="method_id" id="method_id" required>
                                @foreach($methods as $id => $entry)
                                    <option value="{{ $id }}" {{ old('method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email', '') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentSetting.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.paymentSetting.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentSetting.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="routing">{{ trans('cruds.paymentSetting.fields.routing') }}</label>
                            <input class="form-control" type="text" name="routing" id="routing" value="{{ old('routing', '') }}">
                            @if($errors->has('routing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('routing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.paymentSetting.fields.routing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="account">{{ trans('cruds.paymentSetting.fields.account') }}</label>
                            <input class="form-control" type="text" name="account" id="account" value="{{ old('account', '') }}">
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

        </div>
    </div>
</div>
@endsection