<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel IAM') }}</title>

    <link href='{{ asset('vendor/laravel-iam/css/app.css') }}' rel='stylesheet' type='text/css'>


</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('laravel-iam.dashboard') }}">Laravel IAM</a>                
    </nav>    
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                        @include ('laraveliam::layouts.menu')
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard - Logged In as {{ auth()->user()[config('laraveliam.identity_pk')] }}</h1>
                                         
                </div>
                <div class="row">
                        @yield('content')
                </div>
            </main>
        </div>
    </div>
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

(function() {

var laravel = {
  initialize: function() {
    this.methodLinks = $('a[data-method]');

    this.registerEvents();
  },

  registerEvents: function() {
    this.methodLinks.on('click', this.handleMethod);
  },

  handleMethod: function(e) {
    
    var link = $(this);
    var httpMethod = link.data('method').toUpperCase();
    var form;
   

    // If the data-method attribute is not PUT or DELETE,
    // then we don't know what to do. Just ignore.
    if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
      return;
    }

    // Allow user to optionally provide data-confirm="Are you sure?"
    if ( link.data('confirm') ) {
      if ( ! laravel.verifyConfirm(link) ) {
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

  verifyConfirm: function(link) {
    return confirm(link.data('confirm'));
  },

  createForm: function(link) {
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
