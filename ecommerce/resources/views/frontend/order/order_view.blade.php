@extends('frontend.master_dashboard')
@section('main')

 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span> Order
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <h1 class="heading-2 mb-10">Products Order</h1>
                    <h6 class="text-body mb-40">There are products to order</h6>
                    <div class="table-responsive">
                        <table class="table text-center table-compare">
                            <tHead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Name Recipent</th>
                                    <th>Phone Recipient</th>
                                    <th>Price </th>
                                    <th>Quantitty </th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </tHead>
                            <tbody id="view_order">
                                @foreach ($data as  $each)
                                <tr class="bill_detail-{{ $each->detail_id }}">
                                    <td>{{ $each->product_name }}</td>
                                    <td>
                                        <img src="{{ url($each->product_thumbnail) }}" alt="" height="64px">
                                    </td>
                                    <td>{{ $each->name_recipient }}</td>
                                    <td>{{ $each->phone_recipient}}</td>
                                    <td>{{ $each->detail_price }}</td>
                                    <td>{{ $each->detail_quantity }}</td>
                                    <td>{{ $each->detail_quantity *  $each->detail_price }}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="destroy({{ $each->id}}, {{ $each->detail_id }})">Hủy</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tHead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Name Recipent</th>
                                    <th>Phone Recipient</th>
                                    <th>Price </th>
                                    <th>Quantitty </th>
                                    <th class="total">@if (isset($total))
                                        {{ round($total, 2) }}
                                    @endif</th>
                                    <th>Action</th>
                                </tr>
                            </tHead>
                            
                        </table>
                    </div>
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <label for="description">Description Infomattion</label>
                        <input type="text" class="form_group" name="" id="" value="{{ $description_infomation }}" disabled>
                    </div>
                </div>
            </div>
        </div>
@push('js')
<script>
    const total = document.querySelector('.total')
    function destroy(bill,detail) {
        const remove = document.querySelector(`.bill_detail-${detail}`)
        const url = '/checkout/remove_detail/'+bill+'/'+detail;
        API.get(url, function(response) {
            const type = Object.keys(response).shift();
            Swal.fire({
                position: 'top-end',
                icon: type,
                title: response[type],
                showConfirmButton: false,
                timer: 1000,
                width: '25em',
                heightAuto: false,
            })
            total.textContent = response.total;
        })
        remove.remove()
    }
</script>
@endpush
@endsection