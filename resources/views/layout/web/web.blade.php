@include('layout.web.head')

<body>

	<div id="page">

        @include('layout.web.header')
        @yield('content')
        @include('layout.web.footer')

        @include('layout.web.footerscript')

