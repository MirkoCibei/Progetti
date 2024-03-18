<div class="container-fluid p-0 ">
    <x-nav />
    <div class="raw">
        <div class="col-6 mx-auto">
            <livewire:notification-message/>
         </div>
    </div>
    
    <div class="d-flex flex-column justify-content-between " style="height: 85vh">
        <div class="col-12 ">
            <form wire:submit.prevent="store">

                <div class="row">
                    <div class="col-6 m-auto mt-2 ">
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Titolo</label>
                            <input type="text" class="form-control @error('AnnTitle') is-invalid @enderror" id="title" placeholder="nome annuncio" wire:model="AnnTitle">
                            @error('AnnTitle') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label ">Prezzo € </label>
                            <input type="number" class="form-control @error('AnnPrice') is-invalid @enderror" id="price" placeholder="prezzo" wire:model="AnnPrice">
                            @error('AnnPrice') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <select id="category_id" class="form-select" wire:model="AnnCategory">
                                <option selected>Categorie</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="mb-3">
                           <input wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow   @error('temporary_images.*') is-invalid @enderror" placeholder="Img">
                            @error('temporary_images.*')
                                <p class="text-danger mt-2 ">
                                    {{message}}
                                </p>
                            @enderror 
                        </div>
                        @if(!empty($images))
                            <div class="row">
                                <div class="col-12">
                                    <p>Photo prewiew:</p>
                                    <div class="row border border-4 border-info rounded shadow py-4 ">
                                        @foreach($images as $key => $image)
                                        <div class="col my-3">
                                            <!-- <div class="img-prreview mx-auto shadow rounded" style="background-image: url({{$image->temporaryUrl()}});"> -->
                                        </div>
                                        <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                                        wire:click="removeImage({{$key}})">
                                        Cancella
                                        </button>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea class="form-control @error('AnnDescrip') is-invalid @enderror" id="description" rows="3" wire:model="AnnDescrip">

                </textarea>
                            @error('AnnDescrip') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn text-white rounded-5  primary-color-bg btnStatic" wire:confirm="Stai per inserire un nuov annuncio, Confermi?" wire:click="announcementCreated" type="submit">Crea</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-footer />
    </div>
</div>
