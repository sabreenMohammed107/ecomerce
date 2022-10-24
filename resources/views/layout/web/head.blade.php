<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>KAPOTCHA </title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="{{ asset('comassets/image/x-icon')}}">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('comassets/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('comassets/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('comassets/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('comassets/img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('comassets/css/bootstrap.custom.min.css')}}" rel="stylesheet">
    <link href="{{ asset('comassets/css/style.css')}}" rel="stylesheet">
    @if(isset($canonical))
    <link rel="canonical" href="{{ $canonical }}" />
    @endif

    @yield('style')
    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('comassets/css/custom.css')}}" rel="stylesheet">

    <style>
        .footer-selector a:hover{
            color: #fff;
        }
        .alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
    </style>
</head>
