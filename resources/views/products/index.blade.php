@extends('layouts.master')

@push('title')
Produk | Shopcube
@endpush

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('overview')
<div class="label" style="margin-bottom: var(--md);">
  <h2 class="title">Produk</h2>
</div>
<div class="products">
  <div class="label full-content between" style="align-items: center;">
    <div class="label flex gap">
      <a href="/products/create" class="btn primary link">Tambah</a>
      <a href="/products/print" class="btn secondary link">Cetak</a>
    </div>
    <div class="field" style="width: 300px;">
      <div class="input">
        <input type="text" class="input-form" id="search" placeholder="Pencarian">
      </div>
    </div>
  </div>
  <table class="table" id="table" style="margin-top: var(--md)">
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th style="text-align: start;">Barcode</th>
        <th style="text-align: start;">Name</th>
        <th style="text-align: end;">Price</th>
        <th style="text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
        <td>1</td>
        <td style="width: 120px; height: 120px">
          <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//82/MTA-2166021/coca-cola_coca-cola--390-ml-_full01.jpg" class="photo" />
        </td>
        <td>60000123XXXX</td>
        <td>Coca Cola</td>
        <td>IDR. 5.000</td>
        <td>
          <a href="#" class="link">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                <title>Edit</title>
                <path d="M464.37,49.2a22.07,22.07,0,0,0-31.88-.76L414.18,66.69l31.18,31.1,18-17.91A22.16,22.16,0,0,0,464.37,49.2Z" />
                <polygon points="252.76 336 239.49 336 208 336 176 336 176 304 176 272.51 176 259.24 185.4 249.86 323.54 112 48 112 48 464 400 464 400 188.46 262.14 326.6 252.76 336" />
                <polygon points="400 143.16 432.79 110.3 401.7 79.21 368.85 112 400 112 400 143.16" />
                <polygon points="208 304 239.49 304 400 143.16 400 112 368.85 112 208 272.51 208 304" />
              </svg>
            </span>
          </a>
          <a href="#" class="link">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                <title>Delete</title>
                <polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill: none" />
                <polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill: none" />
                <path d="M64,160,93.74,442.51A24,24,0,0,0,117.61,464H394.39a24,24,0,0,0,23.87-21.49L448,160ZM312,377.46l-56-56-56,56L174.54,352l56-56-56-56L200,214.54l56,56,56-56L337.46,240l-56,56,56,56Z" />
                <rect x="32" y="48" width="448" height="80" rx="12" ry="12" />
              </svg>
            </span>
          </a>
        </td>
      </tr> -->
      @forelse($products as $product)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td style="width: 120px; height: 120px">
          <img src="{{ $product->getFirstMediaUrl('avatar', 'thumb') }}" class="photo">
        </td>
        <td style="text-align: start;">{{ $product->barcode }}</td>
        <td style="text-align: start;">{{ $product->name }}</td>
        <td style="text-align: end;">{{ $product->price }} IDR</td>
        <td style="text-align: center;">
          <a href="#" class="link btn primary">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                <title>Edit</title>
                <path d="M464.37,49.2a22.07,22.07,0,0,0-31.88-.76L414.18,66.69l31.18,31.1,18-17.91A22.16,22.16,0,0,0,464.37,49.2Z" />
                <polygon points="252.76 336 239.49 336 208 336 176 336 176 304 176 272.51 176 259.24 185.4 249.86 323.54 112 48 112 48 464 400 464 400 188.46 262.14 326.6 252.76 336" />
                <polygon points="400 143.16 432.79 110.3 401.7 79.21 368.85 112 400 112 400 143.16" />
                <polygon points="208 304 239.49 304 400 143.16 400 112 368.85 112 208 272.51 208 304" />
              </svg>
            </span>
          </a>
          <a href="#" class="link btn danger">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                <title>Delete</title>
                <polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill: none" />
                <polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill: none" />
                <path d="M64,160,93.74,442.51A24,24,0,0,0,117.61,464H394.39a24,24,0,0,0,23.87-21.49L448,160ZM312,377.46l-56-56-56,56L174.54,352l56-56-56-56L200,214.54l56,56,56-56L337.46,240l-56,56,56,56Z" />
                <rect x="32" y="48" width="448" height="80" rx="12" ry="12" />
              </svg>
            </span>
          </a>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6">Tidak ada produk</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/plugins/jquery.js') }}"></script>
<script>
  $(document).ready(function() {
    $(document).on('keyup', '#search', function() {
      const search = $(this).val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'post',
        url: `/products/search`,
        data: {
          search
        },
        dataType: 'json',
        success: function(response) {
          $('tbody').html("");
          $.each(response, function(key, product) {
            $('tbody').append(`
              <tr>
                <td>
                  ${product.id}
                </td>
                <td style="width: 120px; height: 120px">
                  <img src="{{ $product->getFirstMediaUrl('avatar', 'thumb') }}" class="photo">
                </td>
                <td>
                  ${product.barcode}
                </td>
                <td>
                  ${product.name}
                </td>
                <td>
                  ${product.price}
                </td>
                <td style="text-align: center;">
                  <a href="#" class="link btn primary">
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                        <title>Edit</title>
                        <path d="M464.37,49.2a22.07,22.07,0,0,0-31.88-.76L414.18,66.69l31.18,31.1,18-17.91A22.16,22.16,0,0,0,464.37,49.2Z" />
                        <polygon points="252.76 336 239.49 336 208 336 176 336 176 304 176 272.51 176 259.24 185.4 249.86 323.54 112 48 112 48 464 400 464 400 188.46 262.14 326.6 252.76 336" />
                        <polygon points="400 143.16 432.79 110.3 401.7 79.21 368.85 112 400 112 400 143.16" />
                        <polygon points="208 304 239.49 304 400 143.16 400 112 368.85 112 208 272.51 208 304" />
                      </svg>
                    </span>
                  </a>
                  <a href="#" class="link btn danger">
                    <span class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                        <title>Delete</title>
                        <polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill: none" />
                        <polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill: none" />
                        <path d="M64,160,93.74,442.51A24,24,0,0,0,117.61,464H394.39a24,24,0,0,0,23.87-21.49L448,160ZM312,377.46l-56-56-56,56L174.54,352l56-56-56-56L200,214.54l56,56,56-56L337.46,240l-56,56,56,56Z" />
                        <rect x="32" y="48" width="448" height="80" rx="12" ry="12" />
                      </svg>
                    </span>
                  </a>
                </td>
              </tr>
            `)
          });
        }
      })
    })
  });
</script>
@endpush