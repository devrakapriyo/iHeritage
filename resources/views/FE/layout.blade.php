<!DOCTYPE html>
<html lang="en">

<head>
  @include('FE.assets.header')
</head>

<body>

  <!-- Navigation -->
  @include('FE.libs.navbar')

  @yield('content')

  <!-- Footer -->
  @include('FE.libs.footer')

  @include('FE.assets.footer')

</body>

</html>
