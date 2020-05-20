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
                    Update Roles
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" method="POST" action="{{ route('roles.update', $dataDb->id) }}">
                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}
                    <div class="kt-portlet__body">
                        <div class="form-group @if($errors->has('name')) validated @endif">
                            <label @if($errors->has('name')) class="text-danger" @endif>Name<span style="color: red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Enter Name" value="{{ old('name', $dataDb->name) }}">
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#roles">Access Control List</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="roles" role="tabpanel">
                                @include('auth.roles.roles')
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
                                    <button type="submit" class="btn btn-primary submit">Update</button>
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
    <script>
        $(function () {
            $('#role').select2({
                placeholder      : "Select"
            });
        });
    </script>
@endpush
