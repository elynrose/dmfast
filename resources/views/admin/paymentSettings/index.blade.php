@extends('layouts.admin')
@section('content')
@can('payment_setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.payment-settings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.paymentSetting.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.paymentSetting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PaymentSetting">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.paymentSetting.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentSetting.fields.method') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentSetting.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentSetting.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentSetting.fields.routing') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentSetting.fields.account') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentSettings as $key => $paymentSetting)
                        <tr data-entry-id="{{ $paymentSetting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $paymentSetting->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $paymentSetting->method->name ?? '' }}
                            </td>
                            <td>
                                {{ $paymentSetting->email ?? '' }}
                            </td>
                            <td>
                                {{ $paymentSetting->phone ?? '' }}
                            </td>
                            <td>
                                {{ $paymentSetting->routing ?? '' }}
                            </td>
                            <td>
                                {{ $paymentSetting->account ?? '' }}
                            </td>
                            <td>
                                @can('payment_setting_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.payment-settings.show', $paymentSetting->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('payment_setting_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.payment-settings.edit', $paymentSetting->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('payment_setting_delete')
                                    <form action="{{ route('admin.payment-settings.destroy', $paymentSetting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('payment_setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payment-settings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-PaymentSetting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection