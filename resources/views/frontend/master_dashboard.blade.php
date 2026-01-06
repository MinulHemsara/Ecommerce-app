<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Minul-Ecommerce</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->

    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/custom.css') }}" />

</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.body.quickview')
    <!-- Header  -->

    @include('frontend.body.header')
    <!-- End Header  -->




    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('Frontend/assets/imgs/theme/logo.svg') }}"
                            alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="index.html">Home</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="shop-grid-right.html">shop</a>
                                <ul class="dropdown">
                                    <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                    <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                    <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                    <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                    <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                            <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                            <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                            <li><a href="shop-product-vendor.html">Product – Vendor Infor</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop-filter.html">Shop – Filter</a></li>
                                    <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                    <li><a href="shop-cart.html">Shop – Cart</a></li>
                                    <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                    <li><a href="shop-compare.html">Shop – Compare</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Invoice</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                            <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                            <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                            <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                            <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                            <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Mega menu</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                                        <a href="#">Women's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Dresses</a></li>
                                            <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                            <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                            <li><a href="shop-product-right.html">Women's Sets</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Men's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Jackets</a></li>
                                            <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                            <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Technology</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                            <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                            <li><a href="shop-product-right.html">Tablets</a></li>
                                            <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                            <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-category-fullwidth.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product Layout</a>
                                        <ul class="dropdown">
                                            <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                            <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                            <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-forgot-password.html">Forgot password</a></li>
                                    <li><a href="page-reset-password.html">Reset password</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img
                            src="{{ asset('Frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('Frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('Frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('Frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('Frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
    <!--End header-->








    <main class="main">
        @yield('main')

    </main>


    @include('frontend.body.footer')





    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('Frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('Frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('Frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('Frontend/assets/js/shop.js?v=5.3') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    //  console.log(data);
                    $('#product_name').text(data.product.product_name);
                    $('#product_price').text(data.product.selling_price);
                    $('#product_image').attr('src', '/' + data.product.product_thambnail);
                    $('#product_code').text(data.product.product_code);
                    $('#product_category').text(data.product.category.category_name);
                    $('#product_brand').text(data.product.brand.brand_name);
                    $('#product_id').val(id);
                    $('#qty').val(1);

                    console.log(data.product.product_thambnail);

                    // Product Price
                    if (data.product.discount_price == null) {
                        $('#product_price').text('');
                        $('#old_price').text('');
                        $('#product_price').text('$' + data.product.selling_price);
                    } else {
                        $('#product_price').text('$' + data.product.discount_price);
                        $('#old_price').text('$' + data.product.selling_price);
                    } // end prodcut price

                    // Start Stock opiton
                    if (data.product.product_qty > 0) {
                        $('#available').text('Available');
                        $('#stockout').text('');
                    } else {
                        $('#available').text('');
                        $('#stockout').text('Stockout');
                    } // end Stock opiton

                    // Color
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + '">' + value +
                            '</option>')
                        if (data.color == "") {
                            $('#color_area').hide();
                        } else {
                            $('#color_area').show();
                        }
                    }) // end color

                    // Size
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + '">' + value +
                            '</option>')
                        if (data.size == "") {
                            $('#size_area').hide();
                        } else {
                            $('#size_area').show();
                        }
                    }) // end size

                }
            })
        }

        function addToCart() {
            var product_name = $('#product_name').text();
            var product_id = $('#product_id').val();
            var size = $('#size option:selected').val();
            var color = $('#color option:selected').val();
            var qty = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    size: size,
                    color: color,
                    qty: qty,
                    product_name: product_name
                },
                url: "/cart/data/store/" + product_id,
                success: function(data) {
                    $('#closeModel').click();
                    console.log(data);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }

                    miniCart();
                }
            })
        }
    </script>
    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('#cartQty').text(response.cartQty);
                    $('#totalValue').text('$' + response.cartTotal);
                    var miniCart = "";
                    $.each(response.cartItems, function(key, value) {
                        miniCart += `
                                    <li class="mini-cart-item">
                                    <div class="single-mini-img">
                                        <div class="mini-cart-thumb">
                                        <a href="shop-product-right.html">
                                            <img src="/${value.options.image}" alt="${value.name}" />
                                        </a>
                                        </div>

                                        <div class="mini-cart-info">
                                        <h6><a href="shop-product-right.html">${value.name}</a></h6>
                                        <span class="quantity">${value.qty} x <span class="price">$${value.price}</span></span>
                                        </div>

                                        <button
                                        class="shopping-cart-delete"
                                        id="${value.rowId}"
                                        onclick="miniCartRemove(this.id)"
                                        aria-label="Remove item"
                                        type="button"
                                        >
                                        <i class="fi-rs-cross-small"></i>
                                        </button>
                                    </div>
                                    </li>`;

                    });
                    $('#miniCart').html(miniCart);
                }
            });
        }
        miniCart();

        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
    </script>

    <script type="text/javascript">

    function addToCartDetails() {
            var product_name = $('#product_name').text();
            var product_id = $('#details_product_id').val();
            var size = $('#size option:selected').val();
            var color = $('#color option:selected').val();
            var qty = $('#qty').val();

              if ($('#size').length && !$('#size').val()) {
                alert('Please choose a size');
                return;
            }

            if ($('#color').length && !$('#color').val()) {
                alert('Please choose a color');
                return;
            }

            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    size: size,
                    color: color,
                    qty: qty,
                    product_name: product_name
                },
                url: "/detail_cart/data/store/" + product_id,
                success: function(data) {
                    console.log(data);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }

                    miniCart();
                }
            })
        }
    </script>

    <script type="text/javascript">
        function addToWishlist(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
                success: function(data) {
                        wishlist();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }

                }
            })
        }

        function addToCompare(product_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-compare/" + product_id,
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }

                }
            })
        }
    </script>

    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-product",
                success: function(data) {
                        $('#wishlist-count').text(data.count);

                    var rows = "";
                    $.each(data.wishlists, function(key, value) {
                        rows += `
                        <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                            </td>
                            <td class="image product-thumbnail pt-40">
                                <img src="/${value.product.product_thambnail}" alt="#" />
                            </td>
                            <td class="product-des product-name">
                                <h6><a class="product-name mb-10" href="#">${value.product.product_name}</a></h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                ${value.product.discount_price == null
                                    ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                                    : `<h3 class="text-brand">$${value.product.discount_price}</h3>
                                    <h3 class="text-brand text-muted" style="text-decoration: line-through; font-size: 14px;">$${value.product.selling_price}</h3>`
                                }
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                ${value.product.product_qty > 0
                                    ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                    : `<span class="stock-status out-stock mb-0"> Out of Stock </span>`
                                }
                            </td>
                            <td class="text-right" data-title="Cart">
                                <button class="btn btn-sm">Add to cart</button>
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a href="#" class="text-body" id="remove-wishlist-${value.id}" onclick="removeWishlist(${value.id})"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>`;
                    });

                    $('#wishlist').html(rows);
                }
            })
        }

        wishlist();

        function removeWishlist(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/" + id,
                success: function(data) {

                    wishlist();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }

                }
            })
        }
    
    </script>

</body>

</html>
