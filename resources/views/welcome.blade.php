@extends('layouts.main')

@section('title', 'Hello there :: iuser')

@section('content')

<div class="container">
<div class="d-flex justify-content-center text-center">   
      <main>
        <h1>Привіт!</h1>
        <p class="lead">Це міні система для зберігання інформації про користувачів</p>
        <p class="lead">Щоб продовжити, будь ласка, авторизуйтесь</p>
        <p class="lead">
          <a href="{{ route('login.create') }}" class="btn btn-lg btn-primary">Авторизуватись</a>
        </p>
      </main>

</div>
</div>

@endsection