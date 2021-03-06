<div class="kt-header__topbar-item kt-header__topbar-item--user">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
        <div class="kt-header__topbar-user">
            <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
            <span class="kt-header__topbar-username kt-hidden-mobile">@php $u = explode(' ',Sentinel::getUser()->name) @endphp {{ $u[0] }}</span>
            <img class="kt-hidden" alt="Pic" src="{{ url('themes/eci/media/users/300_25.jpg') }}" />
            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ Sentinel::getUser()->name[0] }}</span>
        </div>
    </div>

    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
        <!--begin: Head -->
        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ url('themes/eci//media/misc/bg-1.jpg') }})">
            <div class="kt-user-card__avatar">
                <img class="kt-hidden" alt="Pic" src="{{ url('themes/eci/media/users/300_25.jpg') }}" />
                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ Sentinel::getUser()->name[0] }}</span>
            </div>
            <div class="kt-user-card__name">
                {{Sentinel::getUser()->name}}
            </div>
            {{-- label --}}
            {{--        <div class="kt-user-card__badge">--}}
            {{--            <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>--}}
            {{--        </div>--}}
            {{-- end label --}}
        </div>
        <!--end: Head -->

        <!--begin: Navigation -->
        <div class="kt-notification">
            <a href="{{ route('password.edit') }}" class="kt-notification__item">
                <div class="kt-notification__item-icon">
{{--                    <i class="flaticon2-calendar-3 kt-font-success"></i>--}}
                    <i class="kt-font-success fa fa-key"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title kt-font-bold">
                        Change Password
                        <!-- My Profile -->
                    </div>
                    <div class="kt-notification__item-time">
                        <!-- Account settings and more -->
                    </div>
                </div>
            </a>

            <div class="kt-notification__custom kt-space-between">
                <a href="{{ route('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                {{-- subheader right --}}
                {{-- <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>--}}
                {{-- end subheader right --}}
            </div>
        </div>
        <!--end: Navigation -->
    </div>

</div>

