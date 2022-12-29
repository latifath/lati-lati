<style>
    @media (max-width: 542px) {
    img{
        width: 100px;
        height: 60px;
    }
    }
</style>
  <!-- Top Bar Start -->
<div class="topbar" style="{{ couleur_principal() }}">

    <div class="topbar-left	d-none d-lg-block">
        <div class="text-center">

            <a href="/"><img src="{{ new_year() ? asset('dashbord/images/logo_sapin.png') : asset('dashbord/images/logo.png') }}" height="50" alt="tds" class="logo" ></a>
        </div>
    </div>

    <nav class="navbar-custom" style="{{ couleur_principal() }}">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list"><span class="font-medium text-base text-gray-800">{{ auth()->user()->name}}</span>
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                   <div class="flex items-center px-1">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="user" class="rounded-circle" style="border: solid;">
                        </div>
                    @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profil</a>
                    <a class="dropdown-item" href="{{ route('root_espace_client_information_client') }}"><i class="fa fa-user"></i><span class="badge badge-success mt-1 float-right"></span>Compte</a>
                    <a class="dropdown-item" href="{{ route('root_deconnexion') }}" ><i class="mdi mdi-logout m-r-5 text-muted"></i> Se deconnecter</a>

                </div>
            </li>
        </ul>
        <ul class="list-inline menu-left mb-0" >
            <li class="list-inline-item" style="{{ couleur_principal() }}">
                <button type="button" class="button-menu-mobile open-left waves-effect" >
                    <i class="ion-navicon" style="color:black; {{ couleur_principal() }}"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>
<!-- Top Bar End -->
