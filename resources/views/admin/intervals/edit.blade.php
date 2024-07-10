@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.interval.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.intervals.update", [$interval->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.interval.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $interval->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interval.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.interval.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', $interval->hours) }}" step="1">
                @if($errors->has('hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interval.fields.hours_helper') }}</span>
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