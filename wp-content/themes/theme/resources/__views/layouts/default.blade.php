<?php
$should_hide_header_and_footer = isset($_GET['lp']) && $_GET['lp'] === '1';
$cache_version = '1.1.11';
?>
<!DOCTYPE html>
<html lang="{{ get_locale() }}">
<!--
Made Together
[https://together.agency]
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ themosis_theme_assets() }}/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ themosis_theme_assets() }}/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ themosis_theme_assets() }}/images/favicon-16x16.png">
    <link rel="manifest" href="{{ themosis_theme_assets() }}/images/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="google-site-verification" content="KDKJskZfywPjLj-e3i56wzERrh2KljZS68evvs4q1m4" />

    {{-- Stylesheets --}}
    <style>
        /* hide all img elements until the svg is injected to prevent "unstyled image flash" */
        img.injectable {
            visibility: hidden;
        }
    </style>

    {{-- Add anything wordpressy --}}
    {{ wp_head() }}

    <link rel="stylesheet" href="/wp-content/themes/theme/dist/webpack/main.css?v={{ $cache_version }}" />
    <script async="true" src="https://app.termly.io/embed.min.js" data-auto-block="off"
        data-website-uuid="81bf42f6-ea1c-4ede-bda2-bfc3a0ca7e07"></script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M4SGJL');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-3527360-4"></script>
    <script>
        function gtag() {
            dataLayer.push(arguments)
        }
        window.dataLayer = window.dataLayer || [], gtag("js", new Date), gtag("config", "UA-3527360-4")
    </script>

    <!-- Start of Async Drift Code -- -->
    <script>
        "use strict";

        ! function() {
            var t = window.driftt = window.drift = window.driftt || [];
            if (!t.init) {
                if (t.invoked) return void(window.console && console.error && console.error(
                    "Drift snippet included twice."));
                t.invoked = !0, t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page",
                        "hide", "off", "on"
                    ],
                    t.factory = function(e) {
                        return function() {
                            var n = Array.prototype.slice.call(arguments);
                            return n.unshift(e), t.push(n), t;
                        };
                    }, t.methods.forEach(function(e) {
                        t[e] = t.factory(e);
                    }), t.load = function(t) {
                        var e = 3e5,
                            n = Math.ceil(new Date() / e) * e,
                            o = document.createElement("script");
                        o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src =
                            "https://js.driftt.com/include/" + n + "/" + t + ".js";
                        var i = document.getElementsByTagName("script")[0];
                        i.parentNode.insertBefore(o, i);
                    };
            }
        }();
        drift.SNIPPET_VERSION = '0.3.1';
        drift.load('wd8sxknvurfk');
    </script>
    <!-- End of Async Drift Code -->

    <!-- Start of LeadFeeder code -->
    <script>
        (function(ss, ex) {
            window.ldfdr = window.ldfdr || function() {
                (ldfdr._q = ldfdr._q || []).push([].slice.call(arguments));
            };
            (function(d, s) {
                fs = d.getElementsByTagName(s)[0];

                function ce(src) {
                    var cs = d.createElement(s);
                    cs.src = src;
                    cs.async = 1;
                    fs.parentNode.insertBefore(cs, fs);
                };
                ce('https://sc.lfeeder.com/lftracker_v1_' + ss + (ex ? '_' + ex : '') + '.js');
            })(document, 'script');
        })('3P1w24dj6oo8mY5n');
    </script>
</head>

<body
    class="text-grey {{ 'page--' . (isset($pageName) ? $pageName : '') }} {{ implode(get_body_class(), ' ') }} {{ 'title--' . slugify($page->post_title) }}  {{ $customBodyClass ?? '' }} @if ($isDev) is-dev @endif">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4SGJL" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @if (post_password_required())
        {!! get_the_password_form() !!}
    @else
        @if (!$should_hide_header_and_footer)
            @include('components.header')
        @endif

        <main class="content">
            @yield('content')
        </main>

        @if (!$should_hide_header_and_footer)
            @include('components.footer')
        @endif

        {{-- JS --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="/wp-content/themes/theme/dist/webpack/main.js?v={{ $cache_version }}"></script>


        {{ wp_footer() }}
    @endif
</body>


<script type="text/javascript">
    _linkedin_partner_id = "2942004";
    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script>
<script type="text/javascript">
    (function(l) {
        if (!l) {
            window.lintrk = function(a, b) {
                window.lintrk.q.push([a, b])
            };
            window.lintrk.q = []
        }
        var s = document.getElementsByTagName("script")[0];
        var b = document.createElement("script");
        b.type = "text/javascript";
        b.async = true;
        b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
        s.parentNode.insertBefore(b, s);
    })(window.lintrk);
</script> <noscript> <img height="1" width="1" style="display:none;" alt=""
        src="https://px.ads.linkedin.com/collect/?pid=2942004&fmt=gif" /> </noscript>

</html>
