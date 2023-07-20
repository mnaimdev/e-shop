@extends('dashboard')

@section('content')
    <div class="container" style="margin-left: 300px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="m-auto">Edit Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ $product->product_name }}">
                                        @error('product_name')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Product Price</label>
                                        <input type="number" name="price" class="form-control"
                                            value="{{ $product->price }}">
                                        @error('price')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control category_id">
                                            <option value="{{ old('category_id') }}">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option {{ $product->category_id === $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>


                                    <div class="col-lg-6">
                                        <label>Discount</label>
                                        <input type="number" name="discount" class="form-control" placeholder="Discount"
                                            value="{{ $product->discount }}">
                                        @error('discount')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>


                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Short Description</label>
                                        <input type="text" name="short_desp" class="form-control"
                                            value="{{ $product->short_desp }}">
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control"
                                            value="{{ $product->quantity }}">
                                    </div>
                                    @error('quantity')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Long Description</label>
                                <textarea name="long_desp" class="form-control" id="summernote">
                                    {{ $product->long_desp }}
                            </textarea>
                                @error('long_desp')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Preview Image</label>
                                <input type="file" name="preview" class="form-control"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                                <div class="my-2">
                                    <img src="{{ asset('/uploads/product') }}/{{ $product->preview }}" id="blah"
                                        alt="your image" width="100" />
                                </div>


                                @error('preview')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>



                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('footer_scripts')
        <script>
            $(document).ready(function() {
                $('#summernote').summernote();
            });
        </script>

        @if (session('product_update'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('product_update') }}'
                })
            </script>
        @endif
    @endsection
