$(document).ready(function() {

    if (!device.tablet() && !device.mobile()) {
        $(".player").mb_YTPlayer();
    } else {
        //Если мобильние девайсы
    };

    $("header").height($(window).height());

    //Цели для Яндекс.Метрики и Google Analytics
    $(".count_element").on("click", (function() {
        ga("send", "event", "goal", "goal");
        yaCounterXXXXXXXX.reachGoal("goal");
        return true;
    }));

    //Аякс отправка форм
    //Документация: http://api.jquery.com/jquery.ajax/
    $("#form").submit(function(e) {
        e.preventDefault;
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: $(this).serialize()
        }).done(function() {
            alert("Спасибо за заявку!");
            setTimeout(function() {
            }, 1000);
        });
    });

});$(document).ready(function() {

    if (!device.tablet() && !device.mobile()) {
        $(".player").mb_YTPlayer();
    } else {
        //Если мобильние девайсы
    };

    $("header").height($(window).height());

    //Цели для Яндекс.Метрики и Google Analytics
    $(".count_element").on("click", (function() {
        ga("send", "event", "goal", "goal");
        yaCounterXXXXXXXX.reachGoal("goal");
        return true;
    }));

    //Аякс отправка форм
    //Документация: http://api.jquery.com/jquery.ajax/
    $("#form").submit(function(e) {
        e.preventDefault;
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: $(this).serialize()
        }).done(function() {
            alert("Спасибо за заявку!");
            setTimeout(function() {
            }, 1000);
        });
    });

});