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
                    Create User
                </h3>
            </div>
        </div>

        <form class="kt-form kt-form--label-right" method="POST" action="{{ route('password.update') }}">
            {!! csrf_field() !!}
            {{ method_field('PUT') }}
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group @if($errors->has('old_password')) validated @endif">
                            <label @if($errors->has('old_password')) class="text-danger" @endif>Old Password<span style="color: red">*</span></label>
                            <input type="password" name="old_password" id="old_password" class="form-control @if($errors->has('old_password')) is-invalid @endif" placeholder="Enter Old Password" value="{{ old('old_password') }}">
                            {!! $errors->first('old_password', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <hr>
                        <div class="form-group @if($errors->has('password')) validated @endif">
                            <label @if($errors->has('password')) class="text-danger" @endif>Password<span style="color: red">*</span></label>
                            <input type="password" name="password" id="password" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Enter Password" value="{{ old('password') }}">
                            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group @if($errors->has('password_confirmation')) validated @endif">
                            <label @if($errors->has('password_confirmation')) class="text-danger" @endif>Password Confirmation<span style="color: red">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" placeholder="Enter Password Confirmation" value="{{ old('password_confirmation') }}">
                            {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="alert alert-solid-danger alert-bold" role="alert">
                            <div class="alert-icon"><i class="flaticon2-notepad"></i></div>
                            <div class="alert-text">
                                Attention
                                <ul>
                                    <li>Your password must contain at least 8 characters</li>
                                    <li>Create strong password that combines letters, numbers, and special characters</li>
                                    <li>Never share your password with anyone for any reason</li>
                                    <li>Change your password frequently</li>
                                </ul>
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
                            <button type="submit" class="btn btn-primary submit">Save</button>
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
@endpush
