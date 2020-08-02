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
                    {{ $pageTitle }}
                </h3>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('config_email.store') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="kt-portlet__body">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" data-target="#domain">Domain</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="domain" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group @if($errors->has('name')) validated @endif">
                                    <label @if($errors->has('name')) class="text-danger" @endif>Name<span style="color: red">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Enter Name" value="{{ old('name') }}">
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group @if($errors->has('visibility')) validated @endif">
                                    <label @if($errors->has('visibility')) class="text-danger" @endif>Visibility<span style="color: red">*</span></label>
                                    <select name="visibility" id="visibility" class="form-control @if($errors->has('visibility')) is-invalid @endif kt-select2">
                                        <option value="publish" @if(old('visibility') == 'publish') selected="selected" @endif >Publish</option>
                                        <option value="private" @if(old('visibility') == 'private') selected="selected" @endif >Private</option>
                                    </select>
                                    {!! $errors->first('visibility', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
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
@endpush

@push('scripts')
    <script>
        $(function () {

            $('#visibility').select2({
                placeholder: "Select",
                width: '100%',
            });
        });
    </script>
@endpush
