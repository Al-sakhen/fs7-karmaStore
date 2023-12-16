@extends('frontend.layout.app')
@section('content')
    <!-- Start Banner Area -->

    @include('frontend.layout.partials.breadcrumb', [
        'title' => 'Shop Page',
        'links' => [
            'Home' => route('home'),
            'Shop' => '',
        ],
    ])
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = 0;
                            @endphp
                            
                            @forelse ($cartItems as $item)
                                @php
                                    $total = $item['quantity'] * $item['price'];
                                    $subTotal += $total;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('storage/' . $item['image']) }}" height="150"
                                                    alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $item['title'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>${{ $item['price'] }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="qty" id="sst" maxlength="12"
                                                value="{{ $item['quantity'] }}" title="Quantity:" class="input-text qty"
                                                readonly>
                                            {{-- <button
                                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i
                                                class="lnr lnr-chevron-up"></i></button>
                                        <button
                                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i
                                                class="lnr lnr-chevron-down"></i></button> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <h5>${{ $total }}</h5>
                                    </td>
                                </tr>


                            @empty
                            @endforelse

                            <tr class="bottom_button">
                                <td>
                                    <a class="gray_btn" href="#">Update Cart</a>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>

                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>${{ $subTotal }}</h5>
                                </td>
                            </tr>

                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="#">Continue Shopping</a>
                                        <a class="primary-btn" href="#">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
