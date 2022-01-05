<div class="row small-gutters">
    @foreach($products as $key => $product)
    <div class="col-6 col-md-4">
        <div class="grid_item">

            <figure>
                <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$product->id) }}">
                    <img class="img-fluid lazy" src="{{ asset('uploads/attachment') }}/{{$product->images[0]->img ?? ''}}" data-src="{{ asset('uploads/attachment') }}/{{$product->images[0]->img ?? ''}}" alt="{{ asset('uploads/attachment') }}/{{$product->images[0]->img ?? ''}}">
                </a>

            </figure>
            <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$product->id) }}">
                <h3>@if (LaravelLocalization::getCurrentLocale() === 'en')
                    {{ $product->en_name }}
                @else
                    {{ $product->ar_name }}
                @endif</h3>
            </a>
            <div class="price_box">
                <span class="new_price">{{ $product->price_after_discount }}</span>
                <span class="old_price">@if($product->discount)
                    {{ $product->price }}
                @endif</span>
            </div>
            <ul>
                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
            </ul>
        </div>
        <!-- /grid_item -->
    </div>
    <!-- /col -->
    @endforeach




</div>
<!-- /row -->
<div id="productt" class="pagination__wrapper no_border add_bottom_30">


    <ul class="pagination" id="product">
            <!-- a Tag for previous page -->
<li><a class="prev" href="{{$products->previousPageUrl()}}">
    &#10094;
</a></li>
@for($i=1;$i<=$products->lastPage();$i++)
    <!-- a Tag for another page -->
    <li> <a href="{{$products->url($i)}}" class="{{ ($products->currentPage() == $i) ? ' active' : '' }}" >{{$i}}</a></li>
@endfor
<!-- a Tag for next page -->
<li><a class="next" href="{{$products->nextPageUrl()}}">
    &#10095;
</a></li>
</ul>
</div>

