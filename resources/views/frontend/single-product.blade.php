@extends('frontend.layout.app')
@section('content')
    <!-- Start Banner Area -->

    @include('frontend.layout.partials.breadcrumb', [
        'title' => $product->title,
        'links' => [
            'Home' => route('home'),
            'Shop' => route('shop'),
            $product->title => '',
        ],
    ])
    <!-- End Banner Area -->


    <!--================Single Product Area =================-->
    <div class="pb-5 product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item d-flex justify-content-end">
                        <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $product->title }}</h3>
                        <h2>${{ $product->discount_price ?? $product->price }}</h2>
                        <ul class="list">
                            <li><a class="active"
                                    href="{{ route('shop') }}?category={{ $product->category->id }}"><span>Category</span> :
                                    {{ $product->category->name }}</a>
                            </li>
                            @if ($product->brand)
                                <li>
                                    <a class="active"
                                        href="{{ route('shop') }}?brand={{ $product->brand->id }}"><span>Brand</span> :
                                        {{ $product->brand->name }}</a>
                                </li>
                            @endif
                        </ul>
                        <p>
                            {{ $product->description }}
                        </p>
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                title="Quantity:" class="input-text qty">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <a class="primary-btn" href="#">Add to Cart</a>
                            <a class="icon_btn" href="#"><i class="lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    @if ($product->long_description)
        <!--================Product Description Area =================-->
        <section class="product_description_area">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Description</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p>
                            {{ $product->long_description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Product Description Area =================-->
    @endif
@endsection
