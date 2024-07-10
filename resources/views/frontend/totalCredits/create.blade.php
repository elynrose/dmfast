@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.totalCredit.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.total-credits.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="stripe_transaction">{{ trans('cruds.totalCredit.fields.stripe_transaction') }}</label>
                            <input class="form-control" type="text" name="stripe_transaction" id="stripe_transaction" value="{{ old('stripe_transaction', '') }}" required>
                            @if($errors->has('stripe_transaction'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stripe_transaction') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.totalCredit.fields.stripe_transaction_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="point">{{ trans('cruds.totalCredit.fields.point') }}</label>
                            <input class="form-control" type="number" name="point" id="point" value="{{ old('point', '') }}" step="1">
                            @if($errors->has('point'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('point') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.totalCredit.fields.point_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.totalCredit.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.totalCredit.fields.user_helper') }}</span>
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