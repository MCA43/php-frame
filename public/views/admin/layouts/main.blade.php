<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="shortcut icon" sizes="196x196" href="{{ uploads_url('images/system/favicon.ico') }}" />
    <title> @yield('title', 'Sayfa Başlığı') | Admin Panel </title>

    @include('admin.inc.style')

    @yield('page_style')
</head>

<body class="menubar-top menubar-light theme-primary">

@include('admin.inc.topbar')
@include('admin.inc.navbar')
@include('admin.inc.navbar-search')

<main id="app-main" class="app-main">
    <div class="wrap">
        @yield('content')
    </div>

    <div class="wrap p-t-0">
       @include('admin.inc.footer')
    </div>
</main>

@include('admin.inc.theme-setting')
@include('admin.inc.right-sidebar')


@include('admin.inc.script')
@yield('page_script')

</body>
</html>