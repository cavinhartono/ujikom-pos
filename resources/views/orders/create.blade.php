@extends('layouts.master')

@section('overview')
<div class="full-content">
  <div class="label">
    <h2 class="title">Produk</h2>
    <h2 class="subtitle">Menambahkan suatu produk</h2>
  </div>
  <form action="/product/store" method="POST" class="form">
    @csrf
    <div class="img">
      <img src="" class="photo" />
    </div>
    <div class="field flex gap">
      <div class="input">
        <label for="name">Nama</label>
        <input type="text" id="name" placeholder="Merek" value="{{ $product->name }}" />
      </div>
      <div class="input">
        <label for="price">Harga</label>
        <input type="number" id="price" placeholder="IDR. XXX" value="{{ $product->price }}" />
      </div>
    </div>
    <div class="field">
      <select name="category_id" id="category">
        <option value="">Pilih</option>
        <option value="">Minuman</option>
        <option value="">Makanan</option>
      </select>
    </div>
    <div class="field">
      <div class="input">
        <label for="desc">Deskripsi</label>
        <textarea name="desc" id="desc">{{ $product->desc }}</textarea>
      </div>
    </div>
    <div class="field">
      <button class="btn primary">Kirim</button>
    </div>
  </form>
</div>
@endsection