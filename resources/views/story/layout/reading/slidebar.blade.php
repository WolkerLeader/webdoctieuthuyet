<body>

    <style>
        body {
            background: inherit;
        }

        #footer {
            display: none;
        }
    </style>

    <script>
        document.addEventListener("click", function(event) {
            const sideIcon = document.getElementById("rd-side_icon");
            if (sideIcon && !sideIcon.contains(event.target)) {
                if (sideIcon.style.display === "block") {
                    sideIcon.style.display = "none"; // Ẩn đi
                } else {
                    sideIcon.style.display = "block"; // Hiển thị
                }
            }
        });
    </script>
    <main id="mainpart" class="reading-page style-4">
        <section id="rd-side_icon" class="none force-block-l">

            <!-- Previous Chapter Link -->
            <a href="{{ $chapter->previousChapter() ? route('truyen.chuong', ['slug' => $book->slug, 'chapter_slug' => $chapter->previousChapter()->slug]) : '#' }}"
                class="rd_sd-button_item rd_top-left {{ $chapter->previousChapter() ? '' : 'disabled' }}">
                <i class="fas fa-backward"></i>
            </a>

            <!-- Home Link -->
            <a class="rd_sd-button_item" href="{{ route('truyen.truyen', $book->slug) }}">
                <i class="fas fa-home"></i>
            </a>

            <!-- Settings Icon -->
            <a id="rd-setting_icon" data-affect="#" class="rd_sd-button_item">
                <i class="fas fa-font"></i>
            </a>

            <!-- Nút Phát Nhạc Nền -->
            <a id="rd-speak_icon" data-affect="#music-settings" class="rd_sd-button_item toggle-popup">
                <i class="fas fa-music"></i>
            </a>

            <!-- Nút đọc audio truyện -->
            <a id="rd-speech_icon" data-affect="#speech-settings" class="rd_sd-button_item toggle-popup">
                <i id='show-popup-speech' class="fas fa-volume-up"></i>
            </a>

            <!-- Info Icon -->
            <a id="rd-info_icon" data-affect="#rd_sidebar.chapters" class="rd_sd-button_item">
                <i class="fas fa-info"></i>
            </a>

            <!-- Bookmark Icon -->
            <a id="rd-bookmark_icon" data-affect="#rd_sidebar.bookmarks" class="rd_sd-button_item">
                <i class="fas fa-bookmark"></i>
            </a>

            <!-- Next Chapter Link -->
            <a href="{{ $chapter->nextChapter() ? route('truyen.chuong', ['slug' => $book->slug, 'chapter_slug' => $chapter->nextChapter()->slug]) : '#' }}"
                class="rd_sd-button_item rd_top-right {{ $chapter->nextChapter() ? '' : 'disabled' }}">
                <i class="fas fa-forward"></i>
            </a>

        </section>



        <section id="chapters" class="rd_sidebar rdtoggle">
            <main class="rdtoggle_body">
                <header class="rd_sidebar-header clear">
                    <a class="img"
                        href="{{ route('truyen.chuong', ['slug' => $book->slug, 'chapter_slug' => $chapter->slug]) }}"
                        style="background: url('{{ asset(Storage::url($book->book_path)) }}') no-repeat"></a>
                    <div class="rd_sidebar-name">
                        <h5><a href="{{ route('truyen.truyen', $book->slug) }}">{{ $book->title }}</a></h5>
                        <small><i class="fas fa-pen"></i>{{ $book->author }}</small>
                        <small><i class="fas fa-paint-brush"></i>{{ $book->painter }}</small>
                    </div>
                </header>

                <ul id="chap_list" class="unstyled">
                    @foreach ($book->episodes->sortBy('order') as $item)
                        <li class="@if ($episode->id == $item->id) current @endif">
                            <a href="{{ route('truyen.tap', [$book->slug, $item->slug]) }}">{{ $item->title }}</a>
                        </li>
                        <!-- Hiển thị các chapter nếu đây là tập truyện hiện tại -->
                        @if ($episode->id == $item->id)
                            <ul class="sub-chap_list unstyled">
                                @foreach ($chapters->sortBy('order') as $chap)
                                    <li class="@if ($chapter->id === $chap->id) current @endif">
                                        <a href="{{ route('truyen.chuong', [$book->slug, $chap->slug]) }}">
                                            {{ $chap->title }} chapter:{{ $chapter->id }} và {{ $chap->id }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            </main>
            <div class="black-click"></div>
        </section>

        <section id="bookmarks" class="rd_sidebar rdtoggle">
            <main class="rdtoggle_body">
                <div class="rd_sidebar-header">
                    <h2 class="rd_s-name">
                        <i class="fas fa-bookmark"></i>
                        <a href="/bookmark" style="color: white;">Bookmarks</a>
                    </h2>
                </div>
                <ul id="bookmarks_list" class="unstyled">
                    <!-- Nội dung bookmark sẽ được thêm ở đây bởi JavaScript -->
                    <li id="empty_message">Bạn chưa lưu lại bookmark</li>
                </ul>
            </main>
            <div class="black-click"></div>
        </section>

        <section id="setting" class="rdtoggle">
            <section class="re_set-in basic-section clear rdtoggle_body">
                <header class="sect-header"><span class="sect-title">Tùy chỉnh</span></header>
                <main class="sect-body">
                    <div class="set-list set-color clear">
                        <label class="font-bold">Màu nền</label>
                        <div class="set-input clear justify-center">
                            <span data-color="#ffffff" data-id="0" style="background-color: #ffffff"></span>
                            <span data-color="#e6f0e6" data-id="1" style="background-color: #e6f0e6"></span>
                            <span data-color="#e3f5fa" data-id="2" style="background-color: #e3f5fa"></span>
                            <span data-color="#f6f4ec" data-id="3" style="background-color: #f6f4ec"></span>
                            <span data-color="#eae4d3" data-id="4" style="background-color: #eae4d3"></span>
                            <span data-color="#f5e9ef" data-id="5" style="background-color: #f5e9ef"></span>
                            <span data-color="#222222" data-id="6" style="background-color: #222222"></span>
                            <span data-color="#000000" data-id="7" style="background-color: #000000"></span>
                        </div>
                    </div>
                    <div class="set-list set-font-family clear">
                        <label class="font-bold">Font chữ</label>
                        <div class="set-slide set-input justify-center">
                            <select>
                                <option>Times New Roman</option>
                                <option>Merriweather</option>
                                <option>Lora</option>
                                <option>Roboto</option>
                                <option>Noto Sans</option>
                                <option>Nunito</option>
                            </select>
                        </div>
                    </div>
                    <div class="set-list set-font clear">
                        <label class="font-bold">Kích cỡ chữ</label>
                        <div class="set-slide set-input justify-center">
                            <span class="set-slide_button set-smaller"><i class="fas fa-chevron-left"></i></span>
                            <input class="set-slide_input" disabled="" value="16px" type="text">
                            <span class="set-bigger set-slide_button"><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                    <div class="set-list set-margin clear">
                        <label class="font-bold">Bản lề</label>
                        <div class="set-slide set-input justify-center">
                            <span class="set-slide_button set-smaller"><i class="fas fa-chevron-left"></i></span>
                            <input class="set-slide_input" disabled="" value="20px" type="text">
                            <span class="set-bigger set-slide_button"><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                    {{-- <div class="set-list set-text-align clear">
                        <label class="font-bold">Kiểu căn chỉnh</label>
                        <div class="set-input clear justify-center font-medium text-2xl flex flex-row gap-10">
                            <span data-align="text-left" class="p-1"><i class="fas fa-align-left"></i></span>
                            <span data-align="text-center" class="p-1"><i class="fas fa-align-center"></i></span>
                            <span data-align="text-right" class="p-1"><i class="fas fa-align-right"></i></span>
                            <span data-align="text-justify" class="p-1"><i class="fas fa-align-justify"></i></span>
                        </div>
                    </div> --}}
                </main>
            </section>
            <div class="black-click"></div>
        </section>
        <!-- Cửa sổ Phát Nhạc -->

        <section id="music-settings" class="re_set-in basic-section clear popup-window rdtoggle">
            <main class="sect-body">
                <div class="set-list set-music-default clear">
                    <label class="font-bold">Phát nhạc mặc định</label>
                    <div class="set-input clear justify-center">
                        <button id="play-default-music" class="btn btn-primary">Phát nhạc</button>
                    </div>
                </div>
                <div class="set-list set-music-upload clear">
                    <label class="font-bold">Tải nhạc lên</label>
                    <div class="set-input clear justify-center">
                        <input type="file" id="upload-music" accept="audio/*" class="form-control">
                    </div>
                </div>
                <div class="set-list set-music-player clear">
                    <label class="font-bold">Bộ điều khiển</label>
                    <div class="set-input clear justify-center">
                        <audio id="background-music" controls class="w-full">
                            <source id="music-source" src="" type="audio/mp3">
                            Trình duyệt của bạn không hỗ trợ phát âm thanh.
                        </audio>
                    </div>
                </div>
            </main>
            <div class="black-click"></div>

        </section>
        <!-- Popup tuỳ chỉnh -->
        <div id="speech-settings" class="popup hidden">
            <h3>Tùy chỉnh giọng đọc</h3>
            <label for="voice-select">Chọn giọng:</label>
            <select id="voice-select"></select>

            <label for="rate-range">Tốc độ đọc:</label>
            <input id="rate-range" type="range" min="0.5" max="2" step="0.1" value="1">
            <span id="rate-value">1</span>


            <label for="filter-input">Ký tự cần lọc:</label>
            <input id="filter-input" type="text" placeholder="Nhập ký tự cần lọc">
            <button class="btn btn-primary" id="read-chapter">Đọc</button>
            <button id="cancel-speech">Dừng đọc</button>
            <button id="close-popup">Đóng</button>
        </div>
        <style>

        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toggleButton = document.querySelector('#rd-speak_icon');
                const popupWindow = document.querySelector('#music-settings');
                const blackClick = document.querySelector('.black-click');
                const closeButton = document.querySelector('.popup-close');

                function togglePopup() {
                    popupWindow.classList.toggle('active');
                    blackClick.classList.toggle('active');
                }

                toggleButton.addEventListener('click', togglePopup);
                closeButton.addEventListener('click', togglePopup);
                blackClick.addEventListener('click', togglePopup);
            });
        </script>
