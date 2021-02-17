<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset(mix('js/app.js')) }}" defer></script>

  <!-- Styles -->
  <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>

<body>
  <noscript>
    <strong>We're sorry but retos mtb colombia doesn't work properly without
      JavaScript enabled. Please enable it to continue.</strong>
  </noscript>
  <div id="app"></div>
</body>

</html>