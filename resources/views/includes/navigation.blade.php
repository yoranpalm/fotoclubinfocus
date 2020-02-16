<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <form action="/search" method="post">
                @csrf
                <div class="navbar-item searchbar">
                    <p class="control has-icons-left">
                        <input class="input search-input is-rounded" type="text" name="userSearch" id="userSearch"
                            placeholder="Zoek een lid, foto, categorie">
                        <span class="icon is-small is-left">
                            <i class="fas fa-search"></i>
                            </span>
                        </p>
                    </div>
            </form>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="/">
                    <i class="material-icons-outlined home-icon">home</i>
                </a>

                <a class="navbar-item" href="/foto">
                    Foto's
                </a>
                
                <a class="navbar-item" href="/info">
                    Informatie
                </a>

                @auth
                <a class="navbar-item" href="/foto/create">
                    Uploaden
                </a>
                @endauth

                @auth
                    <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="/instellingen">
                                <strong>{{ auth::user()->userVoornaam }} {{ auth::user()->userAchternaam }}</strong>
                            </a>
                        <div class="navbar-dropdown is-boxed">
                            <a class="navbar-item" href="/instellingen">
                                Instellingen
                            </a>
                            <a class="navbar-item" href="/profiel/{{auth::user()->id}}">
                                Profiel
                            </a>
                            @if(auth::id() && auth::user()->beheerderStatus === 1)
                            <a class="navbar-item" href="/admin">
                                Beheerspagina
                            </a>
                            @endif
                            <hr class="navbar-divider">
                            <form method="POST" action="{{route("logout")}}">
                                @csrf

                                <button class="navbar-item is-active">
                                    Uitloggen
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
                @guest
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-success is-rounded button-green" href="/login">
                            <strong>Inloggen</strong>
                        </a>
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
</nav>