      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"  >
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class ="fa fa-globe btn btn-info">{{trans('admin.lang')}}</i>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{aurl('lang/ar')}}"><i class="fa fa-flag-o"></i> عربي</a></li>
              <li><a href="{{aurl('lang/en')}}"><i class="fa fa-flag-o"></i> English</a></li>
              <li><a href="{{aurl('lang/grm')}}"><i class="fa fa-flag-o"></i> Deutsche</a></li>

            </ul>
          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url('/design/adminLTE/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{!empty(auth()->guard('admin')->user())?auth()->guard('admin')->user()->name: " "}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url('/design/adminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                   {{!empty(auth()->guard('admin')->user())?auth()->guard('admin')->user()->name: " "}}
                  <small>{{session('lang') == 'ar'? Settings()->sitename_ar:Settings()->sitename_en}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                    <a href="{{aurl('logout')}}" class="btn btn-default btn-flat">{{trans('admin.Sign_out')}}</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>