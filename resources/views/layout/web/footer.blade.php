<footer class="revealed">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">{{ __('links.quick_links') }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/about-us') }}">{{ __('links.about_us') }}</a></li>
                        <li><a href="help.html">{{ __('links.faq') }}</a></li>
                        <li><a href="help.html">{{ __('links.help') }}</a></li>
                        <li><a href="account.html">{{ __('links.my_account') }} </a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/blogs') }}">{{ __('links.blog') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/contact') }}">{{ __('links.contacts') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">{{ __('links.categories') }}</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        @foreach ($categories as $category)
                        <li><a href="#">
                             @if (LaravelLocalization::getCurrentLocale() === 'en')
                            {{ $category->en_name }}
                        @else
                            {{ $category->ar_name }}
                        @endif</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_3">{{ __('links.contacts') }}</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>{!!$contact->address!!}</li>
                        <li><i class="ti-headphone-alt"></i>{{$contact->phone}}</li>
                        <li><i class="ti-email"></i><a href="#0">{{$contact->email}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_4">{{ __('links.keep_touch') }}</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <form id="formLetter" action="{{ LaravelLocalization::localizeUrl('/send-letter') }}" method="post">
                        @csrf
                    <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email" id="email_newsletter" class="form-control" placeholder="{{ __('links.email') }}">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div>
                    </form>
                    <div class="follow_us">
                        <h5> {{ __('links.follow_us') }}</h5>
                        <ul>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('comassets/img/twitter_icon.svg')}}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('comassets/img/facebook_icon.svg')}}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('comassets/img/instagram_icon.svg')}}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('comassets/img/youtube_icon.svg')}}" alt="" class="lazy"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">

                <ul class="footer-selector clearfix">
                    {{-- <li>
                        <div class="styled-select lang-selector">
                            <select>
                                <option value="English" selected>Arabic</option>

                            </select>
                        </div>
                    </li>
                    <li>

                    </li> --}}
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        @if (LaravelLocalization::getCurrentLocale() != 'ar' && $localeCode == 'ar')
                        <a class="styled-select lang-selector" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                        <!--{{ $properties['native'] }}-->

                        {{ __('links.ar') }}
                    </a>

                        @endif
                        @if (LaravelLocalization::getCurrentLocale() != 'en' && $localeCode == 'en')
                        <a class="styled-select lang-selector" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                        {{ __('links.en') }} </a>

                        @endif
                        <!--|-->
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">

                    <li><span>© 2022 Fekra</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div><!-- Back to top button -->
