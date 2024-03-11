<?php

namespace App\Livewire;

use Livewire\Component;
Use Illuminate\Support\Facades\Mail;
use App\Mail\ContactVendor;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmailSentsRequest;
use App\Models\EmailSents;
use App\Models\User;
use Livewire\Attributes\On;

class ContactVendorForm extends Component
{
    public $emailSentId = null;
    public $body;
    public $user;


    public function rules(){
        return [
        'body'=> 'required|max:300'
        ];
    }
    
    public function render()
    {
        return view('livewire.contact-vendor-form');
    }

    public function store(Request $request)
    {
        EmailSents::create([
            
            'user_id' => Auth::id(),
            
            'body' => $this->body,
            
        ]);

        $this->dispatch('mail-created');

    }

    
    // #[On('mail-created')]
    // public function contactVendor(User $user)
    // {

    //     dd(Auth::id()->email);
    //     Mail::to('admin@presto.it')->send(new ContactVendor(Auth::user()));
    //     // $user->email
    // }
}