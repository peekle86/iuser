@extends('layouts.main')

@section('title', 'Зареєстровані користувачі :: iuser')

@section('content')

<div class="row row-cols-3 g-4">
@foreach($users as $user)
  <div class="col">
    <div class="card mb-3 position-relative shadow">
    <a href="{{ route('user.view', ['id' => $user->id]) }}" class="stretched-link"></a>
        <div class="row g-0">
            <div class="col-md-4">
            <img src="{{ $user->getAvatar() }}" class="img-fluid rounded" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>
                <p class="card-text text-end">
                    @if($user->is_admin === 1)
                        <span class="badge text-bg-danger">admin</span>
                    @else
                        <span class="badge text-bg-secondary">user</span>
                    @endif
                </p>
            </div>
            </div>
        </div>
    </div>
  </div>
  @endforeach
</div>

<div class="d-flex justify-content-center my-4">
        {{ $users->links() }}
    </div>

@endsection

