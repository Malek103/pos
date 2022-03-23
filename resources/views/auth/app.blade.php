<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>POS Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" type="image/png" href="{{ asset('log/images/icons/favicon.ico') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/bootstrap/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('log/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('log/fonts/iconic/css/material-design-iconic-font.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/animate/animate.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/css-hamburgers/hamburgers.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/animsition/css/animsition.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/select2/select2.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/daterangepicker/daterangepicker.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('logcss/util.css/') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('log/css/main.css') }}" />

    <meta name="robots" content="noindex, follow" />
    <script nonce="ee2fa88b-90f7-4e3c-88e8-1fdaadd09bb3">
        (function(w, d) {
            !(function(a, e, t, r, z) {
                (a.zarazData = a.zarazData || {}),
                (a.zarazData.executed = []),
                (a.zarazData.tracks = []),
                (a.zaraz = {
                    deferred: []
                });
                var s = e.getElementsByTagName("title")[0];
                s &&
                    (a.zarazData.t =
                        e.getElementsByTagName("title")[0].text),
                    (a.zarazData.w = a.screen.width),
                    (a.zarazData.h = a.screen.height),
                    (a.zarazData.j = a.innerHeight),
                    (a.zarazData.e = a.innerWidth),
                    (a.zarazData.l = a.location.href),
                    (a.zarazData.r = e.referrer),
                    (a.zarazData.k = a.screen.colorDepth),
                    (a.zarazData.n = e.characterSet),
                    (a.zarazData.o = new Date().getTimezoneOffset()),
                    (a.dataLayer = a.dataLayer || []),
                    (a.zaraz.track = (e, t) => {
                        for (key in (a.zarazData.tracks.push(e), t))
                            a.zarazData["z_" + key] = t[key];
                    }),
                    (a.zaraz._preSet = []),
                    (a.zaraz.set = (e, t, r) => {
                        (a.zarazData["z_" + e] = t),
                        a.zaraz._preSet.push([e, t, r]);
                    }),
                    a.dataLayer.push({
                        "zaraz.start": new Date().getTime(),
                    }),
                    a.addEventListener("DOMContentLoaded", () => {
                        var t = e.getElementsByTagName(r)[0],
                            z = e.createElement(r);
                        (z.defer = !0),
                        (z.src =
                            "../../../cdn-cgi/zaraz/sd0d9.js?z=" +
                            btoa(
                                encodeURIComponent(
                                    JSON.stringify(a.zarazData)
                                )
                            )),
                        t.parentNode.insertBefore(z, t);
                    });
            })(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @yield('content')

            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>

    <script src="{{ asset('log/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('log/vendor/animsition/js/animsition.min.js') }}"></script>

    <script src="{{ asset('log/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('log/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('log/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('log/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('log/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('log/vendor/countdowntime/countdowntime.js') }}"></script>

    <script src="{{ asset('log/js/main.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-23581568-13");
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"6e79a01cb841cd61","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
