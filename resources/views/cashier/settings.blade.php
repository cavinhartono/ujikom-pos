@extends('layouts.cashier')

@push('title')
Pengaturan | Shopcube
@endpush

@section('overview')
<div class="auth" style="margin-left: 80px; padding-top: 60px">
  <form action="/auth/settings/update" method="POST" class="form" enctype="multipart/form-data">
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

@section('dashboard')
<ul class="revenue">
  <li class="list" style="background: var(--fifth-color)">
    <h2 class="subtitle">
      Dimulai dari
    </h2>
    <h2 class="subtitle value">
      {{ \Carbon\Carbon::parse( Auth::user()->created_at)->isoFormat('HH MM') }}
    </h2>
  </li>
  <li class="list" style="background: var(--fourth-color)">
    <h2 class="subtitle">Saat Ini</h2>
    <h2 class="subtitle value">
      {{ App\Models\Order::whereDay('created_at', '=', Carbon\Carbon::now())->count() }}
    </h2>
  </li>
</ul>
@endsection