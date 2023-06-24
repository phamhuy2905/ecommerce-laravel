@extends('admin.master')
@section('content')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/form-pickadate.css') }}">
@endpush
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
<div class="card-content">
    <div class="card-body pt-1">
        <form method="POST" action="{{ route('coupon.store') }}" id="form" enctype="multipart/form-data">
            @csrf
            <div class="form-label-group form-group position-relative has-icon-left">
                <label for="name">Coupon name</label>
                <input class="form-control" id="name" placeholder="Coupon name"  name="name"
                value="{{ old('name') }}">
                <span class="message_validate text-danger" style="font-size: 12px"></span>
                @if ($errors->has('name'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-label-group form-group position-relative has-icon-left">
                <label for="discount">Discount</label>
                <input class="form-control" id="discount" placeholder="Discount "  name="discount"
                value="{{ old('discount') }}">
                <span class="message_validate text-danger" style="font-size: 12px"></span>
                @if ($errors->has('discount'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('discount') }}</span>
                @endif
            </div>

            <div class="form-label-group form-group position-relative has-icon-left">
                <input type="date" id="date" class="form-control pickadate-limits picker__input picker__input--active" name="valid"
                value="{{ old('valid') }}">
                @if ($errors->has('valid'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('valid') }}</span>
                @endif
            </div>
            <div class="form-label-group form-group position-relative has-icon-left">
                <input type="time" id="date" class="form-control pickadate-limits picker__input picker__input--active" name="time"
                value="{{ old('time') }}">
                @if ($errors->has('time'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('time') }}</span>
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-primary float-left btn-inline">Submit</button>
        </form>
    </div>
</div>

@endsection
@push('js')
    <script>
        // The date picker (read the docs)
        Validation({
            form: "#form",
            rule: [
                ValidateRequired("#name",'Vui lòng nhập trường này'),
                ValidateRequired("#image",'Vui lòng chọn ảnh'),
            ]
        }, 'span')
    </script>
@endpush