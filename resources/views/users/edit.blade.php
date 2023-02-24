@extends('layouts.master')

@push('title')
Edit User | {{ $user->name }}
@endpush

@section('overview')
<div class="full-content">
  <div class="label" style="margin-bottom: var(--md);">
    <h2 class="title">{{ $user->name }}</h2>
    <h2 class="subtitle">Mengedit seorang pengguna</h2>
  </div>
  <form action="/users/store" method="POST" class="form full-content" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="img">
      <img src="{{ $user->getFirstMediaUrl('avatar', 'thumb') }}" class="photo" />
    </div>
    <div class="field flex gap">
      <div class="input">
        <label for="name">Nama</label>
        <input class="input-form" type="text" name="name" id="name" placeholder="John Doe" value="{{ $user->name }}" />
      </div>
      <div class="input">
        <label for="email">Email</label>
        <input class="input-form" type="email" name="email" id="email" placeholder="johndoe@example.com" value="{{ $user->email }}" />
      </div>
    </div>
    <div class="field flex gap">
      <div class="input">
        <label for="roles">Roles</label>
        <select class="input-form" style="text-transform: capitalize;" name="role" id="roles" @foreach($user->roles as $role) @if($role->id == 1) disabled @endif @endforeach>
          @foreach($roles as $role)
          <option value="{{ $role->id }}" style="text-transform: capitalize;">{{ $role->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="input">
        <label for="password">Kata Sandi</label>
        <input class="input-form" type="password" name="password" id="password" placeholder="Minimal 8 karakter" />
      </div>
    </div>
    <div class="field">
      <div class="input">
        <label for="avatar">Foto</label>
        <input type="file" name="avatar" id="avatar">
      </div>
    </div>
    <div class="field">
      <button class="btn primary">Kirim</button>
    </div>
  </form>
</div>
@endsection