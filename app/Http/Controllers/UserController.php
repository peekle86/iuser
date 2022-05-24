<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRegister;
use App\Http\Requests\StoreLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Сторінка з формою для реєстрації
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Обробка пост запиту для створення нового користувача
     *
     * Перенаправляє на сторінку для авторизації при успіху, або вертає помилки валідації
     *
     * @param StoreRegister $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRegister $request)
    {
        $data = $request->all();

        $data['avatar'] = User::uploadAvatar($request);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return redirect()->route('login')->with('success', 'Ви успішно зареєструвались');
    }

    /**
     * Сторінка з формою для авторизації
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loginForm()
    {
        return view('user.login');
    }

    /**
     * Обробка пост запиту для авторизації
     *
     * Перенаправляє на сторінку користувачів при успіху, 
     * перенаправляє знову на сторінку авторизації при неправильних даних (якщо користувача з такими даними немає)
     *
     * @param StoreLogin $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(StoreLogin $request)
    {
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            session()->flash('success', 'Ви успішно авторизувались');
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Невірний email або пароль');
    }

    /**
     * Деавторизує користувача
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

}
