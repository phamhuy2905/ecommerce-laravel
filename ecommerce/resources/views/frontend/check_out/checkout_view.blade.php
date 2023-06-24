@extends('frontend.master_dashboard')
@section('main')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Checkout
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-lg-8 mb-40">
            <h3 class="heading-2 mb-10">Checkout</h3>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">There are products in your cart</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">

            <div class="row">
                <h4 class="mb-30">Billing Details</h4>
                <form method="post" action="{{ route('checkout.processcheckout') }}" id="form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="Email" value="{{ $data->email }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="name_recipient">Name Ricipient</label>
                            <input type="text" id="name_recipient"  name="name_recipient" placeholder=" Name" value="{{ $data->name }}">
                        </div>
                    </div>


                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <label>Provice <span class="required">*</span></label>
                                <select name="provinces" id="provinces" class="form-control ">
                                    <option value="-1">Chọn--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="phone_recipient">Phone Recipient</label>
                            <input  id="phone" type="text" name="phone_recipient" placeholder="Phone*" value="{{ $data->phone }}">
                        </div>
                    </div>

                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <label>District <span class="required">*</span></label>
                                <select name="districts" id="districts" class="form-control ">
                                    <option value="-1">Chọn--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="user">User name</label>
                            <input id="user"  type="text" name="user" placeholder="User Name" value="{{ $data->username }}"> 
                        </div>
                    </div>


                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <label>Ward <span class="required">*</span></label>
                                <select name="wards" id="wards" class="form-control ">
                                    <option value="-1">Chọn--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <input  type="text" name="street" placeholder="Address *"value="{{ $data->address }}">
                        </div>
                    </div>

                    <div class="form-group mb-30">
                        <textarea rows="5" placeholder="Additional information" name="description_infomation"></textarea>
                    </div>
                    {{-- <button class="btn btn-success">Sumit</button> --}}
                </form>
            </div>
        </div>


        <div class="col-lg-5">
            <div class="border p-40 cart-totals ml-30 mb-50">
                <div class="d-flex align-items-end justify-content-between mb-30">
                    <h4>Your Order</h4>
                    <h6 class="text-muted">Subtotal</h6>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="table-responsive order_table checkout">
                    <table class="table no-border">
                        <tbody>
                            @foreach ($cart as $each)
                            <tr>
                                <td class="image product-thumbnail"><img src="{{ $each->options->image }}" alt="#">
                                </td>
                                <td>
                                    <h6 class="w-160 mb-5"><a href="shop-product-full.html"
                                            class="text-heading">{{ $each->name }}</a></h6></span>
                                    <div class="product-rate-cover">

                                        <strong>Color : </strong>
                                        <strong>Size : </strong>

                                    </div>
                                </td>
                                <td>
                                    <h6 class="text-muted pl-20 pr-20">x {{ $each->qty }}</h6>
                                </td>
                                <td>
                                    <h4 class="text-brand">${{ $each->qty * $each->price }}</h4>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>




                    <table class="table no-border">
                        <tbody>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">${{ $total  }}</h4>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupn Name</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">EASYLEA</h6>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon Discount</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$12.31</h4>
                                </td>form
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">$12.31</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
            <div class="payment ml-30">
                <h4 class="mb-30">Payment</h4>
                <div class="payment_option">
                    <div class="custome-radio">
                        <input class="form-check-input"  type="radio" name="payment_option"
                            id="exampleRadios3" checked="">
                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                            data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                    </div>
                    <div class="custome-radio">
                        <input class="form-check-input"  type="radio" name="payment_option"
                            id="exampleRadios4" checked="">
                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                            data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                    </div>
                    <div class="custome-radio">
                        <input class="form-check-input"  type="radio" name="payment_option"
                            id="exampleRadios5" checked="">
                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                            data-target="#paypal" aria-controls="paypal">Online Getway</label>
                    </div>
                </div>
                <div class="payment-logo d-flex">
                    <img class="mr-15" src="assets/imgs/theme/icons/payment-paypal.svg" alt="">
                    <img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">
                    <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">
                    <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                </div>
                {{-- <a href="#" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></a> --}}
                <a class="btn btn-success btn_checkout" onclick="Checkout()">Sumit</a>
            </div>
        </div>
    </div>
</div>


<script>
        
    const provinces = document.querySelector('#provinces');
    const districts = document.querySelector('#districts');
    const wards = document.querySelector('#wards');

    let flag = true;
    provinces.addEventListener('click', function(e) {
        console.log(123);
        if(flag) {
        console.log(123);
            API.get("/address", function(data) {
                Address(data, provinces)
            })
        }
        flag = false;

    })

    provinces.addEventListener('change', function(e) {
        API.get("/address/districts/"+this.value, function(data) {
            Address(data, districts) 
        })
        wards.innerHTML = `<option value="-1">Chọn--</option>`
        districts.innerHTML = `<option value="-1">Chọn--</option>`
    })

    districts.addEventListener('change', function(e) {
        console.log(123);
        API.get("/address/wards/"+this.value, function(data) {
            Address(data, wards)
        })
    })

    function Address(data = [], element) {
        const htmls = data.map(val => {
            return `<option value="${val.id}">${val.name}</option>`
        })
        htmls.unshift(`<option value="-1">Chọn--</option>`)
        element.innerHTML = htmls.join('')
    }

    const form = document.querySelector('#form')
    function Checkout() {
        if(provinces.value == -1 || districts.value == -1 || wards.val == -1) {
            return 0;   
        }
        form.submit()
    }

</script>
@endsection