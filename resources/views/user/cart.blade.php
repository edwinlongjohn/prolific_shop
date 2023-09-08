@extends('layouts.other_guest')
@section('content')
<main class="main cart">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="active"><a href="cart.html">Shopping Cart</a></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="order.html">Order Complete</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg mb-10">
                <div class="col-lg-8 pr-lg-4 mb-6">
                    <table class="shop-table cart-table">
                        <thead>
                            <tr>
                                <th class="product-name"><span>Product</span></th>
                                <th></th>
                                <th class="product-price"><span>Price</span></th>
                                <th class="product-quantity"><span>Quantity</span></th>
                                <th class="product-subtotal"><span>Subtotal</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('cart'))
                            @foreach (session('cart') as $i => $product)
                            <tr data-id="{{$i}}">
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="product-default.html">
                                            <figure>
                                                <img src="/storage/product_display_images/{{$product['image']}}"
                                                    alt="product" width="300" height="338">
                                            </figure>
                                        </a>
                                        <button type="submit" class="btn btn-close cart_remove"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="product-default.html">
                                        {{$product['name']}}
                                    </a>
                                </td>
                                <td class="product-price"><span
                                        class="amount">${{number_format($product['price'],2)}}</span></td>
                                <td class="product-quantit">
                                    <div class="input-grou">
                                        <input class="quant form-control cart_update" value="{{$product['quantity']}}"
                                            type="number" min="1" max="100000">

                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    @php
                                    $subTotal = $product['price'] * $product['quantity'];
                                    @endphp
                                    <span class="amount">${{number_format($subTotal,2)}}</span>
                                </td>
                            </tr>
                            @endforeach

                            @endif


                        </tbody>
                    </table>

                    <div class="cart-action mb-6">
                        <a href="#" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                        <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart"
                            value="Clear Cart">Clear Cart</button>
                        <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart"
                            value="Update Cart">Update Cart</button>
                    </div>


                </div>
                <div class="col-lg-4 sticky-sidebar-wrapper">
                    <div class="sticky-sidebar">
                        <div class="cart-summary mb-4">
                            <h3 class="cart-title text-uppercase">Cart Totals</h3>
                            <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                <label class="ls-25">Subtotal</label>
                                <span>$100.00</span>
                            </div>





                            <hr class="divider mb-6">
                            <div class="order-total d-flex justify-content-between align-items-center">
                                <label>Total</label>
                                <span class="ls-50">$100.00</span>
                            </div>
                            <a href="#" class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
<!-- End of Main -->
@endsection

@section('scripts')
<script type="text/javascript">
    $('.cart_update').change(function (e) {
        e.preventDefault();
        let ele = $(this);
        $.ajax({
            url: '{{route('user.update_cart')}}',
            method: "PATCH",
            data: {
                _token: '{{csrf_token()}}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents('tr').find('.quant').val()
            },
            success: function (response) {
                window.location.reload();
            }
        }).fail(function (xhr, status, error) {
            console.log(xhr, status, error);
        })

    })

    $('.cart_remove').click(function (e) {
        e.preventDefault();
        let ele = $(this);
        if (confirm('are you sure you want to delete this product from your Cart')) {
            $.ajax({
                url: '{{route('user.remove_product_from_cart')}}',
                method: "DELETE",
                data: {
                    _token: '{{csrf_token()}}',
                    id: ele.parents("tr").attr("data-id"),
                },
                success: function (response) {
                    window.location.reload();
                }
            }).fail(function (xhr, status, error) {
                console.log(xhr, status, error);
            })
        }
    })

</script>
@endsection
