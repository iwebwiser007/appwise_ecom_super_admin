@php
$setting = App\Models\Setting::where('id','1')->first();
$admin_logo = $setting['admin_logo'] ?? 'default-logo.png';
@endphp
<div class="sa-app__sidebar">
    <div class="sa-sidebar">
        <div class="sa-sidebar__header">
            <a class="sa-sidebar__logo" href="{{ url('admin/dashboard') }}">
                <div class="sa-sidebar-logo">
                    <!-- <img src="https://123ecommerce.co.za/public/front/images/logo/41101.jpg" alt=""> -->
                    <img src="{{ asset('public/admin/images/logo/' . $admin_logo) }}" alt="">
                    {{-- <div class="sa-sidebar-logo__caption">
                        Super Admin
                    </div> --}}
                </div>
                <!-- logo / end -->

            </a>
        </div>
        <div class="sa-sidebar__body" data-simplebar="init">
            <div class="simplebar-wrapper">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset">
                        <div class="simplebar-content-wrapper">
                            <div class="simplebar-content">
                                <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                                    <li class="sa-nav__section">
                                        <div class="sa-nav__section-title">
                                            <span>Application</span>
                                        </div>
                                        <ul class="sa-nav__menu sa-nav__menu--root">
                                            <li
                                                class="sa-nav__menu-item sa-nav__menu-item--has-icon {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                                <a href="{{ url('admin/dashboard') }}" class="sa-nav__link">
                                                    <span class="sa-nav__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"
                                                            fill="currentColor">
                                                            <path
                                                                d="M8,13.1c-4.4,0-8,3.4-8-3C0,5.6,3.6,2,8,2s8,3.6,8,8.1C16,16.5,12.4,13.1,8,13.1zM8,4c-3.3,0-6,2.7-6,6c0,4,2.4,0.9,5,0.2C7,9.9,7.1,9.5,7.4,9.2l3-2.3c0.4-0.3,1-0.2,1.3,0.3c0.3,0.5,0.2,1.1-0.2,1.4l-2.2,1.7c2.5,0.9,4.8,3.6,4.8-0.2C14,6.7,11.3,4,8,4z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <span class="sa-nav__title">Dashboard</span>
                                                </a>
                                            </li>
                                            <li
                                                class="sa-nav__menu-item sa-nav__menu-item--has-icon {{ request()->is('admin/transaction') ? 'active' : '' }}">
                                                <a href="{{ url('admin/transaction') }}" class="sa-nav__link">
                                                    <span class="sa-nav__icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                                            fill="currentColor">
                                                            <!-- Coin with "R" for Rand (ZAR) -->
                                                            <circle cx="12" cy="12" r="10" stroke="black" stroke-width="2" fill="" />
                                                            <text x="12" y="16" font-size="12" text-anchor="middle" fill="black"
                                                                font-family="Arial, sans-serif" font-weight="bold">R</text>
                                                        </svg>
                                                    </span>
                                                    <span class="sa-nav__title">Transaction Report</span>
                                                </a>
                                            </li>

                                            @can('view packages')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon "
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                            class="bi bi-box-seam" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                                                        </svg></span><span class="sa-nav__title">Package
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/packages') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/packages') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Packages</span></a>
                                                    </li>
                                                </ul>

                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/package_buy') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/package_buy') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Package
                                                                Purchase</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan
                                            @can('view owners')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                            class="bi bi-shop" viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                                                        </svg></span><span class="sa-nav__title">Business Owner Management</span><span
                                                        class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="9"
                                                            viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/shop-owners') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/shop-owners') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Business
                                                                Owner</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan

                                            @can('view sales report')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.18l7.45 3.72-2.92 1.47L12 6.04 7.47 7.37 4.55 5.9 12 4.18zM4 9.6v7.91l8 4 8-4V9.6l-8 4-8-4zm8 2.36l4.7 2.36-4.7 2.35-4.7-2.35 4.7-2.36z" />
                                                        </svg></span><span class="sa-nav__title">Business Owner Sales Report
                                                    </span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6"
                                                            height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/sales-reports') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/sales-reports') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Sales
                                                                Report</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan

                                            @can('view inquiries')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                            class="bi bi-device-hdd" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 11a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m-7.5.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1M5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M8 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                                            <path
                                                                d="M12 7a4 4 0 0 1-3.937 4c-.537.813-1.02 1.515-1.181 1.677a1.102 1.102 0 0 1-1.56-1.559c.1-.098.396-.314.795-.588A4 4 0 0 1 8 3a4 4 0 0 1 4 4m-1 0a3 3 0 1 0-3.891 2.865c.667-.44 1.396-.91 1.955-1.268.224-.144.483.115.34.34l-.62.96A3 3 0 0 0 11 7" />
                                                            <path
                                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                                        </svg></span><span class="sa-nav__title">Inquiry
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/inquiries') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/inquiries') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Inquiry</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan
                                            @can('view pages')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                            class="bi bi-ui-radios-grid" viewBox="0 0 16 16">
                                                            <path
                                                                d="M3.5 15a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m9-9a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m0 9a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5M16 3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-9 9a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m5.5 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-9-11a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 2a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7">
                                                            </path>
                                                        </svg></span><span class="sa-nav__title">CMS
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/pages') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/pages') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Pages</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan
                                            @can('update setting')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"
                                                            fill="currentColor">
                                                            <path
                                                                d="M14,6.8l-0.2,0.1C14,7.3,14,7.6,14,8c0,0.4,0,0.7-0.1,1.1L14,9.2c1,0.6,1.4,1.9,0.8,3c-0.5,0.9-1.6,1.2-2.5,0.7l-0.5-0.3c-0.6,0.5-1.2,0.8-1.9,1.1v0.8c0,0.9-0.7,1.6-1.6,1.6H7.6C6.7,16,6,15.3,6,14.4v-0.8c-0.7-0.2-1.3-0.6-1.9-1.1l-0.5,0.3c-0.9,0.5-2,0.2-2.5-0.7c-0.6-1-0.3-2.4,0.8-3l0.2-0.1C2,8.7,2,8.4,2,8c0-0.4,0-0.7,0.1-1.1L2,6.8c-1.1-0.6-1.4-2-0.8-3C1.7,3,2.8,2.7,3.6,3.2l0.5,0.3C4.7,3,5.3,2.6,6,2.4V1.6C6,0.7,6.7,0,7.6,0h0.8C9.3,0,10,0.7,10,1.6v0.8c0.7,0.2,1.3,0.6,1.9,1.1l0.5-0.3c0.9-0.5,2-0.2,2.5,0.7C15.4,4.9,15.1,6.2,14,6.8z M8,5.5C6.6,5.5,5.5,6.6,5.5,8s1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5S9.4,5.5,8,5.5z">
                                                            </path>
                                                        </svg></span><span class="sa-nav__title">Setting
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/logo') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/logo') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Logo</span></a>
                                                    </li>

                                                    <li class="sa-nav__menu-item {{ request()->is('admin/admin-details') ? 'active' : '' }}">
                                                        <a href="{{ url('admin/admin-details') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Update Admin
                                                                Setting</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan
                                            @can('view permissions')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                            class="bi bi-key" viewBox="0 0 16 16">
                                                            <path
                                                                d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                        </svg></span><span class="sa-nav__title">Permission
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/permissions/index') ? 'active' : '' }}">
                                                        <a href="{{ route('permissions.index') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span
                                                                class="sa-nav__title">Permissions</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan
                                            @can('view roles')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                            class="bi bi-diagram-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                                        </svg></span><span class="sa-nav__title">Role
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/roles') ? 'active' : '' }}">
                                                        <a href="{{ route('roles.index') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Roles</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan
                                            @can('view users')
                                            <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"
                                                data-sa-collapse-item="sa-nav__menu-item--open">
                                                <a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg
                                                            class="svg-inline--fa fa-user fa-w-14" aria-hidden="true" focusable="false"
                                                            data-prefix="far" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z">
                                                            </path>
                                                        </svg></span><span class="sa-nav__title">User
                                                        Management</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                            <path
                                                                d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                            </path>
                                                        </svg></span></a>
                                                <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                                    <li class="sa-nav__menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
                                                        <a href="{{ route('users.index') }}" class="sa-nav__link"><span
                                                                class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">users</span></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endcan


                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal">
                <div class="simplebar-scrollbar"></div>
            </div>
            <div class="simplebar-track simplebar-vertical">
                <div class="simplebar-scrollbar"></div>
            </div>
        </div>
    </div>
    <div class="sa-app__sidebar-shadow"></div>
    <d i v="" class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></d>
</div>