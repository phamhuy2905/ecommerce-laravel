@extends('frontend.master_dashboard')
@section('main')


 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span> Compare
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <h1 class="heading-2 mb-10">Products Compare</h1>
                    <h6 class="text-body mb-40">There are products to compare</h6>
                    <div class="table-responsive">
                        <table class="table text-center table-compare">
                            <tHead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Price</th>
                                    <th>Short Desription</th>
                                    <th>Long Desription</th>
                                    <th>Remove</th>
                                </tr>
                            </tHead>
                            <tbody id="compare">
                                @foreach ($data as $each)
                                <tr class="compare-{{ $each->id }}">
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $each->product_name }}</td>
                                    <td>
                                        <img src="{{ url($each->thumbnail) }}" alt="" height="50px">
                                    </td>
                                    <td>{{ $each->brand_name }}</td>
                                    <td>{{ $each->category_name }}</td>
                                    <td>{{ $each->subcategory_name}}</td>
                                    <td>{{ $each->price }}</td>
                                    <td>{{ $each->short }}</td>
                                    <td>{{ $each->long }}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="destroy({{ $each->id }} )"><i class="fi-rs-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
@push('js')
<script>
    function destroy(id) {
        const remove = document.querySelector(`.compare-${id}`)
        const url = '/compare/destroy/'+id;
        get(url, function(response) {
            console.log(response);
            const type = Object.keys(response).join('')
            Swal.fire({
                position: 'top-end',
                icon: type,
                title: response[type],
                showConfirmButton: false,
                timer: 1000,
                width: '25em',
                heightAuto: false,
            })
        })
        remove.remove()
    }
</script>
@endpush
@endsection