@extends('layouts.master')

@section('overview')
<div class="products">
  <div class="full-content">
    <div class="label">
      <h2 class="title">Produk</h2>
      <h2 class="subtitle">Menambahkan suatu produk</h2>
    </div>
    <form action="/products/store" method="POST" class="form full-content" style="margin: var(--sm) 0;" enctype="multipart/form-data">
      @csrf
      <div class="field flex gap">
        <div class="input">
          <label for="name">Nama</label>
          <input class="input-form" name="name" type="text" id="name" placeholder="Merek" />
        </div>
        <div class="input">
          <label for="qty">Quantity</label>
          <input class="input-form" name="qty" type="number" id="qty" placeholder="XX" />
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
            <option value="" selected disabled>Pilih</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="field">
        <div class="input">
          <label for="barcode">Barcode</label>
          <textarea class="input-form" name="barcode" id="barcode"></textarea>
        </div>
        <div class="input">
          <input type="file" class="input-form" name="avatar" />
        </div>
      </div>
      <div class="field">
        <button class="btn primary" name="submit">Kirim</button>
      </div>
    </form>
  </div>
</div>
@endsection