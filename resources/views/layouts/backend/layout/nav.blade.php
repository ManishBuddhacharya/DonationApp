<nav class="navbar navbar-default navbar-fixed-top be-top-header">
  <div class="container-fluid">
    <div class="navbar-header"><a href="/backend/dashboard" class="navbar-brand"></a>
    </div>
    <div class="be-right-navbar">
      <ul class="nav navbar-nav navbar-right be-user-nav">
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{asset('img/avatar.png')}}" alt="Avatar"><span class="user-name">{{auth()->user()->fname}}</span></a>
          <ul role="menu" class="dropdown-menu">
            <li>
              <div class="user-info">
                <div class="user-name">{{auth()->user()->fname}}</div>
                <div class="user-position online">Available</div>
              </div>
            </li>
            <li><a class="pointer load_page" data-url="/backend/setting"><span class="icon mdi mdi-settings"></span> Settings</a></li>
            <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="icon mdi mdi-power"></span>{{ __('Logout') }}</a></li>
                                                     
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
