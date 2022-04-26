@extends('layouts.frontend')

@section('main-content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Fashion Category</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        @foreach($category as $cat)
                        <li class="main-nav-list"><a data-toggle="collapse" href="#{{$cat->slug}}" aria-expanded="false" aria-controls="{{$cat->slug}}"><span
                                    class="lnr lnr-arrow-right"></span>{{$cat->name}}<span class="number">({{$cat->products->count()}})</span></a>
                            <ul class="collapse" id="{{$cat->slug}}" data-toggle="collapse" aria-expanded="false" aria-controls="{{$cat->slug}}">

                                @foreach($cat->subcategories as $sc)
                                    <li class="main-nav-list child"><a href="#">{{$sc->name}}<span class="number">({{$sc->products->count()}})</span></a></li>
                                @endforeach
                            </ul>
                        </li>
                            @endforeach
                    </ul>
                </div>
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
                                        Leather<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
                                        with red<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span>
                                <div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span>
                                <div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select id="order_by">
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list" >
                    <div class="row" id="final-product">
                        <!-- single product -->
                        @foreach($data['products'] as $product)
                            @php
                                $image = $product->productImage()->first();
                            @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                @if($image)
                                    <img class="img-fluid" src="{{asset('images/backend/product/255_271_' . $image->image_name)}}" alt="{{$image->image_title}}" height="271">
                                @else
                                    <img class="img-fluid" src="{{asset('assets/frontend/img/product/p1.jpg')}}" alt="">
                                @endif
                                <div class="product-details">
                                    <h6>{{$product->title}}</h6>
                                    <div class="price">
                                        <h6>Rs.{{$product->price-$product->discount}}</h6>
                                        <h6 class="l-through">Rs{{$product->price}}</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="{{route('frontend.product',$product->slug)}}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>
    <div>

    </div>
    @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/nice-select.css')}}">

@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#price-range').click(function(){
            var lower_value = document.getElementById('lower-value').innerText;
            var upper_value = document.getElementById('upper-value').innerText;
            var order_by = $('#order_by').val();

            $.ajax({
                url:"{{route('frontend.category.filter_product')}}",
                data:{'lower_price': lower_value,'upper_price':upper_value,'catid' : {{$data['details']->id}},'order' :order_by},
                method:'post',
                success:function (response){
                   $('#final-product').html(response);
                }
            });
        })

        $('#order_by').change(function(){
            var lower_value = document.getElementById('lower-value').innerText;
            var upper_value = document.getElementById('upper-value').innerText;
            var order_by = $('#order_by').val();
            $.ajax({
                url:"{{route('frontend.category.filter_product')}}",
                data:{'lower_price': lower_value,'upper_price':upper_value,'catid' : {{$data['details']->id}},'order' :order_by},
                method:'post',
                success:function (response){
                    $('#final-product').html(response);
                }
            });
        })
    </script>
    <script src="{{asset('assets/frontend/js/jquery.nice-select.min.js')}}"></script>

@endsection
