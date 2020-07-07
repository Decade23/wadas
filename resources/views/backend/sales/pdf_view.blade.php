<!doctype html>
<html lang="en">
<head>
    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <!--end::Fonts -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="themes/eci/css/style.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->

    <!-- PDF -->
    <link href="themes/eci/css/pages/invoices/invoice-2.css" rel="stylesheet" type="text/css" />
<!-- End PDF -->

</head>
<body>
<div class="kt-invoice-2">
    <div class="kt-invoice__head">
        <div class="kt-invoice__container">
            <div class="kt-invoice__brand">
                <h1 class="kt-invoice__title">INVOICE</h1>

                <div href="#" class="kt-invoice__logo">
                    <a href="#"><img width="203" height="50" src="eci/logo/eci_logo_no_bg.png"></a>
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
                    <span class="kt-invoice__text">{{ $dataDb->order_code }} {!! $dataDb->payment_status_view !!} </span>
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
                            <td>{{ucwords($details->product_group)}}</td>
                            <td>{{ucwords($details->product_name)}}</td>
                            <td>{{ $details->qty }}</td>
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
</div>
</body>

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="themes/eci/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
</html>
