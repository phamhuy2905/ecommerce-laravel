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
<div class="card-content">
    <div class="card-body pt-1">
        <form method="POST" action="{{ route('slider.store') }}" id="form" enctype="multipart/form-data">
            @csrf
            <div class="form-label-group form-group position-relative has-icon-left">
                <label for="name">Slider name</label>
                <input class="form-control" id="name" placeholder="Slider name"  name="name"
                value="{{ old('name') }}">
                <span class="message_validate text-danger" style="font-size: 12px"></span>
                @if ($errors->has('name'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="media-body mt-75">
                <img src="{{ url('img/no_img.jpg') }}" class="rounded mr-75 border-primary show_img" alt="profile image" height="64" width="64" style="object-fit: cover" class="show_img" id="show_img">
                <label for="image" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" style="opacity: 1">Slider image</label>
                <input class="form-control" id="image" placeholder="Slider image"  name="image" type="file" hidden>
                <span class="message_validate text-danger" style="font-size: 12px"></span>
                @if ($errors->has('image'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('image') }}</span>
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-primary float-left btn-inline">Submit</button>
        </form>
    </div>
</div>

@endsection
@push('js')
    <script src="{{ asset('js/validate.js') }}"></script>
    <script>
        const file = document.querySelector('#image');
        const show_img = document.querySelector('#show_img');
        file.addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload  = function(e) {
                show_img.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files['0'])
        })

        Validation({
            form: "#form",
            rule: [
                ValidateRequired("#name",'Vui lòng nhập trường này'),
                ValidateRequired("#image",'Vui lòng chọn ảnh'),
            ]
        }, 'span')

      
    </script>
@endpush