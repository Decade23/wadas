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

                    <a href="{{ route('exam.create') }}" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus-1 kt-font-hover-brand"></i>
                        Add Exam
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
                    <th>Title</th>
                    <th>Total Of Questions</th>
                    <th>Status</th>
                    <th>@lang('auth.index_created_by')</th>
                    <th>@lang('auth.index_created_at')</th>
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
                dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                ajax: {
                    url: '{!! route('exam.ajax.data') !!}',
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
                    {data: 'title', name: 'title'},

                    {data: 'total_question', name: 'total_question'},

                    {data: 'visibility', name: 'visibility'},

                    {data: 'written_by', name: 'written_by', visible: true},

                    {data: 'created_at', name: 'created_at', visible: true},

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
                        columns: '0, 1, 2, 3, 4, 5, 6'
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
