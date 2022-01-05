<div class="row">
    @foreach($blogs as $blog)
<div class="col-md-6">
    <article class="blog">
        <figure>
            <a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$blog->id.'/'.$blog->slug) }}"><img style="width: 100%" src="{{ asset('uploads/blogs') }}/{{$blog->img}}" alt="{{ asset('uploads/blogs') }}/{{$blog->img}}">
                <div class="preview"><span>{{ __('links.read_more') }} </span></div>
            </a>
        </figure>
        <div class="post_info">

            <h2><a href="{{ LaravelLocalization::localizeUrl('/single-blog/'.$blog->id.'/'.$blog->slug) }}">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                {{ $blog->en_title }}
            @else
                {{ $blog->ar_title }}
            @endif</a></h2>
            <p>@if (LaravelLocalization::getCurrentLocale() === 'en')
                {{Illuminate\Support\Str::limit(strip_tags($blog->en_text ?? ''), $limit = 100, $end = '...')}}
            @else
            {{Illuminate\Support\Str::limit(strip_tags($blog->ar_text ?? ''), $limit = 100, $end = '...')}}
            @endif</p>

        </div>
    </article>
    <!-- /article -->
</div>
<!-- /col -->
@endforeach

</div>
<!-- /row -->

<div class="pagination__wrapper no_border add_bottom_30">


    <ul class="pagination">
            <!-- a Tag for previous page -->
<li><a class="prev" href="{{$blogs->previousPageUrl()}}">
    &#10094;
</a></li>
@for($i=1;$i<=$blogs->lastPage();$i++)
    <!-- a Tag for another page -->
    <li> <a href="{{$blogs->url($i)}}" class="{{ ($blogs->currentPage() == $i) ? ' active' : '' }}" >{{$i}}</a></li>
@endfor
<!-- a Tag for next page -->
<li><a class="next" href="{{$blogs->nextPageUrl()}}">
    &#10095;
</a></li>
</ul>
</div>
<!-- /pagination -->
