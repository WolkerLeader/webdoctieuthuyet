function _toConsumableArray(e) {
    return (
        _arrayWithoutHoles(e) ||
        _iterableToArray(e) ||
        _unsupportedIterableToArray(e) ||
        _nonIterableSpread()
    );
}
function _nonIterableSpread() {
    throw new TypeError(
        "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
    );
}
function _unsupportedIterableToArray(e, t) {
    if (e) {
        if ("string" == typeof e) return _arrayLikeToArray(e, t);
        var n = Object.prototype.toString.call(e).slice(8, -1);
        return (
            "Object" === n && e.constructor && (n = e.constructor.name),
            "Map" === n || "Set" === n
                ? Array.from(e)
                : "Arguments" === n ||
                  /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)
                ? _arrayLikeToArray(e, t)
                : void 0
        );
    }
}
function _iterableToArray(e) {
    if (
        ("undefined" != typeof Symbol && null != e[Symbol.iterator]) ||
        null != e["@@iterator"]
    )
        return Array.from(e);
}
function _arrayWithoutHoles(e) {
    if (Array.isArray(e)) return _arrayLikeToArray(e);
}
function _arrayLikeToArray(e, t) {
    (null == t || t > e.length) && (t = e.length);
    for (var n = 0, o = new Array(t); n < t; n++) o[n] = e[n];
    return o;
}
function _typeof(e) {
    return (
        (_typeof =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                ? function (e) {
                      return typeof e;
                  }
                : function (e) {
                      return e &&
                          "function" == typeof Symbol &&
                          e.constructor === Symbol &&
                          e !== Symbol.prototype
                          ? "symbol"
                          : typeof e;
                  }),
        _typeof(e)
    );
}
function listab(e, t) {
    (t = t || 0),
        $(e + " .tab-title")
            .filter(function (e) {
                return e != t;
            })
            .addClass("tab-off"),
        $(".tab-content").eq(t).removeClass("none"),
        $(".tab-content")
            .filter(function (e) {
                return e != t;
            })
            .hide(),
        $(e + " .tab-title").on("click", function () {
            var t = $(this).data("tab-index");
            $(this).hasClass("tab-off") &&
                ($(e + " .tab-title").addClass("tab-off"),
                $(this).removeClass("tab-off")),
                $(".tab-content").hide(),
                $("#tab-content-" + t).fadeIn("slow");
        });
}
function scrollhide(e) {
    var t,
        n = 0;
    $(e).outerHeight();
    $(window).scroll(function (e) {
        t = !0;
    }),
        setInterval(function () {
            t &&
                (!(function () {
                    var t = $(this).scrollTop();
                    if (Math.abs(n - t) <= 1) return;
                    t >= n
                        ? $(e).hide()
                        : t + $(window).height() < $(document).height() &&
                          $(e).show();
                    n = t;
                })(),
                (t = !1));
        }, 250);
}
function scrollmenuside(e) {
    var t,
        n = 0;
    $(e).outerHeight();
    $(window).scroll(function (e) {
        t = !0;
    }),
        setInterval(function () {
            t &&
                (!(function () {
                    var t = $(this).scrollTop();
                    if (Math.abs(n - t) <= 1) return;
                    t >= n
                        ? ($(e).hide(), $("#mainpart").removeClass("menuside"))
                        : t + $(window).height() < $(document).height() &&
                          ($(e).show(), $("#mainpart").addClass("menuside"));
                    n = t;
                })(),
                (t = !1));
        }, 250);
}
function getParameterByName(e, t) {
    t || (t = window.location.href), (e = e.replace(/[\[\]]/g, "\\$&"));
    var n = new RegExp("[?&]" + e + "(=([^&#]*)|&|#|$)").exec(t);
    return n
        ? n[2]
            ? decodeURIComponent(n[2].replace(/\+/g, " "))
            : ""
        : null;
}
if (
    ($(document).ajaxError(function (e, t, n, o) {
        var i = "",
            a = t.responseJSON;
        if (a) {
            if ("object" === _typeof(a.errors))
                for (var s in a.errors)
                    a.errors.hasOwnProperty(s) &&
                        a.errors[s].forEach(function (e) {
                            i += e + "\n";
                        });
            else i = a.message;
            alert(i);
        } else console.log(t.statusText);
    }),
    $("time.timeago").timeago(),
    (token = $('meta[name="csrf-token"]').attr("content")),
    $("#mainpart").css({
        "min-height": window.innerHeight - $("#footer").outerHeight(!0),
    }),
    $(window).on("resize", function () {
        $("#mainpart").css({
            "min-height": window.innerHeight - $("#footer").outerHeight(!0),
        });
    }),
    !$("main.reading-page").length)
) {
    var headroom = new Headroom(document.querySelector("#navbar"));
    headroom.init();
}
var sliderOptions = {
    controls: !1,
    mouseDrag: !0,
    navPosition: "bottom",
    slideBy: "page",
};
if (
    ($(".daily-recent_views .slider").length &&
        tns(
            Object.assign(
                {
                    container: ".daily-recent_views .slider",
                    items: 4,
                    loop: !1,
                    responsive: {
                        0: {
                            items: 2,
                        },
                        768: {
                            items: 3,
                        },
                        980: {
                            items: 4,
                        },
                        1200: {
                            items: 4,
                        },
                    },
                },
                sliderOptions
            )
        ),
    $(".js-finished-series .slider").length &&
        tns(
            Object.assign(
                {
                    container: ".js-finished-series .slider",
                    items: 8,
                    loop: !1,
                    responsive: {
                        0: {
                            items: 2,
                        },
                        768: {
                            items: 4,
                        },
                        980: {
                            items: 6,
                        },
                        1200: {
                            items: 8,
                        },
                    },
                },
                sliderOptions
            )
        ),
    $(".mobile-toggle header").click(function () {
        $(this).parent().find(".summary.at-series").toggle(),
            $(this).parent().find(".listall_summary.at-volume").toggle(),
            $(this).parent().find("main").toggle();
    }),
    $(window).on("scroll", function () {
        $(window).scrollTop() > 50
            ? $(".backtoTop").show()
            : $(".backtoTop").hide();
    }),
    $(".backtoTop").on("click", function () {
        var e = $(this).data("scrollto");
        $("html, body").animate({
            scrollTop: $(e).offset().top,
        });
    }),
    $(
        "#sidenav-icon, .nav-user_icon, #noti-icon, .nav-has-submenu, #guest-menu"
    ).on("click", function (e) {
        e.stopPropagation();
        var t = $(this),
            n = t.find(".hidden-block");
        t.parents(".hidden-block").first().is(":visible") ||
            ($(".active").not(t).removeClass("active"),
            $(".hidden-block").not(n).addClass("none")),
            t.toggleClass("active"),
            n.toggleClass("none");
    }),
    $(document).on("click", function () {
        $("#navbar .hidden-block").addClass("none"),
            $("#navbar .active").removeClass("active");
    }),
    
    $(".nightmode-toggle").on("click", function (e) {
        e.stopPropagation(),
            $(this)
                .find(".toggle-icon")
                .find("i")
                .toggleClass("fa-toggle-off fa-toggle-on"),
            Cookies.get("night_mode")
                ? (Cookies.remove("night_mode"),
                  $("#night-mode-css").remove(),
                  $("html").removeClass("dark"))
                : (Cookies.set("night_mode", !0, {
                      expires: 365,
                  }),
                  $("html").addClass("dark"),
                  window.location.reload());
    }),
    $(document).ajaxComplete(function () {
        $("time.timeago").timeago();
    }),
    document.addEventListener("alpine:init", function () {
        Alpine.store("toast", {
            on: !1,
            message: null,
            timeout: null,
            resetTime: function () {
                this.timeout &&
                    (clearTimeout(this.timeout), (this.timeout = null));
            },
            show: function (e) {
                var t = this;
                (this.on = !0),
                    (this.message = e),
                    this.resetTime(),
                    (this.timeout = setTimeout(function () {
                        return t.hide();
                    }, 3e3));
            },
            hide: function () {
                (this.on = !1), this.resetTime();
            },
            toggle: function () {
                this.on = !this.on;
            },
        });
    }),
    "undefined" != typeof chapter_id &&
        chapter_id > 0 &&
        ((bookmark_data = {
            _token: token,
            chapter_id: chapter_id,
            line_id: 0,
        }),
        $("#bookmark_top").on("click", function () {
            if (($(this).addClass("on"), !isLoggedIn))
                return alert("Bạn phải đăng nhập để sử dụng bookmark"), !1;
            var e =
                $(".reading-content p#" + bookmark_data.line_id)
                    .text()
                    .trim()
                    .substring(0, 30) + "...";
            bookmark_data.line_id > 0 &&
                $.post(
                    "/action/chapter/bookmark",
                    bookmark_data,
                    function (t) {
                        "success" == t.status
                            ? ($("ul#bookmarks_list").append(
                                  '<li data-line="' +
                                      t.line_id +
                                      '"><span class="pos_bookmark">Đoạn thứ ' +
                                      t.line_id +
                                      '</span><small style="display: block">' +
                                      e +
                                      '</small><span data-item="' +
                                      t.bookmark_id +
                                      '" class="del_bookmark remove_bookmark"><i class="fas fa-times"></i></span></li>'
                              ),
                              alert(
                                  "Bạn đã lưu bookmark thành công đoạn thứ " +
                                      t.line_id
                              ))
                            : alert(t.message);
                    },
                    "json"
                );
        }),
        $(window).on("scroll", function () {}),
        $(function () {
            $(".reading-content p").on("click", function () {
                var e = $(this);
                if ($(window).width() > 979) {
                    var t =
                            e.offset().top -
                            $("body").offset().top +
                            e.scrollTop(),
                        n =
                            e.offset().left -
                            $(".reading-content").offset().left -
                            $(".save_bookmark").outerWidth(!0);
                    $(".save_bookmark").css({
                        height: e.height() + 28 + "px",
                        right: n + "px",
                        top: t + "px",
                        display: "",
                    });
                } else $("#bookmark_top").toggleClass("on"), $("#rd-side_icon").toggle();
                bookmark_data.line_id = e.attr("id");
            });
        }),
        $(".save_bookmark").on("click", function () {
            if (!isLoggedIn)
                return alert("Bạn phải đăng nhập để sử dụng bookmark"), !1;
            $(window).width() > 979 &&
                bookmark_data.line_id > 0 &&
                $.post(
                    "/action/chapter/bookmark",
                    bookmark_data,
                    function (e) {
                        "success" == e.status
                            ? ($("ul#bookmarks_list").append(
                                  '<li data-line="' +
                                      e.line_id +
                                      '"><span class="pos_bookmark">Đoạn thứ ' +
                                      e.line_id +
                                      '</span><span data-item="' +
                                      e.bookmark_id +
                                      '" class="del_bookmark remove_bookmark"><i class="fas fa-times"></i></span></li>'
                              ),
                              alert(
                                  "Bạn đã lưu bookmark thành công đoạn thứ " +
                                      e.line_id
                              ))
                            : alert(e.message);
                    },
                    "json"
                );
        }),
        $("ul#bookmarks_list").on("click", "span.pos_bookmark", function () {
            var e = $("#" + $(this).parent().data("line"));
            $("body,html").animate({
                scrollTop:
                    e.offset().top - $("body").offset().top + e.scrollTop(),
            });
        }),
        $("ul#bookmarks_list").on("click", "span.remove_bookmark", function () {
            (_this = $(this)),
                (bookmark_id = _this.data("item")),
                $.post(
                    "/action/chapter/removebookmark",
                    {
                        _token: token,
                        bookmark_id: bookmark_id,
                    },
                    function (e) {
                        "success" == e.status &&
                            _this.parent().fadeOut("normal", function () {
                                $(this).parent("li").remove();
                            });
                    },
                    "json"
                );
        }),
        $(document).keydown(function (e) {
            if (
                "INPUT" != e.target.nodeName &&
                "TEXTAREA" != e.target.nodeName &&
                1 != e.target.isContentEditable
            ) {
                var t = e.which || e.keyCode,
                    n = $(".fa-backward").parent().attr("href") || "",
                    o = $(".fa-forward").parent().attr("href") || "";
                switch (t) {
                    case 37:
                        "" != n && (window.location.href = n);
                        break;
                    case 39:
                        "" != o && (window.location.href = o);
                        break;
                    case 27:
                        $(".black-click").click();
                }
            }
        }),
        Object.keys(readingObject).length))
) {
    var readingSeries =
        JSON.parse(localStorage.getItem("reading_series")) || [];
    for (i = 0; i < readingSeries.length; i++)
        if (readingSeries[i].series_id == series_id) {
            readingSeries.splice(i, 1);
            break;
        }
    readingSeries.unshift(readingObject),
        readingSeries.length > 100 && readingSeries.pop(),
        localStorage.setItem("reading_series", JSON.stringify(readingSeries));
}
function seeMoreButton(e) {
    (e.find("img[alt]").length || e[0].scrollHeight >= 90) &&
        e.next(".comment_see_more").removeClass("none");
}
function seeMoreButtons() {
    $(".ln-comment-content").each(function () {
        seeMoreButton($(this));
    });
}
function clickSeeMore(e) {
    e.prev().css("max-height", "initial"), e.remove();
}
function br2nl(e) {
    return e.replace(/\r|\n|\r\n/g, "").replace(/<br(\s?\/?)?>/g, "\n");
}
function nl2br(e) {
    return e.replace(/\n/g, "<br>");
}
function strip_tags(e) {
    return e.replace(/<[^>]+>/gi, "");
}
function getEditor(e) {
    return tinymce.activeEditor;
}
if (
    ($(".ln-comment-body").on("click", "span.span-pin", function () {
        $.post(
            "/action/comment/pin_comment",
            {
                _token: token,
                comment_id: $(this).closest(".ln-comment-item").data("comment"),
            },
            function (e) {
                "success" == e.status
                    ? window.location.replace(e.url)
                    : alert(e.message);
            }
        );
    }),
    // $(".ln-comment-body").on("click", "a.do-like", (function () {
    //     var e = $(this);
    //     $.post("/action/comment/like-unlike", {
    //         _token: token,
    //         comment_id: $(this).closest(".ln-comment-item").data("comment")
    //     }, (function (t) {
    //         "success" == t.status ? (console.log(e),
    //             t.liked ? (e.addClass("liked"),
    //                 e.find("span.likecount").text(t.like_count)) : (e.removeClass("liked"),
    //                     e.find("span.likecount").text(t.like_count))) : alert(t.message)
    //     }
    //     ))
    // }
    // )),
    seeMoreButtons(),
    $(".ln-comment-body").on("click", ".comment_see_more", function (e) {
        clickSeeMore($(this));
    }),
    // $("form.comment_form input.button").on("click", (function () {
    //     var e = tinymce.activeEditor.getContent();
    //     $.post("/action/comment/new", {
    //         _token: token,
    //         type: comment_type,
    //         type_id: comment_typeid,
    //         content: e,
    //         parent_id: 0
    //     }, (function (e) {
    //         if ("success" == e.status && "" != e.html) {
    //             var t = $(".ln-comment-body");
    //             $("html,body").animate({
    //                 scrollTop: t.offset().top - $("body").offset().top + t.scrollTop()
    //             }),
    //                 $("#ln-comment-submit").after($('<div class="ln-comment-group">' + e.html + "</div>").fadeIn(700)),
    //                 tinymce.activeEditor.setContent(""),
    //                 seeMoreButton($("#ln-comment-" + e.comment_id).find(".ln-comment-content"))
    //         } else
    //             alert(e.message)
    //     }
    //     ), "json")
    // }
    // )),

    //sửa thông tin trong đây để lấy được tên người dùng
    $(".ln-comment-body").on("click", ".do-reply", function () {
        var e = $(this),
            t = e.closest(".ln-comment-item").data("comment"),
            n = e.closest(".ln-comment-item").data("parent");
        if (
            $("#ln-comment-" + t)
                .next()
                .find("textarea.comment_reply").length
        )
            $(".reply-form").remove();
        else {
            $(".reply-form").remove();
            var o =
                t != n
                    ? "@" +
                      $("#ln-comment-" + t + " a.ln-username")
                          .text()
                          .trim() +
                      ":&nbsp;"
                    : "";
            $("#ln-comment-" + t).after(
                $(
                    '<form action="{{route("cmt-child-forum",$id)}}" method="post"> <div class="ln-comment-reply reply-form"><div class="ln-comment-form"><input type="hidden" name="parent_id" value="{{$id}}"><textarea class="comment_reply"></textarea><div class="comment_toolkit clear"><input type="button" class="button submit_reply" value="Trả lời" data-parent="' +
                        n +
                        '"></div></div></div></form>'
                )
            ),
                tinymce.init(tinymce.activeEditor.settings),
                tinymce.activeEditor.setContent(o);
        }
    }),
    // $(".ln-comment-body").on("click", "input.submit_reply", (function () {
    //     var e = tinymce.activeEditor.getContent()
    //         , t = parseInt($(this).data("parent")) || 0;
    //     $.post("/action/comment/new", {
    //         _token: token,
    //         type: comment_type,
    //         type_id: comment_typeid,
    //         content: e,
    //         parent_id: t
    //     }, (function (e) {
    //         if ("success" == e.status && "" != e.html) {
    //             $("#ln-comment-" + t).parent().append($('<div class="ln-comment-reply">' + e.html + "</div>"));
    //             var n = $("#ln-comment-" + e.comment_id);
    //             $("html,body").animate({
    //                 scrollTop: n.offset().top - $("body").offset().top + n.scrollTop() - 270
    //             }),
    //                 seeMoreButton(n.find(".ln-comment-content"))
    //         } else
    //             alert(e.message);
    //         $(".reply-form").remove()
    //     }
    //     ), "json")
    // }
    // )),
    // $(".ln-comment-body").on("click", ".span-edit", (function () {
    //     var e = $(this).closest(".ln-comment-item").data("comment")
    //         , t = $("#ln-comment-" + e)
    //         , n = t.find(".ln-comment-content");
    //     if (t.find(".ln-comment-content .comment_hidden").length && n.html(t.find(".ln-comment-content .comment_hidden").html()),
    //         t.find(".ln-comment-form").length)
    //         return t.find(".ln-comment-form").remove(),
    //             void n.show();
    //     $(".edit-form").remove(),
    //         n.css("max-height", "initial"),
    //         n.next(".comment_see_more").remove(),
    //         n.after('<div class="ln-comment-form edit-form" style="padding-left: 10px"><textarea class="comment_edit"></textarea><div class="comment_toolkit clear"><input type="button" class="button submit_edit" value="Sửa" data-comment="' + e + '"></div></div>'),
    //         n.hide(),
    //         tinymce.init(tinymce.activeEditor.settings),
    //         tinymce.activeEditor.setContent(n.html())
    // }
    // )),
    // $(".ln-comment-body").on("click", "input.submit_edit", (function () {
    //     var e = parseInt($(this).data("comment")) || 0
    //         , t = tinymce.activeEditor.getContent();
    //     $.post("/action/comment/update", {
    //         _token: token,
    //         comment_id: e,
    //         content: t
    //     }, (function (t) {
    //         var n = $("#ln-comment-" + e);
    //         "success" == t.status && "" != t.html ? ($("html,body").animate({
    //             scrollTop: n.offset().top - $("body").offset().top + n.scrollTop()
    //         }),
    //             n.find(".ln-comment-content").html(t.html).show()) : (n.find(".ln-comment-content").show(),
    //                 alert(t.message)),
    //             $(".edit-form").remove()
    //     }
    //     ), "json")
    // }
    // )),

    //Sử lý xóa ở đây
    $(".ln-comment-body").on("click", ".span-delete", function () {
        var e = $(this),
            t = parseInt(e.closest(".ln-comment-item").data("comment"));
        if (!confirm("Bạn có muốn xóa bình luận?")) return !1;
        $.post(
            "/action/comment/delete",
            {
                _token: token,
                comment_id: t,
            },
            function (e) {
                if ("success" == e.status) {
                    var n = $("#ln-comment-" + t);
                    n.find(".ln-comment-content").html("(Bình luận đã bị xóa)"),
                        n.find("hr.ln-comment").remove(),
                        n.find(".ln-comment-toolkit").remove();
                } else alert(e.message);
            }
        );
    }),
    $(".ln-comment-body").on(
        "click",
        ".paging_item, #refresh_comment",
        function (e) {
            e.preventDefault();
            var t = $(this);
            "refresh_comment" == t.attr("id") && t.addClass("refresher");
            var n = getParameterByName("page", t.attr("href")) || 1;
            return (
                $.post(
                    "/comment/ajax_paging",
                    {
                        _token: token,
                        type: comment_type,
                        type_id: comment_typeid,
                        page: n,
                    },
                    function (e) {
                        if ("success" == e.status && "" != e.html) {
                            $(".ln-comment-body")
                                .find(".ln-comment-group, .ln-comment-page")
                                .remove(),
                                $(".ln-comment-body").append(e.html);
                            var n = $(".ln-comment-body").parent();
                            seeMoreButtons(),
                                $("html,body").animate({
                                    scrollTop:
                                        n.offset().top -
                                        $("body").offset().top +
                                        n.scrollTop(),
                                });
                        } else alert(e.message);
                        t.removeClass("refresher");
                    },
                    "json"
                ),
                !1
            );
        }
    ),
    $(".ln-comment-body").on("click", ".fetch_reply", function (e) {
        var t = $(this);
        t.next().show(),
            $.post(
                "/comment/fetch_reply",
                {
                    _token: token,
                    parent_id: t.data("parent"),
                    offset: t.parent().find(".ln-comment-item").length,
                    after: t
                        .parent()
                        .find(".ln-comment-item")
                        .last()
                        .data("comment"),
                },
                function (e) {
                    "success" == e.status && "" != e.html
                        ? (t.next().hide(),
                          e.remaining > 0 ? t.text(e.fetchReplyText) : t.hide(),
                          t.before(e.html),
                          seeMoreButtons())
                        : "error" == e.status && alert(e.message);
                },
                "json"
            );
    }),
    "undefined" != typeof series_id &&
        series_id > 0 &&
        (-1 == (Cookies.getJSON("mature_confirm") || []).indexOf(series_id) &&
            $("#mature_modal").css("display", "block"),
        $("button#mature_confirm").on("click", function (e) {
            var t = Cookies.getJSON("mature_confirm") || [];
            -1 == t.indexOf(series_id) &&
                (t.push(series_id),
                Cookies.set("mature_confirm", t, {
                    expires: 3,
                })),
                $("#mature_modal").css("display", "none");
        })),
    "1" == $('meta[name="logged-in"]').attr("content") &&
        !$("main.reading-page").length)
) {
    var handleNotiData = function (e) {
            e.notification_count > 0
                ? ($("#noti-icon").find(".noti-unread").remove(),
                  $("#noti-icon .icon-wrapper").append(
                      '<span class="noti-unread">' +
                          e.notification_count +
                          "</span>"
                  ),
                  $("#noti-icon #noti-sidebar")
                      .find("#noti-content")
                      .prepend(e.html))
                : $("#noti-icon").find(".noti-unread").remove(),
                e.seriesunread_count > 0
                    ? ($("#series-unread-icon").find(".noti-unread").remove(),
                      $("#series-unread-icon .icon-wrapper").append(
                          '<span class="noti-unread">' +
                              e.seriesunread_count +
                              "</span>"
                      ))
                    : $("#series-unread-icon").find(".noti-unread").remove(),
                e.pmunread_count > 0
                    ? ($(".at-user_avatar").addClass("icon-notify"),
                      $(".at-user_list").addClass("icon-notify"))
                    : ($(".at-user_avatar").removeClass("icon-notify"),
                      $(".at-user_list").removeClass("icon-notify")),
                (unreadCount = parseInt(e.total)),
                setDocumentTitle(
                    unreadCount > 0
                        ? "(" + unreadCount + ") " + pageTitle
                        : pageTitle
                );
        },
        setDocumentTitle = function (e) {
            document.title = e;
        },
        pageTitle = document.title,
        unreadCount = 0,
        refreshTime = 180;
    $("span.noti-unread").each(function () {
        unreadCount += parseInt($(this).text());
    }),
        unreadCount > 0 &&
            (document.title = "(" + unreadCount + ") " + document.title),
        // $("#noti-icon").on("click", (function (e) {
        //     e.stopPropagation();
        //     $(this).find(".noti-sidebar");
        //     var t = $(this).find("span.noti-unread");
        //     "" != t.text().trim() && $.post("/action/notification/clearunread", {
        //         _token: token
        //     }, (function (e) {
        //         "success" == e.status ? (t.remove(),
        //             unreadCount = 0,
        //             $("span.noti-unread").each((function () {
        //                 unreadCount += parseInt($(this).text())
        //             }
        //             )),
        //             document.title = unreadCount > 0 ? "(" + unreadCount + ") " + pageTitle : pageTitle) : alert(e.message)
        //     }
        //     ), "json")
        // }
        // )),
        $(".noti-sidebar").on("click", function (e) {
            e.stopPropagation();
        }),
        $(document).on("click", function () {
            var e = $(".noti-sidebar");
            e.hasClass("block") && e.toggleClass("none block");
        }),
        $("#noti-icon #noti-sidebar").on(
            "mousedown",
            ".noti-item",
            function () {
                var e = $(this);
                e.hasClass("untouch") &&
                    $.post(
                        "/action/notification/touch",
                        {
                            _token: token,
                            notification_id: $(this).data("notification"),
                        },
                        function (t) {
                            "success" == t.status || "touched" == t.status
                                ? e.removeClass("untouch")
                                : alert(t.message);
                        },
                        "json"
                    );
            }
        ),
        (function e() {
            setTimeout(function () {
                var t =
                    $(".noti-item time.timeago").first().attr("title") || "";
                ((new Date().getTime() / 1e3) | 0) -
                    (localStorage.getItem("ln_refresh_time") || 0) <
                refreshTime
                    ? e()
                    : localStorage.setItem(
                          "ln_refresh_time",
                          (new Date().getTime() / 1e3) | 0
                      );
            }, 1e3 * refreshTime);
        })(),
        $(window).on("storage", function (e) {
            "ln_crosstab" == e.originalEvent.key &&
                handleNotiData(JSON.parse(localStorage.getItem("ln_crosstab")));
        });
}
if (
    ($(".spoiler_toggle").on("click", function (e) {
        e.preventDefault();
        var t,
            n = $(this);
        return (
            (t = n.parent().next()).is(":visible")
                ? (t.hide(), n.text("Click vào để hiển thị nội dung"))
                : (t.show(), n.text("Click vào để ẩn nội dung")),
            !1
        );
    }),
    "undefined" != typeof series_id &&
        series_id > 0 &&
        $("span.star-evaluate-item").on("click", function () {
            if ("1" == $('meta[name="logged-in"]').attr("content")) {
                var e = $(this).data("value");
                $.post(
                    "/action/series/updaterating",
                    {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        series_id: series_id,
                        value: e,
                    },
                    function (e) {
                        "success" == e.status
                            ? alert("Cảm ơn bạn đã đánh giá truyện")
                            : e.message
                            ? alert(e.message)
                            : alert("Error");
                    },
                    "json"
                );
            } else alert("Bạn phải đăng nhập để đánh giá truyện");
        }),
    $("main.search-page div.search-advance").length)
) {
    var selectGenres = new Set(),
        rejectGenres = new Set();
    $(".search-advance_toggle").on("click", function () {
        $(".search-advance").toggle(), $(this).toggleClass("on");
    }),
        $(".genre_label").on("click", function () {
            var e = $(this);
            e.data("genre-id");
            1 == e.find("i.fa-square").length
                ? e.find("i.far").toggleClass("far fas fa-square fa-check")
                : 1 == e.find("i.fa-check").length
                ? e.find("i.fas").toggleClass("fa-check fa-times")
                : e.find("i.fas").toggleClass("far fas fa-times fa-square");
        }),
        $("form").on("submit", function (e) {
            e.preventDefault(),
                $(".gerne-icon i").each(function (e, t) {
                    var n = $(this),
                        o = n.parents("label").data("genre-id");
                    n.hasClass("fa-check")
                        ? selectGenres.add(o)
                        : n.hasClass("fa-times") && rejectGenres.add(o);
                });
            var t =
                "?selectgenres=" +
                _toConsumableArray(selectGenres).join(",") +
                "&rejectgenres=" +
                _toConsumableArray(rejectGenres).join(",");
            (t += "&" + $(this).serialize()),
                (window.location.href = window.location.href.split("?")[0] + t);
        });
}
$(".container").width() <= 768 && $(".gradual-mobile").find("main").hide(),
    $(".gradual-mobile header").on("click", function () {
        var e = $(this).parent();
        e.find(".see_more").click(),
            e.find("main").toggle(),
            $(this)
                .find(".mobile-icon i")
                .toggleClass("fa-chevron-down fa-chevron-up");
    }),
    $("#collect").on("click", function (e) {
        $.post(
            "/action/series/collect",
            {
                _token: token,
                series_id: series_id,
            },
            function (e) {
                var t = $("#collect");
                if ("success" == e.status) {
                    var n = e.collected
                        ? "Bạn đã theo dõi truyện."
                        : "Bạn đã ngừng theo dõi truyện.";
                    t.toggleClass("follow followed"),
                        t.find("i").toggleClass("far fas"),
                        Alpine ? Alpine.store("toast").show(n) : alert(n);
                } else
                    $(".summary-content").css({
                        maxHeight: "150px",
                        overflow: "hidden",
                    }),
                        _this.html(
                            '<i class="fa fa-angle-double-down" aria-hidden="true"></i> Xem thêm'
                        );
            },
            "json"
        );
    }),
    $(".feature-section .summary-content").length &&
        $(".feature-section .summary-content")[0].scrollHeight >= 100 &&
        $(".feature-section .summary-more").removeClass("none"),
    $(".mobile-more").click(function (e) {
        e.preventDefault(),
            $(this).parent().find("li").removeClass("none"),
            $(this).remove();
    }),
    $(".summary-more").click(function (e) {
        e.preventDefault();
        var t = $(this),
            n = $(this).find(".see_more");
        return (
            t.hasClass("more-state")
                ? ($(".feature-section .summary-content").css({
                      maxHeight: "none",
                      overflow: "",
                  }),
                  n.html("Ẩn đi"))
                : ($(".feature-section .summary-content").css({
                      maxHeight: "100px",
                      overflow: "hidden",
                  }),
                  n.html("Xem thêm")),
            t.toggleClass("more-state less-state"),
            !1
        );
    });
