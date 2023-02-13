@extends('layouts.cashier')

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/jquery.dataTables.min.css') }}">
@endpush

@push('title')
Cashier | Shopcube
@endpush

@section('overview')
<div class="content full-content between gap">
  <form class="form" style="margin: var(--md) 0;">
    <div class="field">
      <div class="input flex gap">
        <input type="text" placeholder="Barcode" id="productCode" class="input-form">
        <button class="btn primary" id="find" style="display: block">Cari</button>
      </div>
    </div>
    <ul class="products flex" style="margin: var(--md) 0; gap: var(--sm)">
      @forelse($products as $product)
      <li class="list">
        <button class="btn card" id="card" style="cursor: pointer; border: none;" value="{{ $product->id }}">
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
  </form>
  <div class="dashboard">
    <table class="table">
      <div class="field">
        <div class="input">
          <input type="text" class="input-form" id="search">
        </div>
      </div>
      <thead>
        <tr>
          <th>Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <form action="/transaction/store" method="POST" class="form">
      @csrf
      <div class="field">
        <div class="input" style="text-align: right;">
          <label for="total">Total</label>
          <input type="number" value="" class="input-form" name="price" id="total" readonly>
        </div>
      </div>
      <div class="field flex gap">
        <div class="input">
          <label for="accept">Uang Tunai</label>
          <input type="number" class="input-form" name="accept" id="accept">
        </div>
        <div class="input">
          <label for="return">Kembalian</label>
          <input type="number" value="" class="input-form" name="return" id="return" readonly>
        </div>
      </div>
      <div class="field flex gap">
        <div class="input">
          <button class="btn danger">Cancel</button>
        </div>
        <div class="input">
          <button class="btn primary">Pay</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/plugins/jquery.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script>
  $(document).ready(function() {
    function getCarts() {
      $.ajax({
        type: 'get',
        url: '/dashboard/cashier/carts',
        dataType: 'json',
        success: (response) => {
          let total = 0
          $('tbody').html("")
          $.each(response.carts, (key, product) => {
            total += product.price * product.qty
            $('tbody').append(`
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
                  <button class="btn danger" value="${product.id}">Delete</button>
                </td>
                <td style="text-align: right;">
                  ${product.qty * product.price}
                </td>
              </tr>
            `)
          });
          const value = $('#total').attr('value', `${total}`);
        },
      });
    }

    getCarts();

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
        url: `/dashboard/cashier/carts/${cartId}`,
        data: {
          qty
        },
        dataType: 'json',
        success: (response) => {
          if (response.status === 400) {
            alert(response.message);
          }
          getCarts()
        }
      })
    })

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
        success: (response) => {
          $('.products').html("");
          $.each(response, (key, product) => {
            $('.products').append(`
            <li class="list">
              <button class="btn card" style="cursor: pointer; border: none;" value="${product.id}">
                <div class="img">
                  <img src="" class="photo" />  
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
        url: `/dashboard/cashier/carts/${cartId}`,
        success: (response) => {
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
        url: `/dashboard/cashier/carts`,
        data: {
          productCode
        },
        dataType: 'json',
        success: (response) => {
          if (response.status === 400 || response.status === 500) {
            alert(response.message);
          }
          getCarts()
        }
      })
    });

    $(document).on('click', '#card', () => {
      const productId = $(this).val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'post',
        url: '/dashboard/cashier/carts',
        data: {
          productId
        },
        dataType: 'json',
        success: (response) => {
          if (response.status === 400) {
            alert(response.message);
          }
          getCarts()
        }
      })

    })

  });
</script>
@endpush