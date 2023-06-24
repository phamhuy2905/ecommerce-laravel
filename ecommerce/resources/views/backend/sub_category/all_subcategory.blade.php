
@push('css')
{{-- <link href="{{ asset('css/datatable/datatables.min.css') }}"  rel="stylesheet" > --}}
{{-- <link href="{{ asset('css/toastr.css') }}"  rel="stylesheet" >
<link href="{{ asset('css/toastr1.css') }}"  rel="stylesheet" > --}}

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
<div class="card">
    <div class="card-body">
        <label for="">Category</label>
        <form method="GET" action="" class="form">
            <select name="category" id="" class="form-control category_search">
                <option selected value="-1">All</option>
                @foreach ($category as $each)
                    <option value="{{ $each->id }}"
                        @if ($category_search  == $each->id)
                            selected
                        @endif
                    >{{ $each->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<a href="{{ route('subcategory.create') }}" class="btn btn-info float-right white">Add subcategory</a>


<form method="post" action="{{ route('subcategory.destroy_all') }}">
<div class="card-content">
    <div class="card-body card-dashboard">
            @csrf
            <div class="table-responsive">
                <table class="table zero-configuration display" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Nam</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Tick</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $each )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $each->name }}</td>
                                <td>{{ optional($each->category)->name}}</td>
                                <td><a  href="{{ route('subcategory.edit', $each) }}" class="btn btn-primary">Edit</a></td>
                                <td><a href="{{ route('subcategory.destroy', $each) }}" class="btn btn-danger">Delete</a></td>
                                <td><input class="" type="checkbox" value="{{ $each->id }}" name="{{ 'delete'.$index + 1 }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button class="btn btn-danger ">Delete tick</button>
        </div>
       
    </div>
</form>

{{-- <button type="button" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" id="slide-toast">slideDown -
    slideUp</button> --}}

@endsection
@push('js')
<script src="{{ asset('js/datatable/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/datatable/jquery.min.js') }}"></script>
<script src="{{ asset('js/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/datatable/datatables.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );

    @if (Session::has('message'))
        toastr.success("{{ Session::get('message') }}") 
    @endif
</script>
@endpush