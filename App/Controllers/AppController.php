<?php

namespace App\Controllers;

use Aeros\Src\Classes\Controller;
use Aeros\Src\Classes\RateLimiter;

class AppController extends Controller
{
    public function __construct()
    {
        // Registration
//        rateLimiter()->throttle(
//            RateLimiter::keyByRoute(
//                request()->getURI(),           // e.g., "/api/users"
//                RateLimiter::keyByIP()         // e.g., "192.168.1.1"
//            ),
//            3,    // only 3 attempts
//            60    // per hour
//        );

        parent::__construct();
    }

    public function index(): string
    {
        // Trigger email notify event
        // app()->event->emit('email.notify', 'ralph@myaero.app');

        // more logic...

        // Trigger email reminder event
        // app()->event->emit('email.reminder', 'adam@myaero.app');

        // more logic...

        // Trigger email follow up event
        // app()->event->emit('email.followup', ['ben@myaero.app', 'andy@myaero.app']);

        // more logic...

        // return view('app');

        app()->event->emit(
            'email.notify', 
            ['ralph@myaero.app']
        );

        // Or

        // If you want to remove the event from the event hub, pass a 3rd parameter as true
        // app()->event->emit(
        //     'email.notify', 
        //     ['ralph@myaero.app'], 
        //     true
        // );

        return 'Index';
    }

    public function login(): string
    {
        return 'Pasa';
    }
    
    public function profile(int $userid, string $profile): string
    {
        return 'Profile';
    }

    public function showForm(): string
    {
        return 'Show form';
    }
}
