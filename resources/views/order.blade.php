@extends('master.master')

@section('content')
    <!-- cart product start -->
    <div class="flex flex-col items-center h-screen">

        <div class="px-3 h-5/9">
            <div class="card card-compact bg-black h-full">
                <div class="card-actions justify-between items-center p-4">
                </div>

                <div class="card-body h-full w-full">
                    <section class="middle">
                        <div class="container">

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="text-center d-block mb-5">
                                        <h2 class="my-2">Order</h2>

                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <form action="{{ route('order.store') }}" method="POST">
                                        @csrf

                                        <h5 class="mb-4 ft-medium">Billing Details</h5>
                                        <div class="row mb-2">

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control my-2"
                                                        placeholder="Name" />
                                                </div>
                                            </div>


                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control my-2"
                                                        placeholder="Email" />
                                                </div>
                                            </div>

                                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <input type="number" name="phone" class="form-control"
                                                        placeholder="Phone Number" />
                                                </div>
                                            </div>


                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <textarea name="address" class="form-control my-2" placeholder="Address"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <select name="district" class="form-control my-2 select">
                                                        <option>Select District</option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->name }}">
                                                                {{ $district->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                                <div class="form-group">

                                                    <input type="number" name="zip_code" class="form-control my-2"
                                                        placeholder="Zip / Postcode" />
                                                </div>
                                            </div>

                                        </div>


                                </div>

                                <!-- Sidebar -->
                                <div class="col-12 col-lg-12 col-md-12">
                                    <div class="d-block mb-3">
                                        {{-- <h5 class="mb-4">Order Items: {{ $carts->count() }}</h5> --}}
                                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">

                                        </ul>
                                    </div>


                                    <!-- Delivery Location -->
                                    <h5 class="mb-4 ft-medium">Delivery Location</h5>
                                    <div class="mb-4">

                                        <div class="form-check">
                                            <input value="60" class="form-check-input charge" type="radio"
                                                name="charge" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Inside City
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="120" class="form-check-input charge" type="radio"
                                                name="charge" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Outside City
                                            </label>
                                        </div>
                                    </div>



                                    <!-- Payments -->
                                    <h5 class="my-4 ft-medium">Payments</h5>
                                    <div class="mb-4">

                                        <div class="form-check">
                                            <input value="1" class="form-check-input" type="radio"
                                                name="payment_method" id="flexRadioDefault3">
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Cash On Delivery
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input value="2" class="form-check-input" type="radio"
                                                name="payment_method" id="flexRadioDefault4">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                Pay With SSLCommerz
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input value="3" class="form-check-input" type="radio"
                                                name="payment_method" id="flexRadioDefault5">
                                            <label class="form-check-label" for="flexRadioDefault5">
                                                Pay With Stripe
                                            </label>
                                        </div>

                                    </div>


                                    <div class="card mb-4 gray">
                                        <div class="card-body">
                                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">

                                                    <span>Subtotal: </span>
                                                    <span class="ml-auto text-dark ft-medium" id="subTotal">
                                                        {{ session('subTotal') }}
                                                    </span>
                                                </li>


                                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                                    <span>Discount: </span>
                                                    <span class="ml-auto text-dark ft-medium" id="discount">
                                                        {{ session('discount') }}
                                                    </span>
                                                </li>


                                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                                    <span>Delivery Charge: </span>
                                                    <span class="ml-auto text-dark ft-medium" id="deliveryCharge">
                                                        0
                                                    </span>
                                                </li>


                                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                                    <span>Total: </span> <span class="ml-auto text-dark ft-medium"
                                                        id="total">{{ session('total') }}</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <input type="hidden" name="subTotal" value="{{ session('subTotal') }}">
                                    <input type="hidden" name="discount" value="{{ session('discount') }}">
                                    <input type="hidden" name="total" value="{{ session('total') }}">
                                    <input type="hidden" name="customerId" value="{{ session('customerId') }}">


                                    <button type="submit" class="bg-blue-500 p-2">Place Your Order</button>
                                </div>

                                </form>

                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- cart product end -->
@endsection


@section('footer_scripts')
    <script>
        let charge = document.querySelectorAll('.charge');
        for (let i = 0; i < charge.length; i++) {
            charge[i].addEventListener('click', () => {
                let chargeValue = Number(charge[i].value);

                let subTotal = Number(document.getElementById('subTotal').innerText);
                let discount = Number(document.getElementById('discount').innerText);

                let total = document.getElementById('total');
                let deliveryCharge = document.getElementById('deliveryCharge');

                let totalPrice = subTotal + chargeValue - discount;
                deliveryCharge.innerHTML = chargeValue;

                total.innerHTML = totalPrice;

                alert(totalPrice);

            });
        }
    </script>
@endsection
