@extends('layouts.main')

@section('title', 'Інформація про користувача :: iuser')

@section('content')


<div class="d-flex justify-content-center mb-4">
        @if($user->isAdmin())
        <form action="{{ route('users.reduce', ['user' => $user->id]) }}" method="post">
        @csrf
        @method('PUT')
            <button type="submit" class="btn btn-secondary mx-2">Понизити до юзера</button>
        </form>
        @else
        <form action="{{ route('users.raise', ['user' => $user->id]) }}" method="post">
        @csrf
        @method('PUT')
            <button type="submit" class="btn btn-dark mx-2">Підвищити до адміна</button>
        </form>
        @endif
        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning mx-2">Редагувати</a>
        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
        @csrf
        @method('DELETE')
            <button type="submit" class="btn btn-danger mx-2" onclick="return confirm('Підтвердіть видалення')">Видалити</button>
        </form>
</div>

<div class="row">
    <div class="col-4">
        <img src="{{ $user->getAvatar() }}" class="img-fluid rounded" alt="{{ $user->name }}">
        <p class="text-muted"><small>Зареєстрований: {{ $user->getCreatedDate() }}</small></p>
        <p class="text-muted"><small>Інформацію оновлено: {{ $user->getUpdatedDate() }}</small></p>
        <p>
            @if($user->is_admin === 1)
                <span class="badge text-bg-danger">admin</span>
            @else
                <span class="badge text-bg-secondary">user</span>
            @endif
        </p>
    </div>
    <div class="col-8">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Ім'я: {{ $user->name }}</li>
            @if($user->surname !== null)
            <li class="list-group-item">Прізвище: {{ $user->surname }}</li>
            @endif
            @if($user->age !== null)
            <li class="list-group-item">Вік: {{ $user->age }}</li>
            @endif
            <li class="list-group-item">Email: {{ $user->email }}</li>
            @if($user->description !== null)
            <li class="list-group-item">Біографія:<br/>
                {!! $user->description !!}
            </li>
            @endif
        </ul>
    </div>
</div>

@endsection

