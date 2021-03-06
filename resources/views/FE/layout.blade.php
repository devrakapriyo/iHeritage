<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
  @include('FE.assets.header')
  @yield('header')
</head>

<body>

  <!-- Navigation -->
  @include('FE.libs.navbar')

  @yield('content')

  <!-- Footer -->
  @include('FE.libs.footer')

  @include('FE.assets.footer')
  @yield('footer')

</body>

</html>
