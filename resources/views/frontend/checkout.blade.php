@extends('frontend.layout.app')
@section('content')
    <!-- Start Banner Area -->

    @include('frontend.layout.partials.breadcrumb', [
        'title' => 'Checkout Page',
        'links' => [
            'Home' => route('home'),
            'Shop' => '',
        ],
    ])
    <!-- End Banner Area -->

    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <form class="row contact_form" action="{{ route('checkout.store') }}" method="post"
                        novalidate="novalidate">
                        @csrf
                        <div class="col-lg-8">
                            <h3>Shipping Details</h3>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" required>
                                <span class="placeholder" data-placeholder="Full name"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    required>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>


                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="address" name="address" required>
                                <span class="placeholder" data-placeholder="Address"></span>
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" required>
                                <span class="placeholder" data-placeholder="Town/City"></span>
                            </div>

                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    placeholder="Postcode/ZIP">
                            </div>

                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="more_info" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li><a href="#">Product <span>Total</span></a></li>
                                    @php

                                        $subTotal = 0;
                                    @endphp
                                    @foreach ($items as $item)
                                        @php
                                            $total = $item['quantity'] * $item['price'];
                                            $subTotal += $total;
                                        @endphp
                                        <li>
                                            <a href="#">
                                                {{ $item['title'] }}
                                                <span class="middle">x {{ $item['quantity'] }}</span>
                                                <span class="last">${{ $total }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li><a href="#">Subtotal <span>${{ $subTotal }}</span></a></li>
                                    <li><a href="#">Total <span>${{ $subTotal }}</span></a></li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="payment_method" value="cash" checked>
                                        <label for="f-option5">Cash payments</label>
                                        <div class="check"></div>
                                    </div>
                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                        Store Postcode.</p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="payment_method" value="paypal">
                                        <label for="f-option6">Paypal </label>
                                        <img src="img/product/card.jpg" alt="">
                                        <div class="check"></div>
                                    </div>
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                        account.</p>
                                </div>
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option4" name="selector">
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a href="#">terms & conditions*</a>
                                </div>
                                <button class="primary-btn" href="#">Proceed to Pay</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
