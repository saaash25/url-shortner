(function ($, window, undefined) {
    URL.Shortner = {
        createShortUrl: () => {
            $(document).on('click', '.url-shorten-button', (e) => {
                e.preventDefault();
                var longUrlValue = $(".longUrl").val();
                if (longUrlValue) {
                    if (URL.Shortner.isUrlValid(longUrlValue)) {
                        $(".errorMessage").css('display', 'none');
                        $.ajax({
                            url: basepath + 'Controllers/urlShortner.php',
                            type: "POST",
                            data: $("#urlShortenForm").serialize() + '&action=urlShorten',
                            dataType: "json",
                            success: function (data) {
                                if (data.status) {
//                                console.log(data.shortUrl);
                                    $(".longUrl").val("");
                                    $(".shortUrl").val(data.shortUrl);
                                } else {
                                    $(".longUrl").val("");
                                    $(".shortUrl").val("");
                                }
                            }
                        });
                    } else {
                        $(".errorMessage").text('Note: Invalid Url!');
                        $(".errorMessage").css('display', 'block');
                    }
                } else {
                    $(".errorMessage").text('Note: Please fill Long URL before submiting!');
                    $(".errorMessage").css('display', 'block');
                }

            });

        },
        adminLogin: () => {
            $(document).on('click', '.login-button', (e) => {
                if ($('.login-button').hasClass('Logout')) {
                    $.ajax({
                        url: basepath + 'Controllers/urlShortner.php',
                        type: "POST",
                        data: $("#admin-login").serialize() + '&action=logout',
                        dataType: "json",
                        success: function (data) {
                            $('.login-button').removeClass("Logout");
                            window.location.href = basepath;
                        }
                    });
                } else {
                    $(".errorLoginMessage").css('display', 'none');
                    $("#login-modal").modal('show');
                    $("#admin-login input").val("");
                }

            });
            $(document).on('click', '.adminLogin', (e) => {
                e.preventDefault();
                var username = $(".username").val();
                var password = $(".password").val();

                if (username && password) {
                    $(".errorLoginMessage").css('display', 'none');
                    $.ajax({
                        url: basepath + 'Controllers/urlShortner.php',
                        type: "POST",
                        data: $("#admin-login").serialize() + '&action=adminLogin',
                        dataType: "json",
                        success: function (data) {
                            if (data.status) {
                                $(".errorLoginMessage").css('display', 'none');
                                $(".errorLoginMessage").text("");
                                window.location.href = "/url-shortner/admin"
                            } else {
                                $(".errorLoginMessage").css('display', 'block');
                                $(".errorLoginMessage").text("Invalid Credetials!");
                            }
                        }
                    });

                } else {
                    $(".errorLoginMessage").css('display', 'block');
                    $(".errorLoginMessage").text(" Note: Please fill username and password before submiting!");
                }
            });
            $(document).on('keyup', '#admin-login', (e) => {
                var code = e.keyCode;
                if (code == 13) {
                    $('.adminLogin').trigger('click');
                }

            });

        },
        copyShortUrl: () => {
            $(document).on('click', '.url-copy-button', (e) => {
                if ($(".shortUrl").val()) {
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val($(".shortUrl").val()).select();
                    document.execCommand("copy");
                    $temp.remove();
                } else {
                    alert('Nothing to Copy')
                }
            });
        },
        urlListTable: function () {
            var pagelength;
            pagelength = 10;
            var cookieString = document.cookie.split(';');
            var cookieSub = [];
            $.each(cookieString, function (i, item) {
                cookieSub.push(item.split("=")[0].trim());
                cookieSub.push(item.split("=")[1].trim());
            });

            if ($.inArray("urlLength", cookieSub) !== -1) {
                var arrayIndex = cookieSub.indexOf("urlLength") + 1;
                pagelength = cookieSub[arrayIndex];
            }
            var columnData = [];
            if ($('#urlListingTable').DataTable())
                $('#urlListingTable').DataTable().destroy();
            var urlParams = {action: 'urlListing'};
            columnData.push(
                    {data: 'SLNO', "width": "5%", "class": "text-center align-middle"},
                    {data: 'URL_LongUrl', "width": "60%", "class": "text-left align-middle text-break"},
                    {data: 'URL_ShortUrl', "width": "25%", "class": "text-left align-middle text-break"
                        , render: function (data, type, row) {
                            return '<a href="' + row.URL_ShortUrl + '" target="_blank">' + row.URL_ShortUrl + '</a>'
                        }},
                    {data: 'AddedDate', "width": "10%", "class": "text-left align-middle"},
                    );
            $('#urlListingTable').DataTable({
                "processing": true,
                "searching": false,
                "serverSide": true,
                "ordering": false,
                "autoWidth": false,
                "responsive": true,
                "pageLength": pagelength,
                "dom": 'lt<"bottom"rip><"clear">',
                "ajax": {
                    url: basepath + 'Controllers/urlShortner.php',
                    type: "post",
                    data: urlParams
                },
                "aoColumns": columnData
            });
        },
        isUrlValid: (url) => {
            return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
        },
        LoadAllFunctions: () => {
            URL.Shortner.createShortUrl();
            URL.Shortner.copyShortUrl();
            URL.Shortner.adminLogin();

        }
    }
})(jQuery, this);