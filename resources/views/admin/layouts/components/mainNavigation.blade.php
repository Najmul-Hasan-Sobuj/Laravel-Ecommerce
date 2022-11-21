<div class="sidebar-section">
    <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main -->
        <li class="nav-item-header pt-0">
            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
            <i class="ph-dots-three sidebar-resize-show"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('provider.admin.home') }}"
                class="{{ request()->is('provider/admin/home*') ? 'nav-link active' : 'nav-link' }}">
                <i class="ph-house"></i>
                <span>
                    Dashboard
                    <span class="d-block fw-normal opacity-50">No pending orders</span>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('provider.admin.changelog') }}"
                class="{{ request()->is('provider/admin/changelog*') ? 'nav-link active' : 'nav-link' }}">
                <i class="ph-list-numbers"></i>
                <span>Changelog</span>
                <span class="badge bg-primary align-self-center rounded-pill ms-auto">4.0</span>
            </a>
        </li>
        <li class="nav-item nav-item-submenu @if (request()->is('provider/categories*')) nav-item-open @endif">
            <a href="#" class="nav-link">
                <i class="ph-list-bullets"></i>
                <span>Categories</span>
            </a>
            <ul class="nav-group-sub collapse @if (request()->is('provider/categories*')) show @endif">
                <li class="nav-item"><a href="{{ route('provider.categories.category.index') }}"
                        class="{{ request()->is('provider/categories/category*') ? 'nav-link active' : 'nav-link' }}">
                        Category</a></li>
                <li class="nav-item"><a href="{{ route('provider.categories.subCategory.index') }}"
                        class="{{ request()->is('provider/categories/subCategory*') ? 'nav-link active' : 'nav-link' }}">
                        Sub Category</a></li>
                <li class="nav-item"><a href="{{ route('provider.categories.childCategory.index') }}"
                        class="{{ request()->is('provider/categories/childCategory*') ? 'nav-link active' : 'nav-link' }}">
                        Child Category</a></li>
                <li class="nav-item"><a href="{{ route('provider.brand.index') }}"
                        class="{{ request()->is('provider/brand*') ? 'nav-link active' : 'nav-link' }}">
                        Brand</a></li>
                <li class="nav-item"><a href="{{ route('provider.wareHouse.index') }}"
                        class="{{ request()->is('provider/wareHouse*') ? 'nav-link active' : 'nav-link' }}">
                        Warehouse</a></li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link">
                <i class="icon-gift"></i>
                <span>Offer</span>
            </a>
            <ul class="nav-group-sub collapse @if (request()->is('provider*')) show @endif">
                <li class="nav-item"><a href="{{ route('provider.coupon.index') }}"
                        class="{{ request()->is('provider/coupon*') ? 'nav-link active' : 'nav-link' }}">
                        Coupon</a></li>
                {{-- <li class="nav-item"><a href="{{ route('provider.eCampaign .index') }}"
                        class="{{ request()->is('provider/eCampaign*') ? 'nav-link active' : 'nav-link' }}">
                        Campaign</a></li> --}}
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('provider.pages.index') }}"
                class="{{ request()->is('provider/pages.index*') ? 'nav-link active' : 'nav-link' }}">
                <i class="far fa-file-word"></i>
                <span>Pages</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('provider.pickUpPoint.index') }}"
                class="{{ request()->is('provider/pickUpPoint.index*') ? 'nav-link active' : 'nav-link' }}">
                <i class="icon-truck"></i>
                <span>Pick-Up Point</span>
            </a>
        </li>
    </ul>
</div>
