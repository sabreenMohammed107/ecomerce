<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\MyFirstNotification;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layout.web');
    }


    /***
     * send notify test
     */

    public function sendNotification()
    {
        $user = User::first();

        $details = [
            // 'greeting' => 'Hi Artisan',
            // 'body' => 'This is my first notification from ItSolutionStuff.com',
            // 'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            // 'actionText' => 'View My Site',
            // // 'actionURL' => url('/'),
            'product_name' => 'shooses',
        ];

        Notification::send($user, new MyFirstNotification($details));

        dd('done');
        /*
        you can also send notification like this way:
$user->notify(new MyFirstNotification($details));
        */
    }

    public function comment_replay($id)
    {
        $userUnreadNotification = auth()->user()
                                        ->unreadNotifications
                                        ->where('id', $id)
                                        ->first();

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return redirect('/product');
        }


    }
}
