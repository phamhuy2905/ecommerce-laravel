@push('css')
<style>
    .option {
        display: none
    }
    .resize {
        width: 70px;
        height: 70px;
        object-fit: cover;
        margin-right: 10px;
        margin-bottom: 10px;
        border: groove;
    }
</style>
@endpush
@extends('vendor.master')
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
                                            <img src="{{ url($data->product_thumbnail) }}" class="rounded mr-75 border-primary show_img" alt="profile image" height="100" width="100" style="object-fit: cover">
                                        </a>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Name product</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->product_name }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Name Recipient</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->name_recipient }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Phone Recipient</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->phone_recipient }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Address Repicient</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->address_recipient}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Name Orderer</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->name_orderer }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Phone Orderer</label>
                                                    <input disabled type="text" class="form-control" id="account-username"  value="{{ $data->phone_orderer }}"  name="username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Quantity</label>
                                                    <input disabled type="" class="form-control" id="account-e-mail"  value="{{ $data->quantity }}"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Price</label>
                                                    <input type="" class="form-control" id="account-e-mail"value="{{ $data->price }}"  disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Total</label>
                                                    <input type="" class="form-control" id="account-e-mail" value="{{ $data->total }}"  disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Color</label>
                                                    <input type="" class="form-control" id="account-e-mail" value="{{ $data->product_color }}"  disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Size</label>
                                                    <input type="" class="form-control" id="account-e-mail" value="{{ $data->size }}"  disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Discount</label>
                                                    <input type="" class="form-control" id="account-e-mail" value="{{ $data->discount }}"  disabled>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="account-company">Created at</label>
                                                <input disabled type="text" class="form-control" id="account-company" value="{{ $data->created_at }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label for="short_description">Description Information</label>
                                                </div>
                                                <div class="card-body">
                                                    <fieldset class="form-label-group">
                                                        <textarea disabled name="short_description" class="form-control" id="short_description" rows="3" placeholder="Short Description">{{ $data->description_infomation }}</textarea>
                                                    </fieldset>
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
    </section>
    <!-- account setting page end -->
</div>

@endsection
