@extends('frontend.layouts.app')

@section('body')
    @include('frontend.section.about')

    @include('frontend.section.work')

    <!-- others
    <div class="container clearfix">

        <div class="col_one_third bottommargin-sm center">
            <img data-animate="fadeInLeft" src="frontend/images/services/iphone6.png" alt="Iphone">
        </div>

        <div class="col_two_third bottommargin-sm col_last">

            <div class="heading-block topmargin-sm">
                <h3>Optimized for Mobile &amp; Touch Enabled Devices.</h3>
            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero quod consequuntur quibusdam, enim expedita sed quia nesciunt incidunt accusamus necessitatibus modi adipisci officia libero accusantium esse hic, obcaecati, ullam, laboriosam!</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti vero, animi suscipit id facere officia. Aspernatur, quo, quos nisi dolorum aperiam fugiat deserunt velit rerum laudantium cum magnam.</p>

            <a href="#" class="button button-border button-dark button-rounded button-large noleftmargin topmargin-sm">Learn more</a>

        </div>

    </div>
    -->
    @include('frontend.section.testimonials')

    @include('frontend.section.blog')

    @include('frontend.section.team')

    @include('frontend.section.clients')
@stop

@push('css')
@endpush

@push('scripts')
@endpush
