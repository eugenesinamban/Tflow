<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/storage/images/tflow.png" alt="Logo" class="img-fluid" style="max-width: 5rem;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @guest

            @else
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="/questions" class="nav-link">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field/Game" class="nav-link">Game</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field/e-Sports" class="nav-link">e-Sports</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field/AI & Robot" class="nav-link">AI & Robot</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field/Web & IT" class="nav-link">Web & IT</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field/Anime & Illustration" class="nav-link">Anime & Illustration</a>
                    </li>
                    <li class="nav-item">
                        <a href="/field/CG & Video" class="nav-link">CG & Video</a>
                    </li>
                </ul>
        @endguest
        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <form action="{{ action('SearchController@search') }}" method="get" class="mt-2">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="search" name="search" class="form-control" placeholder="Search">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>

                    <li class="nav-item dropdown mt-2">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="/dashboard/" class="dropdown-item">Dashboard</a>
                            <a href="/profile/" class="dropdown-item">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
