<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-lg py-3 px-4 sticky-top">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-3 text-gradient" href="{{ route('home') }}">
            <i class="fas fa-crown me-2 text-warning"></i>
            FashionStore
        </a>

        <!-- Search Bar -->
        <form action="{{ route('search.products') }}" class="d-flex mx-4 search-bar flex-grow-1" style="max-width: 500px;">
            <div class="input-group search-container">
                <input 
                    class="form-control search-input rounded-pill border-0 shadow-sm"
                    type="search" 
                    value="{{ request('searchTerm') }}"
                    name="searchTerm" 
                    placeholder="Search for products, brands, and more..." 
                    aria-label="Search">
                <button class="btn search-button rounded-pill bg-gradient text-white shadow" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <!-- User Actions -->
        <div class="d-flex align-items-center gap-4">
            <!-- User Menu -->
            @auth     
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle user-menu" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar bg-gradient rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <span class="ms-2 fw-semibold text-dark d-none d-md-block">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('user.profile') }}">
                                <i class="fas fa-user-circle me-3 text-primary"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('user.orders') }}">
                                <i class="fas fa-shopping-bag me-3 text-success"></i>
                                <span>My Orders</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 text-danger" 
                               href="#" onclick="document.getElementById('userLogoutForm').submit()">
                                <i class="fas fa-sign-out-alt me-3"></i>
                                <span>Logout</span>
                            </a>
                            <form id="userLogoutForm" action="{{ route('user.logout') }}" method="post">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- Guest Menu -->
            @guest
                <div class="d-flex gap-3">
                    <a href="{{ route('user.register') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3" title="Register">
                        <i class="fas fa-user-plus me-1"></i>
                        <span class="d-none d-md-inline">Register</span>
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-pill px-3" title="Login">
                        <i class="fas fa-sign-in-alt me-1"></i>
                        <span class="d-none d-md-inline">Login</span>
                    </a>
                </div>
            @endguest

            <!-- Cart -->
            <div class="position-relative">
                <a href="{{ route('cart.index') }}" class="cart-icon position-relative text-dark" title="Cart">
                    <div class="cart-container bg-light rounded-circle p-2 shadow-sm">
                        <i class="fas fa-shopping-bag fs-5"></i>
                    </div>
                    <span class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count(session()->get('cart', [])) }}
                        <span class="visually-hidden">items in cart</span>
                    </span>
                </a>
            </div>

            <!-- Total Price -->
            <div class="total-price bg-gradient text-white rounded-pill px-3 py-2 shadow">
                <small class="fw-light">Total:</small>
                <span class="fw-bold fs-6">
                    @if(session()->has('applied_coupon'))
                        ${{ number_format(session()->get('cartItemsTotal') - session()->get('cartItemsTotal') * session()->get('applied_coupon')->discount / 100, 2) }}
                    @elseif(session()->has('cartItemsTotal'))
                        ${{ number_format(session()->get('cartItemsTotal'), 2) }}
                    @else
                        $0.00
                    @endif
                </span>
            </div>
        </div>
    </div>
</nav>

<!-- Mega Menu -->
<div class="mega-menu-container bg-white shadow-sm border-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="nav mega-nav justify-content-center py-2">
                    <li class="nav-item">
                        <a class="nav-link home-link d-flex align-items-center fw-semibold" href="{{ route('home') }}">
                            <i class="fas fa-home me-2"></i>
                            Home
                        </a>
                    </li>
                    
                    @foreach ($categories as $category)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" 
                           href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <i class="fas fa-tag me-2 text-primary"></i>
                            {{ $category->name }}
                        </a>
                        <div class="dropdown-menu mega-dropdown shadow-lg border-0 rounded-3 p-4">
                            <div class="container-fluid">
                                <div class="row g-4">
                                    @foreach ($category->subcategories as $subcategory)
                                    <div class="col-lg-3 col-md-4">
                                        <div class="mega-menu-section">
                                            <a href="{{ route('subcategory.products',$subcategory->slug) }}" 
                                               class="section-title d-block fw-bold text-dark mb-3 pb-2 border-bottom">
                                                {{ $subcategory->name }}
                                                <span class="badge bg-primary ms-2">{{ $subcategory->products->count() }}</span>
                                            </a>
                                            <div class="child-categories">
                                                @foreach ($subcategory->childcategories as $childcategory)
                                                <a class="dropdown-item d-flex align-items-center justify-content-between py-2 px-0" 
                                                   href="{{ route('childcategory.products',$childcategory->slug) }}">
                                                    <span>{{ $childcategory->name }}</span>
                                                    <small class="text-muted">{{ $childcategory->products->count() }}</small>
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach

                    <!-- Brands -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-star me-2 text-warning"></i>
                            Brands
                        </a>
                        <div class="dropdown-menu mega-dropdown shadow-lg border-0 rounded-3 p-4">
                            <div class="container-fluid">
                                <div class="row g-3">
                                    @foreach ($brands as $brand)
                                    <div class="col-lg-2 col-md-3 col-4">
                                        <a href="{{ route('brand.products',$brand->slug) }}" 
                                           class="brand-item text-center text-decoration-none">
                                            <div class="brand-card p-3 rounded-3 border hover-shadow">
                                                <div class="brand-icon mb-2">
                                                    <i class="fas fa-copyright fs-4 text-primary"></i>
                                                </div>
                                                <div class="brand-name small fw-bold text-dark">{{ $brand->name }}</div>
                                                <div class="brand-count text-muted x-small">{{ $brand->products->count() }} items</div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Sizes -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ruler me-2 text-info"></i>
                            Sizes
                        </a>
                        <div class="dropdown-menu mega-dropdown shadow-lg border-0 rounded-3 p-4">
                            <div class="container-fluid">
                                <div class="row g-2">
                                    @foreach ($sizes as $size)
                                    <div class="col-lg-2 col-md-3 col-4">
                                        <a href="{{ route('size.products',$size->slug) }}" 
                                           class="size-item text-decoration-none">
                                            <div class="size-card text-center p-3 rounded-3 border hover-shadow">
                                                <div class="size-badge bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                                     style="width: 40px; height: 40px;">
                                                    <span class="fw-bold text-dark">{{ $size->name }}</span>
                                                </div>
                                                <div class="size-count text-muted x-small">{{ $size->products->count() }} items</div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Colors -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-palette me-2 text-success"></i>
                            Colors
                        </a>
                        <div class="dropdown-menu mega-dropdown shadow-lg border-0 rounded-3 p-4">
                            <div class="container-fluid">
                                <div class="row g-3">
                                    @foreach ($colors as $color)
                                    <div class="col-lg-2 col-md-3 col-4">
                                        <a href="{{ route('color.products',$color->slug) }}" 
                                           class="color-item text-decoration-none">
                                            <div class="color-card text-center p-3 rounded-3 border hover-shadow">
                                                <div class="color-swatch mb-2 mx-auto rounded-circle border"
                                                     style="background-color: {{ $color->name }}; width: 40px; height: 40px;">
                                                </div>
                                                <div class="color-name small fw-bold text-dark text-capitalize">
                                                    {{ str_replace(['#', '-'], '', $color->name) }}
                                                </div>
                                                <div class="color-count text-muted x-small">{{ $color->products->count() }} items</div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Sort and Pagination Options -->
