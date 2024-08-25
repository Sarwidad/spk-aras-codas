<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="./assets/img/favicon.ico" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="./assets/img/apple-icon.png"
    />
    @include('layouts.partials.link')
    <title>SPK-Sarwidad Fivaprila</title>
  </head>
  <body class="text-blueGray-700 antialiased">
    @include('layouts.partials.navbar')
    @yield('landing')

    @include('layouts.partials.footer')
  </body>
  @include('layouts.partials.script')
</html>
