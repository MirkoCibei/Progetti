<div>

  <form class="mt-3" wire:submit="store">
    <div class="mb-3">
      <label for="body" class="form-label"></label>
      <textarea type="text" wire:model="body" class="form-control p-0 @error('body') is-invalid @enderror" id="body" placeholder="  Scrivi al venditore" style="height: 200px"></textarea>
      @error('body') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 d-grid">
      <button wire:confirm="stai inviando un email al venditore, il venditore potrà vedere il tuo indirizzo mail e i tuoi dati personali, verrai reindirizzato alla home principale, sei sicuro di di voler inviare la mail?" wire:click="emailSent" class="btn btn-light p-0" type="submit">invia messaggio</button>
    </div>
    <input type="text" class="invisible z-n1" value="{{$receiving_user_id}}" wire:model="receiving_user_id">
    <input type="text" class="invisible z-n1" value="{{$receiving_user_email}}" wire:model="receiving_user_email">
    <div class="dropdown background ">
      @if(session()->has('success'))
      <span class="position-absolute top-0 start-100 translate-middle rounded-pill bg-danger" style="width:10px; height:10px"></span>
      @endif

    </div>





  </form>

</div>