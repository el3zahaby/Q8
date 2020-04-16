<!DOCTYPE html>
<html lang="en">

<head>
  <title>Star Admin Pro Laravel Dashboard Template</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}">

    <link rel="stylesheet"
        href="{{ url('dash/assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('dash/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}">

    @stack('plugin-styles')

    <link rel="stylesheet" href="{{ url('dash/css/app.css') }}">

    @stack('style')
    @stack('css')

</head>

<body>

    <div class="container-scroller" id="app">
        @include('layouts.header')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!!  session('status') !!}
                        </div>
                    @endif
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    <script src="{{ url('dash/js/app.js') }}"></script>
    <script src="{{ url('dash/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>

    @stack('plugin-scripts')

    <script src="{{ url('dash/assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('dash/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('dash/assets/js/misc.js') }}"></script>
    <script src="{{ url('dash/assets/js/settings.js') }}"></script>
    <script src="{{ url('dash/assets/js/todolist.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $('.mdi-delete').parent().click(function (event) {
            var _this = $(this);
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _method: 'DELETE',
                            _token: "{{ csrf_token() }}",
                        },
                        url: _this.attr('href'),
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    });

                }
            })
        });
    </script>
    @stack('custom-scripts')
    @stack('js')

</body>

</html>
