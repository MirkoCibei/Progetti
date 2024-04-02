<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\BecomeRevisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\MakeUserRevisor;
use App\Http\Requests\FormRevisorRequest;
use App\Http\Requests\StoreEmailSentsRequest;
use App\Models\Notification;
use App\Models\EmailSents;


use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function index()
    {

        $announcement_to_check = Announcement::where('is_accepted', null)->orderBy('created_at', 'desc')->first();




        return view('revisor.index', compact('announcement_to_check'));
    }

    public function indexRevised()
    {

        $announcement_checked = [

            'true' => Announcement::where('is_accepted', true)->first(),
            'false' => Announcement::where('is_accepted', false)->first(),

        ];

        return view('revisor.index-revised', compact('announcement_checked'));
    }

    public function acceptAnnouncement(Announcement $announcement)

    {
        $announcement->setAccepted(true);
        Notification::create(
            [
                'user_id' => Auth::id(),
                'body' => "Annuncio accettato",
            ]
        );
        return redirect()->back()->with('success', 'Annuncio accettatto!');
    }

    public function rejectAnnouncement(Announcement $announcement)

    {
        $announcement->setAccepted(false);
        Notification::create(
            [
                'user_id' => Auth::id(),
                'body' => "Annuncio rifiutato!",
            ]
        );
        return redirect()->back()->with('success', 'Annuncio rifiutato!');
    }

    public function restoreRevisionAnnouncement(Announcement $announcement)

    {
        $announcement->setAccepted(NULL);
        Notification::create(
            [
                'user_id' => Auth::id(),
                'body' => "Annuncio messo in revisione!",
            ]
        );

        return redirect()->back()->with('success', 'Annuncio ripristinato!');
    }

    public function becomeRevisor(FormRevisorRequest $request)
    {

        EmailSents::create(
            [

                'sending_user_id' => Auth::id(),
                'receiving_user_id' => null,
                'body' => $request->body,

            ]
        );

        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));

        Notification::create(
            [
                'user_id' => Auth::id(),
                'body' => "hai inviato la richiesta da revisore!",
            ]
        );
        return redirect('/')->with('success', 'complementi! hai richesto di diventare revisore correttamente, attendi la conferma da parte dell\'admin');
    }

    public function makeRevisor(User $user)
    {

        if (Auth::check() && Auth::user()->is_revisor) {

            return redirect('/')->with(['error' => 'Hai già reso revisore questo utente']);
        }

        Artisan::call('presto:MakeUserRevisor', ["email" => $user->email]);
        return redirect('/')->with(['success' => 'Complimenti! l\'utente è diventato revisore']);
    }
}
