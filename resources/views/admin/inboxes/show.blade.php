@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.inbox.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inboxes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.inbox.fields.id') }}
                        </th>
                        <td>
                            {{ $inbox->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inbox.fields.message') }}
                        </th>
                        <td>
                            {{ $inbox->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inbox.fields.package') }}
                        </th>
                        <td>
                            {{ $inbox->package->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inbox.fields.user') }}
                        </th>
                        <td>
                            {{ $inbox->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inboxes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection