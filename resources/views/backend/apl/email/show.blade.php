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
                    {{ $pageTitle }} Show
                </h3>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="#" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="kt-portlet__body">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" data-target="#productPanel">Compose</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#image">Attachment</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="productPanel" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>From</b><span style="color: red">*</span></label>
                                    <p>{{ $dataDb['compose']->from }}</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Recipient Group</b><span style="color: red">*</span></label>
                                    <p>{{ $dataDb['compose']->group }}</p>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Recipient To</b><span style="color: red">*</span></label>
                                    <p>{{ $dataDb['compose']->recipient }}</p>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Recipient CC</b><span style="color: red">*</span></label>
                                    <p>{{ $dataDb['compose']->cc }}</p>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Recipient BCC</b><span style="color: red">*</span></label>
                                    <p>{{ $dataDb['compose']->bcc }}</p>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Subject</b><span style="color: red">*</span></label>
                                    <p>{{ $dataDb['compose']->title }}</p>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Body</b><span style="color: red">*</span></label>
                                    <p>{!! $dataDb['compose']->body !!}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="image" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ( is_array( $dataDb['compose']->attachments_media ) && count( $dataDb['compose']->attachments_media ) > 0  )
                                    @foreach ( $dataDb['compose']->attachments_media as $doc )
                                        <div class="responsive">
                                            <div class="gallery">
                                                <a target="_blank" href="{{ $doc->url }}">
                                                    <img class="text-break" src="{{ $doc->url }}" alt="{{ $doc->file_name }}" width="600" height="400">
                                                </a>
                                                <div class="desc text-break">Upload By: {{ $doc->created_by }}</div>
                                            </div>
                                        </div>      
                                    @endforeach
                                @else
                                        <p class="text-body">there's no attachment</p>
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
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!--end::Portlet-->
@stop

