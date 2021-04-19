@extends('backend.layouts.app')

@section('body')

    @include('flash')
    <!--begin::Portlet-->

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-avatar"></i>
                                </span>
                <h3 class="kt-portlet__head-title">
                    {{ $pageTitle }} Form
                </h3>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('exam.store') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="kt-portlet__body">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" data-target="#examPanel">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#questionPanel">Question</a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('backend.apl.exam.create._form_title')
                    @include('backend.apl.exam.create._form_question')
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="kt-portlet__head-wrapper">
                                    <a href="javascript: window.history.back()" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 kt-align-right">
                                <button type="submit" class="btn btn-primary submit">@lang('global.save')</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!--end::Portlet-->
@stop

@push('css')
{{--    <link href="{{ url('themes/eci/css/pages/inbox/inbox.css') }}" rel="stylesheet" type="text/css" />--}}
@endpush

@push('scripts')
    <script src="{{ url('plugins/autonumeric/autoNumeric.js') }}"></script>
{{--    <script src="{{ url('themes/eci/js/pages/custom/inbox/inbox.js') }}"></script>--}}
{{--    <script src="{{ url('themes/eci/js/pages/crud/forms/widgets/tagify.js') }}"></script>--}}
    <script>
        $(function () {
            $('#visibility').select2({
                placeholder: "Select",
                width: '100%',
            });
        });

        function loadCurrency() {
            $("#totalPrice").autoNumeric('init', {aPad: false, aSep: ',', mDec: '0.00'});
        }

        function initializeProduct(){
            $('#product').select2({
                placeholder: "Search Product",
                width: '100%',
                ajax: {
                    url: '{{route('product.ajax.select2')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {

                        return {
                            term: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {

                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        };
                    },
                    //cache: true,
                }
            });
        }

        // initialize
        $(document).ready(function () {
            initializeProduct()
            loadCurrency();
        })

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
@endpush
