@extends('admin.layouts.default')

@section('title')
    @parent
    Danh sách truyện
@endsection

@push('styles')
@endpush

@section('content')
    {{-- <div class="p-4" style="min-height: 800px;">
        @if (session('message'))
            <div class="alert alert-primary" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <h2 class="text-primary mb-4">Danh Sách Truyện</h2>
        <a href="{{ route('admin_stories_trashed') }}" class="btn btn-secondary">
            <i class="fa fa-trash"></i> Thùng rác
        </a>
        <!-- Thêm nút Duyệt Truyện -->
        <div class="mb-5">
            <a class="btn btn-info" href="{{ route('admin_stories_approval') }}">
                <i class="fas fa-check-circle"></i> Duyệt Truyện
            </a>
        </div>
        <table id="" class="table">
            <thead>
                <tr>
                    <th style="width: 15%;">Tên truyện</th>
                    <th style="width: 10%;">Ảnh truyện</th>
                    <th style="width: 10%;">Người đăng</th>
                    <th style="width: 10%;">Nhóm đăng</th>
                    <th style="width: 7%;">Số Tập</th>
                    <th style="width: 7%;">Lượt xem</th>
                    <th style="width: 10%;">Lượt thích</th>
                    <th style="width: 8%;">Đánh giá</th>
                    <th style="width: 15%;">Trạng thái</th>
                    <th style="width: 10%;">
                        <a class="btn btn-success" href="{{ route('admin_storycreate') }}">Thêm Truyện</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stories as $story)
                    <tr>
                        <td>{{ $story->title }}</td>
                        <td>
                            <img width="50px" src="{{ asset(Storage::url($story->book_path)) }}" alt="Không có ảnh bìa">
                        </td>
                        <td>{{ $story->user->username }}</td>
                        <td>{{ $story->group->name }}</td>
                        <td>{{ $story->episodeCount() }}</td>
                        <td>{{ $story->view }}</td>
                        <td>{{ $story->like }}</td>
                        <td>{{ $story->average_stars }}/5 <i class="fas fa-star"></i></td>
                        <td>
                            @if ($story->status == 1)
                                Đang tiến hành
                            @elseif($story->status == 2)
                                Tạm ngưng
                            @elseif($story->status == 3)
                                Đã hoàn thành
                            @endif
                        </td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('admin_storyshow', $story->id) }}">Chi tiết</a>
                            <a class="btn btn-warning" href="{{ route('admin_storyedit', $story->id) }}">Sửa</a>
                            <a class="btn btn-info" href="{{ route('showPublicationHistory', $story->id) }}">Lịch sử</a>
                            <form action="{{ route('admin_storydestroy', $story->id) }}" method="POST"
                                onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Danh Sách Truyện</h5>
                    <div>
                        <a href="{{ route('admin_stories_trashed') }}" class="btn btn-secondary">
                            <i class="ri-delete-bin-fill"></i> Thùng rác
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Tên truyện</th>
                                <th>Ảnh truyện</th>
                                <th>Người đăng</th>
                                <th>Nhóm đăng</th>
                                <th>Số tập</th>
                                <th>Lượt xem</th>
                                <th>Lượt thích</th>
                                <th>Đánh giá</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stories as $story)
                                <tr>
                                    <td>{{ $story->title }}</td>
                                    <td>
                                        <img width="50px" src="{{ asset(Storage::url($story->book_path)) }}"
                                            alt="Không có ảnh bìa">
                                    </td>
                                    <td>{{ $story->user->username }}</td>
                                    <td>{{ $story->group->name }}</td>
                                    <td>{{ $story->episodeCount() }}</td>
                                    <td>{{ $story->view }}</td>
                                    <td>{{ $story->like }}</td>
                                    <td>{{ $story->average_stars }}/5 <i class="ri-star-fill"></i></td>
                                    <td>
                                        @if ($story->status == 1)
                                            <span class="badge bg-info-subtle text-info">Đang tiến hành</span>
                                        @elseif($story->status == 2)
                                            <span class="badge bg-danger-subtle text-danger">Tạm ngưng</span>
                                        @elseif($story->status == 3)
                                            <span class="badge bg-success-subtle text-success">Đã hoàn thành</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{ route('admin_storyshow', $story->id) }}"
                                                        class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>Chi
                                                        tiết</a>
                                                </li>
                                                <li><a href="{{ route('admin_storyedit', $story->id) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Sửa</a>
                                                </li>
                                                <li><a href="{{ route('showPublicationHistory', $story->id) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-chat-history-fill align-bottom me-2 text-muted"></i>
                                                        Lịch sử</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item remove-item-btn"
                                                        onclick="return confirmDeleteAndSubmit('{{ route('admin_storydestroy', $story->id) }}');">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Xóa
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@push('scripts')
    <script>
        function confirmDeleteAndSubmit(url) {
            if (confirm('Bạn có chắc chắn muốn xóa không?')) {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';

                // Add CSRF token
                form.innerHTML = `
                @csrf
                @method('DELETE')
            `;

                document.body.appendChild(form);
                form.submit();
            }
            return false; // Ngăn href mặc định.
        }
    </script>
@endpush
