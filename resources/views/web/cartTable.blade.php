    <!-- /page_header -->
    <table id="table" class="table table-striped cart-list">
        <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Subtotal
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody >
            <?php
            $rowtotal=0;
             $footTotal=0;
            ?>
            @isset($cart)


            @foreach ($cart->items as $index=>$item)
            <?php
            $rowtotal=$item->product->price_after_discount*$item->quantity;
            $footTotal+=$rowtotal;
            ?>
            <tr data-id="{{$index+1}}">
                <td>
                    <div class="thumb_cart">
                        <img src="{{ asset('uploads/attachment') }}/{{$item->product->images[0]->img ?? ''}}" data-src="{{ asset('uploads/attachment') }}/{{$item->product->images[0]->img ?? ''}}" class="lazy" alt="Image">
                    </div>
                    <span class="item_cart">@if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{ $item->product->en_name  ?? ''}}
                    @else
                        {{ $item->product->ar_name ??'' }}
                    @endif</span>
                </td>
                <td>
                    <strong>{{ $item->product->price_after_discount ?? '' }}</strong>
                </td>

                <input type="hidden" id="cart_id{{$index+1}}" value="{{$item->id}}" >
                <td>
                    <div class="numbers-row">

                        <input type="text" value="{{ $item->quantity ?? '' }}" id="quantity_1" class="qty2" name="quantity_1">

                        <div  class="inc button_inc"  >+</div>
                    <div  class="dec button_inc" >-</div>
                </div>
                </td>
                <td>
                    <strong>{{ $rowtotal}} </strong>
                </td>
                <td class="options">
                    <a href="#" class="delItem" ><i class="ti-trash"></i></a>
                </td>
            </tr>
            @endforeach

            @endisset
        </tbody>
    </table>

    <div class="row add_top_30 flex-sm-row-reverse cart_actions">
    <div class="col-sm-4 text-end">

    </div>

</div>
<!-- /cart_actions -->

<!-- /container -->

<div class="box_cart">
<div class="container">
<div class="row justify-content-end">
<div class="col-xl-4 col-lg-4 col-md-6">
<ul>
    @if($footTotal>0)
<li>
<span>Total</span>
<p>{{$footTotal}}</p>

</li>
@endif
</ul>
@isset($cart)
@if($cart && $cart->items->count()>0)
<a href="{{ LaravelLocalization::localizeUrl('/place-order/'.$cart->id) }}" class="btn_1 full-width cart">Proceed to Checkout</a>
@endif
@endisset

</div>
</div>
</div>
</div>
<!-- /box_cart -->
