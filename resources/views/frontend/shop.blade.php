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


    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        @foreach ($mainCategories as $category)
                            <li class="main-nav-list">
                                <a data-toggle="collapse" href="#category-{{ $category->id }}" aria-expanded="false"
                                    aria-controls="category-{{ $category->id }}"><span class="lnr lnr-arrow-right"></span>
                                    {{ $category->name }}
                                </a>
                                <ul class="collapse" id="category-{{ $category->id }}" data-toggle="collapse"
                                    aria-expanded="false" aria-controls="category-{{ $category->id }}">
                                    @foreach ($category->childrens as $child)
                                        <li class="main-nav-list child"><a
                                                href="{{ route('shop') }}?category={{ $child->id }}">
                                                {{ $child->name }}
                                                <span class="number">({{ $child->products_count }})</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <li class="main-nav-list">
                            <a href="{{ route('shop') }}">
                                Show all products
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <ul class="main-categories">
                            @foreach ($brands as $brand)
                                <li class="main-nav-list">
                                    <a href="{{ route('shop') }}?brand={{ $brand->id }}">
                                        {{ $brand->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="flex-wrap filter-bar d-flex align-items-center">
                    <div class="mr-auto sorting">
                        <select onchange="location = this.value">
                            <option value="{{ route('shop') }}?limit=1">Show 1</option>
                            <option value="{{ route('shop') }}?limit=4">Show 4</option>
                            <option value="{{ route('shop') }}?limit=10">Show 10</option>
                            <option value="{{ route('shop') }}?limit=50">Show 50</option>
                            <option value="{{ route('shop') }}?limit=100">Show 100</option>
                        </select>
                    </div>
                    {{ $products->links() }}
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="pb-40 lattest-product-area category-list">
                    <div class="row">
                        @forelse ($products as $product)
                            <!-- single product -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <div style="height: 300px; overflow: hidden;">
                                        <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}"
                                            alt="">
                                    </div>
                                    <div class="product-details">
                                        <h6>
                                            {{ $product->title }}
                                        </h6>
                                        @if ($product->discount_price)
                                            <div class="price">
                                                <h6>${{ $product->discount_price }}</h6>
                                                <h6 class="l-through">${{ $product->price }}</h6>
                                            </div>
                                        @else
                                            <div class="price">
                                                <h6>${{ $product->price }}</h6>
                                            </div>
                                        @endif
                                        <div class="prd-bottom">

                                            <a href="" class="social-info">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">add to bag</p>
                                            </a>
                                            {{-- <a href="" class="social-info">
                                                <span class="lnr lnr-heart"></span>
                                                <p class="hover-text">Wishlist</p>
                                            </a> --}}
                                            <a href="" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">view more</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                            <div class="my-5 col-12">
                                <h6 class="p-4 text-center text-white rounded bg-secondary">
                                    No Product Found
                                </h6>
                            </div>
                        @endforelse

                    </div>
                </section>
                <!-- End Best Seller -->
            </div>
        </div>
    </div>
@endsection
