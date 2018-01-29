    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo csv_title(); ?></title>
        <!--meta name="description" content="<!?php echo csv_description(); ?>" /-->
        <meta name="keywords" content="<?php echo csv_tags(); ?>" />
        <meta name="robots" content="index,follow" />
        <meta name="revisit-after" content="3 days" />
        <meta name="googlebot" content="index,follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- <script type="text/javascript"  src="/js/moment-with-locales.min.js"></script> -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//my.hellobar.com/bea66eed0652618cc7b8aa9d4847fd4dcc5990fb.js" type="text/javascript" charset="utf-8" async="async"></script>
<link rel="stylesheet" type="text/css" href="/s.css">



<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

        <?php wp_head();?>
    </head>

    <body>
        <!-- Google Tag Manager -->

        <noscript>
            <iframe src="//www.googletagmanager.com/ns.html?id=GTM-P48WKL" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime()
                    , event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0]
                , j = d.createElement(s)
                , dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                '//www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-P48WKL');
        </script>
        <!-- End Google Tag Manager -->

        <div id="fixed-div">
            <?php edit_post_link('<i class="fa fa-pencil-square fa-3x" aria-hidden="true"></i>
'); ?>
        </div>
        <?php include('menubar.php'); ?>

