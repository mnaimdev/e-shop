@extends('master.master')
@section('content')
    <div class="wrapper px-2">
        <!-- quick access -->
        <div class="card w-full overflow-hidden mt-2">
            <div class="card-body mx-auto w-full bg-black py-2">
                <div class="py-3 flex h-full justify-between items-centers">
                    <div class="w-1/2 flex justify-start items-center">
                        <h2 class="text-xl">Akash</h2>
                    </div>
                    <div class="w-1/2 relative h-full flex justify-end items-center">
                        <div class="flex space-x-4 items-center justify-between border px-2 py-1 rounded-3xl">
                            <p class="product-cart ps-2">
                                @php
                                    $cartCount = App\Models\Cart::where('customer_id', session()->getId())->count();
                                    
                                @endphp
                                {{ $cartCount }}
                            </p>
                            <a href="{{ route('CHECKOUT') }}" class="btn btn-circle btn-sm p-1 "><svg viewBox="0 0 256 256"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h256v256H0z"></path>
                                    <circle cx="80" cy="216" r="14" fill="#ffffff" class="fill-000000">
                                    </circle>
                                    <circle cx="184" cy="216" r="14" fill="#ffffff" class="fill-000000">
                                    </circle>
                                    <path
                                        d="M42.3 72h179.4l-26.4 92.4a15.9 15.9 0 0 1-15.4 11.6H84.1a15.9 15.9 0 0 1-15.4-11.6L32.5 37.8a8 8 0 0 0-7.7-5.8H8"
                                        fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="12" class="stroke-000000"></path>
                                </svg> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- quick access -->
        <!--discount start  -->
        <div class="card w-full overflow-hidden mt-5">
            <div class="card-body mx-auto w-full bg-black h-60 p-0">
                <div class="flex h-full">
                    <div class="hreo-text w-1/2 h-full flex flex-col justify-center ps-4">
                        <small>
                            sale
                        </small>

                        @php
                            $banner = App\Models\Banner::where('banner_type', 'Header')->first();
                        @endphp

                        <h2 class="text-3xl" style="color: {{ $banner->color }}">{{ $banner->title }}</h2>
                        <small>
                            {{ $banner->heading }}
                        </small>
                        <a class="btn btn-sm mt-1" href="{{ $banner->link }}">Tiny</a>
                    </div>
                    <div class="hero-img w-1/2 relative h-full">
                        <img class=" h-full absolute bottom-0" src="{{ asset('/uploads/banner') }}/{{ $banner->image }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <!--discount end  -->

        <!-- Featured collection start -->
        <div class="featured-collection w-full px-4">

            <h2 class="px-5 my-3 w-full flex justify-between">
                Featured Collection
                <span>
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </h2>

            <div class="wrapper flex justify-center gap-3 flex-wrap">
                @foreach ($products as $product)
                    <div class="w-[167px] rounded-md overflow-hidden relative">
                        <img src="{{ asset('/uploads/product') }}/{{ $product->preview }}" alt="">
                        <a class="btn btn-circle absolute right-2 bottom-2"
                            href='{{ route('product.details', $product->id) }}'>
                            <svg viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" d="M0 0h50v50H0z"></path>
                                <path fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4"
                                    d="M9 25h32M25 9v32" class="stroke-000000"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Featured collection end -->

        <!-- small banner section -->
        <div class="card w-full overflow-hidden my-10">
            <div class="card-body mx-auto w-full bg-black h-40 p-0">
                <div class="flex h-full">
                    <div class="hreo-text w-1/2 h-full flex flex-col justify-center ps-4">
                        <small>
                            sale
                        </small>

                        @php
                            $banner = App\Models\Banner::where('banner_type', 'Content')->first();
                        @endphp

                        <h2 class="text-3xl">{{ $banner->title }}f</h2>
                        <small>
                            {{ $banner->heading }}
                        </small>
                        <a class="btn btn-sm mt-1" href="{{ $banner->link }}">Tiny</a>

                    </div>
                    <div class="hero-img w-1/2 relative h-full">
                        <img class=" h-full absolute bottom-0" src="{{ asset('/uploads/banner') }}/{{ $banner->image }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- small banner section -->

        <!-- Most view  collection start -->

        <div class="featured-collection w-full px-4">
            <h2 class="px-5 my-3 w-full flex justify-between">
                Most view
                <span>
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </h2>
            <div class="wrapper flex justify-center gap-3 flex-wrap">

                @foreach ($randomProducts as $product)
                    <div class="w-[167px] rounded-md overflow-hidden relative">
                        <img src="{{ asset('/uploads/product') }}/{{ $product->preview }}" alt="">
                        <a class="btn btn-circle absolute right-2 bottom-2">
                            <svg viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" d="M0 0h50v50H0z"></path>
                                <path fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4"
                                    d="M9 25h32M25 9v32" class="stroke-000000"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
        <!-- Featured collection end -->

    </div>
@endsection
