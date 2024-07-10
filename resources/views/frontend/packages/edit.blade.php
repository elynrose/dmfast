@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.package.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.packages.update", [$package->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.package.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $package->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="intervals_id">{{ trans('cruds.package.fields.intervals') }}</label>
                            <select class="form-control select2" name="intervals_id" id="intervals_id" required>
                                @foreach($intervals as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('intervals_id') ? old('intervals_id') : $package->intervals->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('intervals'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('intervals') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.intervals_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="credits">{{ trans('cruds.package.fields.credits') }}</label>
                            <input class="form-control" type="number" name="credits" id="credits" value="{{ old('credits', $package->credits) }}" step="1" required>
                            @if($errors->has('credits'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('credits') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.credits_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.package.fields.notify_me') }}</label>
                            @foreach(App\Models\Package::NOTIFY_ME_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="notify_me_{{ $key }}" name="notify_me" value="{{ $key }}" {{ old('notify_me', $package->notify_me) === (string) $key ? 'checked' : '' }}>
                                    <label for="notify_me_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('notify_me'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notify_me') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.notify_me_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.package.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $package->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.user_helper') }}</span>
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