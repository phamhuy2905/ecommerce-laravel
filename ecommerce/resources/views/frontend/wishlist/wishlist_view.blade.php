

@extends('frontend.master_dashboard')
@section('main')

<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Wishlist  
                </div>
            </div>
        </div>
        <div class="container mb-30 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="mb-50">
                        <h1 class="heading-2 mb-10">Your Wishlist</h1>
                        <h6 class="text-body">There are products in this list</h6>
                    </div>
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">
                                      #   
                                    </th>
                                    <th>Image</th>
                                    <th scope="col" colspan="2">Name</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $each)
                                <tr class="wishlist-{{ $each->id }}" class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        {{ $loop->index }}
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="{{ url($each->product->product_thumbnail) }}" alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="shop-product-right.html">{{ $each->product->product_name }}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h3 class="text-brand">${{ $each->product->price }}</h3>
                                    </td>
                                    <td class="r detail-info" data-title="Stock">
                                        <a href="{{ route('cart.detail', $each->product->id) }}" class="btn btn-success">Detail</a>
                                    </td>
                                   
                                    <td class="" data-title="Remove">
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
            const remove = document.querySelector(`.wishlist-${id}`)
            const url = '/wishlist/destroy/'+id;
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
                count_wishlist()
            })
            remove.remove()
        }
    </script>
@endpush
@endsection