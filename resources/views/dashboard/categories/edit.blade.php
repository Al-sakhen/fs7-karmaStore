@extends('dashboard.layout.app', ['title' => 'Update Ctegory'])

@section('content')
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.categories.update' , $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        {{-- name field --}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="name"
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            {{-- // 0 or 1 --}}
                            <label for="status">Status</label>
                            <select name="status" class="custom-select" id="status">
                                <option value="1"  @selected($category->status == 1)>active</option>
                                <option value="0" @selected($category->status == 0)>inactive</option>
                            </select>
                        </div>


                        @if ($category->parent_id != null)
                        {{-- hide if the category is Main Category --}}
                        <div class="form-group">
                            <label for="parent_id">Parent or Main Category</label>
                            <select name="parent_id" class="custom-select" id="parent_id">
                                <option value="" selected>select main category</option>
                                @foreach ($mainCategories as $cat)
                                    <option value="{{ $cat->id }}" @selected($category->parent_id == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

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
