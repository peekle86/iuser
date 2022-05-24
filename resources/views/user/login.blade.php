@extends('layouts.main')

@section('title', 'Авторизація :: iuser')

@section('content')

<main class="form-signin">
    <div class="d-flex justify-content-center text-center">
  <form action="{{ route('login') }}" method="post">
    @csrf
    <h1 class="h3 mb-3 fw-normal">Авторизація</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" placeholder="name@example.com" style="border-radius: 0.375rem 0.375rem 0 0">
      <label for="email-input">Email</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password-input" placeholder="Password" style="border-radius: 0 0 0.375rem 0.375rem">
      <label for="password-input">Пароль</label>
    </div>

    <div class="d-flex justify-content-center mt-4">
      <button class="btn btn-lg btn-primary" type="submit">Авторизуватись</button>
    </div>
  </form>
</div>
</main>

@endsection