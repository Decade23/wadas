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
                    {{ $pageTitle }} Detail
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{ route('sales.pdf', $dataDb->id) }}" class="btn btn-success btn-icon-sm">
                        <i class="flaticon2-paper kt-font-hover-brand"></i>
                        PDF
                    </a>
                    &nbsp;
                </div>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="kt-portlet__body">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" data-target="#productPanel">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#image">Proof Of Payment (Image)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="productPanel" role="tabpanel">
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet">
                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <div class="kt-invoice-2">
                                        <div class="kt-invoice__head">
                                            <div class="kt-invoice__container">
                                                <div class="kt-invoice__brand">
                                                    <h1 class="kt-invoice__title">INVOICE</h1>

                                                    <div href="#" class="kt-invoice__logo">
                                                        <a href="#"><img width="203" height="50" src="{{ url('eci/logo/eci_logo_no_bg.png') }}"></a>
                                                        <span class="kt-invoice__desc">
                                                            <span>Perum Diamond Golden Cinere Blok G/11 RT 001 RW 013 Grogol Limo</span>
                                                            <span>Kota Depok Jawa Barat</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="kt-invoice__items">
                                                    <div class="kt-invoice__item">
                                                        <span class="kt-invoice__subtitle">Order Created At</span>
                                                        <span class="kt-invoice__text">{{ $dataDb->created_at_order }}</span>
                                                    </div>
                                                    <div class="kt-invoice__item">
                                                        <span class="kt-invoice__subtitle">INVOICE NO.</span>
                                                        <span class="kt-invoice__text">{{ $dataDb->order_code }}</span>
                                                    </div>
                                                    @if( $dataDb->customer->address !== null && isset($dataDb->customer->address->subdistrict_id) && $dataDb->customer->address->subdistrict_id != null )
                                                    <div class="kt-invoice__item">
                                                        <span class="kt-invoice__subtitle">INVOICE TO.</span>
                                                        <span class="kt-invoice__text">{{$dataDb->customer->address !== null ? $dataDb->customer->address->address . strip_tags('<br />') : ''}} {{isset($dataDb->customer->address->subdistrict_id) && $dataDb->customer->address->subdistrict_id != null ? $dataDb->customer->address->subdistrict->urban . ', ' . $dataDb->customer->address->subdistrict->sub_district . ', ' . $dataDb->customer->address->subdistrict->city . ' ' . $dataDb->customer->address->subdistrict->postal_code : ''}}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-invoice__body">
                                            <div class="kt-invoice__container">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Product Type</th>
                                                            <th>Product Name</th>
                                                            <th>Product Qty</th>
                                                            <th>Product Unit Price</th>
                                                            <th>Product Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($dataDb->details as $details)
                                                        <tr>
                                                            <td class="text-center">{{ucwords($details->product_group)}}</td>
                                                            <td class="text-center">{{ucwords($details->product_name)}}</td>
                                                            <td class="text-center">{{ $details->qty }}</td>
                                                            <td>Rp. {{number_format($details->product_unit_price)}}</td>
                                                            <td class="kt-font-brand kt-font-lg">Rp. {{number_format($details->product_price)}}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-invoice__footer">
                                            <div class="kt-invoice__container">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            @if($dataDb->payment_status == 'unpaid')
                                                            <th>BANK</th>
                                                            <th>ACC.NO.</th>
                                                            <th>DUE DATE</th>
                                                            @endif
                                                            <th>TOTAL AMOUNT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            @if($dataDb->payment_status == 'unpaid')
                                                            <td>BANK BCA</td>
                                                            <td>12345678909</td>
                                                            <td>{{ $dataDb->due_date_order }}</td>
                                                            @endif
                                                            <td class="kt-font-brand kt-font-xl kt-font-boldest">Rp. {{ number_format($dataDb->total_price) }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-invoice__actions">
                                            <div class="kt-invoice__container">
{{--                                                <button type="button" class="btn btn-label-brand btn-bold" onclick="window.print();">Download Invoice</button>--}}
                                                <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Print Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="image" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                @if( isset($dataDb->media) && count($dataDb->media) > 0)
                                    @foreach($dataDb->media as $doc)
                                        <div class="responsive">
                                            <div class="gallery">
                                                <a target="_blank" href="{{ $doc->url }}">
                                                    <img src="{{ $doc->url }}" alt="{{ $doc->file_name }}" width="600" height="400">
                                                </a>
                                                <div class="desc">Upload By: {{ $doc->created_by }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
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
                                <a href="{{ route('sales.edit', $dataDb->id) }}" class="btn btn-primary submit">
                                    @lang('global.update')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!--end::Portlet-->
@stop

@push('css')
    <link href="{{ url('themes/eci/css/pages/invoices/invoice-2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('themes/eci/css/custom/gallery.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
@endpush
