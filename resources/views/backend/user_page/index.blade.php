@extends('backend.layouts.app')

@section('body')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                <h3 class="kt-portlet__head-title">
                    Local Datasource
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="javascript: window.history.back()" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                    &nbsp;
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon2-plus"></i> Add New
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__section kt-nav__section--first">
                                    <span class="kt-nav__section-text">Choose an action:</span>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-open-text-book"></i>
                                        <span class="kt-nav__link-text">Reservations</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                        <span class="kt-nav__link-text">Appointments</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-bell-alarm-symbol"></i>
                                        <span class="kt-nav__link-text">Reminders</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                                        <span class="kt-nav__link-text">Announcements</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-shopping-cart-1"></i>
                                        <span class="kt-nav__link-text">Orders</span>
                                    </a>
                                </li>
                                <li class="kt-nav__separator kt-nav__separator--fit">
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-rocket-1"></i>
                                        <span class="kt-nav__link-text">Projects</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-chat-1"></i>
                                        <span class="kt-nav__link-text">User Feedbacks</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
{{--                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">--}}
{{--                                <div class="kt-input-icon kt-input-icon--left">--}}
{{--                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">--}}
{{--                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">--}}
{{--                                        <span><i class="la la-search"></i></span>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Status:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_status">
                                            <option value="">All</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Delivered</option>
                                            <option value="3">Canceled</option>
                                            <option value="4">Success</option>
                                            <option value="5">Info</option>
                                            <option value="6">Danger</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Type:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a href="#" class="btn btn-default kt-hidden">
                            <i class="la la-cart-plus"></i> New Order
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
{{--            <div class="kt-datatable" id="local_data"></div>--}}
            <table class="table table-striped- table-bordered table-hover table-checkable" id="user_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Gender</th>
                    <th>Last Login</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
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

    <script>
        $(function () {
            let table;
            table = $('#user_table').DataTable({
                aaSorting: [[0, 'desc']],
                iDisplayLength: 25,
                //stateSave: true,
                // responsive: true,
                // scrollX: !0,
                fixedHeader: true,
                deferRender: !0,
                responsive: !0,
                processing: true,
                serverSide: true,
                // scrollY: "500px",
                // scrollCollapse: !0,
                // scroller: !0,
                //select: !0, // select by 1
                select: {
                    style: "multi",
                    selector: "td:first-child .kt-checkable"
                },
                headerCallback: function(e, t, a, s, n) {
                    e.getElementsByTagName("th")[0].innerHTML = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand"><input type="checkbox" value="" class="kt-group-checkable"><span></span></label>';
                },
                dom: "<'dt-panelmenu clearfix'<'row'<'col-sm-2'B><'col-sm-4'l><'col-sm-6'f>>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'dt-panelfooter clearfix'<'row'<'col-sm-5'i><'col-sm-7'p>>>",
                pagingType: "full_numbers",
                ajax: {
                    url: '{!! route('user.ajax.data') !!}',
                    dataType: 'json',
                    data: function (d) {
                        d.param = 1;
                    }
                },
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {
                        data: 'checkbox', name: 'checkbox', orderable: false, searchable: false,
                        checkboxes: true
                    },
                    {data: 'email', name: 'email'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'type', name: 'type'},
                    {data: 'gender', name: 'gender'},
                    {data: 'last_login', name: 'last_login'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'updated_by', name: 'updated_by'},

                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},

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
                        columns: '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10'
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

    <script>
        "use strict";
        var DataTablesLoad = {
            init: function() {
                var e;
                 (e = $("#user_table_kt").DataTable({
                     responsive: !0,
                     aaSorting: [[0, 'desc']],
                     iDisplayLength: 25,
                     // //stateSave: true,
                     // scrollX: !0,
                     fixedHeader: true,
                     deferRender: !0,
                     processing: true,
                     serverSide: true,
                     // scrollY: "500px",
                     // scrollCollapse: !0,
                     // scroller: !0,
                     //select: !0, // select by 1
                     ajax: {
                         url: '{!! route('user.ajax.data') !!}',
                         dataType: 'json',
                         data: function (d) {
                             d.param = 1;
                         }
                     },
                     columns: [
                         {data: 'id', name: 'id', visible: false},
                         {
                             data: 'checkbox', name: 'checkbox', orderable: false, searchable: false,
                             checkboxes: true
                         },
                         {data: 'email', name: 'email'},
                         {data: 'name', name: 'name'},
                         {data: 'phone', name: 'phone'},
                         {data: 'type', name: 'type'},
                         {data: 'gender', name: 'gender'},
                         {data: 'last_login', name: 'last_login'},
                         {data: 'created_by', name: 'created_by'},
                         {data: 'updated_by', name: 'updated_by'},

                         {data: 'created_at', name: 'created_at'},
                         {data: 'updated_at', name: 'updated_at'},

                         // {
                         //     data: 'action', name: 'action', orderable: false, searchable: false,
                         //     fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                         //         $("a", nTd).tooltip({container: 'body'});
                         //     }
                         // }
                     ],
                    select: {
                        style: "multi",
                        selector: "td:first-child .kt-checkable"
                    },
                    headerCallback: function(e, t, a, s, n) {
                        e.getElementsByTagName("th")[0].innerHTML = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand">                        <input type="checkbox" value="" class="kt-group-checkable">                        <span></span>                    </label>'
                    },
                    columnDefs: [{
                        targets: 1,
                        orderable: !1,
                        render: function(e, t, a, s) {
                            return '                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand">                            <input type="checkbox" value="" class="kt-checkable">                            <span></span>                        </label>'
                        }
                    }]
                })).on("change", ".kt-group-checkable", function() {
                    var t = $(this).closest("table").find("td:first-child .kt-checkable"),
                        a = $(this).is(":checked");
                    $(t).each(function() {
                        a ? ($(this).prop("checked", !0), e.rows($(this).closest("tr")).select()) : ($(this).prop("checked", !1), e.rows($(this).closest("tr")).deselect())
                    })
                })
            }
        };

        jQuery(document).ready(function() {
            DataTablesLoad.init()
        });
    </script>
@endpush