@push('css')
<link href="{{ url('themes/eci/css/custom/gallery.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')

    <script>
        $(function () {
            $('#body_email').summernote();
            // tagify recipient
            //$('#recipient').tagify();
            var bccEl = document.querySelector('input[id=recipient]');
            var cc = document.querySelector('input[id=cc]');
            var bcc = document.querySelector('input[id=bcc]');
            var blastGroup = document.querySelector('input[id=group]');
            var tagifyTo = new Tagify(bccEl, {
                delimiters: ", ", // add new tags when a comma or a space character is entered
                maxTags: 10,
                blacklist: ["fuck", "shit", "pussy"],
                keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                whitelist:[],
                // [
                //     {
                //     value: 'Chris Muller',
                //     email: 'chris.muller@wix.com',
                //     initials: '',
                //     initialsState: '',
                //     pic: './assets/media/users/100_11.jpg',
                //     class: 'tagify__tag--primary'
                // }, {
                //     value: 'Nick Bold',
                //     email: 'nick.seo@gmail.com',
                //     initials: 'SS',
                //     initialsState: 'warning',
                //     pic: ''
                // }, {
                //     value: 'Alon Silko',
                //     email: 'alon@keenthemes.com',
                //     initials: '',
                //     initialsState: '',
                //     pic: './assets/media/users/100_6.jpg'
                // }, {
                //     value: 'Sam Seanic',
                //     email: 'sam.senic@loop.com',
                //     initials: '',
                //     initialsState: '',
                //     pic: './assets/media/users/100_8.jpg'
                // }, {
                //     value: 'Sara Loran',
                //     email: 'sara.loran@tilda.com',
                //     initials: '',
                //     initialsState: '',
                //     pic: './assets/media/users/100_9.jpg'
                // }, {
                //     value: 'Eric Davok',
                //     email: 'davok@mix.com',
                //     initials: '',
                //     initialsState: '',
                //     pic: './assets/media/users/100_13.jpg'
                // }, {
                //     value: 'Sam Seanic',
                //     email: 'sam.senic@loop.com',
                //     initials: '',
                //     initialsState: '',
                //     pic: './assets/media/users/100_13.jpg'
                // }, {
                //     value: 'Lina Nilson',
                //     email: 'lina.nilson@loop.com',
                //     initials: 'LN',
                //     initialsState: 'danger',
                //     pic: './assets/media/users/100_15.jpg'
                // }],
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

            // tagify cc
            var tagifyCC = new Tagify(cc, {
                delimiters: ", ", // add new tags when a comma or a space character is entered
                maxTags: 10,
                blacklist: ["fuck", "shit", "pussy"],
                keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                whitelist:[],
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

            // tagify bcc
            var tagifyBCC = new Tagify(bcc, {
                delimiters: ", ", // add new tags when a comma or a space character is entered
                maxTags: 10,
                blacklist: ["fuck", "shit", "pussy"],
                keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                whitelist:[],
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

            // tagify to user
            tagifyTo.on('input', onInput);

            // tagify cc user
            tagifyCC.on('input', onInputCC);

            // tagify bcc user
            tagifyBCC.on('input', onInputBCC);

            function onInput(e)
            {
                // console.log(e);
                // console.log(e.detail.value);
                var value_ = e.detail.value;
                tagifyTo.settings.whitelist.length = 0; // reset the whitelist.

                // ajax
                var uri = '{!! route("apl_email.ajax.tagify") !!}';
                // controller = new AbortController();
                // controller && controller.abort();

                $.ajax({
                    url: uri,
                    method: 'GET',
                    data: { 'term': value_ },
                    //cache: false,
                    success:function(val)
                    {
                        //console.log(val);
                        let values = [];

                        $.each(val.data, function(v, d) {
                            //var client += '{value: '+ d.name + ',' + 'email:' + d.text + '},';
                            var client = {value: d.email, email: d.name};
                            values.push(client);
                            //console.log(d);

                        });

                        // values = values.toString();
                        // let keys = "[" + values + "]";
                        // keys = JSON.stringify(keys);
                        // console.log(keys);
                        // tagifyTo.settings.whitelist = keys;
                        values = JSON.stringify(values);
                        values = JSON.parse(values);
                        tagifyTo.settings.whitelist = values;

                    }
                });

            }

            function onInputCC(e)
            {
                // console.log(e);
                // console.log(e.detail.value);
                var value_ = e.detail.value;
                tagifyCC.settings.whitelist.length = 0; // reset the whitelist.

                // ajax
                var uri = '{!! route("apl_email.ajax.tagify") !!}';
                // controller = new AbortController();
                // controller && controller.abort();

                $.ajax({
                    url: uri,
                    method: 'GET',
                    data: { 'term': value_ },
                    //cache: false,
                    success:function(val)
                    {
                        //console.log(val);
                        let values = [];

                        $.each(val.data, function(v, d) {
                            //var client += '{value: '+ d.name + ',' + 'email:' + d.text + '},';
                            var client = {value: d.email, email: d.name};
                            values.push(client);
                            //console.log(d);

                        });

                        values = JSON.stringify(values);
                        values = JSON.parse(values);
                        tagifyCC.settings.whitelist = values;
                    }
                });

            }

            function onInputBCC(e)
            {
                // console.log(e);
                // console.log(e.detail.value);
                var value_ = e.detail.value;
                tagifyBCC.settings.whitelist.length = 0; // reset the whitelist.

                // ajax
                var uri = '{!! route("apl_email.ajax.tagify") !!}';
                // controller = new AbortController();
                // controller && controller.abort();

                $.ajax({
                    url: uri,
                    method: 'GET',
                    data: { 'term': value_ },
                    //cache: false,
                    success:function(val)
                    {
                        //console.log(val);
                        let values = [];

                        $.each(val.data, function(v, d) {
                            //var client += '{value: '+ d.name + ',' + 'email:' + d.text + '},';
                            var client = {value: d.email, email: d.name};
                            values.push(client);
                            //console.log(d);

                        });

                        values = JSON.stringify(values);
                        values = JSON.parse(values);
                        tagifyBCC.settings.whitelist = values;

                    }
                });

            }

            // tagify to group
            var tagIfyGroup = new Tagify(blastGroup,{
                delimiters: ", ", // add new tags when a comma or a space character is entered
                maxTags: 10,
                blacklist: ["fuck", "shit", "pussy"],
                keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                whitelist:[],
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

            tagIfyGroup.on('input', loadRecipientGroup);

            function loadRecipientGroup(e)
            {
                var value_ = e.detail.value;
                tagIfyGroup.settings.whitelist.length = 0; // reset the whitelist.

                // ajax
                var uri = '{!! route("apl_email.ajax.tagify_group") !!}';

                $.ajax({
                    url: uri,
                    method: 'GET',
                    data: {'term': value_},
                    //cache: false,
                    success: function (val) {
                        //console.log(val);
                        let values = [];

                        $.each(val.data, function (v, d) {
                            //var client += '{value: '+ d.name + ',' + 'email:' + d.text + '},';
                            var client = {value: d.slug, email: d.name};
                            values.push(client);
                            // console.log(d);

                        });

                        values = JSON.stringify(values);
                        values = JSON.parse(values);
                        tagIfyGroup.settings.whitelist = values;

                    }
                });
            }

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
                url: '{!! route('apl_email.upload.image') !!}',
                paramName: "file",
                maxFiles: 10,
                maxFilesize: 10,
                addRemoveLinks: !0,
                acceptedFiles: "image/*, application/*",
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
                    url:"{{ route('apl_email.retrieve_create.image') }}",
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
                    url:"{{ route('apl_email.retrieve_create.image') }}",
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
                    url:"{{ route('apl_email.delete.image') }}",
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

    </script>
@endpush
