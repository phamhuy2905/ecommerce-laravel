
@push('css')
{{-- <link href="{{ asset('css/datatable/datatables.min.css') }}"  rel="stylesheet" > --}}
{{-- <link href="{{ asset('css/toastr.css') }}"  rel="stylesheet" >
<link href="{{ asset('css/toastr1.css') }}"  rel="stylesheet" > --}}

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
<div class="card">
    <div class="card-body">
        <label for="">Order pending</label>
    </div>
</div>

<div class="card-content">
    <div class="card-body card-dashboard">
            @csrf
            <div class="table-responsive">
                <table class="table zero-configuration display" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name product</th>
                            <th>Photo product</th>
                            <th>Name Recipient</th>
                            <th>Phone Recipient</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody class="fetch">
                        @foreach ($data as $each)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{ $each->product_name}}</td>
                                <td><img src="{{ url($each->photo) }}" alt="" style="height: 70px"></td>
                                <td>{{ $each->name_recipient}}</td>
                                <td>{{ $each->phone_recipient}}</td>
                                <td>
                                    @if ($each->status == 0)
                                        <a href="{{ route('managerorder.acpect', $each->id) }}" class="text-success">Acpect bill</a>
                                    @else
                                        <a class="text-success">{{ $each->Namestatus }}</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('managerorder.detail', $each->id) }}" class="text-primary">Detail</a>
                                </td>
                                <td>
                                <button data-set="{{ route('managerorder.cancel',$each->detail_id) }}" type="button" class="btn btn-primary cancel" data-toggle="modal" data-target=".bd-example-modal-lg">Cancel</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

</div>

<!-- Large modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Reason Cancel</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <label>Reason: </label>
            <form method="POST" action="" class="form">
                @csrf
                <fieldset class="form-label-group">
                    <textarea name="description_reason" class="form-control" id="short_description" rows="3" placeholder="Short Description"></textarea>
                </fieldset>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal"  id="myModal">Submit</button>
            </div>
    </div>
  </div>
</div>


@push('js')
<script src="{{ asset('js/datatable/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/datatable/jquery.min.js') }}"></script>
<script src="{{ asset('js/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/components-modal.js') }}"></script>

<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );

    @if (Session::has('message'))
        toastr.success("{{ Session::get('message') }}") 
    @endif


    const form = document.querySelector('.form')
    const btn = document.querySelector('#myModal')
    const fetch = document.querySelector('.fetch')
    fetch.addEventListener('click', function(e) {
        const target = e.target
        if(target.classList.contains('cancel')) {
            const route = target.getAttribute('data-set')
            form.setAttribute('action', route)
        }
    })

    btn.addEventListener('click', function() {
        const action = form.getAttribute('action')
        form.submit()
    })


    function get(url, callback) {
        fetch(url)
            .then(response => {
                return response.json();
            })
            .then(callback)
    }

    function handel(data) {
        console.log(data);
    }
</script>
@endpush
@endsection