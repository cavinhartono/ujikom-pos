@extends('layouts.cashier')

@section('header')

@if(Session::get('success'))
<div class="alert success between">
  <span class="icon">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
      <path d="M48,48V464H464V48ZM218,360.38,137.4,270.81l23.79-21.41,56,62.22L350,153.46,374.54,174Z" />
    </svg>
  </span>
  <h2 class="subtitle">{{ Session::get('success') }}</h2>
</div>
@endif

@if(Session::get('failed'))
<div class="alert flex between">
  <span class="icon"></span>
  <h2 class="subtitle">{{ Session::get('failed') }}</h2>
</div>
@endif

@endsection

@section('overview')
<div class="infomation" style="margin: 80px 0; margin-left: 75px;">
  <ul class="flex" style="gap: 12px">
    <li class="list">
      <h2 class="title">
        Menunggu izin dari admin
      </h2>
      <h2 class="subtitle">
        Semoga harimu menyenangkan!
      </h2>
    </li>
    <li class="list">
      <h2 class="title">
        {{ Auth::user()->name }}
      </h2>
      <h2 class="subtitle">
        {{ Auth::user()->email }}
      </h2>
    </li>
  </ul>
</div>
@endsection

@section('dashboard')
<div class="dashboard">
  <div class="label" style="margin-bottom: var(--md);">
    <h2 class="title">Pengaturan</h2>
  </div>
  <div class="auth">
    <form action="/auth/update" method="POST" class="form" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="field">
        <div class="input">
          <label for="name">Nama</label>
          <input type="text" name="name" id="name" class="input-form" value="{{ Auth::user()->name }}">
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
</div>
@endsection