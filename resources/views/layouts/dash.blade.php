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

    <style>
        select.form-control {
            padding: 1px 1px 1px 7px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
    <style>
        .select2-container {
            width: 100%!important;
        }
    </style>
    @stack('style')
    @stack('css')

</head>

<body>

    <div class="container-scroller" id="ap/images/logo.svgp">
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
                        @if($errors->any())
                            {!!  implode('', $errors->all('<div  class="alert alert-danger">:message</div>')) !!}
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('select').select2();
        });
    </script>
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

        // color thing
        $('.badge-bg').each(function () {
            var rgb = $(this).css('backgroundColor');
            var colors = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);

            var r = colors[1];
            var g = colors[2];
            var b = colors[3];

            var o = Math.round(((parseInt(r) * 299) + (parseInt(g) * 587) + (parseInt(b) * 114)) /1000);

            if(o > 125) {
                $(this).css('color', 'black');
            }else{
                $(this).css('color', 'white');
            }
        });


    </script>
    @stack('custom-scripts')

    @stack('js')
</body>

</html>
