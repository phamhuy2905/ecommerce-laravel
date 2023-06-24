
@push('css')
{{-- <link href="{{ asset('css/datatable/datatables.min.css') }}"  rel="stylesheet" > --}}
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
    <div class="card-body card-dashboard">
        <div class="table-responsive">
            <table class="table zero-configuration display" id="table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $each )
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{ $each->name }}</td>
                            <td><a href="mailto:{{ $each->email }}">{{ $each->email }}</a></td>
                            <td>{{ $each->YearCreatedAt }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('managervendor.active.detail', $each) }}">Detail</a>
                            </td>
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

</script>
@endpush