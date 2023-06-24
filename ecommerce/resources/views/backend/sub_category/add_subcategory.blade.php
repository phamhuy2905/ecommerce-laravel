@push('css')
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endpush
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
        <form method="POST" action="{{ route('subcategory.store') }}" id="form" enctype="multipart/form-data">
            @csrf
            <div class="form-label-group form-group position-relative has-icon-left">
                <label for="name">Subcategory name</label>
                <input class="form-control" id="name" placeholder="Subcategory name"  name="name"
                value="{{ old('name') }}">
                <span class="message_validate text-danger" style="font-size: 12px"></span>
                @if ($errors->has('name'))
                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <br>
            
            {{-- // category --}}
           <div class="card" data-select2-id="262">
                <div class="card-header">
                    <p class="">Category name</p>
                </div>
                <div class="card-content" data-select2-id="261">
                    <div class="col-12" data-select2-id="288">
                        <div class="form-group" data-select2-id="287">
                            <select class="select2 form-control select2-hidden-accessible" id="default-select" data-select2-id="default-select" tabindex="-1" aria-hidden="true" name="category_name">
                                @foreach ($data as $index => $each )
                                <option value="{{ $each->id }}" data-select2-id="{{288 + $index}}">{{ $each->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-left btn-inline">Submit</button>
        </form>
    </div>
</div>

@endsection
@push('js')
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/select2/form-select2.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
    <script>
        Validation({
            form: "#form",
            rule: [
                ValidateRequired("#name",'Vui lòng nhập trường này'),
            ]
        }, 'span')

    </script>
@endpush