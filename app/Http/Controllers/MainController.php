<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;



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
     * Виводить список зареєстрованих користувачів. При чому, якщо роль користувача - юзер
     * то показує тільки юзерів.
     * Адміни можуть бачити всіх користувачів, в тому числі і адмінів
     */
    public function users()
    {
        if(Auth::user()->isAdmin()) {
            $users = User::where('id', '!=', Auth::user()->id)->paginate(6);
        } else {
            $users = User::where('id', '!=', Auth::user()->id)->where('is_admin', User::ROLE_USER)->paginate(6);
        }
        return view('main.users', compact('users'));
    }

}