@extends('layouts.cashier')

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  thead tr {
    width: 100%;
    display: flex;
    justify-content: space-between;
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
  <table class="table">
    <div class="field">
      <div class="input"></div>
    </div>
    <thead class="between">
      <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
      </tr>
    </thead>
    <tbody id="tbody"></tbody>
  </table>
  <form action="/transaction/store" method="POST" class="form">
    @csrf
    <div class="field flex gap" style="justify-content: flex-end; align-items: flex-end;">
      <div class="input flex" style="flex-direction: column; align-items: flex-end;">
        <label for="total">Total</label>
        <div class="center gap">
          <input type="number" style="padding: 0; text-align: end;" value="" class="title" name="price" id="total" readonly disabled>
          <h2 class="title">IDR </h2>
        </div>
      </div>
    </div>
    <div class="field between gap" style="margin: var(--md) 0;">
      <div class="input">
        <label for="return">Kembalian</label>
        <div class="center gap">
          <h2 class="title">IDR </h2>
          <input type="number" style="padding: 0;" value="" class="title" name="return" id="return" readonly disabled>
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
                <td class="flex">
                  <select class="input-form" id="qty">
                  ${[...Array(product.stock).keys()].map((x) => (
                    `<option ${product.qty == x + 1 ? 'selected' : null} value=${x + 1}>
                        ${x + 1}
                    </option>`
                  ))}
                  </select>
                  <input type="hidden" id="cartId" class="input-form" value="${product.id}">
                  <button type="button" class="btn danger" value="${product.id}">Delete</button>
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