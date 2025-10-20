@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">EditProduct</h5>
            <hr />
            <form method="POST" action="{{ route('update.product', $products->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$products->id}}">
                <input type="hidden" name="old_img" value="{{$products->product_thambnail}}">
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">


                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" value="{{$products->product_name}}" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                                </div>


                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                                    <input type="text" name="product_tags" value="{{$products->product_tags}}" class="form-control visually-hidden" data-role="tagsinput" value="new product, top product">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Size</label>
                                    <input type="text" name="product_size" value="{{$products->product_size}}" class="form-control visually-hidden" data-role="tagsinput" value="Small , Medium , Large">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Color</label>
                                    <input type="text" name="product_color" value="{{$products->product_color}}" class="form-control visually-hidden" data-role="tagsinput" value="Red , Blue , Black">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea name="short_descp" value="" class="form-control" id="inputProductDescription" rows="3">{{$products->short_descp}}</textarea>
                                </div>

                                <!-- <div class="mb-3">
                                <label for="inputProductDescription" class="form-label">Long Description</label>
                                <textarea name="long_descp" value="{{$products->long_descp}}" class="form-control" id="mytextarea" rows="3"></textarea>
                            </div> -->


                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Product Price</label>
                                        <input type="text" name="selling_price" value="{{$products->selling_price}}" class="form-control" id="inputPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                        <input type="text" name="discount_price" value="{{$products->discount_price}}" class="form-control" id="inputCompareatprice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                        <input type="text" name="product_code" value="{{$products->product_code}}" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                        <input type="text" name="product_qty" value="{{$products->product_qty}}" class="form-control" id="inputStarPoints" placeholder="00.00">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select name="brand_id" class="form-select" id="inputProductType">
                                            <option></option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                {{ $brand->brand_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputVendor" class="form-label">Product Category</label>
                                        <select name="category_id" class="form-select" id="inputVendor">
                                            <option></option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $products->category_id ? 'selected' : '' }}>
                                                {{ $cat->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputCollection" class="form-label">Product SubCategory</label>
                                        <select name="subcategory_id" class="form-select" id="inputCollection">
                                            <option></option>
                                            @foreach($subcategory as $subcat)
                                            <option value="{{ $subcat->id }}" {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcat->subcategory_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-12">
                                        <label for="inputCollection" class="form-label">Select Vendor</label>
                                        <select name="vendor_id" class="form-select" id="inputCollection">
                                            <option></option>
                                            @foreach($activeVendor as $vendor)
                                            <option value="{{$vendor->id}}" {{$vendor->id == $products->vendor_id ? 'selected' : ''}}>{{$vendor->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="hot_deals" type="checkbox" id="hotDeals" {{$products->hot_deals == 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="hotDeals">Hot Deals</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="featured" type="checkbox" id="featured" {{$products->featured == 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="featured">Featured</label>
                                                </div>
                                            </div>

                                            <hr class="my-2">

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_offer" type="checkbox" id="specialOffer" {{$products->special_offer == 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="specialOffer">Special Offer</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="specialDeals">
                                                    <label class="form-check-label" for="specialDeals">Special Deals</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </form>
        </div>
    </div>

</div>

<form method="POST" action="{{ route('update.product.thambnail') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="id" value="{{ $products->id }}">
    <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">

    <div class="card-body">
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Choose Thambnail Image</label>
            <input class="form-control" name="product_thambnail" type="file" id="formFileMultiple">
        </div>

        <div class="mb-3">
            <img src="{{ asset($products->product_thambnail) }}" style="width:100px; height:100px;">
        </div>

        <input type="submit" class="btn btn-primary px-4" value="Update Image" />
    </div>
</form>

<div class="page-content">
    <h6 class="mb-0 text-uppercase">Update Multi Image</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">#Sl</th>
                        <th scope="col">Image</th>
                        <th scope="col">Change Image</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="post" action="{{route('update.product.multiimage')}}" enctype="multipart/form-data">
                        @csrf
                        @foreach($multiImgs as $key => $img)    
                            <tr>
                                <th scope="row">{{ $key+1}}</th>
                                <td> <img src="{{asset($img->photo_name)}}" style="width: 70px; height: 40px;"></td>
                                <td> <input type="file" class="form-group" name="multi_img[{{ $img->id}}]"/></td>
                                <td><input type="submit" class="btn btn-primary px-4" value="Update Image" /></td> 
                                <td>
                                    <button class="btn btn-danger delete-image" data-id="{{ $img->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </form>               
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('#multiImg').on('change', function() {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var data = $(this)[0].files;

                $.each(data, function(index, file) {
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                        var fRead = new FileReader();
                        fRead.onload = (function(file) {
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                    .height(80);
                                $('#preview_img').append(img);
                            };
                        })(file);
                        fRead.readAsDataURL(file);
                    }
                });

            } else {
                alert("Your browser doesn't support File API!");
            }
        });
    });

    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        })
    });

    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).on('click', '.delete-image', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let button = $(this);

            $.ajax({
                url: '/delete/product/multiimage/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.status === 'success') {
                        button.closest('tr').remove();
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                }
            });
    });

</script>
@endsection