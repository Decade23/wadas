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

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('sales.update', $dataDb->id) }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {{ method_field('PUT') }}

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
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group @if($errors->has('orderDate')) validated @endif">
                                    <label @if($errors->has('orderDate')) class="text-danger" @endif>Order Date<span style="color: red">*</span></label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" name="orderDate" id="orderDate" class="form-control @if($errors->has('orderDate')) is-invalid @endif" placeholder="Order Date" value="{{ old('orderDate', $dataDb->order_date) }}" readonly>
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                            <span><i class="la la-calendar"></i></span>
                                        </span>
                                    </div>
                                    {!! $errors->first('orderDate', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group @if($errors->has('type')) validated @endif">
                                    <label @if($errors->has('type')) class="text-danger" @endif>Order Type<span style="color: red">*</span></label>
                                    <select name="type" id="type" class="form-control @if($errors->has('type')) is-invalid @endif kt-select2">
                                        <option></option>

                                        <option value="wa" @if(old('type', $dataDb->type) === 'wa') selected @endif>Whatsapp</option>
                                        <option value="web" @if(old('type', $dataDb->type) === 'web') selected @endif>Website</option>
                                    </select>
                                    {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group @if($errors->has('paymentStatus')) validated @endif">
                                    <label @if($errors->has('paymentStatus')) class="text-danger" @endif>Payment Status<span style="color: red">*</span></label>
                                    <select name="paymentStatus" id="paymentStatus" class="form-control @if($errors->has('paymentStatus')) is-invalid @endif kt-select2">
                                        <option></option>

                                        <option value="unpaid" @if(old('paymentStatus', $dataDb->payment_status) === 'unpaid') selected @endif>Unpaid</option>
                                        <option value="cancel" @if(old('paymentStatus', $dataDb->payment_status) === 'cancel') selected @endif>Cancel</option>
                                        <option value="paid" @if(old('paymentStatus', $dataDb->payment_status) === 'paid') selected @endif>Paid</option>
                                    </select>
                                    {!! $errors->first('paymentStatus', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group @if($errors->has('bank_id')) validated @endif">
                                    <label @if($errors->has('bank_id')) class="text-danger" @endif>Paid To</label>
                                    <select name="bank_id" id="bank_id" class="form-control @if($errors->has('bank_id')) is-invalid @endif kt-select2">
                                        <option></option>
                                    </select>
                                    {!! $errors->first('bank_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <hr class="divider-short">
                            </div>
                            <div class="col-lg-4">
                                <input type="hidden" name="member[id]" id="memberId" value="{{$dataDb->customer->id}}">
                                <div class="form-group @if($errors->has('member.name')) validated @endif">
                                    <label @if($errors->has('member.name')) class="text-danger" @endif>Member Name<span style="color: red">*</span></label>
                                    <input type="text" name="member[name]" id="name" class="form-control @if($errors->has('member.name')) is-invalid @endif" placeholder="Enter Member Name ...*" value="{{ old('member.name', $dataDb->customer->name) }}" readonly>
                                    {!! $errors->first('member.name', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="hidden" name="member[id]" id="memberId" value="{{$dataDb->customer->id}}">
                                <div class="form-group @if($errors->has('member.email')) validated @endif">
                                    <label @if($errors->has('member.email')) class="text-danger" @endif>Member Email<span style="color: red">*</span></label>
                                    <input type="text" name="member[email]" id="name" class="form-control @if($errors->has('member.email')) is-invalid @endif" placeholder="Enter Member Email ...*" value="{{ old('member.email', $dataDb->customer->email) }}" readonly>
                                    {!! $errors->first('member.email', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('member.phone')) validated @endif">
                                    <label @if($errors->has('member.phone')) class="text-danger" @endif>Member Phone<span style="color: red">*</span></label>
                                    <input type="text" name="member[phone]" id="phone" class="form-control @if($errors->has('member.phone')) is-invalid @endif" placeholder="Enter Member Phone ...*" value="{{ old('member.phone', $dataDb->customer->phone) }}" readonly>
                                    {!! $errors->first('member.phone', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group @if($errors->has('member.address.address')) validated @endif">
                                    <label @if($errors->has('member.address.address')) class="text-danger" @endif>Address</label>
                                    <textarea name="member[address][address]" id="address" cols="24" rows="2" class="form-control @if($errors->has('member.address.address')) is-invalid @endif" placeholder="Enter Member Address ...*" readonly>{!! old('member.address.address', $dataDb->customer->address !== null ? $dataDb->customer->address->address : '') !!}</textarea>
                                    {!! $errors->first('member.address.address', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('member.address.subdistrict_id')) validated @endif">
                                    <label @if($errors->has('member.address.subdistrict_id')) class="text-danger" @endif>City Or Subdistrict</label>
                                    <select name="member[address][subdistrict_id]" id="subdistrict" class="form-control @if($errors->has('member.address.subdistrict_id')) is-invalid @endif kt-select2">
                                        <option></option>
                                    </select>
                                    {!! $errors->first('member.address.subdistrict_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('member.address.province')) validated @endif">
                                    <label @if($errors->has('member.address.province')) class="text-danger" @endif>Province</label>
                                    <input type="text" name="member[address][province]" id="province" class="form-control @if($errors->has('member.address.province')) is-invalid @endif" placeholder="Province" value="{{$dataDb->customer->address !== null ? $dataDb->customer->address->province : ''}}" readonly>
                                    {!! $errors->first('member.address.province', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('member.address.postal_code')) validated @endif">
                                    <label @if($errors->has('member.address.postal_code')) class="text-danger" @endif>Postal Code</label>
                                    <input type="text" name="member[address][postal_code]" id="postalCode" class="form-control @if($errors->has('member.address.postal_code')) is-invalid @endif" placeholder="Postal Code" value="{{$dataDb->customer->address !== null ? $dataDb->customer->address->postal_code : ''}}" readonly>
                                    {!! $errors->first('member.address.postal_code', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <hr class="divider-short">

                                <table class="table table-hover table-striped" id="product-container">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th width="150">Product Type</th>
                                        <th width="100">Qty</th>
                                        <th width="150" class="text-right">Unit Price</th>
                                        <th width="150" class="text-right">Price</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">
                                            Total :
                                        </th>
                                        <th colspan="1" class="text-right"><span><strong>Rp. {{number_format($dataDb->total_price)}}</strong></span></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($dataDb->details as $detail)
                                    <tr>
                                        <td>
                                            {{$detail->product_name}}
                                            <input type="hidden" name="products[{{$detail->id}}][qty]" value="{{$detail->qty}}">
                                            <input type="hidden" name="products[{{$detail->id}}][product_id]" value="{{$detail->product_id}}">
                                            <input type="hidden" name="products[{{$detail->id}}][product_time_period]" value="{{$detail->product_time_period}}">
                                        </td>
                                        <td>
                                            <input type="hidden" name="products[{{$detail->id}}][product_group]" value="{{$detail->product_group}}">
                                            {{$detail->product_group}}
                                        </td>
                                        <td>{{$detail->qty}}</td>
                                        <td class="text-right">Rp. {{number_format($detail->product_unit_price)}}</td>
                                        <td class="text-right">Rp. {{number_format($detail->product_price)}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="tab-pane" id="image" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group @if($errors->has('file')) validated @endif">
                                    <label @if($errors->has('file')) class="text-danger" @endif>Files</label>
                                    <div class="dropzone dropzone-default dropzone-brand" id="file">
                                        <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                        <span class="dropzone-msg-desc">Upload up to 10 files</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" id="previews">
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
                                <button type="submit" class="btn btn-primary submit">@lang('global.update')</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!--end::Portlet-->
@stop

@push('css')
@endpush

@push('scripts')
    <script src="{{ url('plugins/autonumeric/autoNumeric.js') }}"></script>
    <script>
        $(function () {

            //$('#description').summernote();

            $('#price').autoNumeric('init', {currencySymbol: 'Rp. ', aPad: false, aSep: ',', mDec: '0.00'});

            $('#paymentStatus, #type, #bank_id').select2({
                placeholder: "Select",
                width: '100%',
            });

            $('#subdistrict').select2({
                placeholder: "Search City Or Subdistrict",
                width: '100%',
                disabled:true,
                //tags: true,
                ajax: {
                    url: '{{route('subdistrict.ajax.select2')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term,
                            page: params.page,
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
                    cache: true,
                }
            });

            //change subdistrict
            $('#subdistrict').on("change", function (e) {

                const select2Data = $(this).select2("data");

                if(typeof select2Data[0].province !== "undefined"){
                    $('#province').val(select2Data[0].province.name);
                }

                if(typeof select2Data[0].province !== "undefined") {
                    $('#postalCode').val(select2Data[0].postal_code)
                }
            });

            @if(isset($dataDb->customer->address->subdistrict_id) && $dataDb->customer->address->subdistrict_id != null )
            $('#subdistrict').append('<option value="{{$dataDb->customer->address->subdistrict_id}}" selected="selected">{{$dataDb->customer->address->subdistrict->urban . ', ' . $dataDb->customer->address->subdistrict->sub_district . ', ' . $dataDb->customer->address->subdistrict->city}}</option>');
            @endif

            var uploadedDocumentMap = new Array();
            $("#file").dropzone({
                url: '{!! route('sales.upload.image') !!}',
                paramName: "file",
                maxFiles: 10,
                maxFilesize: 10,
                addRemoveLinks: !0,
                acceptedFiles: "image/*",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                accept: function (e, o) {
                    "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o();
                    //console.log('e: '+ e)
                    //console.log('o: '+ o)
                },
                init: function (file) {
                    //let myDropZone = this;
                    //let i = 0;
                    load_images_old()

                    // action for handling after click remove file
                    this.on("removedfile", function (file) {

                    }),
                        // action for handling after added file
                        this.on("addedfile", function(file) {

                        });
                    // action for handling uploadprogress
                    this.on("uploadprogress", function(file) {
                        $('.submit').attr('disabled', true); // disable submit
                    });
                },
                // action for hadling if success upload
                success: function (file, response) {
                    let fileName = getFileName(response);

                    //append to input document
                    $('form').append('<input type="hidden" name="document[]" value="' + fileName + '">');

                    //append data to array
                    uploadedDocumentMap.push(fileName);

                    //alert($('input[name="document[]"]').map(function(){return $(this).val()}).get());
                    // console.log('add input: '+ $('input[name="document[]"]').map(function(){return $(this).val()}).get());

                    //remove file from preview
                    file.previewElement.remove();
                    load_images()
                    $('.submit').attr('disabled', false); // enable submit

                },
                // action for handling sending others parameters like csrf
                sending: function(file, xhr, formData){
                    //$('.submit').attr('disabled', true); // disable submit
                    //formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    //console.log('file: '+file + ' xhr: '+ xhr +' formData: '+ formData);
                },
                // action for handling canceled
                canceled: function(file, xhr, formData){
                    $('.submit').attr('disabled', false); // enable submit
                },
                // action for handling error
                error: function(err) {
                    //console.log(err);
                }
            });
            // array conversion
            function getFileName(path)
            {
                let arr = path.split("/");
                let val = arr.slice(-1);
                return val[0];
            }

            function load_images()
            {
                let data;
                data = {
                    'fileNames': uploadedDocumentMap
                }

                $.ajax({
                    url:"{{ route('sales.retrieve_create.image') }}",
                    method: 'POST',
                    data: data,
                    //cache: false,
                    success:function(data)
                    {
                        $('#previews').html(data);
                    }
                })
            }

            function load_images_old()
            {
                let data;
                @if(old('document') && count(old('document')))
                    uploadedDocumentMap = new Array();
                @foreach(old('document') as $fileName )
                uploadedDocumentMap.push( '{!! $fileName !!}' );
                @endforeach

                    data = {
                    'fileNames': uploadedDocumentMap
                }
                @elseif($dataDb->media->isNotEmpty())
                    uploadedDocumentMap = new Array();
                @foreach($dataDb->media as $fileName )
                //append to input document and data array
                $('form').append('<input type="hidden" name="document[]" value="' + '{{ $fileName->file_name }}' + '">');
                uploadedDocumentMap.push( '{!! $fileName->file_name !!}' );
                @endforeach
                console.log(uploadedDocumentMap)
                data = {
                    'fileNames': uploadedDocumentMap
                }

                @endif

                $.ajax({
                    url:"{{ route('sales.retrieve_create.image') }}",
                    method: 'POST',
                    data: data,
                    //cache: false,
                    success:function(data)
                    {
                        $('#previews').html(data);
                    }
                })
            }

            // event remove file
            $(document).on('click', '.remove_image', function(){
                $('.submit').attr('disabled', true); // disable submit
                var name = $(this).attr('id');

                $.ajax({
                    url:"{{ route('sales.delete.image') }}",
                    data:{name : name},
                    method: 'DELETE',
                    //cache: false,
                    success:function(data){
                        $('.submit').attr('disabled', false); // enable submit
                        uploadedDocumentMap = removeArr(uploadedDocumentMap, name);
                        removeInputDocArray(name);
                        $.each(uploadedDocumentMap, function(i, e) {
                            $('form').append('<input type="hidden" name="document[]" value="' + e + '">');
                        })

                        load_images();

                    },
                    error: function(err) {
                        //console.log(err);
                    }
                })
            });

        });

        function removeArr(arr, remove)
        {
            const index = arr.indexOf(remove);

            if (index > -1) {
                arr.splice(index, 1);
                return arr;
            }
        }

        function removeInputDocArray(remove)
        {
            const index = $("input[name='document[]']").attr('value', remove);
            index.remove();
        }

        function loadCurrency() {
            $("#totalPrice").autoNumeric('init', {aPad: false, aSep: ',', mDec: '0.00'});
        }

        // initialize
        $(document).ready(function () {
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
