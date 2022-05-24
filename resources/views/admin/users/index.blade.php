@extends('layouts.main')

@section('title', 'Створення нового користувача :: iuser')

@section('content')

<div class="d-flex justify-content-center mb-4">
    <a class="btn btn-success" href="{{ route('users.create') }}">Новий користувач</a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ім'я</th>
            <th scope="col">Прізвище</th>
            <th scope="col">Вік</th>
            <th scope="col">Email</th>
            <th scope="col">Роль</th>
            <th scope="col">Дії</th>
        </tr>
    </thead>
    <tbody>
@foreach($users as $user)
<tr>
    <th scope="row">{{ $user->id }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->surname }}</td>
    <td>{{ $user->age }}</td>
    <td>{{ $user->email }}</td>
    <td>
        @if($user->isAdmin())
        <span class="badge bg-danger">admin</span>
        @else
        <span class="badge bg-secondary">user</span>
        @endif
    </td>
    <td>
        <div class="d-flex">
            <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-sm btn-primary mx-2">Переглянути</a>
            @if($user->isAdmin())
            <form action="{{ route('users.reduce', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
                <button type="submit" class="btn btn-secondary btn-sm mx-2">Понизити</button>
            </form>
            @else
            <form action="{{ route('users.raise', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
                <button type="submit" class="btn btn-dark btn-sm mx-2">Підвищити</button>
            </form>
            @endif
            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-warning mx-2">Редагувати</a>
            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Підтвердіть видалення')">Видалити</button>
            </form>
        </div>
    </td>
</tr>
  @endforeach
  </tbody>
</table>

    <div class="d-flex justify-content-center my-4">
        {{ $users->links() }}
    </div>

@endsection

