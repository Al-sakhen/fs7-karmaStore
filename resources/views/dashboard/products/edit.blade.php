@extends('dashboard.layout.app', ['title' => 'Update Product'])

@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Product - {{ $product->title }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        {{-- name field --}}
                        <div class="form-group">
                            <label for="name">Title *</label>
                            <input type="text" value="{{ $product->title }}" name="title" class="form-control"
                                id="title" placeholder="Enter title" required>
                        </div>

                        {{-- description --}}
                        <div class="form-group">
                            <label for="description">Description *</label>
                            <textarea required name="description" class="form-control" id="description">{{ $product->description }}</textarea>
                        </div>

                        {{-- long_description --}}
                        <div class="form-group">
                            <label for="long_description">Long Description</label>
                            <textarea name="long_description" class="form-control" id="long_description">{{ $product->long_description }}</textarea>
                        </div>
                        <hr>
                        <hr>
                        {{-- price field --}}
                        <div class="form-group">
                            <label for="price">Price *</label>
                            <input type="number" required value="{{ $product->price }}" name="price" class="form-control"
                                step="0.01" id="title" placeholder="Enter price">
                        </div>

                        {{-- discount price field --}}
                        <div class="form-group">
                            <label for="discount_price">Discount Price</label>
                            <input type="number" value="{{ $product->discount_price }}" name="discount_price"
                                step="0.01" class="form-control" id="discount_price" placeholder="Enter discount price">
                        </div>
                        <hr>
                        <hr>
                        <div class="form-group">
                            {{-- // 0 or 1 --}}
                            <label for="status">Status *</label>
                            <select required name="status" class="custom-select" id="status">
                                <option value="1" @selected($product->status == 1)>active</option>
                                <option value="0" @selected($product->status == 0)>inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Image *</label>
                            <input type="file" name="image" class="form-control-file" id="image"
                                accept="image/*">
                        </div>
                        <img src="{{ asset('storage/' . $product->image) }}" width="200" height="150"
                            style="object-fit: contain">

                        <div class="form-group">
                            <label for="category_id">Category *</label>
                            <select name="category_id" class="custom-select" id="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" class="custom-select" id="brand_id">
                                <option value="">Please select brand....</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection


@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection
