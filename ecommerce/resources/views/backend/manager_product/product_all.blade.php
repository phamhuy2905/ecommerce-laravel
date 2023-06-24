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

<a href="{{ route('managerproduct.add') }}" class="btn btn-info float-right white ">Add products</a>


<div class="card-content">
    <div class="card-body card-dashboard">
        <div class="table-responsive">
            <table class="table zero-configuration display" id="table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Shop name</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $each )
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $each->product_name }}</td>
                            <td>{{ $each->vendor->shop_name ?? $each->vendor->name }}</td>
                            <td>
                                <img src="{{ url($each->product_thumbnail) }}" alt="" style="width: 50px; height: 50px; object-fit: cover">
                            </td>
                            <td>
                                @if ($each->Namestatus == 'Fulfill')
                                    {{ $each->Namestatus }}
                                @elseif ($each->Namestatus == 'Pending')
                                <a href="{{ route('managerproduct.updatestatus', $each->id) }}" class="text text-primary">{{ $each->Namestatus }}</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('managerproduct.edit', $each) }}" class="btn btn-primary fa-solid fa-pen"></a>
                            </td>
                            <td>
                                <a href="{{ route('managerproduct.destroy', $each->id) }}" class="btn btn-danger fa-solid fa-trash"></a>
                            </td>
                            <td>
                                <a href="{{ route('managerproduct.detail', $each->id) }}"class="text text-primary">Detail</a>
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
    
    @if (Session::has('message'))
        toastr.success("{{ Session::get('message') }}") 
    @endif
</script>
@endpush