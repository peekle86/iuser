@extends('layouts.main')

@section('title', 'Редагування профілю :: iuser')

@section('content')

<main class="form-signin mb-5">
    <div class="d-flex justify-content-center">
  <form role="form" method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
    <h1 class="h3 mb-3 fw-normal text-center">Редагувати профіль</h1>

    <div class="mb-3">
        <label for="avatar-input" class="form-label">Аватарка</label>
        <input name="avatar" class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar-input">
    </div>
    
    <div class="mb-3">
        <label for="name-input" class="form-label">Ім'я</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name-input" value="{{ $user->name }}">
    </div>
    
    <div class="mb-3">
        <label for="surname-input" class="form-label">Прізвище</label>
        <input name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" id="surname-input" value="{{ $user->surname }}">
    </div>

    <div class="mb-3">
        <label for="age-input" class="form-label">Вік</label>
        <input name="age" type="number" class="form-control @error('age') is-invalid @enderror" id="age-input" value="{{ $user->age }}">
    </div>

    <div class="mb-3">
        <label for="description-input" class="form-label">Опис</label>
        <textarea name="description" id="description-input">{!! $user->description !!}</textarea>
    </div>


    <div class="mt-3 text-center">
    <button class="btn btn-lg btn-primary" type="submit">Зберегти</button>
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