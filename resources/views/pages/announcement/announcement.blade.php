<x-layout>
  <x-nav />
  <div class="container">
    <div class="col-12">
      <div class="row  m-0 ">
        <div class="col-12 p-0 ">
          <header>
            <h1 class="primary-color-text ">{{__('ui.announce')}}: {{$announcement->title}}</h1>
            <h3 class="d-flex align-items-center primary-color-text ">
              {{ Number::currency($announcement->price, in: 'EUR', locale: 'it') }}
              <span class="text-end fs-6 ms-3 primary-color-text ">{{__('ui.category')}}:
                {{$announcement->category->name}}</span>
            </h3>
          </header>
        </div>
      </div>
    </div>

    <div class="row mt-1 g-5">

      <div class=" col-12 ">

        <div class="row m-0 text-center mt-2 d-block d-sm-flex ">

          <div class="col-12  col-md-7 col-lg-7 p-4 m-0">


            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <!-- <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="3" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="4" aria-label="Slide 4"></button>

              </div> -->
              <div class="carousel-inner">
                @if(count($announcement->images))
                @foreach($announcement->images as $image)
                <div class="carousel-item @if($loop->first) active @endif ">
                  <img src="{{$image->getUrl(300,200)}}" class="d-block w-100" alt="...">
                </div>
                @endforeach
                @else
                <div class="carousel-item active">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                @endif
              </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

            <h4 class="mt-4 mb-2 fw-light h2 primary-color-text ">{{__('ui.insertDescription')}}:</h4>
            <h4 class="mb-4 primary-color-text ">{{$announcement->description}}</h4>

          </div>


          <div class="col-12  col-md-5  flex-column m-0 p-4 border-start border-end">
            @auth
            <div>
              <h5 class="primary-color-text ">{{__('ui.contactVendor')}} {{$user->name}}.</h5>
            </div>

            <livewire:contact-vendor-form :receiving_user_id="$user->id" :receiving_user_email="$user->email" />

            @else
            <div>
              <h5 class="primary-color-text ">{{__('ui.contactVendor')}} {{$user->name}}.</h3>

            </div>

            <form>

              <div class="mb-3 text-secondary">
                <p>Per contattare il venditore devi essere loggato, se non hai un account premi su registrati</p>
              </div>

              <div class="d-flex mt-3 justify-content-center">
                <div class="mx-2">
                  <a class="btn btn-primary" href="/login" role="button">{{__('ui.Login')}}</a>
                </div>
                <div class="mx-2">
                  <a class="btn btn-primary" href="/register" role="button">{{__('ui.Register')}}</a>
                </div>
              </div>

            </form>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-footer />

</x-layout>