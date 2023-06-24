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

<a href="{{ route('managerproduct_vendor.add') }}" class="btn btn-info float-right white ">Add subcategory</a>


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
                        <th>Status selling</th>
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
                                {{ $each->Namestatus }}
                            </td>
                            <td>
                                <a href="{{ route('managerproduct_vendor.edit', $each) }}" class="btn btn-primary fa-solid fa-pen"></a>
                            </td>
                            <td>
                                @if ($each->status == 1)
                                <a href="{{ route('managerproduct_vendor.stop_selling', $each->id) }}" class="btn btn-danger">Stop</a>
                                @else
                                <a href="{{ route('managerproduct_vendor.continue_selling', $each->id) }}" class="btn btn-success">Selling</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('managerproduct_vendor.detail', $each->id) }}"class="text text-primary">Detail</a>
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
    @if (Session::has('message'))
        toastr.success("{{ Session::get('message') }}") 
    @endif
</script>
@endpush