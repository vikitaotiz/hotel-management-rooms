 <!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')

    <!-- 1. Addchat css -->
    <link href="<?php echo asset('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">

</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="alert alert-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- 2. AddChat widget -->
                    <div id="addchat_app" 
                        data-baseurl="<?php echo url('') ?>"
                        data-csrfname="<?php echo 'X-CSRF-Token' ?>"
                        data-csrftoken="<?php echo csrf_token() ?>"
                    ></div>

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')

<script>
  $('#rooms_table').dataTable( {
    "pageLength": 10,
    "columnDefs": [
    { "width": "30%", "targets": 0 }]
  });
</script>

<!-- 3. AddChat JS -->
<!-- Modern browsers -->
<script type="module" src="<?php echo asset('assets/addchat/js/addchat.min.js') ?>"></script>
<!-- Fallback support for Older browsers -->
<script nomodule src="<?php echo asset('assets/addchat/js/addchat-legacy.min.js') ?>"></script>

</body>
</html>