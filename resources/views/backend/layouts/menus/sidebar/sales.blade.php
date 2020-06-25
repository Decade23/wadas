@if(Sentinel::inRole('root') || Sentinel::hasAnyAccess(['sales.show']))
    <li class="kt-menu__item  kt-menu__item--submenu @if( request()->is('console/sales*') ) {{ 'kt-menu__item--open' }} @endif" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
        <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
        <span class="kt-menu__link-icon">
          <i class="flaticon flaticon-apps"></i>
        </span>
            <span class="kt-menu__link-text">Sales</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true" >
                <span class="kt-menu__link">
                    <span class="kt-menu__link-text">Applications</span>
                </span>
                </li>
                @if(Sentinel::inRole('root') || Sentinel::hasAccess(['sales.show']))
                    <li class="kt-menu__item @if(request()->is('console/product/items*')) {{ 'kt-menu__item--active' }} @endif" aria-haspopup="true" >
                        <a  href="{{ route('sales.index') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                <span></span>
                            </i>
                            <span class="kt-menu__link-text">Orders</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
@endif
