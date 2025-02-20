<script>
    function turnoffall() {
        $(".rdtoggle").removeClass("on");
        $(".rdtoggle_body").removeClass("animation fade-in-left-big fade-in-down");
        $("html").removeClass("overflow-hiden");
    }

    function rdtoggle(classicon, effect) {
        if ($(classicon).hasClass("on")) {
            turnoffall();
        } else {
            turnoffall();
            $(classicon).addClass("on");
            $("html").addClass("overflow-hiden");
            $(classicon + " .rdtoggle_body").addClass("animation " + effect);
        }
    };

    $("#rd-setting_icon").on('click', function() {
        rdtoggle("#setting", "fade-in-down");
    });

    $("#rd-info_icon").on('click', function() {
        rdtoggle("#chapters", "fade-in-left-big");
    });

    $("#rd-bookmark_icon").on('click', function() {
        rdtoggle("#bookmarks", "fade-in-left-big");
    });

    $(".black-click").on('click', function() {
        turnoffall();
        $("#rd-side_icon").hide();
        $("#bookmark_top").removeClass("on");
    });

    var bgcolor = Cookies.get('color') || (Cookies.get('night_mode') ? 6 : 4);
    var fontfamily = Cookies.get('fontfamily') || '';
    var fontsize = Cookies.get('font') || 18;
    var margin = Cookies.get('margin') || 0;
    var textAlign = Cookies.get('textAlign') || 'text-justify';

    function setcolor(alter = true) {
        // Lấy màu nền hiện tại được chọn (màu tại vị trí `bgcolor`)
        var switcher = $(".set-color .set-input span").eq(bgcolor);
        switcher.addClass("current");

        if (alter) {
            // Xóa các lớp màu nền cũ
            for (var i = 0; i < $(".set-color .set-input span").length; i++) {
                $("#mainpart").removeClass('style-' + i);
                $("#mainpart").removeClass('dark');
            }

            // Thêm lớp màu nền mới cho #mainpart
            $("#mainpart").addClass('style-' + bgcolor);

            // Lấy màu từ data-color
            var selectedColor = $(".set-color .set-input span").eq(bgcolor).data("color"); // Lấy màu từ data-color
            if (selectedColor) {
                // Thay đổi màu nền cho #mainpart
                $("#mainpart").css("background-color", selectedColor);

                // Tính độ sáng của màu nền (sử dụng hàm luminance)
                const rgb = hexToRgb(selectedColor);
                const brightness = luminance(rgb.r, rgb.g, rgb.b);

                // Dựa vào độ sáng để thay đổi màu chữ sao cho có độ tương phản tốt
                if (brightness > 0.5) {
                    // Nền sáng -> chữ tối
                    $("h1, h2, h3, h4,h5, p, span, li, div, label, .content-text").css("color", "#000000");
                } else {
                    // Nền tối -> chữ sáng
                    $("h1, h2, h3, h4,h5, p, span, li, div, label, .content-text").css("color", "#ffffff");
                }
            }
        }
    }

    // Hàm chuyển màu hex thành RGB
    function hexToRgb(hex) {
        var r = 0,
            g = 0,
            b = 0;
        // 3 chữ số
        if (hex.length === 4) {
            r = parseInt(hex[1] + hex[1], 16);
            g = parseInt(hex[2] + hex[2], 16);
            b = parseInt(hex[3] + hex[3], 16);
        }
        // 6 chữ số
        else if (hex.length === 7) {
            r = parseInt(hex[1] + hex[2], 16);
            g = parseInt(hex[3] + hex[4], 16);
            b = parseInt(hex[5] + hex[6], 16);
        }
        return {
            r: r,
            g: g,
            b: b
        };
    }

    // Hàm tính luminance (độ sáng)
    function luminance(r, g, b) {
        const a = [r, g, b].map(function(v) {
            v /= 255;
            return (v <= 0.03928) ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
        });
        return a[0] * 0.2126 + a[1] * 0.7152 + a[2] * 0.0722;
    }



    // This creates unsmooth experience so we only use it for select box
    function setfontfamily() {
        $('.set-font-family select option').filter(function() {
            return fontfamily.split(',')[0].indexOf($(this).text()) != -1;
        }).attr('selected', true);
    }

    function setfontstyle(alter = true) {
        $(".set-font input.set-slide_input").val(fontsize + "px");

        if (alter) {
            $("div#chapter-content").css("font-size", fontsize + "px");

            var lineheight = +fontsize + 10;
            $("#chapter-content").css("line-height", lineheight + "px");
        }
    }

    function setmargin() {
        $(".set-margin input.set-slide_input").val(margin + "px");
        $("#chapter-content").css({
            'padding-left': margin + "px",
            'padding-right': margin + "px"
        });
    }

    function setTextAlign(alter = true) {
        var switcher = $(".set-text-align .set-input span[data-align='" + textAlign + "']");
        switcher.addClass("current");

        if (alter) {
            $(".set-text-align .set-input span").each(function() {
                $("#chapter-content").removeClass($(this).attr('data-align'));
            });

            $("#chapter-content").addClass(textAlign);
        }
    }

    setcolor(false);
    setfontfamily();
    setfontstyle(false);
    setmargin();
    setTextAlign(true);

    //1px = 0.0625rem;
    //16px = 1rem (default);

    $(".set-color .set-input span").click(function() {
        bgcolor = $(this).data("id");
        $(".set-color .set-input span").removeClass("current");
        setcolor();
        Cookies.set('color', bgcolor, {
            expires: 365
        });
    });

    $('.set-font-family select').on('change', function() {
        fontfamily = "'" + $('option:selected', this).text() + "', " + '\'Times New Roman\', Georgia, serif';

        $('div#chapter-content').css('font-family', fontfamily);

        Cookies.set('fontfamily', fontfamily, {
            expires: 365
        });
    });

    $(".set-font .set-slide_button.set-smaller").click(function() {
        fontsize = fontsize - 2;
        if (fontsize < 0) fontsize = 0;
        setfontstyle();
        Cookies.set('font', fontsize, {
            expires: 365
        });
    });

    $(".set-font .set-slide_button.set-bigger").click(function() {
        fontsize = +fontsize + 2;
        setfontstyle();
        Cookies.set('font', fontsize, {
            expires: 365
        });
    });

    $(".set-margin .set-slide_button.set-smaller").click(function() {
        margin = margin - 20;
        if (margin < 0) margin = 0;
        setmargin();
        Cookies.set('margin', margin, {
            expires: 365
        });
    });

    $(".set-margin .set-slide_button.set-bigger").click(function() {
        margin = +margin + 20;
        setmargin();
        Cookies.set('margin', margin, {
            expires: 365
        });
    });

    $(".set-text-align .set-input span").click(function() {
        textAlign = $(this).data("align");
        $(".set-text-align .set-input span").removeClass("current");
        setTextAlign();
        Cookies.set('textAlign', textAlign, {
            expires: 365
        });
    });



    $('div#chapter-content').html(
        $('div#chapter-content').html().replace(
            /\[note(\d+)\]/gi,
            '<span id="anchor-note$1" class="note-icon none-print inline note-tooltip" data-tooltip-content="#note$1 .note-content" data-note-id="note$1"><i class="fas fa-sticky-note"></i></span><a id="anchor-note$1" class="inline-print none" href="#note$1">[note]</a>'
        )
    )

    tippy('.note-tooltip', {
        delay: 50,
        maxWidth: 240,
        interactive: true,
        content(ref) {
            const selector = ref.getAttribute('data-tooltip-content');
            const template = document.querySelector(selector);
            return template ? template.innerHTML : 'Đặt sai ID của note';
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toast = document.getElementById('toast-message');
        if (toast) {
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000);
        }
    });

    function confirmPurchase(title, price, chapterId, url) {
        var modal = $('#purchaseModal');
        modal.find('#modalTitle').text('Xác nhận mua chương: ' + title);
        modal.find('#chapterPrice').text(price + ' coin');
        modal.find('#confirmPurchaseButton').data('chapter-id', chapterId);
        modal.find('#confirmPurchaseButton').data('url', url);
        modal.show(); // Show the modal
    }

    // Function to close modal
    function closeModal() {
        $('#purchaseModal').hide();
    }

    window.onclick = function(event) {
        var modal = document.getElementById("purchaseModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function addToCart(chapterId, chapterTitle, chapterPrice) {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!document.querySelector('meta[name="user-id"]')) {
            window.location.href = '/login';
            return;
        }

        // Gửi yêu cầu AJAX để thêm chương vào giỏ hàng
        fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    chapter_id: chapterId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showNotification(
                        `Chương "${chapterTitle}" với giá ${chapterPrice} coin đã được thêm vào giỏ hàng.`,
                        'success'
                    );
                } else {
                    showNotification(data.message, 'danger');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notificationMessage');

        notification.className = 'alert alert-' + type;
        notificationMessage.innerText = message;
        notification.style.display = 'block';

        setTimeout(closeNotification, 5000);
    }

    function closeNotification() {
        const notification = document.getElementById('notification');
        notification.style.display = 'none';
    }

    $(document).ready(function() {
        // Xử lý click vào nút Mua chương
        $('.purchase-chapter').on('click', function() {
            var title = $(this).data('title');
            var price = $(this).data('price');
            var url = $(this).data('url');
            
            // Xác nhận mua chương
            confirmPurchase(title, price, url);
        });
        // Confirm purchase (when user clicks the confirm button in the modal)
        $('#confirmPurchaseButton').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior

            var chapterId = $(this).data('chapter-id');
            var url = `{{ route('purchase.chapter',$chapter->id) }}`;

            // Perform AJAX request to purchase the chapter
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr(
                        'content'), // Add CSRF token for security
                    chapter_id: chapterId,
                },
                success: function(response) {
                    alert(response.message); // Show success message
                    closeModal(); // Close the modal after success
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
                        "Đã có lỗi xảy ra.";
                    alert(errorMessage); // Show error message
                }
            });
        });
    });
    // Xử lý click vào nút "Thêm vào giỏ hàng"
    $('.btn-add-to-cart').on('click', function() {
        var chapterId = $(this).data('chapter-id');
        var chapterTitle = $(this).data('chapter-title');
        var chapterPrice = $(this).data('chapter-price');

        addToCart(chapterId, chapterTitle, chapterPrice);
    });
</script>


<script src="{{ asset('scripts/app.js') }}"></script>
