@if(Session::has('success'))
    <div class="alert alert-solid-success alert-bold" role="alert">
        <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
        <div class="alert-text">Well Done: {!! Session::get('success') !!}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if(Session::has('failed'))
    <div class="alert alert-solid-danger alert-bold" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Warning: {!! Session::get('failed') !!}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if($errors->all())
    <div class="alert alert-solid-danger alert-bold" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Warning: Please check the form carefully for fix errors!</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif
