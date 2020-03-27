@if(Session::has('success'))
    <div class="alert alert-solid-success alert-bold" role="alert">
        <div class="alert-text">Well Done: {!! Session::get('success') !!}</div>
    </div>
@endif

@if(Session::has('failed'))
    <div class="alert alert-solid-danger alert-bold" role="alert">
        <div class="alert-text">Warning: {!! Session::get('failed') !!}</div>
    </div>
@endif

@if($errors->all())
    <div class="alert alert-solid-danger alert-bold" role="alert">
        <div class="alert-text">Warning: Please check the form carefully for errors!</div>
    </div>
@endif
