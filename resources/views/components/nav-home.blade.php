<nav class="navbar navbar-expand-lg  navShadow fixed-top background">
  <div class="container py-4  bg-trasparent">
    <div class="d-flex">
      <img src="/img/Speed_Shop_Logo.svg" alt="" style="width: 40px;">
      <a class="navbar-brand fw-bold fs-3 p-0 ms-2 primary-color-text" href="{{route('home')}}">Presto</a>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ms-5 pt-3 p-lg-0 " id="navbarSupportedContent">
      <ul class="navbar-nav me-auto  mb-lg-0 ">
        <li class="nav-item border-bottom noBorderBot">
          <a class="nav-link active navAnimation linkNav" aria-current="page" href="{{route('home')}}">Home</a>
        </li>


        <li class="nav-item border-bottom noBorderBot">
          <a class="nav-link active navAnimation linkNav" aria-current="page"
            href="#category-section">{{__('ui.Category')}}</a>
        </li>
        <li class="nav-item border-bottom noBorderBot">
          <a class="nav-link active navAnimation linkNav" aria-current="page"
            href="#announcements-section">{{__('ui.Announce')}}</a>
        </li>

      </ul>

      
      @guest
      <div class="row m-0 me-lg-4 ms-lg-3">
        <div class="col-12 col-lg-6 py-2 px-0 p-lg-0 border-bottom noBorderBot">
          <a class="dropdown-item linkNav navAnimation " href="/login">{{__('ui.Login')}}</a>
        </div>
        <div class="col-12 col-lg-6 py-2 px-0 p-lg-0 border-bottom noBorderBot">
          <a class="dropdown-item linkNav navAnimation" href="/register">{{__('ui.Register')}}</a>
        </div>
      </div>

      @else


      <div class=" me-3 position-relative d-flex align-items-center ">
        
        <livewire:notifications-list />

        <button class="btn dropdown-toggle linkNav position-relative  " type="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          @if (Auth::user()->is_revisor)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{App\Models\Announcement::toBeRevisionedCount()}}
          </span>
          @endif
          <i class="bi bi-person-circle me-1"></i>
          {{auth()->user()->name}}
        </button>
        <ul class="dropdown-menu ">
          <li>
            @if (Auth::user()->is_revisor)
            <a href="{{ route('revisor.index')}}"
              class=" nav-link text-start position-relative dropdown-item primary-color-text ps-3 p-0 dropDownHover">
              {{__('ui.acceptAnnounce')}}<br>{{__('ui.dropDownAnnounce')}}: <span
                class=" fw-bold">{{App\Models\Announcement::toBeRevisionedCount()}}</span>
            </a>
          <li>
            <hr class="dropdown-divider">
          </li>
          <a href="{{ route('revisor.index-revised')}}" class="nav-link primary-color-text ps-3 dropDownHover">
            {{__('ui.restoreAnnounce')}}<br>{{__('ui.dropDownAnnounce')}}: <span
              class="fw-bold">{{App\Models\Announcement::revisionedCount()}}</span>
          </a>
          <li>
            <hr class="dropdown-divider">
          </li>

          @endif
          <form action="/logout" method="POST" class="nav-link btn ">
            @csrf
            <button class="nav-link primary-color-text ps-3 dropDownHover w-100 text-start "
              type="submit">Logout</button>
          </form>

          </li>
        </ul>
      </div>
      @endguest
      <div class="py-3 p-lg-0 d-flex align-items-center ">
        <a href="{{route('insert_announcement')}}" type="submit"
          class="btn text-white rounded-5  primary-color-bg btnStatic">{{__('ui.InsertAnnounce')}}</a>

        @if(session('locale')=='en')
        <x-_locale lang="en" nation="gb" />
        @elseif(session('locale')=='it')
        <x-_locale lang="it" nation="it" />
        @else
        <x-_locale lang="es" nation="es" />
        @endif

        <div class="dropdown background ">
          <button class="btn primary-color-text dropdown-toggle px-2 " type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
          </button>
          <ul class="dropdown-menu background ">
            <li class="dropdown-item">
              <x-_locale lang="en" nation="en" />
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-item">
              <x-_locale lang="it" nation="it" />
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-item">
              <x-_locale lang="es" nation="es" />
            </li>
          </ul>
        </div>
      </div>





    </div>
  </div>
</nav>