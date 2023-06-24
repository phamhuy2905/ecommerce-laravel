@extends('vendor.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Profile Settings</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active"> Profile Settings
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                <i class="feather icon-globe mr-50 font-medium-3"></i>
                                General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                <i class="feather icon-lock mr-50 font-medium-3"></i>
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                <i class="feather icon-camera mr-50 font-medium-3"></i>
                                Social links
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-connections" data-toggle="pill" href="#account-vertical-connections" aria-expanded="false">
                                <i class="feather icon-feather mr-50 font-medium-3"></i>
                                Connections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                <i class="feather icon-message-circle mr-50 font-medium-3"></i>
                                Notifications
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        <div class="media">
                                            <a href="javascript: void(0);">
                                                <img src="{{ !empty($data->photo) ? url('img/user_img/'.$data->photo)
                                                : url('img/no_img.jpg') }}" class="rounded mr-75 border-primary show_img" alt="profile image" height="64" width="64" style="object-fit: cover">
                                            </a>
                                            <div class="media-body mt-75">
                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                    <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                                                </div>
                                                <p class="text-muted ml-75 mt-50"><small class="title_img">Allowed JPG, GIF or PNG. Max size of 800kB</small></p>
                                                @if (Session::has('message_password_error'))
                                                    <span class="float-right alert alert-danger">
                                                        {{ Session::get('message_password_error') }}
                                                    </span>
                                                @endif
                                                @if (Session::has('message_password_success'))
                                                <span class="float-right alert alert-success">
                                                    {{ Session::get('message_password_success') }}
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <form method="POST" action="{{ route('vendor.update_profile', $data) }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" id="account-upload" hidden name="photo">
                                            @if (Session::has('message_profile'))
                                                <div class="alert alert-success mb-2" role="alert">
                                                   {{ Session::get('message_profile') }}
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">Name</label>
                                                            <input type="text" class="form-control" id="account-name" placeholder="Name" value="{{ $data->name }}"   data-validation-required-message="This name field is required" name="name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-username">Username</label>
                                                            <input disabled type="text" class="form-control" id="account-username" placeholder="Username" value="{{ $data->username }}"  data-validation-required-message="This username field is required" name="username">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-e-mail">E-mail</label>
                                                            <input disabled type="" class="form-control" id="account-e-mail" placeholder="Email" value="{{ $data->email }}"  data-validation-required-message="This email field is required" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-e-mail">Phone number</label>
                                                            <input type="" class="form-control" id="account-e-mail" placeholder="Phone number" value="{{ $data->phone }}"  data-validation-required-message="This email field is required" name="phone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-e-mail">Address</label>
                                                            <input type="" class="form-control" id="account-e-mail" placeholder="Address" value="{{ $data->address }}"  data-validation-required-message="This email field is required" name="address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-company">Created at</label>
                                                        <input disabled type="text" class="form-control" id="account-company" placeholder="Company name" value="{{ $data->YearCreated_At }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                        <form method="POST" action="{{ route('vendor.update_password') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-old-password">Old Password</label>
                                                            <input type="password" class="form-control" id="account-old-password" required placeholder="Old Password" data-validation-required-message="This old password field is required" name="old_password">
                                                        </div>
                                                        <p class="alert_password"></p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-new-password">New Password</label>
                                                            <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                        </div>
                                                        <p class="alert_password-old"></p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-retype-new-password">Retype New
                                                                Password</label>
                                                            <input type="password" name="con-password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                        </div>
                                                        <p class="alert_password-confirm"></p>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button  class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 submit_password">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                        <form>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-twitter">Twitter</label>
                                                        <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-facebook">Facebook</label>
                                                        <input type="text" id="account-facebook" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-google">Google+</label>
                                                        <input type="text" id="account-google" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-linkedin">LinkedIn</label>
                                                        <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-instagram">Instagram</label>
                                                        <input type="text" id="account-instagram" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-quora">Quora</label>
                                                        <input type="text" id="account-quora" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <a href="javascript: void(0);" class="btn btn-info">Connect to
                                                    <strong>Twitter</strong></a>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                <h6>You are connected to facebook.</h6>
                                                <span>Johndoe@gmail.com</span>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <a href="javascript: void(0);" class="btn btn-danger">Connect to
                                                    <strong>Google</strong>
                                                </a>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                <h6>You are connected to Instagram.</h6>
                                                <span>Johndoe@gmail.com</span>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                        <div class="row">
                                            <h6 class="m-1">Activity</h6>
                                            <div class="col-12 mb-1">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch1">
                                                    <label class="custom-control-label mr-1" for="accountSwitch1"></label>
                                                    <span class="switch-label w-100">Email me when someone comments
                                                        onmy
                                                        article</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-1">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch2">
                                                    <label class="custom-control-label mr-1" for="accountSwitch2"></label>
                                                    <span class="switch-label w-100">Email me when someone answers on
                                                        my
                                                        form</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-1">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch3">
                                                    <label class="custom-control-label mr-1" for="accountSwitch3"></label>
                                                    <span class="switch-label w-100">Email me hen someone follows
                                                        me</span>
                                                </div>
                                            </div>
                                            <h6 class="m-1">Application</h6>
                                            <div class="col-12 mb-1">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch4">
                                                    <label class="custom-control-label mr-1" for="accountSwitch4"></label>
                                                    <span class="switch-label w-100">News and announcements</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-1">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch5">
                                                    <label class="custom-control-label mr-1" for="accountSwitch5"></label>
                                                    <span class="switch-label w-100">Weekly product updates</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-1">
                                                <div class="custom-control custom-switch custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch6">
                                                    <label class="custom-control-label mr-1" for="accountSwitch6"></label>
                                                    <span class="switch-label w-100">Weekly blog digest</span>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->
    </div>
</div>

<script>
    const file = document.querySelector('#account-upload');
    const title_img = document.querySelector('.title_img');
    const show_img = document.querySelector('.show_img');
    file.addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload  = function(e) {
            show_img.src = e.target.result;
        }
        title_img.textContent = this.value;
        reader.readAsDataURL(e.target.files['0'])
    })


    const password_old = document.querySelector('#account-old-password')
    const password_new = document.querySelector('#account-new-password')
    const password_confirm = document.querySelector('#account-retype-new-password')
    const submit_password = document.querySelector('.submit_password');
    const alert_password = document.querySelector('.alert_password')
    const alert_password_old = document.querySelector('.alert_password-old')
    const alert_password_confirm = document.querySelector('.alert_password-confirm')
    submit_password.addEventListener('click', function(e) {
        if(password_old.value.length < 8) {
            alert_password.textContent = 'Trường này tối thiểu 8 kí tự!'
            alert_password.style.color = 'red';
            alert_password.style.fontSize  = '12px';
            e.preventDefault();
        }
        else {
            alert_password.textContent = ''
        }
        if(password_new.value.length < 8) {
            alert_password_old.textContent = 'Trường này tối thiểu 8 kí tự!'
            alert_password_old.style.color = 'red';
            alert_password_old.style.fontSize  = '12px';
            e.preventDefault();
        }
        else {
            alert_password_old.textContent = ''
        }
        if(password_confirm.value.length < 8) {
            alert_password_confirm.textContent = 'Trường này tối thiểu 8 kí tự!'
            alert_password_confirm.style.color = 'red';
            alert_password_confirm.style.fontSize  = '12px';
            e.preventDefault();
        }
        else {
            alert_password_confirm.textContent = ''
        }
        if(password_confirm.value !== password_new.value) {
            alert_password_confirm.textContent = 'Mật khẩu xác thực không trùng nhau!'
            alert_password_confirm.style.color = 'red';
            alert_password_confirm.style.fontSize  = '12px';
            e.preventDefault();
        }
    })
</script>
@endsection