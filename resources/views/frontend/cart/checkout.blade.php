@extends('layouts.frontend')

@section('main-content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="returning_customer">
                <div class="check_title">
                    <h2>Returning Customer? <a href="#">Click here to login</a></h2>
                </div>
                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new
                    customer, please proceed to the Billing & Shipping section.</p>
                <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="placeholder" data-placeholder="Username or Email"></span>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="placeholder" data-placeholder="Password"></span>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="primary-btn">login</button>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option" name="selector">
                            <label for="f-option">Remember me</label>
                        </div>
                        <a class="lost_pass" href="#">Lost your password?</a>
                    </div>
                </form>
            </div>
            <div class="cupon_area">
                <div class="check_title">
                    <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>
                </div>
                <input type="text" placeholder="Enter coupon code">
                <a class="tp_btn" href="#">Apply Coupon</a>
            </div>
            <form class="row contact_form" action="{{route('frontend.cart.make_order')}}" method="post" novalidate="novalidate">
                @csrf

            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" placeholder="Enter name">
{{--                                <span class="placeholder" data-placeholder="First name"></span>--}}
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company name">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="contact" placeholder="contact">
{{--                                <span class="placeholder" data-placeholder="Phone number"></span>--}}
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="email">
{{--                                <span class="placeholder" data-placeholder="Email Address"></span>--}}
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="address" placeholder="enter address">
{{--                                <span class="placeholder" data-placeholder="Address line 01"></span>--}}
                            </div>


                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" name="country">
                                    <option value="nepal">Nepal</option>
                                    <option value="india">India</option>
                                    <option value="china">China</option>
                                </select>
                            </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                @php
                                  $total = 0;
                                @endphp
                                @foreach($data['carts'] as $cart)
                                    @php
                                        $total += $cart->qty*$cart->price;
                                      $product = \App\Models\Product::find($cart->id);

                                    @endphp
                                    <li><a href="#">{{$product->title}} <span class="middle"> X  {{$cart->qty}}</span> <span class="last">{{ $cart->qty*$cart->price}}</span></a></li>
                                @endforeach
                            </ul>
                            @php
                                if (session('discount_percentage')){
                                    $discount = ($total * session('discount_percentage'))/100;
                                    $final = $total-$discount;
                                } else {
                                    $discount = 0;
                                    $final = $total;
                                }

                            @endphp
                            <ul class="list list_2">
                                <input type="hidden" name="subtotal" value="{{$total}}">
                                <input type="hidden" name="discount" value="{{$discount  }}">
                                <input type="hidden" name="total" value="{{$final}}">

                                <li><a href="#">Subtotal <span>{{$total}}</span></a></li>
                                <li><a href="#">Discount <span> {{$discount}}</span></a></li>
                                <li><a href="#">Total <span>{{$final}}</span></a></li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="payment_type" value="cod">
                                    <label for="f-option5">COD</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                    Store Postcode.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payment_type" value="paypal">
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
                            <button class="primary-btn" href="#">Make Order</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
@section('js')
@endsection
