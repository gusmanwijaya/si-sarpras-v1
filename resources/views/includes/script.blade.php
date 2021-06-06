<script src="{{ asset('js/app.js') }}"></script>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="{{ asset('js/init-alpine.js') }}"></script>
<script src="{{ asset('js/focus-trap.js') }}" defer></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    @if(Session::has('sukses'))
        swal({
            title: "Sukses",
            text: "{{ Session::get('sukses') }}",
            icon: "success",
            button: "OK",
            closeOnClickOutside: false,
        });
    @elseif(Session::has('gagal'))
        swal({
            title: "Gagal",
            text: "{{ Session::get('gagal') }}",
            icon: "error",
            button: "OK",
            dangerMode: true,
            closeOnClickOutside: false,
        });
    @endif
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
{{-- START: Loader --}}
<script>
    $(window).on("load", function () {
        $(".loader").fadeOut();
    });
</script>
{{-- END: Loader --}}
