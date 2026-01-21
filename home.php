<?php
ini_set("error_reporting", 1);
session_start();
include("koneksi.php");
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <!-- Created by Artisteer v4.3.0.60745 -->
    <meta charset="utf-8">
    <title>Produksi Harian Brushing</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="style.responsive.css" media="all">
    <link rel="icon" type="image/png" href="images/index.gif">

    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <script src="script.responsive.js"></script>


    <style>
        .art-content .art-postcontent-0 .layout-item-0 {
            margin-bottom: 10px;
        }

        .art-content .art-postcontent-0 .layout-item-1 {
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-width: 0px;
            border-color: #D1DBE0;
            color: #FFFFFF;
            background: #1F5C98;
            border-spacing: 0px 10px;
            border-collapse: separate;
        }

        .art-content .art-postcontent-0 .layout-item-2 {
            border-right-style: Dotted;
            border-right-width: 1px;
            border-right-color: #4991DA;
            color: #FFFFFF;
            padding-right: 30px;
            padding-left: 30px;
        }

        .art-content .art-postcontent-0 .layout-item-3 {
            color: #FFFFFF;
            padding-right: 30px;
            padding-left: 30px;
        }

        .ie7 .art-post .art-layout-cell {
            border: none !important;
            padding: 0 !important;
        }

        .ie6 .art-post .art-layout-cell {
            border: none !important;
            padding: 0 !important;
        }

        a.button6 {
            display: inline-block;
            padding: 1.4em 2.8em;
            margin: 0 0.6em 0.6em 0;
            border-radius: 0.15em;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            color: #FFFFFF;
            background-color: #DC3545;
            box-shadow: inset 0 -0.6em 0 -0.35em rgba(0, 0, 0, 0.17);
            text-align: center;
            position: relative;
        }

        a.button6:active {
            top: 0.1em;
        }

        @media all and (max-width:30em) {
            a.button6 {
                display: block;
                margin: 0.4em auto;
            }
        }

        /* Simple offline modal (no CDN needed) */
        .notice-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.55);
            z-index: 9999;
            padding: 16px;
            backdrop-filter: blur(1px);
        }

        .notice-modal {
            background: #fff;
            color: #1F1F1F;
            width: min(440px, 100%);
            border-radius: 14px;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.25);
            padding: 22px 22px 18px;
            font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
            text-align: center;
        }

        .notice-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 14px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #FFF5F5;
            border: 2px solid #F3C2C2;
            color: #DC3545;
            font-size: 28px;
            font-weight: bold;
        }

        .notice-modal h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #1F5C98;
        }

        .notice-modal p {
            margin: 8px 0;
            font-size: 15px;
            line-height: 1.5;
        }

        .notice-modal .accent {
            color: #DC3545;
            font-weight: bold;
        }

        .notice-modal .thanks {
            color: #1F5C98;
            font-weight: bold;
        }

        .notice-button {
            margin-top: 16px;
            width: 100%;
            border: none;
            background: #DC3545;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            padding: 12px 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.1s ease, box-shadow 0.1s ease;
        }

        .notice-button:active {
            transform: translateY(1px);
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div id="art-main">
        <nav class="art-nav">
            <div class="art-nav-inner">
                <ul class="art-hmenu">
                    <li><a href="index.php" class="active">Main</a></li>
                    <li><a href="masuk/">Masuk</a></li>
                    <li><a href="data-brushing/">Data Brushing</a></li>
                    <li><a href="keluar/">Keluar</a>
                    <li><a href="splb/">SPLB</a></li>
                    <li><a href="reports/">Reports</a></li>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="art-sheet clearfix">
            <div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
                            <article class="art-post art-article">


                                <div class="art-postcontent art-postcontent-0 clearfix">
                                    <div class="art-content-layout-wrapper layout-item-0">
                                        <div class="art-content-layout layout-item-1">
                                            <div class="art-content-layout-row">
                                                <div class="art-layout-cell layout-item-2" style="width: 33%">
                                                    <h5>Data Brushing</h5>
                                                    <p><span style="font-style:italic;">Input data harian brushing.</span></p>
                                                    <p style="text-align: center;"><img width="200" height="120" alt="" src="images/Balls_01.png" class=""><br></p>
                                                    <p>Form untuk membuat data harian produksi brushing.&nbsp;</p>
                                                    <p><a href="data-brushing/" class="art-button">Read more</a></p>
                                                </div>
                                                <div class="art-layout-cell layout-item-2" style="width: 34%">
                                                    <h5>Reports</h5>
                                                    <p><span style="font-style:italic;">Laporan produksi brushing.</span></p>
                                                    <p style="text-align: center;"><img width="200" height="120" alt="" src="images/Graph_01.png" class=""><br></p>
                                                    <p>Laporan hasil produksi brushing harian dan bulanan.</p>
                                                    <p><a href="reports/" class="art-button">Read more</a></p>
                                                </div>
                                                <div class="art-layout-cell layout-item-3" style="width: 33%">
                                                    <h5>Brushing</h5>
                                                    <p><span style="font-style:italic;">About Brushing&nbsp;</span></p>
                                                    <p style="text-align: center;"><img width="200" height="120" alt="" src="images/Puzzle_01.png" class=" art-preview-selected"><br></p>
                                                    <p>Aplikasi brushing adalah aplikasi untuk input data harian produksi brushing</p>
                                                    <p><a href="#" class="art-button">Read more</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="art-content-layout-wrapper layout-item-0">
                                        <p><a href="logout.php" class="button6" style="color: white;">Log-out</a></p>
                                    </div>
                                </div>



                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="art-footer">
            <div class="art-footer-inner">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell layout-item-0" style="width: 50%">

                        </div>
                        <div class="art-layout-cell layout-item-0" style="width: 100%">
                            <p style="float:center;">
                                Copyright © 2024 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>

                <p class="art-page-footer">
                    <span id="art-footnote-links">Web Template created with Dept. DIT</span>
                </p>
            </div>
        </footer>

    </div>

    <div id="offline-alert" class="notice-overlay" role="dialog" aria-modal="true" aria-labelledby="offline-alert-title">
        <div class="notice-modal">
            <div class="notice-icon">!</div>
            <h2 id="offline-alert-title">PEMBERITAHUAN PENTING</h2>
            <p>Online brushing akan segera di<br><span class="accent">NON AKTIFKAN hari ini pukul 13:00</span></p>
            <p>Silahkan gunakan aplikasi app.indotaichen.com brushing untuk input data harian brushing.</p>
            <p class="thanks">Terima kasih</p>
            <button id="offline-alert-confirm" type="button" class="notice-button">Mengerti</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var overlay = document.getElementById('offline-alert');
            var confirmBtn = document.getElementById('offline-alert-confirm');

            if (!overlay || !confirmBtn) return;

            overlay.style.display = 'flex';

            confirmBtn.addEventListener('click', function () {
                overlay.style.opacity = '0';
                setTimeout(function () {
                    overlay.remove();
                }, 150);
            });

            overlay.addEventListener('click', function (event) {
                // Block outside click (match allowOutsideClick: false)
                if (event.target === overlay) {
                    event.stopPropagation();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    event.preventDefault(); // Block ESC close
                }
            });
        });
    </script>

</body>

</html>
