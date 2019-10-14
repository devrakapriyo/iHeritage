<!-- Bootstrap core JavaScript-->
<script src="{{url('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{url('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{url('backend/js/sb-admin-2.min.js')}}"></script>

{{--Custom script for sweetalert--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{--Custome Plugin Texteditor--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

<script>
    $('.text-editor').summernote({
        tabsize: 2,
        height: 200
    });
</script>