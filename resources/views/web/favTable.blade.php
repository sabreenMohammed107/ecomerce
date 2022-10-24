    <!-- /page_header -->
    <table id="table" class="table table-striped cart-list">
        <thead>
            <tr>
                <th>
                    Product
                </th>

                <th>

                </th>
            </tr>
        </thead>
        <tbody >


            @foreach ($favs as $index=>$fav)

            <tr data-id="{{$index+1}}">
                <td>
                    <div class="thumb_cart">
                        <img src="{{ asset('uploads/attachment') }}/{{$fav->product->images[0]->img ?? ''}}" data-src="{{ asset('uploads/attachment') }}/{{$item->product->images[0]->img ?? ''}}"  alt="Image">
                    </div>
                    <span class="item_cart">@if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{ $fav->product->en_name  ?? ''}}
                    @else
                        {{ $fav->product->ar_name ??'' }}
                    @endif</span>
                </td>
                <input type="hidden" id="fav_id{{$index+1}}" value="{{$fav->id}}" >
                <input type="hidden" id="user_id{{$index+1}}" value="{{$fav->client_id}}" >
                <td class="options">
                    <a href="#" class="delItem" ><i class="ti-trash"></i></a>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>

    <div class="row add_top_30 flex-sm-row-reverse cart_actions">
    <div class="col-sm-4 text-end">

    </div>

</div>
<!-- /cart_actions -->

<!-- /container -->

