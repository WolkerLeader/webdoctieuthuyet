@extends('admin.layouts.default')

@section('title')
    @parent
    Quản lý Banner
@endsection

@push('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle !important;
            text-align: center;
        }

        .table th {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .table td {
            font-size: 1.2rem;
        }

        .table img {
            max-width: 100%;
            height: auto;
        }

        .btn {
            margin: 2px;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <h2 class="text-primary mb-4">Quản Lý Banner</h2>

    <a href="{{ route('banners.create') }}" class="btn btn-primary mb-3">Create New Banner</a>

    <!-- Display Success Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ảnh Banner</th>
                    <th>Loại thiết bị</th>
                    <th>Trạng thái</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <!-- Display a thumbnail of the image -->
                        <td>
                            <img src="{{ asset(Storage::url($banner->image_path)) }}" alt="Banner Image" class="img-thumbnail" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ ucfirst($banner->device_type) }}</td>
                        <!-- Display Active Status -->
                        <td>
                            <span class="badge {{ $banner->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <!-- Action Buttons -->
                        <td>
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination (if needed) -->
    <div class="d-flex justify-content-center mt-4">
        {{-- {{ $banners->links() }} --}}
    </div>
</div>
@endsection
