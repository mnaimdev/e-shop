@extends('dashboard')

@section('content')
    <div class="container mr-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="mt-3 text-center">Banner List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Heading</th>
                                <th>Link</th>
                                <th>Banner Type</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($banners as $sl => $banner)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $banner->title }}</td>
                                    <td>{{ $banner->heading }}</td>
                                    <td>{{ $banner->link }}</td>
                                    <td>{{ $banner->banner_type }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('/uploads/banner') }}/{{ $banner->image }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('banner.edit', $banner->id) }}"
                                                class="btn btn-info mx-2">Edit</a>
                                            <a href="{{ route('banner.delete', $banner->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @if (session('banner_delete'))
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
                icon: "success",
                title: "{{ session('banner_delete') }}",
            })
        </script>
    @endif
@endsection
