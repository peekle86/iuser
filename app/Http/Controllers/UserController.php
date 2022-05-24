<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRegister;
use App\Http\Requests\StoreLogin;
use App\Http\Requests\StoreUserUpdate;
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

        if($user !== false) {
            return redirect()->route('user.index')->with('success', 'Ви успішно зареєструвались');
        }

        return redirect()->back()->with('error', 'Не вдалось зберегти дані');
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

    /**
     * Відобаражає сторінку з даними про користувача
     * 
     * Якщо користувач намагається попасти на сторінку адміна, його поверне назад
     */
    public function view($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if($user->isAdmin() && !Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'Ви не можете переглядати сторінку адміна');
        }

        return view('user.view', compact('user'));
    }

    /**
     * Особистий кабінет користувача
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.index', compact('user'));
    }

    /**
     * Сторінка з формою для редагування даних користувачем
     */
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', compact('user'));
    }

    /**
     * Обробка запиту для обновлення інформації користувача
     *
     * @param StoreUserUpdate $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserUpdate $request)
    {
        $user = Auth::user();

        $data = $request->all();

        if ($file = User::uploadAvatar($request, $user->avatar)) {
            $data['avatar'] = $file;
        }

        $result = $user->update($data);

        if($result !== false) {
            return redirect()->route('user.index')->with('success', 'Зміни збережено');
        }
        return redirect()->back()->with('error', 'Не вдалося зберегти дані');
    }
    
}
