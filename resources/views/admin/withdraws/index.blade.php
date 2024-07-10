@extends('layouts.admin')
@section('content')
@can('withdraw_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.withdraws.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.withdraw.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.withdraw.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Withdraw">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.method') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.paid') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws as $key => $withdraw)
                        <tr data-entry-id="{{ $withdraw->id }}">
                            <td>

                            </td>
                            <td>
                                @foreach($withdraw->methods as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $withdraw->amount ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $withdraw->paid ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $withdraw->paid ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $withdraw->user->name ?? '' }}
                            </td>
                            <td>
                                @can('withdraw_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.withdraws.show', $withdraw->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('withdraw_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.withdraws.edit', $withdraw->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('withdraw_delete')
                                    <form action="{{ route('admin.withdraws.destroy', $withdraw->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('withdraw_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.withdraws.massDestroy') }}",
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
    order: [[ 4, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Withdraw:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection