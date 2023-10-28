@extends('layouts.other_guest')

@section('content')
 <!-- Start of Main -->
 <main class="main checkout">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="#">Shopping Cart</a></li>
                <li class="active"><a href="#">Checkout</a></li>
                <li><a href="#">Order Complete</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">


            <form class="form checkout-form" action="{{route('user.submit_order')}}" method="post">
                @csrf
                {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  --}}
                <div class="row mb-9">
                    <div class="col-lg-7 pr-lg-4 mb-4">
                        <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                            Billing Details
                        </h3>
                        <div class="row gutter-sm">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Full name *</label>
                                    <input type="text" class="form-control form-control-md" value="{{Auth::user()->name}}"
                                        required>
                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <label>Street address *</label>
                            <input type="text" placeholder="House number and street name"
                                class="form-control form-control-md mb-2" name="street" required>

                        </div>
                        <div class="row gutter-sm">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Town / City *</label>
                                    <input type="text" class="form-control form-control-md" name="town" required>
                                </div>
                                <div class="form-group">
                                    <label>ZIP *</label>
                                    <input type="text" class="form-control form-control-md" name="zip" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State *</label>
                                    <div class="select-box">
                                        <select name="state" class="form-control form-control-md">
                                            <option value="port-harcourt" selected="selected">Port Harcourt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone *</label>
                                    <input type="text" class="form-control form-control-md" value="{{Auth::user()->phone}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-7">
                            <label>Email address *</label>
                            <input type="email" class="form-control form-control-md" value="{{Auth::user()->email}}" required>
                        </div>


                        <div class="form-group mt-3">
                            <label for="order-notes">Order notes (optional)</label>
                            <textarea class="form-control mb-0" id="order-notes" name="note" cols="30"
                                rows="4"
                                placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                        <div class="order-summary-wrapper sticky-sidebar">
                            <h3 class="title text-uppercase ls-10">Your Order</h3>
                            <div class="order-summary">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th colspan="2">
                                                <b>Product</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subTotal = 0;
                                        @endphp
                                        @foreach (session('cart') as $product)
                                        @php
                                            $subTotal += $product['quantity']*$product['price'];
                                        @endphp
                                        <tr class="bb-no">
                                            <td>{{$loop->iteration}}</td>
                                            <td class="product-name"> <i
                                                    class="fas fa-times"></i>{{substr($product['name'], 0, 15   )}} <span
                                                    class="product-quantity">{{$product['quantity']}}</span></td>
                                            <td class="product-total">${{number_format($product['quantity']* $product['price'],2)}}</td>
                                        </tr>
                                        @endforeach


                                        <tr class="cart-subtotal bb-no">
                                            <td>
                                                <b>Subtotal</b>
                                            </td>
                                            <td>
                                                <b>${{ number_format($subTotal, 2)}}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="shipping-methods">
                                            <td colspan="2" class="text-left">
                                                <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
                                                </h4>
                                                <ul id="shipping-method" class="mb-4">

                                                    <li>
                                                        <div class="custom-radio">
                                                            <input type="radio" checked id="flat-rate"
                                                                class="custom-control-input" name="shipping">
                                                            <label for="flat-rate"
                                                                class="custom-control-label color-dark">Flat
                                                                rate: $10000.00</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td>
                                                <b>${{number_format(10000* $subTotal, 2)}}</b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>


                                    <h4 class="title font-weight-bold ls-25 pb-0 mb-1 mt-3">Payment Methods</h4>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <select name="payment_method" class="form-control form-control-md">
                                                <option  selected="selected" >Paystack</option>
                                                <option> transfer</option>
                                            </select>
                                        </div>
                                    </div>



                                <div class="form-group place-order pt-6">
                                    <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
<!-- End of Main -->
@endsection

