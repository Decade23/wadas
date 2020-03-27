<li class="kt-menu__item  kt-menu__item--submenu @if( request()->is('console/users*') || request()->is('console/roles*') ) {{ 'kt-menu__item--open' }} @endif" aria-haspopup="true"  data-ktmenu-submenu-toggle="hover">
    <a  href="javascript:;" class="kt-menu__link kt-menu__toggle">
        <span class="kt-menu__link-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"/>
                </g>
            </svg>
        </span>
        <span class="kt-menu__link-text">Access Control Lists</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true" >
                <span class="kt-menu__link">
                    <span class="kt-menu__link-text">Applications</span>
                </span>
            </li>
            <li class="kt-menu__item @if(request()->is('console/users*')) {{ 'kt-menu__item--active' }} @endif" aria-haspopup="true" >
                <a  href="{{ route('user.index') }}" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                        <span></span>
                    </i>
                    <span class="kt-menu__link-text">Users</span>
                    {{-- add label --}}
{{--                    <span class="kt-menu__link-badge">--}}
{{--                        <span class="kt-badge kt-badge--danger kt-badge--inline">new</span>--}}
{{--                    </span>--}}
                    {{-- add arrow --}}
                    {{-- <i class="kt-menu__ver-arrow la la-angle-right"></i>--}}
                </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
                <a  href="#" class="kt-menu__link @if(request()->is('console/roles*')) {{ 'kt-menu__item--active' }} @endif"><i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                        <span></span>
                    </i>
                    <span class="kt-menu__link-text">Roles</span>
                </a>
            </li>
        </ul>
    </div>
</li>
