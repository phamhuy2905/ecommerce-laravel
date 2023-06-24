

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Easy Shop Online Store </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->  
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    

</head>

<body>
    <!-- Modal -->
 
    <!-- Quick view -->
  @include('frontend.body.quickview')
    <!-- Header  -->

    @php
        Use App\Models\Wishlish;
        $count_wishlist = Wishlish::count() ;
    @endphp
  @include('frontend.body.header')
    <!--End header--> 



    <main class="main">
        @yield('main')

    </main>

  @include('frontend.body.footer')


   
    <!-- Preloader Start -->
    {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    @stack('js')

    <script>

        function get(url, callback) {
            fetch(url)
                .then(response => {
                    return response.json();
                })
                .then(callback)
        }
        function minicart() {
            const total_count = document.querySelector('.total_count')
            const cart_total = document.querySelector('.cart_total span')
            const mini_cart = document.querySelector('.mini_cart')
                get('/cart/Add_mini_cart',function(data) {
                    const li_all = document.querySelectorAll('.li_all') ?? null
                    if(li_all) {
                        li_all.forEach(val => {
                            val.remove();
                        })
                    }
                    total_count.textContent = data.total_quantity;
                    cart_total.textContent = data.total;
                    const arr = Object.values(data.cart)
                    arr.forEach(value => {
                        const li = document.createElement('li')
                        li.classList.add('li_all')
                        li.innerHTML = 
                            `
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest"
                                        src="/${value.options.image}" /></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="shop-product-right.html">${value.name}</a></h4>
                                    <h4><span>${value.qty} × </span>${value.price}</h4>
                                </div>
                                <div class="shopping-cart-delete">
                                    <a class="remove_cart" onclick="Remove_cart('${value.rowId}')"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            `
                        mini_cart.appendChild(li);
                    });
                })
        }

        function Remove_cart(id) {
            const total = document.querySelector('.total')
            get("/cart/remove_cart/"+id, function(data) {
                minicart()
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.success,
                    showConfirmButton: false,
                    timer: 1000
                })
                if(total) {
                    total.textContent =  data.total;
                }
            })
        }
        window.addEventListener('load', function() {
            minicart()
        })

        function count_wishlist() {
            const count_wishlist = document.querySelector('.count_wishlist')
            get("/wishlist/count" ,function(data) {
                const count = data.count;
                count_wishlist.textContent = count
            });
        }


        window.addEventListener('load', function() {
            count_wishlist()
        })


        function postApi(url, data, callback) {
            const option = {
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify(data) ,
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json",
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value,
                },
            }
             fetch(url, option)
                .then(response => {
                    return response.json();
                })
                .then(callback)
                .catch(error => {
                    console.log('Lỗi mạng, vui lòng thử lại!');
                    
                })
        }

        function alertsweet(data) {
            const text = data.success || data.error
            const type = Object.keys(data)[0];
            Swal.fire({
                position: 'top-end',
                icon: type,
                title: text,
                showConfirmButton: false,
                timer: 1000,
                width: '25em',
                heightAuto: false,
            })
        }
        function alertsweet_error(data) {
            const type = data.error 
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: type,
                showConfirmButton: false,
                timer: 1000,
                width: '25em',
                heightAuto: false,
            })
        }

        const API = {
            get,
            postApi,
            alertsweet,
            alertsweet_error,
        }

    </script>
</body>

</html>