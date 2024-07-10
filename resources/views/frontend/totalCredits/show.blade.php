@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.totalCredit.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.total-credits.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.totalCredit.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $totalCredit->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.totalCredit.fields.stripe_transaction') }}
                                    </th>
                                    <td>
                                        {{ $totalCredit->stripe_transaction }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.totalCredit.fields.point') }}
                                    </th>
                                    <td>
                                        {{ $totalCredit->point }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.totalCredit.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $totalCredit->user->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.total-credits.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection