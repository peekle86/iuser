@extends('layouts.main')

@section('title', 'Особистий кабінет :: iuser')

@section('content')


@if($user->isAdmin())
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('users.index') }}" class="btn btn-block btn-danger">Список користувачів</a>
    </div>
@endif


<div class="d-flex justify-content-center mb-4">
<a href="{{ route('user.edit') }}" class="btn btn-primary">Редагувати</a>
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

