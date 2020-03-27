@extends('backend.layouts.app')

@section('body')
    @include('flash')
        <div class="row">
            <div class="col">
                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-laptop kt-font-success"></i></div>
                    <div class="alert-text">
                        Welcome <code>{{ Sentinel::getUser()->name }}</code>. you are login into <b>ECI</b> at <code>{{ Sentinel::getUser()->last_login }}</code>
                    </div>
                </div>
            </div>
        </div>

{{--<div class="row">--}}
{{--    <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">--}}
{{--        <!--begin:: Widgets/Best Sellers-->--}}
{{--        <div class="kt-portlet kt-portlet--height-fluid">--}}
{{--            <div class="kt-portlet__head">--}}
{{--                <div class="kt-portlet__head-label">--}}
{{--                    <h3 class="kt-portlet__head-title">--}}
{{--                        Best Sellers--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <div class="kt-portlet__head-toolbar">--}}
{{--                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">--}}
{{--                                Latest--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab">--}}
{{--                                Month--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">--}}
{{--                                All time--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="kt-portlet__body">--}}
{{--                <div class="tab-content">--}}
{{--                    <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">--}}
{{--                        <div class="kt-widget5">--}}
{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product27.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Great Logo Designn--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic admin themes.--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Keenthemes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">19,200</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">1046</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product22.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Branding Mockup--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic bootstrap themes.--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Fly themes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">24,583</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">3809</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product15.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Awesome Mobile App--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic admin themes.Lorem Ipsum Amet--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Fly themes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">210,054</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">1103</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tab-pane" id="kt_widget5_tab2_content">--}}
{{--                        <div class="kt-widget5">--}}
{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product10.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Branding Mockup--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic bootstrap themes.--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Fly themes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">24,583</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">3809</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product11.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Awesome Mobile App--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic admin themes.Lorem Ipsum Amet--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Fly themes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">210,054</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">1103</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product6.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Great Logo Designn--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic admin themes.--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Keenthemes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">19,200</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">1046</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tab-pane" id="kt_widget5_tab3_content">--}}
{{--                        <div class="kt-widget5">--}}
{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product11.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Awesome Mobile App--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic admin themes.Lorem Ipsum Amet--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Fly themes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">210,054</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">1103</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product6.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Great Logo Designn--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic admin themes.--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Keenthemes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">19,200</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">1046</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="kt-widget5__item">--}}
{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__pic">--}}
{{--                                        <img class="kt-widget7__img" src="../../themes/metronic/theme/default/demo1/dist/assets/media/products/product10.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__section">--}}
{{--                                        <a href="#" class="kt-widget5__title">--}}
{{--                                            Branding Mockup--}}
{{--                                        </a>--}}
{{--                                        <p class="kt-widget5__desc">--}}
{{--                                            Metronic bootstrap themes.--}}
{{--                                        </p>--}}
{{--                                        <div class="kt-widget5__info">--}}
{{--                                            <span>Author:</span>--}}
{{--                                            <span class="kt-font-info">Fly themes</span>--}}
{{--                                            <span>Released:</span>--}}
{{--                                            <span class="kt-font-info">23.08.17</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="kt-widget5__content">--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">24,583</span>--}}
{{--                                        <span class="kt-widget5__sales">sales</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-widget5__stats">--}}
{{--                                        <span class="kt-widget5__number">3809</span>--}}
{{--                                        <span class="kt-widget5__votes">votes</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!--end:: Widgets/Best Sellers-->--}}
{{--    </div>--}}
{{--</div>--}}
@stop

@push('css')
@endpush

@push('scripts')
@endpush
