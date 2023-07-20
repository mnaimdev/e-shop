@extends('master.master')

@section('content')
    <!-- cart product start -->
    <div class="flex flex-col items-center h-screen">
        <div class="mt-1">
            <lottie-player src="{{ asset('/order-placed/drone.json') }}" background="transparent" speed="1"
                style="width: 100%; height: 250px;"autoplay loop></lottie-player>
        </div>
        <div class="px-3 h-5/9">
            <div class="card card-compact bg-black h-full">
                <div class="card-actions justify-between items-center p-4">
                    <h2 class="center">Checkout</h2>

                </div>
                <div class="card-body h-full">
                    <div class="overflow-y-scroll max-h-[330px]">

                        <div class="product flex flex-col space-y-4">
                            @php
                                $carts = App\Models\Cart::where('customer_id', session()->getId())->get();
                                $subTotal = 0;
                                $total = 0;
                                $discount = 0;
                                
                            @endphp


                            <!-- item -->
                            @forelse ($carts as $cart)
                                <div class="flex h-30 bg-slate-900 rounded-lg overflow-hidden">
                                    <div class="product-image flex justify-center w-3/12">
                                        <img class=" scale-150"
                                            src="{{ asset('/uploads/product') }}/{{ $cart->product->preview }}"
                                            alt="">
                                    </div>
                                    <div class="product-info ps-4 ms-3 pt-2 pb-3 flex flex-col">

                                        @php
                                            $subTotalPrice = $cart->product->after_discount * $cart->quantity;
                                            $discountPrice = $cart->product->price - $cart->product->after_discount;
                                            $totalPrice = $subTotalPrice - $discountPrice;
                                            
                                        @endphp

                                        <h3>Name: {{ $cart->product->product_name }}</h3>
                                        <h3>Quantity: {{ $cart->quantity }} TK</h3>
                                        <h3>Price: {{ $cart->product->price }} TK</h3>
                                        <h3>Subtotal: {{ $subTotalPrice }}TK</h3>
                                        <h3>Discount: {{ $discountPrice }} TK</h3>
                                        <h3>Total: {{ $totalPrice }} TK</h3>

                                    </div>
                                    @php
                                        $subTotal += $subTotalPrice;
                                        $discount += $discountPrice;
                                        $total += $totalPrice;
                                        
                                        $customerId = $cart->customer_id;
                                    @endphp
                                </div>

                            @empty
                                <p>Cart Empty</p>
                                @php
                                    
                                    $customerId = '';
                                @endphp
                            @endforelse

                        </div>

                        <a href="{{ route('order') }}" class="btn btn-sm">Buy Now</a>


                        @php
                            session([
                                'subTotal' => $subTotal,
                                'discount' => $discount,
                                'total' => $total,
                                'customerId' => $customerId,
                            ]);
                        @endphp

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart product end -->
@endsection
