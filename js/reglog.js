function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
$(document).ready(function() {
    $("form#signInForm").submit(function (e) {
        e.preventDefault();
        let formDataLog = new FormData(this);
        $('div#signresult').hide();
        $('span#signingin').show().html("Signing in, please wait... <i class='fas fa-spinner fa-spin'></i></span>");
        $('button#btnLogin').addClass(" disabled");
        sleep(1500).then(() => {
            $.ajax({
                url: 'reglogconfig.php',
                type: 'POST',
                data: formDataLog,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function (data) {
                //console.log(data);
                if(data=="fail"){
                    $('span#signingin').hide();
                    $('div#signresult').fadeIn(100).show().html("<div><h2><span class='badge badge-danger my-3'>Invalid login details! <i class='fas fa-close'></i></span></h2></div>");
                    $('button#btnLogin').removeClass("disabled");
                } else {
                    $('span#signingin').hide();
                    $('div#signresult').fadeIn(100).show().html(data);
                    sleep(1100).then(() => {
                        (window.location = "index.php")
                    });
                }
            })
                .fail(function (msg) {
                //console.log(msg);
                $('span#signingin').hide();
                $('div#signresult').fadeIn(100).show().html(msg);
                setTimeout(function () {
                    $('div#signresult').hide();
                }, 3500);
            });
        });
    });
});
// REGISTER FORM
$(document).ready(function() {
    $("form#registerForm").submit(function (e) {
        e.preventDefault();
        let formDataLog = new FormData(this);
        $('div#registerresult').hide();
        $('span#registering').show().html("Creating your account, please wait... <i class='fas fa-spinner fa-spin'></i></span>");
        $('button#btnRegister').addClass(" disabled");
        sleep(1500).then(() => {
            $.ajax({
                url: 'regcfg.php',
                type: 'POST',
                data: formDataLog,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function (data) {
                   // console.log(data);
                    if(data=="usernamefail"){
                        $('span#registering').hide();
                        $('div#registerresult').fadeIn(100).show().html("<div><h2><span class='badge badge-danger my-3'>This username is already taken! <i class='fas fa-close'></i></span></h2></div>");
                        $('button#btnRegister').removeClass("disabled");
                    } else if(data=="emailfail") {
                        $('span#registering').hide();
                        $('div#registerresult').fadeIn(100).show().html("<div><h2><span class='badge badge-danger my-3'>This email is already taken! <i class='fas fa-close'></i></span></h2></div>");
                        $('button#btnRegister').removeClass("disabled");
                    } else if(data=="allfail") {
                        $('span#registering').hide();
                        $('div#registerresult').fadeIn(100).show().html("<div><h2><span class='badge badge-danger my-3'>This email & username is already taken! <i class='fas fa-close'></i></span></h2></div>");
                        $('button#btnRegister').removeClass("disabled");
                    } else {
                        $('span#registering').hide();
                        $('div#registerresult').fadeIn(100).show().html(data);
                        sleep(1100).then(() => {
                            (window.location = "index.php")
                        });
                    }
                })
                .fail(function (msg) {
                    //console.log(msg);
                    $('span#registering').hide();
                    $('div#registerresult').fadeIn(100).show().html(msg);
                    setTimeout(function () {
                        $('div#registerresult').hide();
                    }, 3500);
                });
        });
    });
});