@if(request()->routeIs('home') || request()->routeIs('order.products'))
<div class="sorting-section bg-light py-3 border-bottom">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <form method="GET" action="{{ route('home') }}" class="d-flex align-items-center">
                    <span class="fw-semibold text-muted me-3">Show:</span>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="per_page" value="4" id="per_page4" 
                               {{ request('per_page') == 4 ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="btn btn-outline-primary" for="per_page4">4</label>

                        <input type="radio" class="btn-check" name="per_page" value="8" id="per_page8" 
                               {{ request('per_page') == 8 ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="btn btn-outline-primary" for="per_page8">8</label>

                        <input type="radio" class="btn-check" name="per_page" value="12" id="per_page12" 
                               {{ request('per_page') == 12 ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="btn btn-outline-primary" for="per_page12">12</label>
                    </div>
                    <span class="fw-semibold text-muted ms-3">per page</span>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <form method="GET" action="{{ route('order.products') }}" class="d-flex align-items-center justify-content-end gap-2">
                    <span class="fw-semibold text-muted">Sort by:</span>
                    <select name="field" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        <option value="name" {{ request('field') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request('field') == 'price' ? 'selected' : '' }}>Price</option>
                        <option value="created_at" {{ request('field') == 'date' ? 'selected' : '' }}>Date</option>
                    </select>
                    <select name="direction" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<style>
/* Custom Styles */
.text-gradient {
    background: linear-gradient(45deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient {
    background: linear-gradient(45deg, #667eea, #764ba2) !important;
}

.search-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
    border-color: #667eea !important;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, #667eea, #764ba2);
}

.cart-container {
    transition: all 0.3s ease;
    width: 45px;
    height: 45px;
}

.cart-container:hover {
    background: linear-gradient(45deg, #667eea, #764ba2) !important;
    transform: scale(1.1);
}

.cart-container:hover i {
    color: white !important;
}

.cart-badge {
    font-size: 0.7rem;
    padding: 0.35em 0.65em;
}

.total-price {
    transition: all 0.3s ease;
}

.total-price:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.mega-dropdown {
    width: 90vw;
    max-width: 1200px;
    margin-top: 10px !important;
}

.mega-nav .nav-link {
    color: #495057;
    padding: 0.8rem 1.2rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    margin: 0 0.2rem;
}

.mega-nav .nav-link:hover,
.mega-nav .nav-link.active {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white !important;
    transform: translateY(-2px);
}

.home-link {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white !important;
}

.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    transition: all 0.3s ease;
}

.brand-card, .size-card, .color-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.section-title {
    transition: all 0.3s ease;
    border-bottom: 2px solid transparent;
}

.section-title:hover {
    border-bottom-color: #667eea;
}

.dropdown-item:hover {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white !important;
    border-radius: 0.375rem;
}

.x-small {
    font-size: 0.75rem;
}

.sticky-top {
    position: sticky;
    top: 0;
    z-index: 1020;
}

.mega-menu-container {
    position: relative;
    z-index: 1010;
}

.sorting-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.btn-check:checked + .btn-outline-primary {
    background-color: #667eea;
    border-color: #667eea;
    color: white;
}
</style>