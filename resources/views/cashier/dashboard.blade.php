@extends('layouts.cashier')

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  table {
    table-layout: fixed;
  }

  thead tr {
    width: 100%;
    display: flex;
    justify-content: space-between;
  }

  thead th {
    width: 100%;
  }

  tbody tr {
    padding: 8px 12px;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
  }

  thead,
  tbody {
    display: block;
  }

  tbody {
    height: 180px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>
@endpush

@push('title')
Cashier | Shopcube
@endpush

@section('overview')
<form class="form" style="position: relative; margin: var(--lg) 0; padding: 0 var(--md)">
  <div class="field flex gap">
    <div class="input">
      <input type="text" placeholder="Mencari produk..." class="input-form" id="search">
    </div>
    <div class="input center gap">
      <input type="text" placeholder="Barcode" id="productCode" class="input-form">
      <button class="btn primary" id="find" style="padding: 12px 24px;">Cari</button>
    </div>
  </div>
</form>
<ul class="products flex" style="margin: var(--md) 0; gap: 8px; flex-wrap: wrap;">
  @forelse($products as $product)
  <li class="list">
    <button type="button" class="btn card" id="item" style="cursor: pointer; border: none;" value="{{ $product->id }}">
      <div class="img">
        <img src="{{ $product->getFirstMediaUrl('avatar', 'thumb') }}" class="photo">
      </div>
      <div class="label center" style="flex-direction: column;">
        <h2 class="title">{{ $product->name }}</h2>
        <h2 class="subtitle">{{ $product->price }}</h2>
      </div>
    </button>
  </li>
  @empty
  <li class="list">
    tidak ada produk
  </li>
  @endforelse
</ul>
@endsection

@section('dashboard')
<div class="dashboard">
  <form action="/transaction/store" method="POST" class="form">
    @csrf
    <div class="field flex gap">
      <div class="input">
        <input type="text" placeholder="Nama Customer" name="name" class="input-form">
      </div>
      <div class="input">
        <input type="text" placeholder="Nomor Telepon" name="phone" class="input-form">
      </div>
    </div>
    <table class="table" style="margin-bottom: var(--md);">
      <thead class="between">
        <tr>
          <th colspan="2" style="text-align: end;">Jumlah</th>
          <th style="text-align: end;">Harga</th>
        </tr>
      </thead>
      <tbody id="tbody"></tbody>
    </table>
    <div class="field flex gap" style="justify-content: flex-end; align-items: flex-end;">
      <div class="input flex" style="flex-direction: column; align-items: flex-end;">
        <label for="total">Total</label>
        <div class="center gap">
          <input type="number" style="padding: 0; text-align: end;" value="" class="title" name="price" id="total" readonly>
          <h2 class="title">IDR </h2>
        </div>
      </div>
    </div>
    <div class="field between gap" style="margin: var(--md) 0;">
      <div class="input">
        <label for="return">Kembalian</label>
        <div class="center gap">
          <h2 class="title">IDR. </h2>
          <input type="number" style="padding: 0;" value="" class="title" name="return" id="return" readonly>
        </div>
      </div>
      <div class="input flex" style="flex-direction: column;">
        <label for="accept" style="text-align: end;">Uang Tunai</label>
        <div class="center gap">
          <input type="number" style="padding: 0;" class="title" name="accept" id="accept">
          <h2 class="title">IDR</h2>
        </div>
      </div>
    </div>
    <div class="field" style="margin: var(--md) 0;">
      <div class="input">
        <button class="btn primary">Pay</button>
      </div>
    </div>
  </form>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/plugins/jquery.js') }}"></script>
<script>
  $(document).ready(function() {
    // Sukses
    function getCarts() {
      $.ajax({
        type: 'get',
        url: 'carts',
        dataType: 'json',
        success: function(response) {
          let total = 0;
          $('#tbody').html("");
          $.each(response.carts, function(key, product) {
            total += product.price * product.qty
            $('#tbody').append(`
              <tr>
                <td>${product.name}</td>
                <td colspan="2" class="flex gap">
                  <select class="input-form" id="qty">
                  ${[...Array(product.stock).keys()].map((x) => (
                    `<option ${product.qty == x + 1 ? 'selected' : null} value=${x + 1}>
                        ${x + 1}
                    </option>`
                  ))}
                  </select>
                  <button type="button" style="margin: auto; padding: 8px;" class="btn danger" value="${product.id}">
                    <span class="icon center">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512"><polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill:none"/><polygon points="337.46 240 312 214.54 256 270.54 200 214.54 174.54 240 230.54 296 174.54 352 200 377.46 256 321.46 312 377.46 337.46 352 281.46 296 337.46 240" style="fill:none"/><path d="M64,160,93.74,442.51A24,24,0,0,0,117.61,464H394.39a24,24,0,0,0,23.87-21.49L448,160ZM312,377.46l-56-56-56,56L174.54,352l56-56-56-56L200,214.54l56,56,56-56L337.46,240l-56,56,56,56Z"/><rect x="32" y="48" width="448" height="80" rx="12" ry="12"/></svg>
                    </span>
                  </button>
                </td>
                <td style="text-align: right;">
                  ${product.qty * product.price}
                </td>
              </tr>
            `)
          });
          const value = $('#total').attr('value', total);
        },
      });
    }

    getCarts();

    // Sukses
    $(document).on('change', '#accept', function() {
      const received = $(this).val();
      const total = $('#total').val();
      const subTotal = received - total;
      const change = $('#return').val(subTotal);
    })

    $(document).on('change', '#qty', function() {
      const qty = $(this).val();
      const cartId = $(this).closest('td').find('#cartId').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'put',
        url: `/carts/${cartId}`,
        data: {
          qty
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 400) {
            alert(response.message);
          }
          getCarts()
        }
      })
    })

    // Sukses
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
          $('.products').html("");
          $.each(response, function(key, product) {
            $('.products').append(`
            <li class="list">
              <button type="button" class="btn card" id="item" style="cursor: pointer; border: none;" value="${product.id}">
                <div class="img">
                  <img src="{{ $product->getFirstMediaUrl('avatar', 'thumb') }}" class="photo" />  
                </div>
                <div class="label center" style="flex-direction: column;">
                  <h2 class="title">${product.name}</h2>
                  <h2 class="subtitle">${product.price}</h2>
                </div>
              </button>
            </li>
            `)
          });
        }
      })
    })

    $(document).on('click', '.danger', function() {
      const cartId = $(this).val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'delete',
        url: `/carts/${cartId}`,
        success: function(response) {
          if (response.status === 400) {
            alert(response.message);
          }
          getCarts()
        }
      })
    })

    $('#find').click(function(e) {
      e.preventDefault();
      const productCode = $(this).closest('form').find('#productCode').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'post',
        url: `/carts`,
        data: {
          productCode
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 400 || response.status === 500) {
            alert(response.message);
          }
          getCarts()
        }
      })
    });

    $(document).on('click', '#item', function() {
      const productId = $(this).val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'post',
        url: '/carts',
        data: {
          productId
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 400) {
            alert(response.message);
          }
          getCarts()
        }
      })

    });

  });
</script>
@endpush