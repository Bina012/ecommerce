@extends('layouts.frontend')

@section('main-content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>{{$data['details']->title}}</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{route('frontend.index')}}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">{{$data['details']->category->name}}<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">{{$data['details']->subcategory->name}}</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    @php
        $images = $data['details']->productImage()->get();
    @endphp
    <form action="{{route('frontend.cart.add')}}" method="post">
        @csrf
        <input type="hidden" value="{{$data['details']->id}}" name="product_id">
    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_Product_carousel">
                        @foreach($images as $image)
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{asset('images/backend/product/255_271_' . $image->image_name)}}" alt="{{$image->image_title}}" height="271">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        @include('backend.common.flash_message')
                        <h3>{{$data['details']->title}}</h3>
                        <h2>Rs.{{$data['details']->price-$data['details']->discount}}</h2>
                        <ul class="list">
                            <li><a class="active" href="#"><span>Category</span> : {{$data['details']->category->name}}</a></li>
                            <li><a class="active" href="#"><span>Sub Category</span> : {{$data['details']->subcategory->name}}</a></li>
                            <li><a href="#"><span>Availibility</span> @if($data['details']->stock > 0): In Stock @else Out of Stock @endforelse   </a></li>
                            <li><a class="active" href="#"><span>Tags</span> :

                                @foreach($data['details']->tags as $tag)

                                        <a href="" style="padding: 10px;border:1px solid #65452a;margin-left: 10px;">#{{$tag->name}} </a>
                                    @endforeach
                                </a></li>

                        </ul>
                        <p>{{$data['details']->short_description}}</p>
                        @foreach($data['details']->productAttributes as $productAttribute)
                            <div class="form-group">
                                @php
                                $attValue = explode(',',$productAttribute->attribute_value);
                                @endphp
                                {{$productAttribute->attribute->name}}:
                                <select name="attribute[{{$productAttribute->attribute->id}}]" id="{{$productAttribute->attribute->name}}" class="form-control">
                                   @foreach($attValue as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" max="{{$data['details']->stock}}" value="1" title="Quantity:" class="input-text qty">
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                    class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                    class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <button class="primary-btn"type="submit">Add to Cart</button>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                            <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
    </form>
    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                       aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                       aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                       aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                   {!! $data['details']->description  !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        {!! $data['details']->specification  !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="comment_list">
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2018 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo</p>
                                </div>
                                <div class="review_item reply">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-2.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2018 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo</p>
                                </div>
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-3.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2018 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Post a comment</h4>
                                <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="btn primary-btn">Submit Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>4.0</h4>
                                        <h6>(03 Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">

                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                @if(isset($data['ratings']))
                                @forelse($data['ratings'] as $rate)
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/review-1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{\App\Models\Customer::find($rate->customer_id)->name}}</h4>
                                          @if($rate->rate == 1)
                                            <i class="fa fa-star"></i>
                                                @endif
                                            @if($rate->rate == 2)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @endif
                                            @if($rate->rate == 3)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @endif
                                            @if($rate->rate == 4)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @endif
                                            @if($rate->rate == 5)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <p>{{$rate->review}}</p>
                                </div>
                                    @empty
            <p> No Data</p>
                                @endforelse
    @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                @if(isset($data['ratedata']))
                              @if($data['ratedata'] == 1)
                                    <p> Your have alrady done rating </p>
                                  @else
                                @if(\Illuminate\Support\Facades\Auth::guard('customer')->user())
                                        <h4>Add a Review</h4>
                                <p>Your Rating:</p>
{{--                                <ul class="list">--}}
{{--                                    <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                </ul>--}}
                                <div id='jqxRating'>
                                </div>
                                <div style='margin-top: 10px;'>
                                    <div style='float: left;'>
                                        Rating:</div>
                                    <div style='float: left;' id='rate'>
                                    </div>
                                </div>
                                <br>
                                <form class="row contact_form" action="{{route('frontend.product.rating')}}" method="post" id="contactForm" novalidate="novalidate">
                                    @csrf
                                    <div class="col-md-12">
                                        <input type="hidden" name="product_id" value="{{$data['details']->id}}">
                                        <input type="hidden" id="rating_field" name="rate">
                                        <div class="form-group">
                                            <textarea class="form-control" name="review" id="message" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="primary-btn">Submit Now</button>
                                    </div>
                                </form>
                                @else
                                    <p> Please login to provide rating</p>
                                @endif
                            </div>

                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($data['recommended_products'] as $key => $value)
                       @php
                       $product = \App\Models\Product::find($key);
                       @endphp
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r1.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">{{$product->title}}</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ctg-right">
                        <a href="#" target="_blank">
                            <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End related-product Area -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/rate/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
    @endsection


@section('js')
    <script type="text/javascript" src="{{asset('assets/frontend/rate/scripts/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/frontend/rate/jqwidgets/jqxcore.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/frontend/rate/jqwidgets/jqxrating.js')}}"></script>

    <script>
        $(document).ready(function () {
            // Create jqxRating.
            $("#jqxRating").jqxRating({ width: 350, height: 35});
            // bind to jqxRating 'change' event.
            $("#jqxRating").bind('change', function (event) {
                $("#rate").html('<span>' + event.value + '</span');
                $('#rating_field').val(event.value);
            });
        });
    </script>
@endsection
