<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-success fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="{{ asset('icons/android-chrome-192x192.png') }}"/>
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bolder d-flex align-items-center fs-5">
                    {{ auth()->user()->name }}
                </div>
                <a href="#" class="fw-bold text-muted text-hover-success fs-7">{{ auth()->user()->email }}</a>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ route('profile.index') }}" class="menu-link px-5">
            الملف الشخصي
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
   {{-- <div class="menu-item px-5">
        <a href="#" class="menu-link px-5">
            <span class="menu-text">تغيير كلمة المرور</span>
        </a>
    </div>--}}
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-5" >
        <a href="#" class="menu-link px-5">
            <span class="menu-title">سجل النشاط</span>

        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="#" data-action="{{ theme()->getPageUrl('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true" class="button-ajax menu-link px-5">
            تسجيل الخروج
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu-->
