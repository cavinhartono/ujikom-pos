@extends('layouts.master')

@push('title')
Mengedit {{ $product->name }} | Shopcube
@endpush

@push('css')
<style>
  .img {
    height: 200px;
  }
</style>
@endpush

@section('overview')
<div class="full-content">
  <div class="label">
    <h2 class="title">{{ $product->name }}</h2>
    <h2 class="subtitle">Mengedit suatu produk</h2>
  </div>
  <div class="content" style="background: var(--white-primary); padding: var(--md); width: 100%; margin: var(--md) 0">
    <div class="img">
      <img src="{{ $product->getFirstMediaUrl('avatar', 'thumb') }}" class="photo">
    </div>

    <form action="/products/edit/{{ $product->id }}/store" method="POST" class="form" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="field flex gap">
        <div class="input">
          <label for="name">Nama</label>
          <input class="input-form" type="text" name="name" id="name" placeholder="Merek" value="{{ $product->name }}" />
        </div>
        <div class="input">
          <label for="price">Harga</label>
          <input class="input-form" type="number" name="price" id="price" placeholder="IDR. XXX" value="{{ $product->price }}" />
        </div>
      </div>
      <div class="field flex gap">
        <div class="input">
          <label for="category">Kategori</label>
          <select class="input-form" name="category_id" id="category">
            <option>Pilih</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id  ? 'selected' : '' }} style="text-transform: capitalize;"> {{ $category->name }} </option>
            @endforeach
          </select>
        </div>
        <div class="input">
          <label for="barcode">Barcode</label>
          <input type="text" class="input-form" value="{{ $product->barcode }}" name="barcode" id="barcode" />
        </div>
      </div>
      <div class="field">
        <div class="input">
          <label for="qty">Stok</label>
          <input type="text" class="input-form" value="{{ $product->qty }}" name="qty" id="qty" />
        </div>
      </div>
      <div class="field">
        <div class="input">
          <input type="file" class="input-form" name="avatar" />
        </div>
      </div>

      <div class="field">
        <button class="btn primary">Kirim</button>
      </div>
    </form>
  </div>
</div>
@endsection