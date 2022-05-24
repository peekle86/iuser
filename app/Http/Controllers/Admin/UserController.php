<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegister;
use App\Http\Requests\StoreLogin;
use App\Http\Requests\StoreUserUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class UserController extends Controller
{
   
    /**
     * Сторінка зі списком усіх користувачів
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Сторінка з усією інформацією про користувача
     * 
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Сторінка з формою для створення нового користувача
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.users.create');
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
            return redirect()->route('users.index')->with('success', 'Користувач успішно створений');
        }

        return redirect()->back()->with('error', 'Не вдалося зберегти користувача');
    }


    /**
     * Сторінка для редагування інформації про користувача
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Обробка запиту на зміну інформації користувача
     *
     * @param StoreUserUpdate $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUserUpdate $request, $id)
    {
        $user = User::find($id);

        $data = $request->all();

        if ($file = User::uploadAvatar($request, $user->avatar)) {
            $data['avatar'] = $file;
        }

        $result = $user->update($data);

        if($result !== false) {
            return redirect()->route('users.index')->with('success', 'Зміни збережено');
        }
        return redirect()->back()->with('error', 'Не вдалося зберегти дані');
    }

    /**
     * Видаляє користувача
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Storage::delete($user->avatar);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Користувач видалений');
    }

    /**
     * Призначає роль адміна користувачу
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function raise($id)
    {
        $user = User::find($id);
        $user->is_admin = User::ROLE_ADMIN;
        $result = $user->save();

        if($result !== false) {
            Mail::to($user->email)->send(new NotificationMail([
                'title' => 'Вітаємо, тепер ви адмін!',
                'body' => 'Відтепер Вам призначено роль адміністратора.',
            ]));

            return redirect()->route('users.index')->with('success', 'Користувач призначений адміном');
        }
        return redirect()->back()->with('error', 'Не вдалося виконати операцію');
    }

    /**
     * Призначає роль юзера користувачу
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reduce($id)
    {
        $user = User::find($id);
        $user->is_admin = User::ROLE_USER;
        $result = $user->save();

        if($result !== false) {
            Mail::to($user->email)->send(new NotificationMail([
                'title' => 'Ви знову просто користувач...',
                'body' => 'Ваша роль на сайті iuser знову повернулася до звичайного користувача',
            ]));

            return redirect()->route('users.index')->with('success', 'Користувач призначений юзером');
        }
        return redirect()->back()->with('error', 'Не вдалося виконати операцію');
    }
}
