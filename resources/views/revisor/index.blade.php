<x-layout>
  <x-nav />

  <div class="container mt-5">
    <div class="row ">
      <div class="col-12">

        <h1 class="text-center primary-color-text mb-5 ">
          {{$announcement_to_check ? __('ui.announceCheckTrue') : __('ui.announceCheckFalse')}}
        </h1>

      </div>
    </div>
    @if($announcement_to_check)

    <div class="row ">
      <div class="col-10 col-sm-12 col-lg-8 mx-auto  col-xxl-6 mb-3">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">

          @if(count($announcement_to_check->images))
          <div class="carousel-inner">
            @foreach($announcement_to_check->images as $image)
            <div class="carousel-item @if($loop->first) active @endif">
              <img src="{{$image->getUrl(300,200)}}" class="d-block w-100" alt="...">
            </div>
            @endforeach
          </div>
          @else
          <div class="carousel-inner">
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
          </div>
          @endif
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

      <div class="col-12 col-xxl-6">
        <div class="row">
          <div class="col-12 col-sm-4 border-end border-start border-top ps-5 ps-sm-3">
            <h5 class="mb-2 mt-4 fw-light primary-color-text">{{__('ui.insertTitle')}}: </h5>
            <h5 class="mb-4  primary-color-text">{{$announcement_to_check->title}}</h5>
            <h5 class="mb-2 fw-light  primary-color-text">{{__('ui.insertDescription')}}:</h5>
            <h5 class="mb-4  primary-color-text">{{$announcement_to_check->description}}</h5>
            <h5 class="mb-2 fw-light  primary-color-text">{{__('ui.insertPrice')}}:</h5>
            <h5 class="mb-4  primary-color-text">
              {{ Number::currency($announcement_to_check->price, in: 'EUR', locale: 'it') }}
            </h5>
          </div>
          @if(count($announcement_to_check->images))
          <div class="col-12 col-sm-4  border-end border-top ps-5 ps-sm-3">
            <h5 class="mb-2 mt-4 fw-light h4 primary-color-text">{{__('ui.revisorImg')}}</h5>
            <p class="mb-2 mt-4  primary-color-text">Adulti: <span class="{{$image->adult}}"></span></p>
            <p class="mb-2 mt-4  primary-color-text">Satira: <span class="{{$image->spoof}}"></span></p>
            <p class="mb-2 mt-4  primary-color-text">Medicina: <span class="{{$image->medical}}"></span></p>
            <p class="mb-2 mt-4  primary-color-text">Violenza: <span class="{{$image->violence}}"></span></p>
            <p class="mb-2 mt-4  primary-color-text">Contenuto Ammiccante: <span class="{{$image->racy}}"></span></p>
          </div>
          <div class="col-12 col-sm-4 border-end pe-0 border-top pb-2 ps-5 ps-sm-3">
            <h5 class="mb-2 mt-4 fw-light h4 primary-color-text">Tags</h5>
            @if($image->labels)
            @foreach($image->labels as $label)
            <p class="mb-2 mt-4  primary-color-text">{{$label}}</p>
            @endforeach
            @else
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            @endif
            @endif
          </div>
        </div>

        <div class="d-flex  justify-content-end py-3 border-top ">
          <form action="{{route ('revisor.accept_announcement',['announcement'=>$announcement_to_check])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn text-white rounded-5  primary-color-bg btnStatic">{{__('ui.btnAccept')}}</button>
          </form>


          <form class="ps-3" action="{{route ('revisor.reject_announcement',['announcement'=>$announcement_to_check])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger rounded-5 ">{{__('ui.btnRefuse')}}</button>
          </form>
        </div>
        @endif

      </div>

    </div>




  </div>

</x-layout>
<x-footer />