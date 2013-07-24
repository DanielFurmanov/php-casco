(function ($) {
    $.fn.smart_polis = function (s) {
        var settings = $.extend({
            base: "/smpolis/"
        }, s);
        $.smartpolisBase = settings.base;
        this.each(function () {
            var me = $(this);
            me.append(
                $("<iframe></iframe>")
                    .attr("src", settings.base)
                    .css("display", "none")
                    .load(function () {
                        me.html($(this).contents().find("body").html());
                        $("head")
                            .append(
                                 $("<link>")
                                    .attr({
                                        rel: "stylesheet",
                                        href: settings.base + "smartpolis/css/style.css"
                                    })
                            )
                            .append(
                                $("<link>")
                                    .attr({
                                        rel: "stylesheet",
                                        href: settings.base + "smartpolis/css/bootstrap.min.css"
                                    })
                            )
                            .append(
                                $("<script>")
                                    .attr({
                                        type: "text/javascript",
                                        src: settings.base + "smartpolis/js/smartpolis.js?v=2"
                                    })
                             )
                            .append(
                                $("<script>")
                                    .attr({
                                        type: "text/javascript",
                                        src: settings.base + "smartpolis/js/bootstrap.min.js"
                                    })
                            );
                        me.find("#smartpolis_order_form_submit").click(function () {
                            var frm = $("#smartpolis_order_form form");
                            $.post(
                                settings.base,
                                {
                                    fio: frm.find("input[name=fio]").val(),
                                    phone: frm.find("input[name=phone]").val(),
                                    date: frm.find("input[name=date]").val(),
                                    iwant: frm.find("input[name=iwant]").val(),
                                    rqid: frm.find("input[name=rqid]").val(),
                                    address: frm.find("textarea[name=address]").val(),
                                    comments: frm.find("textarea[name=comments]").val()
                                },
                                function (d) {
                                    me.html("<h1>Ваша заявка успешно отправлена!</h1>");
                                }
                            );
                            return false;
                        });
                    })
            );
        });
    };
})(jQuery);