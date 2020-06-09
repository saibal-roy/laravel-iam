<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('iamconstants.app_title') }} @yield('title')</title>

    <link href='{{ asset('vendor/laravel-iam/css/app.css') }}' rel='stylesheet' type='text/css'>


  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('laravel-iam.dashboard') }}">{{ config('iamconstants.app_title') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="nav-item">
              <a class="nav-link" href="/" target="_blank"><span data-feather="external-link"></span> Go to your Laravel
                App</a>
            </li>
            @if (app('laraveliam')->iam())
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                Manage <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('laravel-iam.dashboard') }}">
                  Dashboard
                </a>
                <a class="dropdown-item" href="{{ route('laravel-iam.users.index') }}">
                  Users
                </a>
                <a class="dropdown-item" href="{{ route('laravel-iam.roles.index') }}">
                  Roles
                </a>
                <a class="dropdown-item" href="{{ route('laravel-iam.permissions.index') }}">

                  Permissions
                </a>


              </div>

            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      <div class="container">
        <div class="row justify-content-center">
          @yield('content')
        </div>
      </div>
    </main>


    <script src="{{asset('vendor/laravel-iam/js/app.js')}}"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      //console.log(window.sweetalert("Hello world!"));
      feather.replace();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      /*
<a href="posts/2" data-method="delete"> <---- We want to send an HTTP DELETE request
- Or, request confirmation in the process -
<a href="posts/2" data-method="delete" data-confirm="Are you sure?">
*/

      (function () {

        var laravel = {
          initialize: function () {
            this.methodLinks = $('a[data-method]');

            this.registerEvents();
          },

          registerEvents: function () {
            this.methodLinks.on('click', this.handleMethod);
          },

          handleMethod: function (e) {

            var link = $(this);
            var httpMethod = link.data('method').toUpperCase();
            var form;


            // If the data-method attribute is not PUT or DELETE,
            // then we don't know what to do. Just ignore.
            if ($.inArray(httpMethod, ['PUT', 'DELETE']) === - 1) {
              return;
            }

            // Allow user to optionally provide data-confirm="Are you sure?"
            if (link.data('confirm')) {
              if (!laravel.verifyConfirm(link)) {
                return false;
              }
            }

            form = laravel.createForm(link);
            $.post(link.attr('href'), form.serialize())
              .done(function (data) {
                window.sweetalert(("errors" in data) ? data.errors : "Deleted successfully!")
                  .then((value) => {
                    location.reload();
                  });

              });
            e.preventDefault();
          },

          verifyConfirm: function (link) {
            return confirm(link.data('confirm'));
          },

          createForm: function (link) {
            var form =
              $('<form>', {
                'method': 'POST',
                'action': link.attr('href')
              });

            var hiddenInput =
              $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': link.data('method')
              });

            return form.append(hiddenInput)
              .appendTo('body');
          }
        };

        laravel.initialize();

      })();
    </script>
  </body>

</html>
