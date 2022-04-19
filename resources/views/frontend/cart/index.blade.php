@extends('layouts.frontend')
@section('main-content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    @include('backend.common.flash_message')
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
                            $total = 0;
                        @endphp
                        @foreach($data['carts'] as $cart)
                            @php
                                $total += $cart->qty*$cart->price;
                              $product = \App\Models\Product::find($cart->id);
                              $image = $product->productImage()->first();
                            @endphp
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        @if($image)
                                            <img src="{{asset('images/backend/product/255_271_' . $image->image_name)}}" alt="">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <p>{{$product->title}}</p>
                                        @foreach($cart->options as $key => $option)
                                            <span class="text-info">{{\App\Models\Attribute::find($key)->name}} : {{$option}}</span><br/>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>{{$cart->price}}</h5>
                            </td>
                            <td>
                                <form action="{{route('cart.update')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$cart->rowId}}" name="rowId">
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst_{{$cart->rowId}}" maxlength="12" value="{{$cart->qty}}" title="Quantity:"
                                               class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst_{{$cart->rowId}}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="var result = document.getElementById('sst_{{$cart->rowId}}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                                class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                        <button  type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <h5>{{$cart->qty * $cart->price}}</h5>
                            </td>
                        </tr>
                        @endforeach

                        @if(count($data['carts']) > 0)
                        <tr class="bottom_button">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="cupon_text d-flex align-items-center">
                                    <input type="text" placeholder="Coupon Code" id="coupon_code" value="{{session('coupon_code')}}">
                                    <button class="primary-btn" id="apply_coupon">Apply</button>
                                    <a class="gray_btn" href="#">Close Coupon</a>
                                </div>
                            </td>
                        </tr>
                        @php
                        if (session('discount_percentage')){
                            $discount = ($total * session('discount_percentage'))/100;
                            $final = $total-$discount;
                        } else {
                            $discount = 0;
                            $final = $total;
                        }

                        @endphp
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>{{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Discount</h5>
                            </td>
                            <td>
                                <h5 id="discount_amount">{{$discount}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Total</h5>
                            </td>
                            <td>
                                <h5 id="final_amount">{{$final}}</h5>
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
                                    <a class="gray_btn" href="{{route('frontend.index')}}">Continue Shopping</a>
                                    <a class="primary-btn" href="{{route('cart.checkout')}}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                        @else
                            <tr>
                                <td colspan="4"><span class="text text-danger">Cart is Empty</span></td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#apply_coupon').click(function (){
           var coupon_code =  $('#coupon_code').val();
            $.ajax({
                method: "POST",
                url: "{{route('cart.apply_coupon')}}",
                data:{'code':coupon_code},
                success:function (resp){
                    console.log(resp);
                    $('#discount_amount').html(resp.discount);
                    $('#final_amount').html(resp.final);
                }
            });
        });
    </script>

    @endsection
