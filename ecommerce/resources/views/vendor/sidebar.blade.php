
<!-- BEGIN: Side Bar-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-semi-dark/index.html">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Vendor</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ route('vendor.index') }}"><i class="feather icon-home"></i>
                <span class="menu-title" data-i18n="Dashboard">Home</span></a>
            </li>
            <li class=" nav-item"><a href="{{ route('managerproduct_vendor.all') }}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">Manager Product</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('managerproduct_vendor.all') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">All product</span></a>
                    </li>
                    <li><a href="{{ route('managerproduct_vendor.add') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Add product</span></a>
                    </li>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="{{ route('managerorder.pending') }}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">Manager Order</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('managerorder.pending') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Order Pending</span></a>
                    </li>
                    </li>
                    </li>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">Ecommerce</span></a>
                <ul class="menu-content">
                    <li><a href="app-ecommerce-shop.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Shop</span></a>
                    </li>
                    <li><a href="app-ecommerce-details.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Details</span></a>
                    </li>
                    <li><a href="app-ecommerce-wishlist.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">Wish List</span></a>
                    </li>
                    <li><a href="app-ecommerce-checkout.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Checkout">Checkout</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="{{ route('vendor.profile') }}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Profile">Profile</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">User</span></a></li>
            <li class=" navigation-header"><span>UI Elements</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Data List">Charts</span><span class="badge badge badge-primary badge-pill float-right mr-2">New</span></a>
                <ul class="menu-content">
                    <li><a href="data-list-view.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List View">7 days</span></a></li>
                    <li><a href="data-thumb-view.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Thumb View">30 days</span></a></li>
                    <li><a href="data-thumb-view.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Thumb View">360 days</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-layout"></i><span class="menu-title" data-i18n="Content">Discount</span></a>
                <ul class="menu-content">
                    <li>
                        <a href="content-syntax-highlighter.html">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="Syntax Highlighter">All</span>
                        </a>
                    </li>
                    <li><a href="content-grid.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">Fashion</span></a>
                    </li>
                    <li><a href="content-typography.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Typography">Phone</span></a>
                    </li>
                    <li><a href="content-text-utilities.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Text Utilities">Laptop</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Card">Cart status</span></a>
                <ul class="menu-content">
                    <li><a href="card-basic.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">Pendding</span></a>
                    </li>
                    <li><a href="card-advance.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Advance">Complete</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="page-account-settings.html"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Account Settings">Account Settings</span></a>
            </li>
            <li class=" nav-item"><a href="page-faq.html"><i class="feather icon-help-circle"></i><span class="menu-title" data-i18n="FAQ">FAQ</span></a>
            </li>
            <li class=" nav-item"><a href="page-knowledge-base.html"><i class="feather icon-info"></i><span class="menu-title" data-i18n="Knowledge Base">Knowledge Base</span></a>
            </li>
            <li class=" nav-item"><a href="page-search.html"><i class="feather icon-search"></i><span class="menu-title" data-i18n="Search">Search</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-unlock"></i><span class="menu-title" data-i18n="Authentication">Authentication</span></a>
                <ul class="menu-content">
                    <li><a href="auth-login.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Login">Admin</span></a>
                    </li>
                    <li><a href="auth-register.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Register">Super Admin</span></a>
                    </li>
                </ul>
            </li>
            
            <li class=" nav-item"><a href="maps-google.html"><i class="feather icon-map"></i><span class="menu-title" data-i18n="Google Maps">Google Maps</span></a>
            </li>
            <li class=" navigation-header"><span>Extensions</span>
            </li>
            <li class=" nav-item"><a href="ext-component-sweet-alerts.html"><i class="feather icon-alert-circle"></i><span class="menu-title" data-i18n="Sweet Alert">Sweet Alert</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-toastr.html"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Toastr">Toastr</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-noui-slider.html"><i class="feather icon-sliders"></i><span class="menu-title" data-i18n="NoUi Slider">NoUi Slider</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-file-uploader.html"><i class="feather icon-upload-cloud"></i><span class="menu-title" data-i18n="File Uploader">File Uploader</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-quill-editor.html"><i class="feather icon-edit"></i><span class="menu-title" data-i18n="Quill Editor">Quill Editor</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-drag-drop.html"><i class="feather icon-droplet"></i><span class="menu-title" data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-tour.html"><i class="feather icon-info"></i><span class="menu-title" data-i18n="Tour">Tour</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-clipboard.html"><i class="feather icon-copy"></i><span class="menu-title" data-i18n="Clipboard">Clipboard</span></a>
            </li>
            <li class=" nav-item"><a href=" ext-component-plyr.html"><i class="feather icon-film"></i><span class="menu-title" data-i18n="Media player">Media player</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-context-menu.html"><i class="feather icon-more-horizontal"></i><span class="menu-title" data-i18n="Context Menu">Context Menu</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-swiper.html"><i class="feather icon-smartphone"></i><span class="menu-title" data-i18n="swiper">swiper</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-i18n.html"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="l18n">l18n</span></a>
            </li>
            <li class=" navigation-header"><span>Others</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-menu"></i><span class="menu-title" data-i18n="Menu Levels">Menu Levels</span></a>
                <ul class="menu-content">
                    <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Second Level">Second Level</span></a>
                    </li>
                    <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Second Level">Second Level</span></a>
                        <ul class="menu-content">
                            <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Third Level">Third Level</span></a>
                            </li>
                            <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Third Level">Third Level</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="disabled nav-item"><a href="#"><i class="feather icon-eye-off"></i><span class="menu-title" data-i18n="Disabled Menu">Disabled Menu</span></a>
            </li>
            <li class=" navigation-header"><span>Support</span>
            </li>
            <li class=" nav-item"><a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Documentation">Documentation</span></a>
            </li>
            <li class=" nav-item"><a href="https://pixinvent.ticksy.com/"><i class="feather icon-life-buoy"></i><span class="menu-title" data-i18n="Raise Support">Raise Support</span></a>
            </li>
        </ul>
    </div>
</div>