@extends('auth.layout')

@section('body_content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Sign In To Console</h3>
        </div>
        <form class="kt-form" action="{{ route('login.process') }}" method="POST">
            {!! csrf_field() !!}
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
            </div>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="Password" name="password">
            </div>
                                        <div class="row kt-login__extra">
                                            <div class="col">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" name="remember" value="on"> Remember me
                                                    <span></span>
                                                </label>
                                            </div>
{{--                                            <div class="col kt-align-right">--}}
{{--                                                <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>--}}
{{--                                            </div>--}}
                                        </div>
            <div class="kt-login__actions">
                <button id="kt_login_signin_submit___" class="btn btn-brand btn-elevate kt-login__btn-primary" type="submit">Sign In</button>
            </div>
        </form>
    </div>
@stop

@push('css')
@endpush

@push('scripts')
@endpush
