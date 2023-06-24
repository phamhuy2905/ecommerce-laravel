@extends('frontend.master_dashboard')
@section('main')

    <!-- End Header  -->
    @if ($errors->any())
    <div class="d-flex justify-content-end mt-20 toast_message" role="alert" aria-live="assertive" aria-atomic="true">
        <div class=" toast d-flex align-items-center text-white bg-danger border-0s"
        style="opacity: 1 ">
            <div class="toast-body">
                Thông tin bạn nhập chưa hợp lệ, vui lòng kiểm tra lại!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (Session::has('message_profile'))
    <div class="d-flex justify-content-end mt-20 toast_message" role="alert" aria-live="assertive" aria-atomic="true">
        <div class=" toast d-flex align-items-center text-white bg-success border-0s"
        style="opacity: 1 ">
            <div class="toast-body">
                {{ Session::get('message_profile') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (Session::has('message_success'))
    <div class="d-flex justify-content-end mt-20 toast_message" role="alert" aria-live="assertive" aria-atomic="true">
        <div class=" toast d-flex align-items-center text-white bg-success border-0s"
        style="opacity: 1 ">
            <div class="toast-body">
                {{ Session::get('message_success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if (Session::has('message_error'))
    <div class="d-flex justify-content-end mt-20 toast_message" role="alert" aria-live="assertive" aria-atomic="true">
        <div class=" toast d-flex align-items-center text-white bg-danger border-0s"
        style="opacity: 1 ">
            <div class="toast-body">
                {{ Session::get('message_error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    @endif
    
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span>My Account</span> 
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="true"><i class="fi-rs-user mr-10"></i>Change Password</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Hello </h3>
                                                <br>
                                                <img id="showImage" alt="User" class="rounded-circle p-1 bg-primary"
                                                    src="{{ empty($data->photo) ? url('/img/no_img.jpg')
                                                    : url('/img/adm_img/'.$data->photo) }}" 
                                                    alt="User" class="rounded  border-primary show_img bg-primary" 
                                                    height="64" width="64" 
                                                >
    
    
                                            </div>
                                            <div class="card-body">
                                                <p>
                                                    From your account dashboard. you can easily check ; view your <a href="#">recent orders</a>,<br />
                                                    manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Your Orders</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @php
                                                        Use App\Models\Bill;
                                                        Use App\Models\BillDetail;
                                                        use Illuminate\Support\Facades\Auth;

                                                        $bill = Bill::join('bill_details','bill_details.bill_id','bills.id')
                                                        ->join('address_recipients','address_recipients.bill_id','bills.id')
                                                        ->selectRaw('count(bills.id) as count')
                                                        ->addSelect('bills.id as bills_id', 'bills.status', 'bills.total', 'bills.created_at')
                                                        ->addSelect('address_recipients.*')
                                                        ->where('bills.user_id', Auth::id())
                                                        ->groupBy('bills.id')
                                                        ->groupBy('address_recipients.id')
                                                        ->orderBy('bills_id', 'desc')
                                                        ->get();
                                                        
                                                    @endphp
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Address Recipient</th>
                                                                <th>Total</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($bill as $each)
                                                            <tr>
                                                                <td>${{$loop->index + 1 }}</td>
                                                                <td>{{ $each->created_at }}</td>
                                                                <td>{{ $each->Namestatus }}</td>
                                                                <td>{{ $each->NameAddress }}</td>
                                                                <td>{{ $each->total }}$ for {{ $each->count }} item</td>
                                                                <td><a href="{{ route('checkout.vieworder', $each->bills_id) }}" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Orders tracking</h3>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id" placeholder="Found in your order confirmation email" type="text" />
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email" placeholder="Email you used during checkout" type="email" />
                                                            </div>
                                                            <button class="submit submit-auto-width" type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <img  
                                                    src="{{ empty($data->photo) ? url('/img/no_img.jpg')
                                                    : url('/img/adm_img/'.$data->photo) }}" 
                                                    alt="User" class="rounded  border-primary show_img bg-primary" 
                                                    height="64" width="64" 
                                                >
                                                <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="image">Upload new photo</label>
                                                @if($errors->has('photo'))
                                                    <div class="text-danger">{{ $errors->first('photo') }}</div>
                                                @endif
                                                <form method="POST" action="{{ route('user.edit_profile') }}" enctype="multipart/form-data" >
                                                @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <input 
                                                                class="form-control" name="photo" 
                                                                type="file"  id="image" hidden 
                                                            />
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>User Name <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="username" type="text" value="{{ $data->username }}" />
                                                            @if($errors->has('username'))
                                                                <div class="text-danger">{{ $errors->first('username') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Full Name <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="name" 
                                                            value="{{ $data->name }}" />
                                                            @if($errors->has('username'))
                                                            <div class="text-danger">{{ $errors->first('username') }}</div>
                                                        @endif
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Email <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="email" type="text" value="{{ $data->email }}" disabled/>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Phone <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="phone" type="text" value="{{ $data->phone }}" />
                                                            @if($errors->has('phone'))
                                                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                                                        @endif
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Provice <span class="required">*</span></label>
                                                            <select name="provinces" id="provinces" class="form-control">
                                                                <option value="-1">Chọn--</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>District <span class="required">*</span></label>
                                                            <select name="districts" id="districts" class="form-control">
                                                                <option value="">Chọn--</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Ward <span class="required">*</span></label>
                                                            <select name="wards" id="wards" class="form-control">
                                                                <option value="">Chọn--</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Address <span class="required">*</span></label>
                                                            <input required="" class="form-control" name="address" type="text" value="{{ $data->address }}" />
                                                            @if($errors->has('address'))
                                                            <div class="text-danger">{{ $errors->first('address') }}</div>
                                                        @endif
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Change Password</h5>
                                            </div>
                                            <div class="card-body">
    
                                                <form method="POST" action="{{ route('user.reset_password') }}" > 
                                                @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Old Password <span class="required">*</span></label>
                                                            <input  class="form-control"  name="old_password" type="password" id="current_password"    placeholder="Old Password"  />
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>New Password <span class="required">*</span></label>
                                                            <input  class="form-control"  name="new_password" type="password" id="new_password"   placeholder="New Password"  />
                                                            @if($errors->has('photo'))
                                                                <div class="text-danger">{{ $errors->first('new_password') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Confirm New Password <span class="required">*</span></label>
                                                            <input  class="form-control"  name="new_password_confirmation" type="password" id="new_password_confirmation"  placeholder="Confirm New Password"  /> 
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        const provinces = document.querySelector('#provinces');
        const districts = document.querySelector('#districts');
        const wards = document.querySelector('#wards');
        const toast_message = document.querySelector('.toast_message') ?? '';
        if(toast_message != '') {
            window.onload = function() {
                setTimeout(() => {
                    toast_message.setAttribute('style', 'opacity: 0 !important');
                }, 7000);
            }
        }

        const file = document.querySelector('#image');
        const show_img = document.querySelector('.show_img');
        file.addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload  = function(e) {
                show_img.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files['0'])
        })

        let flag = true;
        provinces.addEventListener('click', function(e) {
            if(flag) {
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

    </script>

@endsection