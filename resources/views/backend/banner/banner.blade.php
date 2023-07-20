@extends('dashboard')

@section('content')
    <div class="container" style="margin-left: 300px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="m-auto">Add Banner</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>


                                    <div class="col-lg-4">
                                        <label>Title Color</label>
                                        <input type="color" name="color" class="form-control"
                                            value="{{ old('color') }}">
                                        @error('color')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Heading</label>
                                        <input type="text" name="heading" class="form-control"
                                            value="{{ old('heading') }}">
                                        @error('heading')
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
                                        <label>Link</label>
                                        <input type="text" name="link" class="form-control"
                                            value="{{ old('link') }}">
                                        @error('link')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Banner Type</label>
                                        <select name="banner_type" class="form-control">
                                            <option value="{{ old('banner_type') }}">-- Select Type --</option>
                                            <option value="Header">Header</option>
                                            <option value="Content">Content</option>
                                            <option value="Footer">Footer</option>
                                        </select>
                                        @error('banner_type')
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        @enderror
                                    </div>



                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Image (Image width and height ratio: 167 x 209)</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>


                                </div>
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

        @if (session('banner'))
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
                    title: '{{ session('banner') }}'
                })
            </script>
        @endif
    @endsection
