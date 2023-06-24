@extends('frontend.master_dashboard')
@section('main')

@php
    use Gloudemans\Shoppingcart\Facades\Cart;
    $total = Cart::total();
@endphp
 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <h1 class="heading-2 mb-10">Cart View</h1>
                    <h6 class="text-body mb-40">There are all products</h6>
                    <div class="table-responsive">
                        <table class="table text-center table-compare">
                            <tHead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantiy</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </tHead>
                            <tbody class="cart">
                                @foreach ($data as $each)
                                <tr class="cart-{{ $each->rowId }}">
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $each->name }}</td>
                                    <td>
                                        <img src="{{ url($each->options->image) }}" alt="" height="70px" style="object-fit: cover">
                                    </td>
                                    <td>{{ $each->price}}</td>
                                    <td>
                                        <div class=" d-flex align-items-center " style="justify-content: center">
                                            <a class="qty-up btn" style="padding: 0 5px;"><i class="fa-solid fa-plus"></i></a>
                                            <input type="text" style="width: 50px; height:30px; margin:0 10px; padding:0; text-align: center" 
                                            value="{{ $each->qty }}" disabled data-set="{{ $each->rowId }}">
                                            <a  class="qty-down btn" style="padding: 0 5px;"><i class="fa-solid fa-minus"></i></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $each->price * $each->qty }}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="destroy('{{ $each->rowId }}')"><i class="fi-rs-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tHead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantiy</th>
                                    <th class="total">{{ $total }}</th>
                                    <th>Remove</th>
                                </tr>
                            </tHead>
                        </table>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="p-40">
                        <h4 class="mb-10">Apply Coupon</h4>
                        <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                        <form action="#" class="form">
                            <div class="d-flex justify-content-between">
                                <input class="font-medium mr-15 coupon" id="coupon_name" placeholder="Enter Your Coupon">
                                <a type="submit" onclick="Applydiscount()" class="btn btn-success">Apply</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="p-40 d-flex justify-content-between">
                        <h4 class="mb-10 amount"></h4>
                        <a href="{{ route('checkout.index') }}" class="btn btn-success"><i class="fi-rs-label mr-10"></i>Checkout</a>
                    </div>
                </div>

            </div>
        </div>
@push('js')
<script>

    
const cart = document.querySelector('.cart')
const amount = document.querySelector('.amount')
const total = document.querySelector('.total')
const coupon = document.querySelector('.coupon')



    function destroy(id) {
        const remove = document.querySelector(`.cart-${id}`)
        const url = '/cart/remove_cart/'+id;
        get(url, function(response) {
            console.log(response);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title:response.success,
                showConfirmButton: false,
                timer: 1000,
                width: '25em',
                heightAuto: false,
            })
            remove.remove()
            minicart()
            total.textContent = response.total;
        })
    }
    
    cart.addEventListener('click', function(e) {
        const target = e.target
        if(target.closest('.qty-up')) {
            const quantity = target.closest('.qty-up').parentElement.querySelector('input')
            const flag = quantity.value > 0 &&  quantity.value++;
            const id = quantity.getAttribute('data-set')
            const url = '/cart/increment/'+id;
            API.get(url, response => {
                alertsweet(response)
                total.textContent = response.total;
                minicart()
            });
        }
        else if(target.closest('.qty-down')) {
            const quantity = target.closest('.qty-down').parentElement.querySelector('input')
            const flag = quantity.value > 1 && quantity.value--;
            if(flag) {
                const id = quantity.getAttribute('data-set')
                const url = '/cart/minus/'+id;
                API.get(url, response => {
                    alertsweet(response)
                    total.textContent = response.total;
                    minicart()
                });
            }
        }
    })

    function Applydiscount() {
        const value = coupon.value;
        if(value) {
            API.get('/cart/apply_discount/'+value, response => {
                console.log(response);
                response.total ? amount.textContent = 'Total: '+ response.total.toFixed(2)+'$' : amount.textContent = '';
                API.alertsweet(response)
            })
        }
    }


    
</script>
@endpush
@endsection