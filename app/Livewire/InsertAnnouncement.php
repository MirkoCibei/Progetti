<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;


class InsertAnnouncement extends Component
{
    use WithFileUploads;

    #[Validate('required', message: 'I campi con * sono obbligatori.')]
    #[Validate('max:50', message: 'il titolo contiene troppi caratteri.')]
    public $AnnTitle;

    #[Validate('required', message: 'seleziona una categoria')]
    public $AnnCategory;
    #[Validate('required', message: 'I campi con * sono obbligatori.')]
    #[Validate('min:1', message: 'la descrizione contiene pochi caratteri.')]
    public $AnnDescrip;
    #[Validate('required', message: 'I campi con * sono obbligatori.')]
    #[Validate('max:10000', message: 'il prezzo è troppo alto.')]
    public $AnnPrice;

    #[Validate([
        // 'images' => 'required',
        'images.*' => 'image|max:1024',
    ], message: [
        'required' => 'l\immagine è richiesta.',
        'images.*image' => 'il file deve essere un\immagine.',
        'images.*.max' => 'l\'immagine è troppo grande',
        'temporary_images.*.min' => 'l\'immagine è troppo piccola',
    ], attribute: [
        'images.*' => 'image',
    ])]
    public $images = [];

    #[Validate([
        // 'temporary_images' => 'required',
        'temporary_images.*' => 'image|max:1024',
    ], message: [
        'required' => 'l\immagine è richiesta.',
        'temporary_images.*image' => 'il file deve essere un\immagine.',
        'temporary_images.*.max' => 'l\'immagine è troppo grande',

    ], attribute: [
        'temporary_images.*' => 'temporary_image',
    ])]
    public $temporary_images = [];

    public $announcement_id = null;

    // protected function rules()
    // {
    //     return [
    //         'AnnTitle'=>'required|max:50',
    //         'AnnCategory'=>'required|max:200',
    //         'AnnDescrip'=>'required|min:1',
    //         'AnnPrice'=>'required|max:10000',

    //         'images.*'=>'image|max:10000',
    //         'temporary_images.*'=>'image|max:10000',
    //     ];
    // }


    // protected $messages =[
    //     'required'=> 'il campo :attribute è richiesto',
    //     'images.max'=>'L\'immagine è richiesta',
    //     'temporary_images.*.max'=>'il file deve essere massimo di ',
    //     'temporary_images.required'=>'L\'immagine è richiesta'


    // ];

    public function store()
    {
        $this->validate();


        $this->announcement_id = Announcement::create([
            'title' => $this->AnnTitle,
            'user_id' => Auth::id(),
            'category_id' => $this->AnnCategory,
            'description' => $this->AnnDescrip,
            'price' => $this->AnnPrice,

        ])->id;





        if (count($this->images)) {
            foreach ($this->images as $image) {
                // Image::create([
                //     'announcement_id'=> $this->announcement_id,
                //     'path'=>$image->store('images', 'public')]);
                $newFileName = "announcement/{$this->announcement_id}";
                $newImage = Image::create([
                    'announcement_id' => $this->announcement_id, 'path' => $image->store($newFileName, 'public')
                ]);

                RemoveFaces::withChain([

                    new ResizeImage($newImage->path, 300, 200),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)

                ])->dispatch($newImage->id);
            }

            // File::deleteDirectory(storage_path('app/livewire-tmp'));
        }

        $this->resetAnnounce();

        session()->flash('announcementSuccess');
    }

    public function resetAnnounce()
    {
        $this->AnnTitle = '';
        $this->AnnDescrip = '';
        $this->AnnCategory = '';
        $this->images = [];
        $this->temporary_images = [];
        $this->AnnPrice = '';
    }

    public function announcementCreated()
    {
        if (!$this->AnnTitle || !$this->AnnPrice || !$this->AnnCategory || !$this->AnnDescrip) {
            return back();
        }

        $this->dispatch('announcement-created');
        session()->flash('success');
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:1024',




        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function render()
    {
        return view('livewire.insert-announcement', ['categories' => Category::all()]);
    }

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }
}
