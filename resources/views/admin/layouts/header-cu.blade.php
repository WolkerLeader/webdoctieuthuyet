<nav class="navbar navbar-default" style="z-index: 999">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">Bảng điều khiển</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ">
                <li><a href="{{ route('home') }}" target="_blank"><i class="fas fa-home"></i><span
                            class="hidden-md hidden-lg"> Cổng Light Novel</span></a></li>
                @if (Auth::check())
                    <li>
                        @can('view-story', Auth::user())
                            <a href="{{ route('books.approval') }}" style="color: #fe998a">Duyệt Truyện</a>
                        @endcan
                    </li>
                    <li>
                        @can('view-author', Auth::user())
                            <a href="{{ route('author.index') }}" style="color: #3107dc">Duyệt Author</a>
                        @endcan
                    </li>
                    <li>
                        @can('view-categories', Auth::user())
                            <a href="{{ route('ListPurchaseUser') }}" style="color: #19fe00">Quản lý Mua</a>
                        @endcan
                    </li>
                    <li>
                        @can('view-story', Auth::user())
                            <a href="{{ route('admin_storylist') }}" style="color: red">Danh Sách Truyện</a>
                        @endcan
                    </li>
                    <li>
                        @can('view-users', Auth::user())
                            <a href="{{ route('user_index') }}" style="color: #3107dc">User</a>
                        @endcan
                    </li>
                    <li>
                        @can('view-categories', Auth::user())
                            <a href="{{ route('genres_index') }}" style="color: #e3953e">Thể Loại</a>
                        @endcan
                    </li>
                    <li>
                        {{-- @can('view-contract', Auth::user()) --}}
                        <a href="{{ route('contracts-manage.index') }}" style="color: #12a724">Hợp Đồng</a>
                        {{-- @endcan --}}
                    </li>
                    <li>
                        <a href="{{ route('reports.index') }}" style="color: #e74369">Báo cáo</a>
                    </li>
                    {{-- <li><a href="{{ route('comment_index') }}" style="color: #d54cac">Bình luận</a></li> --}}
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" style="color: #d54cac" data-toggle="dropdown"
                            role="button" aria-expanded="false">Bình luận <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('bookComment.index') }}">Bình luận truyện</a></li>
                            <li><a href="{{ route('chaptercomments') }}">Bình luận chap</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('banners.index') }}" style="color: #e3953e">Banner</a>
                    </li>
                @else
                    <li>
                        <a href="" onclick="alert('Bạn cần đăng nhập để xem')">Duyệt Truyện</a>
                    </li>
                    <li>
                        <a href="" onclick="alert('Bạn cần đăng nhập để xem')" style="color: #3107dc">Duyệt
                            Author</a>
                    </li>
                    <li>
                        <a href="" onclick="alert('Bạn cần đăng nhập để xem')" style="color: #19fe00">Quản lý
                            Mua</a>
                    </li>
                    <li>
                        <a href="" onclick="alert('Bạn cần đăng nhập để xem')" style="color: red">Danh Sách
                            Truyện</a>
                    </li>
                    <li>
                        <a href="" class="dropdown-toggle" style="color: #d54cac" data-toggle="dropdown"
                            role="button" aria-expanded="false">Bình luận <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="" onclick="alert('Bạn cần đăng nhập để xem')">Bình luận truyện</a></li>
                            <li><a href="" onclick="alert('Bạn cần đăng nhập để xem')">Bình luận chap</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="" onclick="alert('Bạn cần đăng nhập để xem')" style="color: #e3953e">Thể
                            Loại</a>
                        {{-- <a href="" onclick="return('Bạn cần đăng nhập để xem')"></a> --}}
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false">Tiện ích <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/theLoai">Thể loại</a></li>
                        <li><a href="/thuVien">Thư viện</a></li>

                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><span class="glyphicon glyphicon-user"> </span><span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ Auth::check() ? '#' : route('login') }}">
                                @if (Auth::check() && Auth::user()->username)
                                    {{ Auth::user()->username }}
                                @else
                                    Bạn cần đăng nhập để xem thông tin này.
                                @endif
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="https://docln.net/action/profile">Đổi Thông Tin</a></li>
                        <li><a href="https://docln.net/action/password">Đổi Mật Khẩu</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="https://docln.net/action/email">Đổi Email</a></li>
                        <li><a href="https://docln.net/action/username">Đổi Username</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                class="link-underline link-underline-opacity-0"><i
                                    class="fas me-2 fa-sign-out-alt"></i><span>Thoát</span></a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            {{-- <a href="https://docln.net/logout">Thoát</a> --}}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
