@extends('admin.master')
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Home</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{ $name_sidebar }}</a>
                        </li>
                        <li class="breadcrumb-item active"> {{ $title }}
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
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <div class="media">
                                        <a href="javascript: void(0);">
                                            <img src="{{ !empty($data->photo) ? url('img/vendor_img/'.$data->photo)
                                            : url('img/no_img.jpg') }}" class="rounded mr-75 border-primary show_img" alt="profile image" height="64" width="64" style="object-fit: cover">
                                        </a>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Name</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Username</label>
                                                    <input disabled type="text" class="form-control" id="account-username"  value="{{ $data->username }}"  name="username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">E-mail</label>
                                                    <input disabled type="" class="form-control" id="account-e-mail"  value="{{ $data->email }}"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Phone number</label>
                                                    <input type="" class="form-control" id="account-e-mail"value="{{ $data->phone }}"  disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Address</label>
                                                    <input type="" class="form-control" id="account-e-mail" value="{{ $data->address }}"  disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="account-company">Created at</label>
                                                <input disabled type="text" class="form-control" id="account-company" value="{{ $data->YearCreated_At }}" disabled>
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

@endsection
