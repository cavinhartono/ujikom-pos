@extends('layouts.master')

@section('overview')
<div class="full-content">
  <div class="label">
    <h2 class="title">{{ $category->name }}</h2>
    <h2 class="subtitle">Mengedit suatu kategori</h2>
  </div>
  <div class="content" style="background: var(--white-primary); padding: var(--md); width: 100%; margin: var(--md) 0">
    <form action="/categorys/edit/{{ $category->id }}/store" method="POST" class="form" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="field">
        <div class="input">
          <label for="name">Nama</label>
          <input class="input-form" type="text" name="name" id="name" placeholder="Merek" value="{{ $category->name }}" />
        </div>
      </div>
      <div class="field">
        <button class="btn primary">Kirim</button>
      </div>
    </form>
  </div>
</div>
@endsection