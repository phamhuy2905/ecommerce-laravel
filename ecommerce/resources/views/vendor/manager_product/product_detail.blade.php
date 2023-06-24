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
                                                    <label for="account-name">Brand</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->brand->brand_name }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Category</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->category->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Subcategory</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->subcategory->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Vendor</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->vendor->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Product name</label>
                                                    <input type="text" class="form-control" id="account-name" value="{{ $data->product_name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Product code</label>
                                                    <input disabled type="text" class="form-control" id="account-username"  value="{{ $data->product_code }}"  name="username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Product tags</label>
                                                    <input disabled type="" class="form-control" id="account-e-mail"  value="{{ $data->product_tags }}"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-e-mail">Size</label>
                                                    <input type="" class="form-control" id="account-e-mail"value="{{ $data->product_size }}"  disabled>
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
                                                    <label for="account-e-mail">Price</label>
                                                    <input type="" class="form-control" id="account-e-mail" value="{{ $data->price }}"  disabled>
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
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="d-inline-block mr-2">
                                                                <fieldset>
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <input disabled type="checkbox"  value="1" name="product_featured"
                                                                        @if ($data->product_featured == 1)
                                                                            checked
                                                                        @endif>
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                        <span class="">Featured</span>
                                                                    </div>
                                                                </fieldset>
                                                            </li>
                                
                                                            <li class="d-inline-block mr-2">
                                                                <fieldset>
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <input disabled type="checkbox"  value="1" name="hot_deals"
                                                                        @if ($data->hot_deals == 1)
                                                                            checked
                                                                        @endif>
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                        <span class="">Hot deals</span>
                                                                    </div>
                                                                </fieldset>
                                                            </li>
                                
                                                            <li class="d-inline-block mr-2">
                                                                <fieldset>
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <input disabled type="checkbox"  value="1" name="special_offer"
                                                                        @if ($data->special_offer == 1)
                                                                            checked
                                                                        @endif>
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                        <span class="">Special offer</span>
                                                                    </div>
                                                                </fieldset>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label for="short_description">Short Description</label>
                                                </div>
                                                <div class="card-body">
                                                    <fieldset class="form-label-group">
                                                        <textarea disabled name="short_description" class="form-control" id="short_description" rows="3" placeholder="Short Description">{{ $data->short_description }}</textarea>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label for="short_description">Long Description</label>
                                                </div>
                                                <div class="card-body">
                                                    <fieldset class="form-label-group">
                                                        <textarea disabled name="short_description" class="form-control" id="short_description" rows="3" placeholder="Short Description">{{ $data->long_description }}</textarea>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label for="multiImg">Multiple Image</label>
                                                </div>
                                                    <div class="card-body">
                                                        <div class="row" id="preview_img" style="margin: 0">
                                                            @foreach ($multiple_image as $each)
                                                                <img class="thumb resize border-dashed" src="{{ url($each->photo_name) }}" alt="">
                                                            @endforeach
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
    </section>
    <!-- account setting page end -->
</div>

@endsection
