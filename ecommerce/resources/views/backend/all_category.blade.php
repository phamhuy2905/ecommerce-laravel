
@push('css')
    {{-- <link href="{{ asset('css/datatable/datatables.min.css') }}"  rel="stylesheet" > --}}
@endpush
@extends('admin.master')
@section('content')

@if (Session::has('success_category'))
<div class="d-flex justify-content-end mt-20 toast_message" role="alert" aria-live="assertive" aria-atomic="true">
    <div class=" toast d-flex align-items-center text-white bg-success border-0s"
    style="opacity: 1 ">
      <div class="toast-body">
        {{ Session::get('success_category') }}
      </div>
    </div>
</div>
@endif

@if (Session::has('success_delete_category'))
<div class="d-flex justify-content-end mt-20 toast_message" role="alert" aria-live="assertive" aria-atomic="true">
    <div class=" toast d-flex align-items-center text-white bg-success border-0s"
    style="opacity: 1 ">
      <div class="toast-body">
        {{ Session::get('success_delete_category') }}
      </div>
    </div>
</div>
@endif
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
    <a href="{{ route('category.create') }}" class="btn btn-info float-right white">Add category</a>


    <div class="card-content">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <table class="table zero-configuration display" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category name</th>
                            <th>Category Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $each )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $each->name }}</td>
                                <td>
                                    <img src="{{ url($each->image) }}" alt="" style="width: 60px; height: 60px;">
                                </td>
                                <td><a href="{{ route('category.edit', $each) }}" class="btn btn-primary">Edit</a></td>
                                <td><a href="{{ route('category.destroy', $each) }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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

    const toast_message = document.querySelector('.toast_message') ?? '';
    if(toast_message != '') {
        window.onload = function() {
            setTimeout(() => {
                toast_message.setAttribute('style', 'opacity: 0 !important');
            }, 7000);
        }
    }
</script>
@endpush