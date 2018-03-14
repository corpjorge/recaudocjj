<?php
function current_page($url = '/'){
  return request()->path() == $url;
}
?>
<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ url('home')}}" class="navbar-brand"><b>RecaudoCJJ</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo current_page('home') ? "class='active'" : "";?>><a href="{{ url('home')}}">Home <span class="sr-only">(current)</span></a></li>
            <li <?php echo current_page('presupuestos') ? "class='active'" : "";?>><a href="{{ url('presupuestos')}}">Presupuestos <span class="sr-only">(current)</span></a></li>
            <li <?php echo current_page('clientes') ? "class='active'" : "";?>><a href="{{ url('clientes')}}">Clientes <span class="sr-only">(current)</span></a></li>
            <li <?php echo current_page('prestamos') ? "class='active'" : "";?>><a href="{{ url('prestamos')}}">Prestamos <span class="sr-only">(current)</span></a></li>
            <li <?php echo current_page('cuotas') ? "class='active'" : "";?>><a href="{{ url('cuotas')}}">Cuotas <span class="sr-only">(current)</span></a></li>
            <li <?php echo current_page('calendario') ? "class='active'" : "";?>><a href="{{ url('calendario')}}">Calendario <span class="sr-only">(current)</span></a></li>

            {{-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> --}}
          </ul>
          {{-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form> --}}
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
           
            <!-- Tasks Menu -->

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                @if (Auth::user()->avatar == null)
                  <img src="{{ asset('dist/img/avatar5.png')}}" class="user-image" alt="User Image">
                @else
                  <img src="{{Auth::user()->avatar}}" class="user-image" alt="User Image">
                @endif
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">
                  @if (Auth::user()->social_name == null)
                    {{ Auth::user()->name}}
                  @else
                    {{ Auth::user()->social_name}}
                  @endif

                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  @if (Auth::user()->avatar == null)
                      <img src="{{ asset('dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
                  @else
                    <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
                  @endif
                  <p>
                    @if (Auth::user()->social_name == null)
                      {{ Auth::user()->name}}
                    @else
                      {{ Auth::user()->social_name}}
                    @endif
                    <small>{{$carbon->format('Y-m-d')}}</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    @if (Auth::user()->rol_id == 1)
                     <a href="{{ url('rol/2')}}" class="btn btn-default btn-flat">Admin</a> 
                    @else 
                     <a href="{{ url('rol/1')}}" class="btn btn-default btn-flat">Super Admin</a> 
                    @endif 
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat" id="logout"
                     onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                    Cerrar sesión</a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="submit" value="logout" style="display: none;">
                    </form>


                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
