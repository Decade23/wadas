@extends('backend.layouts.app')

@section('body')

    @include('flash')
    <!--begin::Portlet-->

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                <h3 class="kt-portlet__head-title">
                    Create User
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" method="POST" action="{{ route('user.store') }}">
                {!! csrf_field() !!}
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('name')) validated @endif">
                                <label @if($errors->has('name')) class="text-danger" @endif>Name<span style="color: red">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Enter Name" value="{{ old('name') }}">
                                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('phone')) validated @endif">
                                <label @if($errors->has('phone')) class="text-danger" @endif>Phone<span style="color: red">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control @if($errors->has('phone')) is-invalid @endif" placeholder="Enter Phone" value="{{ old('phone') }}">
                                {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('email')) validated @endif">
                                <label @if($errors->has('email')) class="text-danger" @endif>Email<span style="color: red">*</span></label>
                                <input type="text" name="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Enter Email" value="{{ old('email') }}">
                                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('role')) validated @endif">
                                <label @if($errors->has('role')) class="text-danger" @endif>Role<span style="color: red">*</span></label>
                                <select class="form-control @if($errors->has('role')) is-invalid @endif kt-select2" id="role" name="role">
                                    <option value="" {{ old('role') ? 'selected="selected"' : ''}}></option>
                                    @foreach($roleDb as $role)
                                        @if (old('role') == $role->id)
                                            <option value="{{$role->id}}" selected="selected">{{$role->name}}</option>
                                        @else
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('password')) validated @endif">
                                <label @if($errors->has('password')) class="text-danger" @endif>Password<span style="color: red">*</span></label>
                                <input type="password" name="password" id="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Enter Password" value="{{ old('password') }}">
                                <span class="form-text text-muted">Password (at least 8 characters long</span>
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('password')) validated @endif">
                                <label @if($errors->has('password')) class="text-danger" @endif>Password<span style="color: red">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Enter Confirmation Password" value="{{ old('password_confirmation') }}">
                                <span class="form-text text-muted">Type Your Password Again</span>
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
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
                                <button type="submit" class="btn btn-primary">Save</button>
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
