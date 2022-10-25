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

                <li>
                    @if(Auth::user())
                    <form id="myfavForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-fav') }}" method="post">

                    @csrf
                    <input type="hidden" name="fav_id" value="{{ $product->id }}">
                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                    <a
                    onclick="this.closest('form').submit();return false;" class="tooltip-1" data-bs-toggle="tooltip"
                        data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>

            </form>
            @else

            <a
             class="tooltip-1" data-bs-toggle="tooltip"  href="{{ route('user-login') }}"
                data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>
            @endif
        </li>
                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="{{ __('links.share_product') }}"><i class="ti-control-shuffle"></i><span>{{ __('links.share_product') }}</span></a></li>
                @if(Auth::user())
                <li>
                    <form id="mycardForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-cart') }}" method="post">
                        {{-- <form id="mycardForm" action="#" method="post" > --}}
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <a
                        onclick="this.closest('form').submit();return false;" class="tooltip-1" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="{{ __('links.add_cart') }}"><i
                                class="ti-shopping-cart"></i><span></span></a>

                </form>
                </li>
            @endif
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

