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
use App\Models\Notification;
use Livewire\Attributes\On;


class NotificationsList extends Component
{

    public $notifications=[];
    public $notificationCheked=[];
    public $notificationsTocheck=[];
    public $notificationsTocheckTakeFour=[];

    public $acceso=true;
    


    public function render()
    {
        return view('livewire.notifications-list');
    }
    #[On('notification-created')]
    public function mount()
    {
        return $this->loadNotification();
        
    }
   
    public function loadNotification()
    {

        if (Auth::user()) {
            
            $this->notifications = Notification::where('view',false)->where('user_id', Auth::user()->id)->take(4)->orderBy('id', 'DESC')->get();
            $this->notificationsTocheck = Notification::where('view',false)
            ->where('user_id', Auth::user()->id)->get();

        } else {

            $this->notifications =[];

        }
        
    }

    public function clearNotificationList($notificationId)
    {
        $notification = Notification::find($notificationId);

        $notification->delete();

        $this->loadNotification();
        
    }
    

    
    public function notificatonChecked()
    {
        $this->notificationsTocheckTakeFour=$this->notifications;
        foreach ($this->notificationsTocheckTakeFour as $notification) {
            $notification->setChecked(true);
        } 

        $this->acceso=true;
        $this->loadNotification();
        
        
    }

    
    

    
}
