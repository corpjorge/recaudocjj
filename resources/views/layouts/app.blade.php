<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

@section('head')
    @include('layouts.head')
@show

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    @include('layouts.header')

    <div class="content-wrapper">
      <div class="container">
       
          <section class="content">
            @yield('content')
          </section>
      </div>
      <!-- /.container -->
    </div>
     @include('layouts.footer')
  </div>

  @section('script')
      @include('layouts.script')
  @show

</body>
</html>
