@extends('layouts.app')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="container my-4">
        <div class="bg-white shadow-sm rounded-3 overflow-hidden">
            <div class="row g-0">
                <!-- Product Images Section -->
                <div class="col-lg-6">
                    <div class="p-4">
                        <div class="carousel slide" id="productsCarousel">
                            <div class="carousel-inner rounded-3 overflow-hidden">
                                <div class="carousel-item active">
                                    <img 
                                        src="{{ asset($product->thumbnail) }}" 
                                        class="card-img-top d-block w-100" 
                                        alt="{{ $product->name }}"
                                        style="height: 500px; object-fit: contain; background-color: #f8f9fa;"
                                    >
                                </div>
                                @if ($product->first_image)
                                    <div class="carousel-item">
                                        <img 
                                            src="{{ asset($product->first_image) }}" 
                                            class="card-img-top d-block w-100" 
                                            alt="{{ $product->name }}"
                                            style="height: 500px; object-fit: contain; background-color: #f8f9fa;"
                                        >
                                    </div>
                                @endif
                                @if ($product->second_image)
                                    <div class="carousel-item">
                                        <img 
                                            src="{{ asset($product->second_image) }}" 
                                            class="card-img-top d-block w-100" 
                                            alt="{{ $product->name }}"
                                            style="height: 500px; object-fit: contain; background-color: #f8f9fa;"
                                        >
                                    </div>
                                @endif
                                @if ($product->third_image)
                                    <div class="carousel-item">
                                        <img 
                                            src="{{ asset($product->third_image) }}" 
                                            class="card-img-top d-block w-100" 
                                            alt="{{ $product->name }}"
                                            style="height: 500px; object-fit: contain; background-color: #f8f9fa;"
                                        >
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        
                        <!-- Thumbnails -->
                        <div class="row g-2 mt-3">
                            <div class="col-3">
                                <div class="thumbnail-row active rounded-2 overflow-hidden cursor-pointer" data-bs-target="#productsCarousel" data-bs-slide="0">
                                    <img 
                                        src="{{ asset($product->thumbnail) }}" 
                                        alt="{{ $product->name }}"
                                        class="w-100"
                                        style="height: 80px; object-fit: cover;"
                                    >
                                </div>
                            </div>
                            @if ($product->first_image)
                                <div class="col-3">
                                    <div class="thumbnail-row rounded-2 overflow-hidden cursor-pointer" data-bs-target="#productsCarousel" data-bs-slide="1">
                                        <img 
                                            src="{{ asset($product->first_image) }}" 
                                            alt="{{ $product->name }}"
                                            class="w-100"
                                            style="height: 80px; object-fit: cover;"
                                        >
                                    </div>
                                </div>
                            @endif
                            @if ($product->second_image)
                                <div class="col-3">
                                    <div class="thumbnail-row rounded-2 overflow-hidden cursor-pointer" data-bs-target="#productsCarousel" data-bs-slide="2">
                                        <img 
                                            src="{{ asset($product->second_image) }}" 
                                            alt="{{ $product->name }}"
                                            class="w-100"
                                            style="height: 80px; object-fit: cover;"
                                        >
                                    </div>
                                </div>
                            @endif
                            @if ($product->third_image)
                                <div class="col-3">
                                    <div class="thumbnail-row rounded-2 overflow-hidden cursor-pointer" data-bs-target="#productsCarousel" data-bs-slide="3">
                                        <img 
                                            src="{{ asset($product->third_image) }}" 
                                            alt="{{ $product->name }}"
                                            class="w-100"
                                            style="height: 80px; object-fit: cover;"
                                        >
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Product Details Section -->
                <div class="col-lg-6 border-start">
                    <div class="p-4 h-100 d-flex flex-column">
                        <!-- Product Title & Rating -->
                        <div class="mb-3">
                            <h1 class="h2 fw-bold text-dark mb-2">{{ $product->name }}</h1>
                            
                            @if($product->reviews->count())
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex">
                                        @for ($i = 1; $i <= 5; $i++ )
                                            <i class="fas fa-star {{ $i <= $product->avgRating() ? 'text-warning' : 'text-light' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="text-muted">
                                        ({{ $product->reviews->count() }}
                                        {{ $product->reviews->count() > 1 ? 'Reviews' : 'Review'}})
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Price Section -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3">
                                @if ($product->old_price)
                                    <span class="text-decoration-line-through fs-5 text-muted">
                                        ${{ $product->old_price }}
                                    </span>
                                @endif
                                <span class="fw-bold text-dark fs-3">${{ $product->price }}</span>
                                @if ($product->discount)
                                    <span class="badge bg-danger fs-6">-{{ $product->discount }}%</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Category Information -->
                        <div class="mb-4">
                            <div class="d-flex flex-wrap gap-3">
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-tag me-1"></i> {{ $product->category->name }}
                                </span>
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-layer-group me-1"></i> {{ $product->subcategory->name }}
                                </span>
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-table-list me-1"></i> {{ $product->childcategory->name }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Stock Status -->
                        <div class="mb-4">
                            @if ($product->status)
                                <span class="badge bg-success fs-6 p-2">
                                    <i class="fas fa-check-circle me-1"></i> In Stock ({{ $product->qty }} available)
                                </span>
                            @else  
                                <span class="badge bg-danger fs-6 p-2">
                                    <i class="fas fa-times-circle me-1"></i> Out Of Stock
                                </span>
                            @endif
                        </div>
                        
                        <!-- Product Description -->
                        <div class="mb-4 flex-grow-1">
                            <h3 class="h5 mb-2">Description</h3>
                            <div class="text-muted" style="max-height: 150px; overflow-y: auto;">
                                {!! $product->description !!}
                            </div>
                        </div>
                        
                        <!-- Product Options Form -->
                        <form action="{{ route('cart.add') }}" method="post" class="mt-auto" id="product-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="size" id="selected-size" value="">
                            <input type="hidden" name="color" id="selected-color" value="">
                            
                            <!-- Size Selection -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="h5 mb-0">Choose a size</h4>
                                    <small class="text-muted">Click to select/unselect</small>
                                </div>
                                <div class="d-flex flex-wrap gap-2" id="size-selection">
                                    @foreach ($product->sizes as $size)
                                        <div class="size-option d-flex justify-content-center align-items-center rounded-1"
                                             data-size="{{ $size->name }}"
                                             data-size-id="{{ $size->id }}"
                                             style="min-width: 50px;">
                                            <span class="size-text">{{ $size->name }}</span>
                                            <div class="selection-indicator">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-2">
                                    <small id="size-error" class="text-danger d-none">Please select a size</small>
                                </div>
                            </div>
                            
                            <!-- Color Selection -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="h5 mb-0">Choose a color</h4>
                                    <small class="text-muted">Click to select/unselect</small>
                                </div>
                                <div class="d-flex flex-wrap gap-2" id="color-selection">
                                    @foreach ($product->colors as $color)
                                        <div class="color-option rounded-circle border position-relative"
                                             data-color="{{ $color->name }}"
                                             data-color-id="{{ $color->id }}"
                                             style="width: 40px; height: 40px; background-color: {{ $color->name }}; cursor: pointer;"
                                             title="{{ $color->name }}"
                                             aria-label="{{ $color->name }}">
                                            <span class="visually-hidden">{{ $color->name }}</span>
                                            <div class="color-checkmark">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-2">
                                    <small id="color-error" class="text-danger d-none">Please select a color</small>
                                </div>
                            </div>
                            
                            <!-- Selection Summary -->
                            <div class="alert alert-light border mb-4 d-none" id="selection-summary">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Selected:</strong>
                                        <span id="selected-size-text" class="ms-2">No size selected</span>
                                        <span id="selected-color-text" class="ms-3">No color selected</span>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="clear-selection">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Quantity & Add to Cart -->
                            <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
                                <div class="d-flex align-items-center">
                                    <label for="quantity" class="form-label me-2 mb-0">Qty:</label>
                                    <input 
                                        type="number" 
                                        name="qty" 
                                        id="quantity"
                                        max="{{ $product->qty }}"
                                        min="1"
                                        value="1"
                                        class="form-control w-auto"
                                        style="max-width: 80px;"
                                    >
                                </div>
                                <button type="submit"
                                    class="btn btn-primary btn-lg flex-grow-1 {{ !$product->status ? 'disabled' : '' }}"
                                    id="add-to-cart-btn"
                                >
                                   <i class="fas fa-shopping-cart me-2"></i> Add to cart
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
        <div class="mt-4">
            @include('reviews.reviews-list')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add active class to the active image 
        const thumbnails = document.querySelectorAll('.thumbnail-row');
        const carousel = document.querySelector('#productsCarousel');

        carousel.addEventListener('slide.bs.carousel', (e) => {
            thumbnails.forEach(el => el.classList.remove('active'));
            thumbnails[e.to].classList.add('active');
        });
        
        // Track selected options
        let selectedSize = null;
        let selectedColor = null;
        
        // Size selection with toggle functionality
        document.querySelectorAll('.size-option').forEach(option => {
            option.addEventListener('click', function() {
                const size = this.getAttribute('data-size');
                const sizeId = this.getAttribute('data-size-id');
                
                if (selectedSize === size) {
                    // Unselect if clicking the same size
                    this.classList.remove('active', 'size-selected');
                    selectedSize = null;
                    document.getElementById('selected-size').value = '';
                } else {
                    // Remove active class from all size options
                    document.querySelectorAll('.size-option').forEach(opt => {
                        opt.classList.remove('active', 'size-selected');
                    });
                    
                    // Add active class to clicked option
                    this.classList.add('active', 'size-selected');
                    selectedSize = size;
                    document.getElementById('selected-size').value = size;
                    
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple-effect');
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation completes
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                }
                
                updateSelectionSummary();
                validateForm();
            });
        });
        
        // Color selection with toggle functionality
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                const color = this.getAttribute('data-color');
                const colorId = this.getAttribute('data-color-id');
                
                if (selectedColor === color) {
                    // Unselect if clicking the same color
                    this.classList.remove('active', 'color-selected');
                    selectedColor = null;
                    document.getElementById('selected-color').value = '';
                } else {
                    // Remove active class from all color options
                    document.querySelectorAll('.color-option').forEach(opt => {
                        opt.classList.remove('active', 'color-selected');
                    });
                    
                    // Add active class to clicked option
                    this.classList.add('active', 'color-selected');
                    selectedColor = color;
                    document.getElementById('selected-color').value = color;
                    
                    // Add pulse animation
                    this.style.animation = 'pulse 0.5s ease';
                    
                    // Remove animation after it completes
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 500);
                }
                
                updateSelectionSummary();
                validateForm();
            });
        });
        
        // Clear all selections
        document.getElementById('clear-selection').addEventListener('click', function() {
            // Clear sizes
            document.querySelectorAll('.size-option').forEach(opt => {
                opt.classList.remove('active', 'size-selected');
            });
            selectedSize = null;
            document.getElementById('selected-size').value = '';
            
            // Clear colors
            document.querySelectorAll('.color-option').forEach(opt => {
                opt.classList.remove('active', 'color-selected');
            });
            selectedColor = null;
            document.getElementById('selected-color').value = '';
            
            updateSelectionSummary();
            validateForm();
        });
        
        // Update selection summary
        function updateSelectionSummary() {
            const summaryElement = document.getElementById('selection-summary');
            const sizeText = document.getElementById('selected-size-text');
            const colorText = document.getElementById('selected-color-text');
            
            if (selectedSize || selectedColor) {
                summaryElement.classList.remove('d-none');
                
                sizeText.textContent = selectedSize ? `Size: ${selectedSize}` : 'No size selected';
                sizeText.className = selectedSize ? 'ms-2 badge bg-primary' : 'ms-2 text-muted';
                
                colorText.textContent = selectedColor ? `Color: ${selectedColor}` : 'No color selected';
                colorText.className = selectedColor ? 'ms-3 badge bg-primary' : 'ms-3 text-muted';
            } else {
                summaryElement.classList.add('d-none');
            }
        }
        
        // Validate form before submission
        function validateForm() {
            const sizeError = document.getElementById('size-error');
            const colorError = document.getElementById('color-error');
            const addToCartBtn = document.getElementById('add-to-cart-btn');
            
            let isValid = true;
            
            // Show/hide error messages
            if (!selectedSize) {
                sizeError.classList.remove('d-none');
                isValid = false;
            } else {
                sizeError.classList.add('d-none');
            }
            
            if (!selectedColor) {
                colorError.classList.remove('d-none');
                isValid = false;
            } else {
                colorError.classList.add('d-none');
            }
            
            // Update button state
            if (isValid) {
                addToCartBtn.classList.remove('btn-secondary');
                addToCartBtn.classList.add('btn-primary');
            } else {
                addToCartBtn.classList.remove('btn-primary');
                addToCartBtn.classList.add('btn-secondary');
            }
            
            return isValid;
        }
        
        // Form submission validation
        document.getElementById('product-form').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                
                // Show error animation
                if (!selectedSize) {
                    document.getElementById('size-selection').style.animation = 'shake 0.5s ease';
                    setTimeout(() => {
                        document.getElementById('size-selection').style.animation = '';
                    }, 500);
                }
                
                if (!selectedColor) {
                    document.getElementById('color-selection').style.animation = 'shake 0.5s ease';
                    setTimeout(() => {
                        document.getElementById('color-selection').style.animation = '';
                    }, 500);
                }
                
                // Scroll to first error
                if (!selectedSize) {
                    document.getElementById('size-selection').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                } else if (!selectedColor) {
                    document.getElementById('color-selection').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }
        });
        
        // Initialize form validation on page load
        document.addEventListener('DOMContentLoaded', function() {
            validateForm();
        });
    </script>
    
    <style>
        .thumbnail-row {
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        
        .thumbnail-row.active {
            border-color: #0d6efd;
        }
        
        .thumbnail-row:hover:not(.active) {
            border-color: #dee2e6;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .text-light {
            color: #dee2e6 !important;
        }
        
        /* Size Option Styles */
        .size-option {
            background-color: #f8f9fa;
            border: 2px solid #dee2e6;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }
        
        .size-option:hover {
            border-color: #adb5bd;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .size-option.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(13, 110, 253, 0.3);
        }
        
        .size-option .selection-indicator {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
            margin-left: 5px;
        }
        
        .size-option.active .selection-indicator {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Ripple Effect */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.7);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* Color Option Styles */
        .color-option {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .color-option:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .color-option.active {
            transform: scale(1.15);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
            border-width: 3px !important;
            border-color: #0d6efd !important;
        }
        
        .color-checkmark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition: all 0.3s ease;
            font-size: 14px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        }
        
        .color-option.active .color-checkmark {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }
        
        /* Pulse Animation */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
            }
        }
        
        /* Shake Animation for Errors */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        /* Selection text animation */
        .size-text {
            transition: all 0.3s ease;
        }
        
        .size-option.active .size-text {
            font-weight: bold;
        }
        
        /* Selection Summary Styles */
        #selection-summary {
            transition: all 0.3s ease;
        }
    </style>
@endsection