@extends('layouts.admin')
@section('content')
@can('total_credit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.total-credits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.totalCredit.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.totalCredit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TotalCredit">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.totalCredit.fields.stripe_transaction') }}
                        </th>
                        <th>
                            {{ trans('cruds.totalCredit.fields.point') }}
                        </th>
                        <th>
                            {{ trans('cruds.totalCredit.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalCredits as $key => $totalCredit)
                        <tr data-entry-id="{{ $totalCredit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $totalCredit->stripe_transaction ?? '' }}
                            </td>
                            <td>
                                {{ $totalCredit->point ?? '' }}
                            </td>
                            <td>
                                {{ $totalCredit->user->name ?? '' }}
                            </td>
                            <td>
                                @can('total_credit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.total-credits.show', $totalCredit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('total_credit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.total-credits.edit', $totalCredit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('total_credit_delete')
                                    <form action="{{ route('admin.total-credits.destroy', $totalCredit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('total_credit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.total-credits.massDestroy') }}",
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
  let table = $('.datatable-TotalCredit:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection