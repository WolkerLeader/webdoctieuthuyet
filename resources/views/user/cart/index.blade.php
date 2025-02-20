@extends('home.layout.master')

@section('content')
@include('partials.banner')

    <main id="mainpart" class="project-page py-8">
        <div class="container mx-auto mt-5">
            <h1 class="text-2xl font-bold text-center mb-6">Giỏ Hàng</h1>

            @if (session('message'))
                <div
                    class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($unpurchasedItems->isEmpty() && $purchasedItems->isEmpty())
                <div
                    class="alert alert-info bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4">
                    Giỏ hàng của bạn hiện tại trống.
                </div>
            @else
                @if (!$unpurchasedItems->isEmpty())
                    <h2 class="text-2xl font-semibold mt-6">Sản phẩm chưa mua</h2>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden mt-4">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-4 py-2">Chương</th>
                                    <th class="px-4 py-2">Giá</th>
                                    <th class="px-4 py-2">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($unpurchasedItems as $item)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $item->chapter->title }}</td>
                                        <td class="px-4 py-2">{{ $item->chapter->price }} coins</td>
                                        <td class="px-4 py-2">
                                            <button class="btn btn-danger" data-id="{{ $item->id }}">Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if (!$purchasedItems->isEmpty())
                    <h2 class="text-2xl font-semibold mt-6">Sản phẩm đã mua</h2>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden mt-4">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-4 py-2">Chương</th>
                                    <th class="px-4 py-2">Giá</th>
                                    <th class="px-4 py-2">Hành Động</th>

                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($purchasedItems as $item)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $item->chapter->title }}</td>
                                        <td class="px-4 py-2">{{ $item->chapter->price }} coins</td>
                                        <td class="px-4 py-2">
                                            <button class="btn btn-danger" data-id="{{ $item->id }}">Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if (!$unpurchasedItems->isEmpty())
                    <div class="mt-6 text-right">
                        <strong class="text-lg">Số coin hiện tại: {{ Auth::user()->coin_earned }} coins</strong><br>

                        <strong class="text-lg">Tổng cộng: {{ $unpurchasedItems->sum(fn($item) => $item->chapter->price) }}
                            coins</strong><br>
                        <strong class="text-lg">Số dư còn lại:
                            {{ Auth::user()->coin_earned - $unpurchasedItems->sum(fn($item) => $item->chapter->price) }}
                            coins</strong>

                    </div>

                    <button style="background-color: #3b82f6;" class="btn btn-primary">Thanh Toán</button>
                @endif
            @endif
        </div>
    </main>
    <style>
        .mt-6.text-right {
    margin-top: 1.5rem;
    text-align: right;
}

.mt-6.text-right strong {
    font-size: 1.25rem;
    color: #374151; /* Darker gray color for better readability */
    display: block; /* To ensure each item appears on a new line */
    margin-bottom: 0.5rem;
}

.btn-primary {
    background-color: #3b82f6;
    color: #fff;
    font-weight: bold;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #2563eb; /* Slightly darker shade on hover */
}

.btn-primary:active {
    background-color: #1d4ed8; /* Even darker shade for active state */
}

.btn-primary:focus {
    outline: 2px solid #93c5fd; /* Light blue outline when focused */
    outline-offset: 2px;
}

    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle the 'Xóa' button click
            document.querySelectorAll('.btn-danger').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    fetch(`/cart/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                location.reload();
                                updateCartCount(); // Update cart count after adding item

                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Handle the 'Thanh Toán' button click
            document.querySelector('button[style*="background-color: #3b82f6"]').addEventListener('click',
            function() {
                fetch('/order/create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>

@endsection
