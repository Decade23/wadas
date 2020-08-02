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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group @if($errors->has('from')) validated @endif">
                                    <label @if($errors->has('from')) class="text-danger" @endif>From<span style="color: red">*</span></label>
                                    <select name="from" id="from" class="form-control @if($errors->has('from')) is-invalid @endif kt-select2">
                                        <option></option>
                                    </select>
                                    {!! $errors->first('from', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group @if($errors->has('recipient')) validated @endif">
                                    <label @if($errors->has('recipient')) class="text-danger" @endif>To<span style="color: red">*</span></label>
                                    <input type="text" name="recipient" id="recipient" placeholder="Enter Email" value="{{ old('recipient') }}" autofocus>
                                    {!! $errors->first('recipient', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
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
    <link href="{{ url('themes/eci/css/pages/inbox/inbox.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ url('plugins/autonumeric/autoNumeric.js') }}"></script>
    <script src="{{ url('themes/eci/js/pages/custom/inbox/inbox.js') }}"></script>
{{--    <script src="{{ url('themes/eci/js/pages/crud/forms/widgets/tagify.js') }}"></script>--}}
    <script>
        $(function () {

            // tagify recipient
            //$('#recipient').tagify();
            var bccEl = document.querySelector('input[id=recipient]');;
            var tagifyBcc = new Tagify(bccEl, {
                delimiters: ", ", // add new tags when a comma or a space character is entered
                maxTags: 10,
                blacklist: ["fuck", "shit", "pussy"],
                keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                whitelist: [
                    {
                    value: 'Chris Muller',
                    email: 'chris.muller@wix.com',
                    initials: '',
                    initialsState: '',
                    pic: './assets/media/users/100_11.jpg',
                    class: 'tagify__tag--primary'
                }, {
                    value: 'Nick Bold',
                    email: 'nick.seo@gmail.com',
                    initials: 'SS',
                    initialsState: 'warning',
                    pic: ''
                }, {
                    value: 'Alon Silko',
                    email: 'alon@keenthemes.com',
                    initials: '',
                    initialsState: '',
                    pic: './assets/media/users/100_6.jpg'
                }, {
                    value: 'Sam Seanic',
                    email: 'sam.senic@loop.com',
                    initials: '',
                    initialsState: '',
                    pic: './assets/media/users/100_8.jpg'
                }, {
                    value: 'Sara Loran',
                    email: 'sara.loran@tilda.com',
                    initials: '',
                    initialsState: '',
                    pic: './assets/media/users/100_9.jpg'
                }, {
                    value: 'Eric Davok',
                    email: 'davok@mix.com',
                    initials: '',
                    initialsState: '',
                    pic: './assets/media/users/100_13.jpg'
                }, {
                    value: 'Sam Seanic',
                    email: 'sam.senic@loop.com',
                    initials: '',
                    initialsState: '',
                    pic: './assets/media/users/100_13.jpg'
                }, {
                    value: 'Lina Nilson',
                    email: 'lina.nilson@loop.com',
                    initials: 'LN',
                    initialsState: 'danger',
                    pic: './assets/media/users/100_15.jpg'
                }],
                templates: {
                    dropdownItem: function(tagData) {
                        try {
                            var html = '';

                            html += '<div class="tagify__dropdown__item">';
                            html += '   <div class="d-flex align-items-center">';
                            html += '       <span class="symbol sumbol-' + (tagData.initialsState ? tagData.initialsState : '') + ' mr-2" style="background-image: url(\''+ (tagData.pic ? tagData.pic : '') + '\')">';
                            html += '           <span class="symbol-label">' + (tagData.initials ? tagData.initials : '') + '</span>';
                            html += '       </span>';
                            html += '       <div class="d-flex flex-column">';
                            html += '           <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">'+ (tagData.value ? tagData.value : '') + '</a>';
                            html += '           <span class="text-muted font-weight-bold">' + (tagData.email ? tagData.email : '') + '</span>';
                            html += '       </div>';
                            html += '   </div>';
                            html += '</div>';

                            return html;
                        } catch (err) {}
                    }
                },
                transformTag: function(tagData) {
                    tagData.class = 'tagify__tag tagify__tag--primary';
                },
                dropdown: {
                    classname: "color-blue",
                    enabled: 1,
                    maxItems: 5
                }
            });

            $('#from').select2({
                placeholder: "Search Email Sender",
                width: '100%',
                //tags: true,
                ajax: {
                    url: '{{route('apl_email.ajax.select2_config')}}',
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

        //For Place To Check Item Same Or Not
        let productData = [];

        //Ready For Append Html Form
        function htmlProduct(data) {

            let productHtml = '<tr id="product-row-' + data.id + '">';
            productHtml += '<td>';
            productHtml += data.name;
            productHtml += '<input type="hidden" name="products[' + data.id + '][product_id]" value="'+data.id+'">';
            productHtml += '<input type="hidden" name="products[' + data.id + '][product_name]" value="'+data.name+'">';
            productHtml += '<input type="hidden" class="typeTotal" name="products[' + data.id + '][product_group]" value="'+data.groups[0].name+'">';
            productHtml += '<input type="hidden" name="products[' + data.id + '][product_time_period]" value="'+data.time_period+'">';
            productHtml += '<input type="hidden" id="unitPrice'+ data.id +'" name="products[' + data.id + '][product_unit_price]" value="'+data.price+'">';
            productHtml += '</td>';

            productHtml += '<td>';
            productHtml += data.groups[0].name;
            productHtml += '</td>';

            productHtml += '<td><input onchange="qty('+ data.id +')" type="text" name="products[' + data.id + '][qty]" value="1" class="form-control input-sm" id="quantity'+data.id+'"></td>';

            productHtml += '<td class="text-right"> Rp. '+ addCommas(data.price.replace('.00', '')) +'</td>';

            productHtml += '<td class="text-right">';
            productHtml += '<span id="priceText'+data.id+'">Rp. '+ addCommas(data.price.replace('.00', '')) +'</span>'
            productHtml += '<input type="hidden" name="products[' + data.id + '][product_price]" id="price'+ data.id +'" value="'+data.price.replace('.00', '')+'" class="price">';
            productHtml += '</td>';

            productHtml += '<td class="text-center">';
            productHtml += '<i class="fa fa-times" style="color: red;" onclick="removeProductList(' + data.id + ')"></i>';
            productHtml += '</td>';
            productHtml += '</tr>';

            $('#product-container tbody').append(productHtml);
        }

        //To Remove Product Row
        function removeProductList(productId) {

            //console.log(productId);
            $('#product-row-' + productId).remove();

            qty(productId);

            //Remove item in jquery array data
            productData.splice(productData.indexOf(productId.toString()), 1);

        }

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

        function addTotalPrice(price) {
            $('#totalPriceHidden').val(price);
            $('#totalPrice').text('Rp. ' + addCommas(price));
        }

        function qty(rowIndex) {
            let unitPrice = $('#unitPrice' + rowIndex).val();
            let qty = $('#quantity' + rowIndex).val();

            let price = parseFloat(unitPrice) * parseFloat(qty);

            $('#priceText' + rowIndex).text('Rp. ' + addCommas(price));
            $('#price' + rowIndex).val(price);

            let totalPrice = 0;
            $('.price').each(function () {
                totalPrice += parseInt($(this).val());
            });

            addTotalPrice(totalPrice);
        }

    </script>
@endpush
