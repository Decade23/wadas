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
                    Update Product Group
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" method="POST" action="{{ route('product_group.update', $dataDb->id) }}">
                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}

                    <div class="kt-portlet__body">
                        <div class="form-group @if($errors->has('name')) validated @endif">
                            <label @if($errors->has('name')) class="text-danger" @endif>Name<span style="color: red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Enter Name" value="{{ $dataDb->name }}">
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
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
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Portlet-->
@stop

@push('css')
@endpush

@push('scripts')
@endpush
