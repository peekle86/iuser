<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class MainController extends Controller {

    /**
     * Початкова сторінка
     *
     * Якщо користувач авторизований, то перенаправляє на домашню сторінку для авторизованих
     */
    public function index()
    {
        if(Auth::check()) {
            return redirect('home');
        }
        return view('welcome');
    }

    /**
     * Домашня сторінка для авторизованих
     * 
     * 
     */
    public function users()
    {
        return view('main.users');
    }

}