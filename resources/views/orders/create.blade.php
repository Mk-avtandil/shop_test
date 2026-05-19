@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
    <div class="container w-50 m-auto">
        <h1>Create New Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="user_id">Users</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Products</label>

                <select id="product_select" class="form-control">
                    <option value="">Select product</option>

                    @foreach($products as $product)
                        <option
                            value="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                        >
                            {{ $product->name }} ({{ $product->price }}$)
                        </option>
                    @endforeach
                </select>

                <button type="button" id="add_product" class="btn btn-primary mt-2">
                    Add product
                </button>
            </div>

            {{-- CART TABLE --}}
            <h4>Selected Products</h4>

            <table class="table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                </thead>

                <tbody id="cart"></tbody>
            </table>

            <div id="hidden_inputs"></div>

            <div class="form-group mb-3">
                <label>Total price</label>
                <input type="text" id="total_price" class="form-control" disabled>
            </div>

            <div class="form-group mb-3">
                <select name="status" class="form-control" required>
                    <option value="">Status</option>
                    <option value="ending">ending</option>
                    <option value="processing">processing</option>
                    <option value="shipped">shipped</option>
                    <option value="delivered">delivered</option>
                    <option value="cancelled">cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save Order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        let cart = {};

        document.getElementById('add_product').addEventListener('click', function () {
            let select = document.getElementById('product_select');
            let option = select.options[select.selectedIndex];

            let id = option.value;
            if (!id) return;

            let name = option.dataset.name;
            let price = parseFloat(option.dataset.price);

            if (!cart[id]) {
                cart[id] = { name, price, qty: 1 };
            } else {
                cart[id].qty++;
            }

            renderCart();
        });

        function renderCart() {
            let tbody = document.getElementById('cart');
            tbody.innerHTML = '';

            let total = 0;
            let hidden = document.getElementById('hidden_inputs');
            hidden.innerHTML = '';

            Object.keys(cart).forEach(id => {
                let item = cart[id];
                let itemTotal = item.price * item.qty;
                total += itemTotal;

                tbody.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td>
                    <input type="number" min="1" value="${item.qty}"
                        onchange="updateQty(${id}, this.value)">
                </td>
                <td>${itemTotal.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="removeItem(${id})">X</button>
                </td>
            </tr>
        `;

                hidden.innerHTML += `
            <input type="hidden" name="products[${id}]" value="${item.qty}">
        `;
            });

            document.getElementById('total_price').value = total.toFixed(2);
        }

        function updateQty(id, qty) {
            cart[id].qty = parseInt(qty);
            renderCart();
        }

        function removeItem(id) {
            delete cart[id];
            renderCart();
        }
    </script>
@endsection
