@extends('master.master')

@section('content')
    <!-- cart product start -->
    <div class="flex flex-col items-center h-screen">
        <div class="mt-1">
            <lottie-player src="{{ asset('/order-placed/drone.json') }}" background="transparent" speed="1"
                style="width: 100%; height: 250px;"autoplay loop></lottie-player>
        </div>
        <div class="px-5 h-5/9">
            <div class="card card-compact bg-black h-full">

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value={{ $product->id }}>

                    <div class="card-actions justify-between items-center p-4">
                        <h2 class="text-xl">Product</h2>
                        <button class="btn btn-sm">Add to Cart</button>
                    </div>


                    <div class="card-body h-full">
                        <div class="overflow-y-scroll max-h-[330px]">

                            <div class="product flex flex-col space-y-4">

                                <!-- item -->
                                <div class="flex h-[120px] bg-slate-900 rounded-lg overflow-hidden">
                                    <div class="product-image flex justify-center w-3/12">
                                        <img class=" scale-100"
                                            src="{{ asset('/uploads/product') }}/{{ $product->preview }}" alt="">
                                    </div>
                                    <div class="product-info ps-5 pt-2 flex flex-col">
                                        <h3>{{ $product->product_name }}</h3>
                                        <small>{{ $product->price }} TK</small>
                                        <small>{{ $product->short_desp }}</small>
                                        <select name="quantity">
                                            <option value="">Quantity</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>


                                        @error('quantity')
                                            <strong class="text-red-500">
                                                {{ $message }}
                                            </strong>
                                        @enderror

                                        @if (session('stock'))
                                            <strong class="text-red-500">
                                                {{ session('stock') }}
                                            </strong>
                                        @endif

                                        <a href="{{ route('CHECKOUT') }}" class="bg-slate-200 btn-sm">Checkout</a>

                                    </div>

                                </div>
                </form>


            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- cart product end -->
@endsection


@section('footer_scripts')
    @if (session('cart'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('cart') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('stock'))
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{ session('stock') }}',
        showConfirmButton: false,
        timer: 1500
        })
    @endif
@endsection
