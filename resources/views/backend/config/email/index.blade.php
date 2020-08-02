@extends('backend.layouts.app')

@section('body')
    @include('flash')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                <h3 class="kt-portlet__head-title">
                    Data {{ $pageTitle }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="javascript: window.history.back()" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>

                    <a href="{{ route('config_email.create') }}" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus-1 kt-font-hover-brand"></i>
                        Add New
                    </a>
                    &nbsp;
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">

                        </div>
                    </div>

                </div>
            </div>
            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="user_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Visibility</th>
                    <th>@lang('auth.index_created_by')</th>
                    <th>@lang('auth.index_updated_by')</th>
                    <th>@lang('auth.index_created_at')</th>
                    <th>@lang('auth.index_updated_at')</th>
                    <th width="100">@lang('global.action')</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="{{ url('themes/eci/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush

@push('scripts')
    <!--begin::Page Scripts(used by this page) -->
    {{--    <script src="{{ url('themes/eci/js/pages/crud/metronic-datatable/base/data-local.js') }}" type="text/javascript"></script>--}}
    <script src="{{ url('themes/eci/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    <script src="{{ url('plugins/jquery-number/jquery.number.min.js') }}"></script>
    <script>
        $(function () {
            let table;
            table = $('#user_table').DataTable({
                aaSorting: [[0, 'desc']],
                iDisplayLength: 25,
                //stateSave: true,
                //responsive: true,

                fixedHeader: true,
                deferRender: !0,
                responsive: !0,
                processing: true,
                serverSide: true,
                // scrollY: "500px",
                scrollX: !0,
                scrollCollapse: !0,
                width:"100%",
                // scroller: !0,
                //select: !0, // select by 1
                // select: {
                //     style: "multi",
                //     selector: "td:first-child .kt-checkable"
                // },
                // headerCallback: function(e, t, a, s, n) {
                //     e.getElementsByTagName("th")[0].innerHTML = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand"><input type="checkbox" value="" class="kt-group-checkable"><span></span></label>';
                // },
                // dom: "<'dt-panelmenu clearfix'<'row'<'col-sm-2'B><'col-sm-4'l><'col-sm-6'f>>>" +
                //     "<'row'<'col-sm-12'tr>>" +
                //     "<'dt-panelfooter clearfix'<'row'<'col-sm-5'i><'col-sm-7'p>>>",
                // pagingType: "full_numbers",
                dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                ajax: {
                    url: '{!! route('config_email.ajax.data') !!}',
                    dataType: 'json',
                    data: function (d) {
                        d.param = 1;
                    }
                },
                columns: [
                    {data: 'id', name: 'id', visible:false},
                    // {
                    //     data: 'checkbox', name: 'checkbox', orderable: false, searchable: false,
                    //     checkboxes: true
                    // },
                    {data: 'name', name: 'name'},

                    {data: 'visibility', name: 'visibility'},

                    {data: 'created_by', name: 'created_by', visible: true},
                    {data: 'updated_by', name: 'updated_by', visible: true},

                    {data: 'created_at', name: 'created_at', visible: true},
                    {data: 'updated_at', name: 'updated_at', visible: true},

                    {
                        data: 'action', name: 'action', orderable: false, searchable: false,
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            $("a", nTd).tooltip({container: 'body'});
                        }
                    }
                ],
                buttons: [
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i> Columns',
                        columns: '0, 1, 2, 3, 4, 5'
                    }
                ],
                select: {
                    style: 'multi'
                },
            });

            table.on("change", ".kt-group-checkable", function() {
                var t = $(this).closest("table").find("td:first-child .kt-checkable"),
                    a = $(this).is(":checked");
                $(t).each(function() {
                    a ? ($(this).prop("checked", !0), table.rows($(this).closest("tr")).select()) : ($(this).prop("checked", !1), e.rows($(this).closest("tr")).deselect());
                });
            });
        });
    </script>
@endpush
