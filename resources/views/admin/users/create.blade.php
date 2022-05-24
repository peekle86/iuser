@extends('layouts.main')

@section('title', 'Новий користувач :: iuser')

@section('content')

<main class="form-signin mb-5">
    <div class="d-flex justify-content-center">
  <form role="form" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
      @csrf
    <h1 class="h3 mb-3 fw-normal text-center">Новий користувач</h1>

    <div class="mb-3">
        <label for="avatar-input" class="form-label">Аватарка</label>
        <input name="avatar" class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar-input">
    </div>

    <div class="mb-3">
        <label for="email-input" class="form-label">Email</label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" placeholder="name@example.com">
    </div>

    <div class="mb-3">
        <label for="password-input" class="form-label">Пароль</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password-input">
    </div>

    <div class="mb-3">
        <label for="password_confirmation-input" class="form-label">Повторіть пароль</label>
        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation-input">
    </div>
    
    <div class="mb-3">
        <label for="name-input" class="form-label">Ім'я</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name-input">
    </div>
    
    <div class="mb-3">
        <label for="surname-input" class="form-label">Прізвище</label>
        <input name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" id="surname-input">
    </div>

    <div class="mb-3">
        <label for="age-input" class="form-label">Вік</label>
        <input name="age" type="number" class="form-control @error('age') is-invalid @enderror" id="age-input">
    </div>

    <div class="mb-3">
        <label for="description-input" class="form-label">Опис</label>
        <textarea name="description" id="description-input"></textarea>
    </div>


    <div class="mt-3 text-center">
    <button class="btn btn-lg btn-primary" type="submit">Створити</button>
</div>
  </form>
</div>
</main>

@endsection


@section('scripts')
<script src="https://cdn.tiny.cloud/1/mmnirtae7k108732zy450ey88v1qlp8ijgyg0kxf28l1pnuf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
    });
</script>
@endsection