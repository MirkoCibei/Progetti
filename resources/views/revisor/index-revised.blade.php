<x-layout>
  <x-nav />
  <div class="container p-0">



    <div class="row justify-content-evenly ">

      <div class="col-12 col-md-6 p-3 mb-5 border-start border-end ">

        <div class="col-12 mb-5 ">
          <div class="">
            <header>
              <h1 class="text-center primary-color-text">
                {{$announcement_checked['true'] ? __('ui.announceAcceptedTrue') : __('ui.announceAcceptedFalse') }}
              </h1>
            </header>
          </div>
        </div>
        @if($announcement_checked['true'])

        <div class="col-8 mx-auto ">
          <div class="col-12 mx-auto">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="4" aria-label="Slide 5"></button>

              </div>
              <div class="carousel-inner">
                @if(count($announcement_checked['true']->images))
                @foreach($announcement_checked['true']->images as $image)
                <div class="carousel-item @if($loop->first) active @endif">
                  <img src="{{$image->getUrl(300,200)}}" class="d-block w-100" alt="...">
                </div>
                @endforeach
                @else
                <div class="carousel-item active">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
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
          </div>
          <div calss="col-6 ">
            <h5 class="mb-2 mt-4  fw-light h2 primary-color-text">{{__('ui.insertTitle')}}: </h5>
            <h4 class="mb-4 primary-color-text">{{$announcement_checked['true']->title}}</h4>
            <h4 class="mb-2 fw-light h2 primary-color-text">{{__('ui.insertDescription')}}:</h4>
            <h4 class="mb-4 primary-color-text">{{$announcement_checked['true']->description}}</h4>
            <h4 class="mb-2 fw-light h2 primary-color-text">{{__('ui.insertPrice')}}:</h4>
            <h4 class="mb-4 primary-color-text">
              {{ Number::currency($announcement_checked['true']->price, in: 'EUR', locale: 'it') }}
            </h4>

          </div>
        </div>
        <div class="col-8 d-flex justify-content-end  mx-auto">


          <form action="{{route ('revisor.restore_announcement',['announcement'=>$announcement_checked['true']])}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn text-white rounded-5  primary-color-bg btnStatic me-3">{{__('ui.btnRestore')}}</button>
          </form>


          <form action="{{route ('revisor.reject_announcement',['announcement'=>$announcement_checked['true']])}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger rounded-5">{{__('ui.btnRefuse')}}</button>
          </form>
        </div>
        @endif
      </div>


      <div class="col-12 col-md-6 p-3 mb-5 border-end ">

        <div class="col-12 mb-5">
          <h1 class="text-center primary-color-text">
            {{$announcement_checked['false'] ? __('ui.announceDiscardedTrue') : __('ui.announceAcceptedFalse')}}
          </h1>
        </div>
        @if($announcement_checked['false'])

        <div class="col-8 mx-auto">
          <div class="col-12 mx-auto">
            <div id="carouselExampleSlidesOnlyFalse" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide-to="4" aria-label="Slide 5"></button>

              </div>
              <div class="carousel-inner">
                @if(count($announcement_checked['false']->images))
                @foreach($announcement_checked['false']->images as $image)
                <div class="carousel-item @if($loop->first) active @endif">
                  <img src="{{$image->getUrl(300,200)}}" class="d-block w-100" alt="...">
                </div>
                @endforeach
                @else
                <div class="carousel-item active">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/img/woman-02.png" class="d-block w-100 " alt="...">
                </div>
              </div>
              @endif

              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnlyFalse" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div calss="col-12">
            <h5 class="mb-2 mt-4 fw-light h2 primary-color-text">{{__('ui.insertTitle')}}: </h5>
            <h4 class="mb-4 primary-color-text">{{$announcement_checked['false']->title}}</h4>
            <h4 class="mb-2 fw-light h2 primary-color-text">{{__('ui.insertDescription')}}:</h4>
            <h4 class="mb-4 primary-color-text">{{$announcement_checked['false']->description}}</h4>
            <h4 class="mb-2 fw-light h2 primary-color-text">{{__('ui.insertPrice')}}:</h4>
            <h4 class="mb-4 primary-color-text">
              {{ Number::currency($announcement_checked['false']->price, in: 'EUR', locale: 'it') }}
            </h4>

          </div>

          <div class="col-8 d-flex">

            <form action="{{route ('revisor.restore_announcement',['announcement'=>$announcement_checked['false']])}}" method="POST">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn text-white rounded-5  primary-color-bg btnStatic me-3">{{__('ui.btnRestore')}}</button>
            </form>

            <form action="{{route ('revisor.accept_announcement',['announcement'=>$announcement_checked['false']])}}" method="POST">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn btn-secondary rounded-5">{{__('ui.btnAccept')}}</button>
            </form>

          </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</x-layout>
<x-footer />