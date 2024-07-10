@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.message.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.messages.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="message">{{ trans('cruds.message.fields.message') }}</label>
                            <textarea class="form-control" name="message" id="message" required>{{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="package_id">{{ trans('cruds.message.fields.package') }}</label>
                            <select class="form-control select2" name="package_id" id="package_id" required>
                                @foreach($packages as $id => $entry)
                                    <option value="{{ $id }}" {{ old('package_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('package'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('package') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.package_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.message.fields.user') }}</label>
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
                            <span class="help-block">{{ trans('cruds.message.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="closed" value="0">
                                <input type="checkbox" name="closed" id="closed" value="1" {{ old('closed', 0) == 1 ? 'checked' : '' }}>
                                <label for="closed">{{ trans('cruds.message.fields.closed') }}</label>
                            </div>
                            @if($errors->has('closed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('closed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.closed_helper') }}</span>
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