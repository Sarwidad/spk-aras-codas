<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../../assets/img/apple-icon.png"
    />
    @include('layouts.partials.admin.link')
    <title>{{ config('app.name', 'SPK') }}</title>
  </head>
  <body class="text-blueGray-700 antialiased">
  <div id="root">
    @include('layouts.partials.admin.sidebar')
    <div class="relative md:ml-64 bg-blueGray-50 flex flex-col min-h-screen">
      @include('layouts.partials.admin.topbar')
      <div class="content">
        @yield('content')
      </div>
      @include('layouts.partials.admin.footer')
    </div>
  </div>
  @include("layouts.partials.admin.script")
  </body>
</html>
