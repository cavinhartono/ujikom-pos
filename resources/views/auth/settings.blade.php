@extends('layouts.master')

@section('overview')
<div class="label" style="margin-bottom: var(--md);">
  <h2 class="title">Pengaturan</h2>
</div>
<div class="auth">
  <form action="/auth/update/{{ $user->id }}" method="POST" class="form">
    @csrf
    @method('PUT')
    <div class="field">
      <div class="input">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="input-form" value="{{ $user->name }}">
      </div>
    </div>
    <div class="field">
      <div class="input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="input-form">
      </div>
    </div>
    <div class="field">
      <div class="input">
        <input type="file" name="avatar" class="input-form">
      </div>
    </div>
    <div class="field">
      <div class="input">
        <button class="btn primary">Kirim</button>
      </div>
    </div>
  </form>
</div>
@endsection