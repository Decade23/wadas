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
                    Update Product
                </h3>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('product.update', $dataDb->id) }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {{ method_field('PUT') }}

            <div class="kt-portlet__body">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" data-target="#product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#image">Image</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="product" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('group')) validated @endif">
                                    <label @if($errors->has('group')) class="text-danger" @endif>Group<span style="color: red">*</span></label>
                                    <select name="group" id="group" class="form-control @if($errors->has('group')) is-invalid @endif kt-select2">
                                        <option></option>
                                        @if($dataDb->groups->isNotEmpty())
                                            <option value="{{ $dataDb->groups[0]->id }}" selected>{{ $dataDb->groups[0]->name }}</option>
                                        @endif
                                    </select>
                                    {!! $errors->first('group', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('name')) validated @endif">
                                    <label @if($errors->has('name')) class="text-danger" @endif>Name<span style="color: red">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Enter Name" value="{{ old('name',$dataDb->name) }}">
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('short_desc')) validated @endif">
                                    <label @if($errors->has('short_desc')) class="text-danger" @endif>Short Description<span style="color: red">*</span></label>
                                    <input type="text" name="short_desc" id="short_desc" class="form-control @if($errors->has('short_desc')) is-invalid @endif" placeholder="Enter Short Desc" value="{{ old('short_desc',$dataDb->short_desc) }}">
                                    {!! $errors->first('short_desc', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group @if($errors->has('description')) validated @endif">
                                    <label @if($errors->has('description')) class="text-danger" @endif>Description<span style="color: red">*</span></label>
                                    <textarea name="description" id="description" cols="24" rows="10" class="form-control @if($errors->has('description')) is-invalid @endif">{!! old('description',$dataDb->description) !!}</textarea>
                                    {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('visibility')) validated @endif">
                                    <label @if($errors->has('visibility')) class="text-danger" @endif>Visibility<span style="color: red">*</span></label>
                                    <select name="visibility" id="visibility" class="form-control @if($errors->has('visibility')) is-invalid @endif kt-select2">
                                        <option value="publish" @if(old('visibility',$dataDb->visibility) == 'publish') selected="selected" @endif >Publish</option>
                                        <option value="private" @if(old('visibility',$dataDb->visibility) == 'private') selected="selected" @endif >Private</option>
                                    </select>
                                    {!! $errors->first('visibility', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('price')) validated @endif">
                                    <label @if($errors->has('price')) class="text-danger" @endif>Price<span style="color: red">*</span></label>
                                    <input type="text" name="price" id="price" class="form-control @if($errors->has('price')) is-invalid @endif" placeholder="Enter Price" value="{{ str_replace(',', '', old('price',$dataDb->price)) }}">
                                    {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
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
                                        {{--                                        <div class="dropzone-msg dz-message needsclick"> <!-- class needsclick -->--}}
                                        {{--                                            <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>--}}
                                        {{--                                            <span class="dropzone-msg-desc">Upload up to 10 files</span>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            {{--                            <input type="hidden" name="document[]" value="">--}}
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
            $('#description').summernote();

            $('#price').autoNumeric('init', {currencySymbol: 'Rp. ', aPad: false, aSep: ',', mDec: '0.00'});

            $('#visibility').select2({
                placeholder: "Select",
                width: '100%',
            });

            $('#group').select2({
                placeholder: "Select",
                width: '100%',
                //tags: true,
                ajax: {
                    url: '{{route('product_group.ajax.select2')}}',
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
                url: '{!! route('product.upload.image') !!}',
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
                let arr = path.split("/"); // make to array
                let val = arr.slice(-1); //get last array
                return val[0];
            }

            function load_images()
            {
                let data;
                data = {
                    'fileNames': uploadedDocumentMap
                }

                $.ajax({
                    url:"{{ route('product.retrieve.image') }}",
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
                    url:"{{ route('product.retrieve.image') }}",
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
                    url:"{{ route('product.delete.image') }}",
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
                        //console.log(uploadedDocumentMap)
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

    </script>
@endpush
