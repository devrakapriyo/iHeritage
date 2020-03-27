<!DOCTYPE html>
<html lang="en">

<head>

  @include('BE.assets.header')
  @yield('header')
  <style>
    .note-group-select-from-files {
      display: none;
    }
  </style>
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('BE.libs.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('BE.libs.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; iHeritage.id 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('messages_be.logout_msg_title')</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">@lang('messages_be.logout_msg_text')</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('messages_be.logout_btn_cancel')</button>
          <a class="btn btn-primary" href="{{url('logout')}}">@lang('messages_be.logout_btn_logout')</a>
        </div>
      </div>
    </div>
  </div>

  @include('BE.assets.footer')
  @yield('footer')
  @include('sweet::alert')
</body>

</html>
