@extends('layouts.master')

@section('overview')
<div class="products">
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
          <input class="input-form" type="text" id="name" placeholder="Merek" />
        </div>
        <div class="input">
          <label for="qty">Quantity</label>
          <input class="input-form" type="number" id="qty" placeholder="XX" />
        </div>
      </div>
      <div class="field flex gap">
        <div class="input">
          <label for="price">Harga</label>
          <input class="input-form" type="text" name="price" id="price" placeholder="IDR. XXX" />
        </div>
        <div class="input">
          <label for="category">Kategori</label>
          <select class="input-form" name="category_id" id="category">
            <option value="">Pilih</option>
            <option value="">Minuman</option>
            <option value="">Makanan</option>
          </select>
        </div>
      </div>
      <div class="field">
        <div class="input">
          <label for="barcode">Barcode</label>
          <textarea class="input-form" name="barcode" id="barcode"></textarea>
        </div>
      </div>
      <div class="field">
        <button class="btn primary">Kirim</button>
      </div>
    </form>
  </div>
</div>
@endsection