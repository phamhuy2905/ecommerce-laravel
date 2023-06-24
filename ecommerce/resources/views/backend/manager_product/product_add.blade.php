@push('css')
{{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2/select2.min.css') }}">
<style>
    
    .option {
        display: none
    }
    .resize {
        width: 70px;
        height: 70px;
        object-fit: cover;
        margin-right: 10px;
        margin-bottom: 10px;
        border: groove;
    }
</style>
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
       
        @foreach ( $errors->all() as $message )
            <p>{{ $message }}</p>
        @endforeach
        <form method="POST" action="{{ route('managerproduct.process_add') }}" id="form" enctype="multipart/form-data" id="form">
            @csrf
            <div class="row">
                {{-- // brand  --}}
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <label for="brand_id">Brand name</label>
                        </div>
                        <div class="card-body">
                            <select class="custom-select" name="brand_id" id="brand_id">
                                @foreach ($brand as $each)
                                    <option value="{{ $each->id }}">{{ $each->brand_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('brand_name'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('brand_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- end brand  --}}
    
                 {{-- // Category  --}}
    
                 <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <label for="category_id">Category name</label>
                        </div>
                        <div class="card-body">
                            <select selected="false"  class="custom-select category" name="category_id" id="category_id">
                                @foreach ($category as $each)
                                    <option @if ($loop->first)
                                        class="option_category"
                                    @endif value="{{ $each->id }}">{{ $each->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>
                    </div>
                 </div>
                {{-- end Category  --}}
    
                {{-- // SubCategory  --}}
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <label for="subcategory_id">SubCategory name</label>
                        </div>
                        <div class="card-body">
                            <select  class="custom-select subcategory " name="subcategory_id" id="subcategory_id">
                                {{-- @foreach ($subcategory as $each)
                                    <option value="{{ $each->id }}" class="option" data-set="{{ $each->category_id }}">{{ $each->name }}</option>
                                @endforeach --}}
                            </select>
                            @if ($errors->has('subcategory_id'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('subcategory_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- end SubCategory  --}}
    
    
                 {{-- // Product name  --}}
                 <div class="col-4">
                     <div class="card">
                         <div class="card-header">
                             <label for="product_name">Product name</label>
                         </div>
                         <div class="card-body">
                             <input class="form-control" id="product_name" placeholder="Product name"  name="product_name"
                             value="{{ old('product_name') }}">
                             <span class="message_validate text-danger" style="font-size: 12px"></span>
                             @if ($errors->has('product_name'))
                             <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('product_name') }}</span>
                             @endif
                         </div>
                     </div>
                 </div>
    
                 {{-- // end Product name  --}}
                {{-- // Product code  --}}
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <label for="product_code">Product code</label>
                        </div>
                        <div class="card-body">
                            <input class="form-control" id="product_code" placeholder="Product code"  name="product_code"
                            value="{{ old('product_code') }}">
                            <span class="message_validate text-danger" style="font-size: 12px"></span>
                            @if ($errors->has('product_code'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('product_code') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
    
                 {{-- // end Product code  --}}
    
                 {{-- // product tag  --}}
                <div class="col-4">
                    <div class="card">
                       <div class="card-header">
                           <label for="product_tags">Product tags </label>
                       </div>
                       <div class="card-body">
                           <div class="card-content">
                               <select  class="form-control select2-border data-border-color data-border-variation"  multiple="multiple" name="product_tags" id="product_tags">
                               </select>
                           </div>
                           <span class="message_validate text-danger" style="font-size: 12px"></span>
                           @if ($errors->has('product_code'))
                           <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('product_code') }}</span>
                           @endif
                       </div>
                   </div>
                </div>
                 {{-- end product tag  --}}
            </div>






             {{-- price  --}}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <label for="price">Price</label>
                            <input id="price" type="" class="input-group-lg form-control" name="price" value="{{ old('price') }}">
                            <span class="message_validate text-danger" style="font-size: 12px"></span>
                            @if ($errors->has('price'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('price') }}</span>
                            @endif
                            
                        </div>

                        <div class="col-2">
                            <label for="color">Color</label>
                            <input id="color" type="" class="input-group-lg form-control" name="color" value="{{ old('color') }}">
                            <span class="message_validate text-danger" style="font-size: 12px"></span>
                        </div>

                        <div class="col-2">
                            <label for="product_quantity">Product Quantity</label>
                            <input id="product_quantity" type="" class="input-group-lg form-control" name="product_quantity" value="{{ old('product_quantity') }}">
                            <span class="message_validate text-danger" style="font-size: 12px"></span>
                            @if ($errors->has('product_quantity'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('product_quantity') }}</span>
                            @endif
                        </div>
                        <div class="col-2">
                            <label for="product_size">Size</label>
                            <input id="product_size" type="text" class="input-group-lg form-control" name="product_size" value="{{ old('product_size') }}">
                            <span class="message_validate text-danger" style="font-size: 12px"></span>
                            @if ($errors->has('product_size'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('product_size') }}</span>
                            @endif
                        </div>
                        <div class="col-2">
                            <label for="discount">Discount</label>
                            <input id="discount" type="" class="input-group-lg form-control" name="discount" value="{{ old('discount') }}">
                            @if ($errors->has('discount'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('discount') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
             {{-- end price  --}}
            
             {{-- // radio  --}}
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2">
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox"  value="1" name="product_featured">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class="">Featured</span>
                                    </div>
                                </fieldset>
                            </li>

                            <li class="d-inline-block mr-2">
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox"  value="1" name="hot_deals">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class="">Hot deals</span>
                                    </div>
                                </fieldset>
                            </li>

                            <li class="d-inline-block mr-2">
                                <fieldset>
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox"  value="1" name="special_offer">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class="">Special offer</span>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- // end radio  --}}

            <div class="row">
                 {{-- // short description  --}}
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <label for="short_description">Short Description</label>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-label-group">
                                <textarea name="short_description" class="form-control" id="short_description" rows="3" placeholder="Short Description">{{ old('short_description') }}</textarea>
                                <span class="message_validate text-danger" style="font-size: 12px"></span>
                                @if ($errors->has('short_description'))
                                <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('short_description') }}</span>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
                {{-- // end short description  --}}


                {{-- // long description  --}}
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <label for="long_description">Long Description</label>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-label-group">
                                <textarea name="long_description" class="form-control" id="long_description" rows="3" placeholder="Short Description" >{{ old('long_description') }}</textarea>
                            </fieldset>
                        </div>
                    </div>
                </div>
                {{-- // end long description  --}}
             </div>


            <div class="card " >
                <div class="card-body">
                    <img src="{{ url('img/no_img.jpg') }}" id="mainThmb" class="rounded mr-75 border-primary show_img"  height="64" width="64"/>
                    <input hidden name="product_thumbnail" class="form-control" type="file" id="formFile" onChange="mainThamUrl(this)" >
                    <label for="formFile" class="btn btn-sm btn-primary cursor-pointer" style="opacity: 1">Main Thumbnail</label>
                    <span class="message_validate text-danger" style="font-size: 12px"></span>
                    @if ($errors->has('product_thumbnail'))
                    <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('product_thumbnail') }}</span>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <label for="multiImg">Multiple Image</label>
                </div>
                    <div class="card-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="multiImg" name="multipe_img[]"  multiple="" >
                            <label class="custom-file-label" for="multiImg">Choose file</label>
                            <span class="message_validate text-danger" style="font-size: 12px"></span>
                            @if ($errors->has('brand_image'))
                            <span class="message_validate text-danger" style="font-size: 12px">{{ $errors->first('brand_image') }}</span>
                            @endif
                        </div>
                        <div class="row" id="preview_img" style="margin: 0"></div>
                    </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary float-left btn-inline">Submit</button>
        </form>
    </div>
</div>
@push('js')
<script src="{{ asset('js//select2/form-select2.js') }}"></script>
<script src="{{ asset('js//select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js//select2/form-number-input.js') }}"></script>
<script>

    Validation({
        form: "#form",
        rule: [
            ValidateRequired("#product_name",'Trường này bắt buộc nhập!'),
            ValidateRequired("#product_code",'Trường này bắt buộc nhập!'),
            ValidateRequired("#price",'Bắt buộc nhập!'),
            ValidateRequired("#product_quantity",'Bắt buộc nhập!'),
            ValidateRequired("#short_description",'Bắt buộc nhập!'),
            ValidateRequired("#formFile",'Trường này bắt buộc nhập!'),
        ]
    }, '.message_validate')

    
    @if(Session::has('message'))
        toastr.success("{{ Session::get('message') }}") 
    @endif

    $(document).ready(function() {
        $('.select2-border').select2({
            tags: true,
        });
    });

    function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

    $(document).ready(function(){
        $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                
                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb resize border-dashed').attr('src', e.target.result) .width(70)
                        .height(70); //create image element 
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
                
            }
            else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

    

   
    const url = "{{ route('managerproduct.product_api_select') }}"
    const subcategory = document.querySelector('.subcategory')
    const category = document.querySelector('.category')
    const category_first_child = category.firstElementChild;
    function getData() {
        fetch(url) 
            .then(responsive => {
                return responsive.json();
            })
            .then(data => {
                data.forEach(each => {
                    if(each.category_id == category_first_child.value) {
                        const option = document.createElement("option")
                        option.setAttribute('value', each.id);
                        option.classList.add('option_test')
                        option.textContent = each.name;
                        subcategory.appendChild(option);
                    }
                })

                category.addEventListener('change', function(e) {
                const option_test = document.querySelectorAll('.option_test') ?? ''
                    if(option_test) {
                        option_test.forEach(value => {
                            value.remove();
                        })
                    }
                    const value = e.target.value;
                    data.forEach((each, index) => {
                        if(each.category_id == value) {
                            const option = document.createElement("option")
                            option.setAttribute('value', each.id);
                            option.classList.add('option_test')
                            option.textContent = each.name;
                            subcategory.appendChild(option);
                        }
                    });
            })
        })
    }
    getData();
</script>
@endpush
@endsection