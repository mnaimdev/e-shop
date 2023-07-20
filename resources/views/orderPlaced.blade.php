@extends('master.master')

@section('content')
    <div class="w-screen h-screen flex justify-center items-center relative">

        <lottie-player class="absolute bottom-12" src="{{ asset('/order-placed/confetti.json') }}" background="transparent"
            speed="1" style="width: 300px; height: 300px;"autoplay></lottie-player>

        <lottie-player src="{{ asset('/order-placed/ordersplacedjson.json') }}" background="transparent" speed="1"
            style="width: 300px; height: 300px;"autoplay></lottie-player>
    </div>

    <a href="{{ route('HOME') }}">Explore More</a>
@endsection
