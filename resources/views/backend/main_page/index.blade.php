@extends('backend.layouts.app')

@section('body')
    @include('flash')
        <div class="row">
            <div class="col">
                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-laptop kt-font-success"></i></div>
                    <div class="alert-text">
                        Welcome <code>{{ Sentinel::getUser()->name }}</code>. you are login into <b>WADAS</b> at <code>{{ Sentinel::getUser()->last_login }}</code>
                    </div>
                </div>
            </div>

        </div>
@stop

@push('css')
@endpush

@push('scripts')
@endpush
