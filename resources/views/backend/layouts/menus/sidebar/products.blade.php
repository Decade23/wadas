@if(Sentinel::inRole('root') || Sentinel::hasAnyAccess(['product.show','product_group.show']))
    <li class="kt-menu__item  kt-menu__item--submenu @if( request()->is('console/product*') ) {{ 'kt-menu__item--open' }} @endif" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
        <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
        <span class="kt-menu__link-icon">
          <i class="flaticon flaticon-apps"></i>
        </span>
            <span class="kt-menu__link-text">Products</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true" >
                <span class="kt-menu__link">
                    <span class="kt-menu__link-text">Applications</span>
                </span>
                </li>
                @if(Sentinel::inRole('root') || Sentinel::hasAccess(['product.show']))
                    <li class="kt-menu__item @if(request()->is('console/product/items*')) {{ 'kt-menu__item--active' }} @endif" aria-haspopup="true" >
                        <a  href="{{ route('product.index') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                <span></span>
                            </i>
                            <span class="kt-menu__link-text">Product</span>
                            {{-- add label --}}
                            {{--                    <span class="kt-menu__link-badge">--}}
                            {{--                        <span class="kt-badge kt-badge--danger kt-badge--inline">new</span>--}}
                            {{--                    </span>--}}
                            {{-- add arrow --}}
                            {{-- <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
                        </a>
                    </li>
                @endif

                @if(Sentinel::inRole('root') || Sentinel::hasAccess(['product_group.show']))
                    <li class="kt-menu__item @if(request()->is('console/product/groups*')) {{ 'kt-menu__item--active' }} @endif " aria-haspopup="true" >
                        <a  href="{{ route('product_group.index') }}" class="kt-menu__link">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                <span></span>
                            </i>
                            <span class="kt-menu__link-text">Product Group</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif
