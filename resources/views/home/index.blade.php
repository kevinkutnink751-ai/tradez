@extends('layouts.base')

@section('title', $settings->site_title)

@section('styles')
    @parent
    <link href="https://glidelogiccopytrading.com/assets/css/style.css" rel="stylesheet" />
    <link href="https://glidelogiccopytrading.com/assets/css/styledb6.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        .gatsby-image-wrapper {
            position: relative;
            overflow: hidden
        }

        .gatsby-image-wrapper img {
            all: inherit;
            bottom: 0;
            height: 100%;
            left: 0;
            margin: 0;
            max-width: none;
            padding: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: 100%;
            object-fit: cover
        }

        .gatsby-image-wrapper [data-main-image] {
            opacity: 0;
            transform: translateZ(0);
            transition: opacity .25s linear;
            will-change: opacity
        }

        .gatsby-image-wrapper-constrained {
            display: inline-block
        }
    </style>
    <style>
            .gatsby-image-wrapper noscript [data-main-image] {
                opacity: 1 !important
            }

            .gatsby-image-wrapper [data-placeholder-image] {
                opacity: 0 !important
            }
        </style>
    <style>
        .extr-hero {
            height: 350px;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .extr-hero::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 2;
            display: block;
            background: linear-gradient(transparent 0%,#000 95%),radial-gradient(194.14% 91.43% at 2.43% 88.15%,rgba(10,10,10,.8) 0%,rgba(10,10,10,0) 100%),conic-gradient(from 5deg at 92.78% 73.8%,rgba(65,64,62,.4) 0deg,rgba(37,37,35,.4) 360deg),conic-gradient(from -49deg at 85.69% 75.64%,rgba(98,97,97,.3) 0deg,rgba(37,37,37,.3) 360deg),#0a0a0a
        }

        .extra-inner-bg {
            background-image: url(https://glidelogiccopytrading.com/assets/hero-bg.png);
            background-position: right;
            background-size: 500px;
            background-repeat: no-repeat;
            bottom: 0;
            position: absolute;
            top: 0;
        }

        .comp-img {
            background-color: var(--inst-bg-sec);
            width: 50%;
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center
        }


        .fade-in-on-scroll {
            transform: translateY(20px);
            /* Starts 20px below */
        }

        .fade-in-on-scroll.visible {
            transform: translateY(0);
            /* Moves to original position */
        }
    </style>
    <style>
    .com-header-nav-links-item__list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        background: #fff !important;
    }

    .com-header-nav-links-item__item {
        font-size: 16px;
        padding: 12px !important;
        background-color: #EBF4FF;
        color: var(--inst-text);
        border-radius: 8px;
    }

    .com-header-nav-links-item__item a {
        color: var(--inst-text)
    }

    .navigation_item_apps_subtitle {
        font-size: 12px;
        display: block;
    }

    .user_tpl_regulation {
        font-size: 15px
    }

    #gt-mordadam-43217984 {
        display: flex;
        justify-content: end;
        color: #fff;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 768px) {
        #gt-mordadam-43217984 {
            padding-left: 60px;
            padding-right: 60px;
        }
    }

    #gt-mordadam-43217984 .gt_switcher-popup img {
        width: 18px;
        height: 100%;
    }

    #gt-mordadam-43217984 .gt_switcher-popup span {
        font-size: 14px
    }
</style>
    <style>
        .p-home-m-seo-numbers-item__textcontent {
            color: #fff
        }
    </style>
    <style>
                @keyframes scroll-strip {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(-50%);
                    }
                }

                .scrolling-strip {
                    width: 200%;
                }
            </style>
    <style>
    .com-footer_dir_ltr {
        position: relative;
        z-index: 1;
    }

    .com-footer_dir_ltr::before {
        content: "";
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        background-image: url('../assets/header-campus.webp');
        z-index: -1;
        opacity: 0.9;
    }
</style>

@endsection

@section('content')

    <div id="___gatsby">
        <div style="outline:none" tabindex="-1" id="gatsby-focus-wrapper">
            <div class="page page--en">
                <div class="page__header">
                    
<style>
    .com-header-nav-links-item__list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        background: #fff !important;
    }

    .com-header-nav-links-item__item {
        font-size: 16px;
        padding: 12px !important;
        background-color: #EBF4FF;
        color: var(--inst-text);
        border-radius: 8px;
    }

    .com-header-nav-links-item__item a {
        color: var(--inst-text)
    }

    .navigation_item_apps_subtitle {
        font-size: 12px;
        display: block;
    }

    .user_tpl_regulation {
        font-size: 15px
    }

    #gt-mordadam-43217984 {
        display: flex;
        justify-content: end;
        color: #fff;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 768px) {
        #gt-mordadam-43217984 {
            padding-left: 60px;
            padding-right: 60px;
        }
    }

    #gt-mordadam-43217984 .gt_switcher-popup img {
        width: 18px;
        height: 100%;
    }

    #gt-mordadam-43217984 .gt_switcher-popup span {
        font-size: 14px
    }
</style>
<div>
    

                </div>
                    <style>
        .p-home-m-seo-numbers-item__textcontent {
            color: #fff
        }
    </style>
    <div class="page-main section">
        <section class="p-home-m-welcome p-home__section"
            style="position: relative;background: linear-gradient(transparent 0%,#000 95%),radial-gradient(194.14% 91.43% at 2.43% 88.15%,rgba(10,10,10,.8) 0%,rgba(10,10,10,0) 100%),conic-gradient(from 5deg at 92.78% 73.8%,rgba(65,64,62,.4) 0deg,rgba(37,37,35,.4) 360deg),conic-gradient(from -49deg at 85.69% 75.64%,rgba(98,97,97,.3) 0deg,rgba(37,37,37,.3) 360deg),#0a0a0a;background-position: center;background-repeat: no-repeat;background-size: cover;">
            
            <div class="p-home-m-welcome__content">
                <h1 data-trans="home_welcome_title" class="page-c-title p-home-m-welcome__title" data-aos="slide-up"
                    class="mb-4">
                    Purpose-Driven Copytrading, Built on Innovation and Transparency
                </h1>
                <p class="com-c-description p-home-m-welcome__desc" data-trans="home_welcome_desc" data-aos="slide-up"
                    style="font-size: 16px;font-weight: 400;line-height: 24px;">Trade smarter, not harder,
                    by automatically mirroring the strategies of top-performing investors, giving you a smarter way to grow
                    your portfolio with confidence, transparency, and control.</p>

                <div style="display: flex;">
                    <a href="https://app.glidelogiccopytrading.com/register"
                        class="_633ZZh0WP6 btn btn-primary p-home-c-button-desktop p-home-m-devices__button"
                        type="button"
                        style="min-height: unset;margin-right:5px;background:var(--inst-accent);border-radius:8px" data-aos="zoom-in" data-aos-delay="200">Register</a>
                    <a href="https://app.glidelogiccopytrading.com/login"
                        class="_633ZZh0WP6 btn btn-primary p-home-c-button-desktop p-home-m-devices__button"
                        type="button"
                        style="min-height: unset;background: #fff;color: var(--inst-accent);outline: 2px solid var(--inst-accent);border-radius:8px" data-aos="zoom-in" data-aos-delay="200">Login</a>
                </div>
            </div>
            <div class="p-home-m-welcome__img" style="position:relative;height: 350px;">
                <img src="/assets/hero-img.svg" style="position: absolute;width: 80%;right: 0;top: 0;" / data-aos="zoom-in" data-aos-delay="100">
                <img src="/assets/hero-img1.svg" style="position: absolute;width: 10%;left: 25%;" / data-aos="zoom-in" data-aos-delay="100">
                <img src="/assets/hero-img2.svg" style="position: absolute;width: 10%;left: 25%;top: 60%;;" / data-aos="zoom-in" data-aos-delay="100">
            </div>
        </section>
        <div
            style="padding-left:50px;padding-right:60px;padding-top:60px;scrollbar-width:none;column-gap:16px;row-gap:16px;">
            <div style="scrollbar-width:none;-webkit-font-smoothing:antialiased">
                <div style="scrollbar-width:none;width: 100%;max-width:1232px;margin-left: auto;margin-right: auto;">
                    <div
                        style="scrollbar-width:none;column-gap:0px;row-gap:0px;grid-template-columns:616px 616px;gap:0px;grid-template-rows: auto;grid-auto-columns: 1fr;align-items:center;display:grid;">
                        <section
                            style="scrollbar-width:none;padding-right:48px;flex-flow:column nowrap;width: 100%;min-height:70%;display:flex;">
                            <div class="fade-up"
                                style="scrollbar-width:none;column-gap:16px;row-gap:16px;flex-direction:column;display:flex;">
                                <div style="scrollbar-width:none;gap:8px;flex-flow:column nowrap;display:flex;">
                                    <h1 data-aos="slide-up"
                                        class="mb-4">
                                        A user-friendly trading platform</h1>
                                </div>
                                <p data-aos="slide-up"
                                    style="scrollbar-width:none;margin-bottom:0px;margin-top:0px;">
                                    Trade options on financial markets and 24/7 Derived Indices. Start with just
                                    USD&nbsp;0.09, and choose from multiple contract types and durations to suit your
                                    trading strategy.</p>
                            </div>
                            <div
                                style="scrollbar-width:none;margin-right:0px;margin-bottom:0px;margin-left:0px;margin:48px 0px 0px;">
                                <div
                                    style="scrollbar-width:none;gap:8px;flex-wrap:wrap;justify-content:flex-start;align-items:center;display:flex;">
                                    <a data-wf-native-id-path="a2023ccd-9563-d11a-a5ea-012bbe566319"
                                        data-wf-ao-click-engagement-tracking="true"
                                        data-wf-element-id="a2023ccd-9563-d11a-a5ea-012bbe566319" href="/"
                                        target="_blank"
                                        style="scrollbar-width:none;column-gap:8px;row-gap:8px;align-items:stretch;display:flex;border-radius:96px;background-color:var(--inst-accent);text-align:center;white-space:nowrap;min-width:96px;min-height:48px;padding:12px 16px;font-weight:800;text-decoration:none solid rgb(255, 255, 255);transition:background-color 0.16s cubic-bezier(0.72, 0, 0.24, 1);position:relative;max-width:100%;">
                                        <div style="scrollbar-width:none;">
                                            Try now</div>
                                    </a>
                                </div>
                            </div>
                        </section>
                        <div
                            style="scrollbar-width:none;background-color:var(--inst-bg);border-radius:24px;width: 100%;height: auto;display:flex;overflow:hidden;">
                            <img src="/assets/6757d2193bf331c84b5fd1be_dtrader-revamped-hero-row.webp"
                                alt="CHF/JPY, EUR/USD, Germany 40, Wall street 30 icons displayed around a mobile device for trading."
                                style="display:block;scrollbar-width:none;object-fit:contain;max-width:60%;vertical-align:middle;border:0px none rgb(24, 28, 37);" / data-aos="zoom-in" data-aos-delay="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="page__container">
                <div class="p-home-m-seo-become-a-trader__content-wrap">
                    <h2 class="com-c-title p-home-m-seo-become-a-trader__title" data-aos="slide-up" data-aos="fade-up">About Us
                    </h2>
                    <div class="p-home-m-seo-become-a-trader__content">
                        <div class="p-home-m-seo-become-a-trader__item-wrap"
                            style="max-width: 100%;width: 100%;height: 100%;">
                            <div class="p-home-m-seo-become-a-trader__item-wrap-content zoom-in_"
                                style="display: flex;gap:16px">
                                <div style="width: 60%;">
                                    <h2 class="com-c-title p-home-m-seo-become-a-trader__item-head" style="color: #fff"
                                        data-aos="slide-up" data-aos="fade-up">Time to take action with the international
                                        {{ $settings->site_name }} broker</h2>
                                    <p class="p-home-m-seo-become-a-trader__item-text" data-aos="slide-up">
                                        Trading will bring you profit with proper support, constant education, and a
                                        reasonable
                                        approach. {{ $settings->site_name }} is a broker platform that has created all the
                                        conditions to help you
                                        improve your trading life in every possible way.</p>
                                    <p class="p-home-m-seo-become-a-trader__item-text" data-aos="slide-up">
                                        From educational broker’s tools, demo accounts, and 24/7 support to your financial
                                        success,
                                        {{ $settings->site_name }} works tirelessly to remain at the forefront in trading
                                        online.
                                        Join now! Take full
                                        advantage of this online trading leader and make your way into the world of
                                        professional
                                        trading.</p>
                                </div>
                                <div style="width: 40%;">
                                    <img src="https://glidelogiccopytrading.com/assets/euro-copy.webp" width="100%" style="border-radius: 8px;" / data-aos="zoom-in" data-aos-delay="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="section">
            <ul class="p-home-m-seo-numbers__list">
                <li class="p-home-m-seo-numbers-item p-home-m-seo-numbers-item--l" data-aos="zoom-in">
                    <div class="p-home-m-seo-numbers-item__bg">
                        <div data-gatsby-image-wrapper="" class="gatsby-image-wrapper gatsby-image-wrapper-constrained"
                            style="height: 100%; width: 100%;">
                            <div style="max-width: 394px; display: block;"><img alt="" role="presentation"
                                    aria-hidden="true"
                                    src="data:image/svg+xml;charset=utf-8,%3Csvg height='794' width='394' xmlns='http://www.w3.org/2000/svg' version='1.1'%3E%3C/svg%3E"
                                    style="max-width: 100%; display: block; position: static;" data-aos="zoom-in" data-aos-delay="100"></div>
                            <div aria-hidden="true" data-placeholder-image=""
                                style="opacity: 0; transition: opacity 500ms linear 0s; background-color: transparent; position: absolute; inset: 0px;">
                            </div>
                            <img src="https://glidelogiccopytrading.com/assets/960.webp" alt="planet" style="object-fit: cover; opacity: 1;" data-aos="zoom-in" data-aos-delay="100">
                        </div>
                    </div>
                    <div class="p-home-m-seo-numbers-item__content">
                        <div class="p-home-m-seo-numbers-item__icon"> <img
                                src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik00LjA2MTg5IDExSDcuMDIzMjhDNy4xMjY0MyA4Ljc5NTk3IDcuNTY3OTggNi43ODE5MSA4LjI1Nzc2IDUuMjI5OUM4LjMxODAyIDUuMDk0MzEgOC4zODA2NCA0Ljk2MTIyIDguNDQ1NjEgNC44MzA5OUM2LjA5NDg1IDUuOTk4NzQgNC4zOTk5OSA4LjI4ODcgNC4wNjE4OSAxMVpNMTIgMkM2LjQ3NzE1IDIgMiA2LjQ3NzE1IDIgMTJDMiAxNy41MjI4IDYuNDc3MTUgMjIgMTIgMjJDMTcuNTIyOCAyMiAyMiAxNy41MjI4IDIyIDEyQzIyIDYuNDc3MTUgMTcuNTIyOCAyIDEyIDJaTTEyIDRDMTEuNzczMSA0IDExLjQ4MTYgNC4wOTkzIDExLjEzMjQgNC40MzE2NkMxMC43NzggNC43Njg5MiAxMC40MTM0IDUuMzA0MjIgMTAuMDg1NCA2LjA0MjE4QzkuNTIzOTIgNy4zMDU0NiA5LjEyNzM2IDkuMDMzNDcgOS4wMjU2NyAxMUgxNC45NzQzQzE0Ljg3MjYgOS4wMzM0NyAxNC40NzYxIDcuMzA1NDYgMTMuOTE0NiA2LjA0MjE4QzEzLjU4NjYgNS4zMDQyMiAxMy4yMjIgNC43Njg5MiAxMi44Njc2IDQuNDMxNjZDMTIuNTE4NCA0LjA5OTMgMTIuMjI2OSA0IDEyIDRaTTE2Ljk3NjcgMTFDMTYuODczNiA4Ljc5NTk3IDE2LjQzMiA2Ljc4MTkxIDE1Ljc0MjIgNS4yMjk5QzE1LjY4MiA1LjA5NDMxIDE1LjYxOTQgNC45NjEyMiAxNS41NTQ0IDQuODMwOTlDMTcuOTA1MiA1Ljk5ODc0IDE5LjYgOC4yODg3IDE5LjkzODEgMTFIMTYuOTc2N1pNMTQuOTc0MyAxM0g5LjAyNTY3QzkuMTI3MzYgMTQuOTY2NSA5LjUyMzkyIDE2LjY5NDUgMTAuMDg1NCAxNy45NTc4QzEwLjQxMzQgMTguNjk1OCAxMC43NzggMTkuMjMxMSAxMS4xMzI0IDE5LjU2ODNDMTEuNDgxNiAxOS45MDA3IDExLjc3MzEgMjAgMTIgMjBDMTIuMjI2OSAyMCAxMi41MTg0IDE5LjkwMDcgMTIuODY3NiAxOS41NjgzQzEzLjIyMiAxOS4yMzExIDEzLjU4NjYgMTguNjk1OCAxMy45MTQ2IDE3Ljk1NzhDMTQuNDc2MSAxNi42OTQ1IDE0Ljg3MjYgMTQuOTY2NSAxNC45NzQzIDEzWk0xNS41NTQ0IDE5LjE2OUMxNS42MTk0IDE5LjAzODggMTUuNjgyIDE4LjkwNTcgMTUuNzQyMiAxOC43NzAxQzE2LjQzMiAxNy4yMTgxIDE2Ljg3MzYgMTUuMjA0IDE2Ljk3NjcgMTNIMTkuOTM4MUMxOS42IDE1LjcxMTMgMTcuOTA1MiAxOC4wMDEzIDE1LjU1NDQgMTkuMTY5Wk04LjQ0NTYxIDE5LjE2OUM4LjM4MDY0IDE5LjAzODggOC4zMTgwMiAxOC45MDU3IDguMjU3NzYgMTguNzcwMUM3LjU2Nzk4IDE3LjIxODEgNy4xMjY0MyAxNS4yMDQgNy4wMjMyOCAxM0g0LjA2MTg5QzQuMzk5OTkgMTUuNzExMyA2LjA5NDg1IDE4LjAwMTMgOC40NDU2MSAxOS4xNjlaIiBmaWxsPSIjMDA5NEZGIi8+Cjwvc3ZnPgo=" / data-aos="zoom-in" data-aos-delay="100">
                        </div>
                        <div class="p-home-m-seo-numbers-item__textcontent">
                            <div class="p-home-m-seo-numbers-item__head"> <span
                                    data-trans="numbers_section_countries_head">130+
                                    <br /> countries</span></div>
                            <div class="p-home-m-seo-numbers-item__desc">
                                <p data-trans="numbers_section_countries_desc" data-aos="fade-up" data-aos-delay="100">We support all, so traders from all over
                                    the world could enjoy and profit anytime</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="p-home-m-seo-numbers-item p-home-m-seo-numbers-item--s" data-aos="zoom-in">
                    <div class="p-home-m-seo-numbers-item__content" class="about-card">
                        <div class="p-home-m-seo-numbers-item__icon"> <img
                                src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMS45OTk5IDNDOS4yMzg1MSAzIDYuOTk5OTQgNS4yMzg1OCA2Ljk5OTk0IDhDNi45OTk5NCA5LjQyMDYgNy41OTIzOSAxMC43MDI4IDguNTQzNjkgMTEuNjEzMUM2LjY0OTM4IDEyLjM1MjQgNS4zNjk5OCAxMy42NTg1IDQuNTMzNzcgMTQuOTU5MkMzLjkwOTU0IDE1LjkzMDMgMy41MzIxNSAxNi44OTM4IDMuMzEwMjggMTcuNjEwNkMzLjE5ODgzIDE3Ljk3MDcgMy4xMjUxOCAxOC4yNzMyIDMuMDc4NzggMTguNDg5N0MzLjA1NTU2IDE4LjU5ODEgMy4wMzkwOCAxOC42ODUzIDMuMDI4MDUgMTguNzQ3OUMzLjAyMjU0IDE4Ljc3OTIgMy4wMTgzOSAxOC44MDQzIDMuMDE1NDMgMTguODIyOUwzLjAxMTg3IDE4Ljg0NThMMy4wMTA3MyAxOC44NTM1TDMuMDEwMzEgMTguODU2NEwzLjAwOTk5IDE4Ljg1ODZDMi45MzE4OSAxOS40MDUzIDMuMzExNzkgMTkuOTExOCAzLjg1ODUyIDE5Ljk5QzQuNDA0NCAyMC4wNjc5IDQuOTEwMTkgMTkuNjg5NCA0Ljk4OTUyIDE5LjE0NEw0Ljk5MDYyIDE5LjEzNjlDNC45OTE4OCAxOS4xMjkgNC45OTQxOSAxOS4xMTQ5IDQuOTk3NzEgMTkuMDk0OUM1LjAwNDc2IDE5LjA1NDkgNS4wMTY2IDE4Ljk5MTggNS4wMzQzOSAxOC45MDg3QzUuMDcwMDIgMTguNzQyNSA1LjEyOTE5IDE4LjQ5ODEgNS4yMjA4NiAxOC4yMDE5QzUuNDA1MjMgMTcuNjA2MiA1LjcxNTM1IDE2LjgxOTcgNi4yMTYxMiAxNi4wNDA4QzcuMTk3NDMgMTQuNTE0MyA4LjkwODU5IDEzIDExLjk5OTkgMTNDMTUuMDkxMyAxMyAxNi44MDI1IDE0LjUxNDMgMTcuNzgzOCAxNi4wNDA4QzE4LjI4NDUgMTYuODE5NyAxOC41OTQ3IDE3LjYwNjIgMTguNzc5IDE4LjIwMTlDMTguODcwNyAxOC40OTgxIDE4LjkyOTkgMTguNzQyNSAxOC45NjU1IDE4LjkwODdDMTguOTgzMyAxOC45OTE4IDE4Ljk5NTEgMTkuMDU0OSAxOS4wMDIyIDE5LjA5NDlDMTkuMDA0OCAxOS4xMDk4IDE5LjAwNjggMTkuMTIxNSAxOS4wMDgxIDE5LjEyOThDMTkuMDA4NiAxOS4xMzI1IDE5LjAwODkgMTkuMTM0OSAxOS4wMDkzIDE5LjEzNjlMMTkuMDEwMSAxOS4xNDIzTDE5LjAxMDQgMTkuMTQ0QzE5LjA4OTcgMTkuNjg5NCAxOS41OTU1IDIwLjA2NzkgMjAuMTQxNCAxOS45OUMyMC42ODgxIDE5LjkxMTggMjEuMDY4IDE5LjQwNTMgMjAuOTg5OSAxOC44NTg2TDIwLjk4OTYgMTguODU2NEwyMC45ODkyIDE4Ljg1MzVMMjAuOTg4IDE4Ljg0NThMMjAuOTg0NSAxOC44MjI5QzIwLjk4MTUgMTguODA0MyAyMC45NzczIDE4Ljc3OTIgMjAuOTcxOCAxOC43NDc5QzIwLjk2MDggMTguNjg1MyAyMC45NDQzIDE4LjU5ODEgMjAuOTIxMSAxOC40ODk3QzIwLjg3NDcgMTguMjczMiAyMC44MDExIDE3Ljk3MDcgMjAuNjg5NiAxNy42MTA2QzIwLjQ2NzcgMTYuODkzOCAyMC4wOTAzIDE1LjkzMDMgMTkuNDY2MSAxNC45NTkyQzE4LjYyOTkgMTMuNjU4NSAxNy4zNTA1IDEyLjM1MjQgMTUuNDU2MiAxMS42MTMxQzE2LjQwNzUgMTAuNzAyOCAxNi45OTk5IDkuNDIwNiAxNi45OTk5IDhDMTYuOTk5OSA1LjIzODU4IDE0Ljc2MTQgMyAxMS45OTk5IDNaTTguOTk5OTQgOEM4Ljk5OTk0IDYuMzQzMTUgMTAuMzQzMSA1IDExLjk5OTkgNUMxMy42NTY4IDUgMTQuOTk5OSA2LjM0MzE1IDE0Ljk5OTkgOEMxNC45OTk5IDkuNjU2ODUgMTMuNjU2OCAxMSAxMS45OTk5IDExQzEwLjM0MzEgMTEgOC45OTk5NCA5LjY1Njg1IDguOTk5OTQgOFoiIGZpbGw9IiMwMDk0RkYiLz4KPC9zdmc+Cg==" / data-aos="zoom-in" data-aos-delay="100">
                        </div>
                        <div class="p-home-m-seo-numbers-item__textcontent">
                            <div class="p-home-m-seo-numbers-item__head"> <span
                                    data-trans="stats_users_registered">1M+</span>
                            </div>
                            <div class="p-home-m-seo-numbers-item__desc">
                                <p data-trans="numbers_section_accounts_desc" data-aos="fade-up" data-aos-delay="100">Trader accounts</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="p-home-m-seo-numbers-item p-home-m-seo-numbers-item--s" data-aos="zoom-in">
                    <div class="p-home-m-seo-numbers-item__content">
                        <div class="p-home-m-seo-numbers-item__icon"> <img
                                src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik04LjcwNzA3IDEyLjA1QzguMzE2NTUgMTEuNjU5NSA3LjY4MzM4IDExLjY1OTUgNy4yOTI4NiAxMi4wNUwzLjA1MDIyIDE2LjI5MjZDMi42NTk2OSAxNi42ODMxIDIuNjU5NjkgMTcuMzE2MyAzLjA1MDIyIDE3LjcwNjhMNy4yOTI4NiAyMS45NDk1QzcuNjgzMzggMjIuMzQgOC4zMTY1NSAyMi4zNCA4LjcwNzA3IDIxLjk0OTVDOS4wOTc2IDIxLjU1ODkgOS4wOTc2IDIwLjkyNTggOC43MDcwNyAyMC41MzUzTDYuMTcxNTQgMTcuOTk5N0wxMyAxNy45OTk3QzEzLjU1MjMgMTcuOTk5NyAxNCAxNy41NTIgMTQgMTYuOTk5N0MxNCAxNi40NDc0IDEzLjU1MjMgMTUuOTk5NyAxMyAxNS45OTk3TDYuMTcxNTQgMTUuOTk5N0w4LjcwNzA3IDEzLjQ2NDJDOS4wOTc2IDEzLjA3MzcgOS4wOTc2IDEyLjQ0MDUgOC43MDcwNyAxMi4wNVoiIGZpbGw9IiMwMDk0RkYiLz4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNS4yOTI5IDIuMDUwMUMxNS42ODM1IDEuNjU5NTcgMTYuMzE2NiAxLjY1OTU3IDE2LjcwNzEgMi4wNTAxTDIwLjk0OTggNi4yOTI3NEMyMS4zNDAzIDYuNjgzMjYgMjEuMzQwMyA3LjMxNjQyIDIwLjk0OTggNy43MDY5NUwxNi43MDcxIDExLjk0OTZDMTYuMzE2NiAxMi4zNDAxIDE1LjY4MzUgMTIuMzQwMSAxNS4yOTI5IDExLjk0OTZDMTQuOTAyNCAxMS41NTkxIDE0LjkwMjQgMTAuOTI1OSAxNS4yOTI5IDEwLjUzNTRMMTcuODI4NSA3Ljk5OTg0TDExIDcuOTk5ODRDMTAuNDQ3NyA3Ljk5OTg0IDEwIDcuNTUyMTMgMTAgNi45OTk4NEMxMCA2LjQ0NzU2IDEwLjQ0NzcgNS45OTk4NCAxMSA1Ljk5OTg0TDE3LjgyODUgNS45OTk4NEwxNS4yOTI5IDMuNDY0MzFDMTQuOTAyNCAzLjA3Mzc4IDE0LjkwMjQgMi40NDA2MiAxNS4yOTI5IDIuMDUwMVoiIGZpbGw9IiMwMDk0RkYiLz4KPC9zdmc+Cg==" / data-aos="zoom-in" data-aos-delay="100">
                        </div>
                        <div class="p-home-m-seo-numbers-item__textcontent">
                            <div class="p-home-m-seo-numbers-item__head"> <span
                                    data-trans="stats_monthly_transactions">30M+</span></div>
                            <div class="p-home-m-seo-numbers-item__desc">
                                <p data-trans="numbers_section_accounts_transactions_desc" data-aos="fade-up" data-aos-delay="100">Monthly transactions</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="p-home-m-seo-numbers-item p-home-m-seo-numbers-item--s" data-aos="zoom-in">
                    <div class="p-home-m-seo-numbers-item__content">
                        <div class="p-home-m-seo-numbers-item__icon"> <img
                                src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNyA0Ljc3NTA3QzE3IDQuMDkyNTEgMTYuMzMxMyAzLjYxMDU0IDE1LjY4MzggMy44MjYzOEw5LjE2MjI4IDYuMDAwMjJIMTdWNC43NzUwN1pNMTkgNi4wMDAyMlY0Ljc3NTA3QzE5IDIuNzI3NCAxNi45OTM5IDEuMjgxNDggMTUuMDUxMyAxLjkyOTAyTDQuMDUxMzIgNS41OTU2OEMyLjgyNjI5IDYuMDA0MDMgMiA3LjE1MDQ0IDIgOC40NDE3M1YxNy4wMDAyQzIgMTguNjU3MSAzLjM0MzE1IDIwLjAwMDIgNSAyMC4wMDAySDUuNUM2LjA1MjI4IDIwLjAwMDIgNi41IDE5LjU1MjUgNi41IDE5LjAwMDJDNi41IDE4LjQ0NzkgNi4wNTIyOCAxOC4wMDAyIDUuNSAxOC4wMDAySDVDNC40NDc3MiAxOC4wMDAyIDQgMTcuNTUyNSA0IDE3LjAwMDJWOS4wMDAyMkM0IDguNDQ3OTMgNC40NDc3MiA4LjAwMDIyIDUgOC4wMDAyMkgxOUMxOS41NTIzIDguMDAwMjIgMjAgOC40NDc5MyAyMCA5LjAwMDIyVjE3LjAwMDJDMjAgMTcuNTUyNSAxOS41NTIzIDE4LjAwMDIgMTkgMTguMDAwMkgxOC41QzE3Ljk0NzcgMTguMDAwMiAxNy41IDE4LjQ0NzkgMTcuNSAxOS4wMDAyQzE3LjUgMTkuNTUyNSAxNy45NDc3IDIwLjAwMDIgMTguNSAyMC4wMDAySDE5QzIwLjY1NjkgMjAuMDAwMiAyMiAxOC42NTcxIDIyIDE3LjAwMDJWOS4wMDAyMkMyMiA3LjM0MzM2IDIwLjY1NjkgNi4wMDAyMiAxOSA2LjAwMDIyWk0xMiAxMS4wMDAyQzEyLjU1MjMgMTEuMDAwMiAxMyAxMS40NDc5IDEzIDEyLjAwMDJWMTguNTk4OUwxNC4yOTU2IDE3LjMxMzFDMTQuNjg3NiAxNi45MjQxIDE1LjMyMDggMTYuOTI2NSAxNS43MDk4IDE3LjMxODVDMTYuMDk4OCAxNy43MTA1IDE2LjA5NjQgMTguMzQzNyAxNS43MDQ0IDE4LjczMjdMMTIuNzA0NCAyMS43MUMxMi4zMTQ1IDIyLjA5NyAxMS42ODU1IDIyLjA5NyAxMS4yOTU2IDIxLjcxTDguMjk1NTggMTguNzMyN0M3LjkwMzU4IDE4LjM0MzcgNy45MDExNyAxNy43MTA1IDguMjkwMjEgMTcuMzE4NUM4LjY3OTI1IDE2LjkyNjUgOS4zMTI0MSAxNi45MjQxIDkuNzA0NDIgMTcuMzEzMUwxMSAxOC41OTg5VjEyLjAwMDJDMTEgMTEuNDQ3OSAxMS40NDc3IDExLjAwMDIgMTIgMTEuMDAwMloiIGZpbGw9IiMwMDk0RkYiLz4KPC9zdmc+Cg==" / data-aos="zoom-in" data-aos-delay="100">
                        </div>
                        <div class="p-home-m-seo-numbers-item__textcontent">
                            <div class="p-home-m-seo-numbers-item__head"> <span
                                    data-trans="stats_withdrawals_per_month">$16M+</span></div>
                            <div class="p-home-m-seo-numbers-item__desc">
                                <p data-trans="numbers_section_accounts_payouts_desc" data-aos="fade-up" data-aos-delay="100">Average monthly payouts</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="p-home-m-seo-numbers-item p-home-m-seo-numbers-item--s">
                    <div class="p-home-m-seo-numbers-item__content" class="about-card">
                        <div class="p-home-m-seo-numbers-item__icon"> <img
                                src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMiA0QzcuNTgxNzIgNCA0IDcuNTgxNzIgNCAxMkM0IDE2LjQxODMgNy41ODE3MiAyMCAxMiAyMEMxNC4yMDc0IDIwIDE2LjIwNDUgMTkuMTA3MyAxNy42NTMgMTcuNjYwN0MxOC4wNDM4IDE3LjI3MDUgMTguNjc2OSAxNy4yNzA5IDE5LjA2NzIgMTcuNjYxN0MxOS40NTc0IDE4LjA1MjUgMTkuNDU3IDE4LjY4NTcgMTkuMDY2MiAxOS4wNzU5QzE3LjI1OCAyMC44ODE2IDE0Ljc1ODcgMjIgMTIgMjJDNi40NzcxNSAyMiAyIDE3LjUyMjggMiAxMkMyIDYuNDc3MTUgNi40NzcxNSAyIDEyIDJDMTYuMDkxIDIgMTkuNjA2OCA0LjQ3ODI4IDIxLjE1ODQgNy45OTk4NEwyMS44MDgyIDYuNDg4ODFDMjIuMDI2MyA1Ljk4MTQ0IDIyLjYxNDUgNS43NDcgMjMuMTIxOSA1Ljk2NTE3QzIzLjYyOTIgNi4xODMzMyAyMy44NjM3IDYuNzcxNDkgMjMuNjQ1NSA3LjI3ODg2TDIxLjg2NzkgMTEuNDEyOUMyMS42NDk3IDExLjkyMDIgMjEuMDYxNiAxMi4xNTQ3IDIwLjU1NDIgMTEuOTM2NUwxNi40MjAyIDEwLjE1ODlDMTUuOTEyOCA5Ljk0MDc0IDE1LjY3ODQgOS4zNTI1OCAxNS44OTY1IDguODQ1MjFDMTYuMTE0NyA4LjMzNzg1IDE2LjcwMjkgOC4xMDM0IDE3LjIxMDIgOC4zMjE1N0wxOS41MzQxIDkuMzIwODFDMTguNDIwNSA2LjIyNzY4IDE1LjQ2MTcgNCAxMiA0WiIgZmlsbD0iIzAwOTRGRiIvPgo8L3N2Zz4K" / data-aos="zoom-in" data-aos-delay="100">
                        </div>
                        <div class="p-home-m-seo-numbers-item__textcontent">
                            <div class="p-home-m-seo-numbers-item__head"> <span
                                    data-trans="stats_monthly_trade_turnover">$211M</span></div>
                            <div class="p-home-m-seo-numbers-item__desc">
                                <p data-trans="numbers_section_accounts_turnover_desc" data-aos="fade-up" data-aos-delay="100">Monthly trade turnover</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </section>
        <div
            style="padding:0px 40px;box-sizing:content-box;max-width:1140px;margin-left: auto;margin-right: auto;vertical-align:baseline;font:16px;background: linear-gradient(transparent 0%,#000 95%),radial-gradient(194.14% 91.43% at 2.43% 88.15%,rgba(10,10,10,.8) 0%,rgba(10,10,10,0) 100%),conic-gradient(from 5deg at 92.78% 73.8%,rgba(65,64,62,.4) 0deg,rgba(37,37,35,.4) 360deg),conic-gradient(from -49deg at 85.69% 75.64%,rgba(98,97,97,.3) 0deg,rgba(37,37,37,.3) 360deg),#0a0a0a;">
            <div
                style="flex-direction:row;gap:45.09px;vertical-align:baseline;font:16px;justify-content:space-between;display:flex;">
                <div
                    style="gap:32px;max-width:460px;vertical-align:baseline;font:16px;justify-content:center;flex-direction:column;flex-shrink:0;display:flex;">
                    <h2
                        style="font-size: 2.5rem;line-height:60px;font-weight:700;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;" data-aos="fade-up">
                        <span
                            style="clip:rect(0px, 0px, 0px, 0px);border:0px none rgb(255, 255, 255);width: 1px;height:1px;margin:-1px;padding:0px;position:absolute;overflow:hidden;vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';">Trusted
                            by millions of traders</span><span role="presentation" aria-hidden="true"
                            style="vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';border:0px none rgb(255, 255, 255);margin:0px;padding:0px;"><span
                                style="clip-path: inset(-10% -5%); transform: none;transform:none;display:inline-block;vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">Trusted</span>
                            <span
                                style="clip-path: inset(-10% -5%); transform: none;transform:none;display:inline-block;vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">by</span>
                            <span
                                style="clip-path: inset(-10% -5%); transform: none;transform:none;display:inline-block;vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">millions</span>
                            <span
                                style="clip-path: inset(-10% -5%); transform: none;transform:none;display:inline-block;vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">of</span>
                            <span
                                style="clip-path: inset(-10% -5%); transform: none;transform:none;display:inline-block;vertical-align:baseline;font:700 48px / 60px Roboto, 'Roboto Fallback';border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">traders</span></span>
                    </h2>
                    <div
                        style="align-items:start;vertical-align:baseline;font:16px;--duration: .4s;--animation-func: cubic-bezier(.33,1,.68,1);flex-direction:column;gap:16px;display:flex;">
                        <a data-event-label="Open free account" href="https://app.glidelogiccopytrading.com/register"
                            style="width: initial;background:var(--inst-accent) none repeat scroll 0% 0% / auto padding-box border-box;box-shadow:rgba(55, 96, 255, 0.5) 0px 4px 0px 0px, rgb(10, 10, 10) 0px 0px 0px 1px inset;margin-bottom:4px;font-size:16px;line-height:24px;font-weight:500;border-radius:8px;padding:12px 24px;appearance:none;cursor:pointer;user-select:none;outline:rgb(255, 255, 255) none 0px;justify-content:center;align-items:center;text-decoration:none solid rgb(255, 255, 255);display:flex;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px 0px 4px;white-space:nowrap;">Open
                            free account</a>
                        <div
                            style="font-size:14px;line-height:20px;vertical-align:baseline;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                            It takes 30 seconds to register</div>
                    </div>
                </div>
                <div style="display:flex;vertical-align:baseline;font:16px;flex-direction:column;gap:16px;">
                    <div
                        style="vertical-align:baseline;font:16px;border: 0px;margin:0px;padding:0px 0px 16px;border-bottom:1px solid rgb(85, 85, 86);padding-bottom:16px;">
                        <div style="gap:16px;vertical-align:baseline;font:16px;display:flex;align-items: center;">
                            <img alt="summary" loading="lazy" width="292" height="288" decoding="async"
                                data-nimg="1" src="/assets/summary.webp"
                                style="color: transparent;vertical-align:baseline;font:16px;border:0px none rgba(0, 0, 0, 0);margin:4px 0px 0px;padding:0px;width: 32px;height:32px;margin-top:4px;" / data-aos="zoom-in" data-aos-delay="100">
                            <div style="vertical-align:baseline;font:16px;flex-direction:column;display:flex;">
                                <p
                                    style="margin-bottom:8px;font-size:28px;line-height:36px;vertical-align:baseline;border:0px none rgb(255, 255, 255);padding:0px;font-weight:700;" data-aos="fade-up" data-aos-delay="100">
                                    Licensed and regulated</p>
                                <p
                                    style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(181, 181, 181);margin:0px 0px 12px;padding:0px;font-weight:400;margin-bottom:12px;" data-aos="fade-up" data-aos-delay="100">
                                    {{ $settings->site_name }} is authorized financial services provider and cryptocurrency exchange.</p><a
                                    href="/regulations"
                                    style="padding:0px;text-decoration:none solid rgb(255, 255, 255);vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;font-weight:500;cursor:pointer;align-items:center;gap:4px;width: fit-content;font-size:14px;line-height:20px;display:flex;">Our
                                    licenses <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="width: 16px;height:16px;">
                                        <path
                                            d="M4.5 11.25C4.08579 11.25 3.75 11.5858 3.75 12C3.75 12.4142 4.08579 12.75 4.5 12.75V11.25ZM20.0303 12.5303C20.3232 12.2374 20.3232 11.7626 20.0303 11.4697L15.2574 6.6967C14.9645 6.40381 14.4896 6.40381 14.1967 6.6967C13.9038 6.98959 13.9038 7.46447 14.1967 7.75736L18.4393 12L14.1967 16.2426C13.9038 16.5355 13.9038 17.0104 14.1967 17.3033C14.4896 17.5962 14.9645 17.5962 15.2574 17.3033L20.0303 12.5303ZM4.5 12.75H19.5V11.25H4.5V12.75Z"
                                            fill="currentcolor" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div
                        style="vertical-align:baseline;font:16px;border: 0px;margin:0px;padding:0px 0px 16px;border-bottom:1px solid rgb(85, 85, 86);padding-bottom:16px;">
                        <div style="gap:16px;vertical-align:baseline;font:16px;display:flex;align-items: center;">
                            <img alt="margin" loading="lazy" width="288" height="288" decoding="async"
                                data-nimg="1" src="/assets/margin.webp"
                                style="color: transparent;vertical-align:baseline;font:16px;border:0px none rgba(0, 0, 0, 0);margin:4px 0px 0px;padding:0px;width: 32px;height:32px;margin-top:4px;" / data-aos="zoom-in" data-aos-delay="100">
                            <div style="vertical-align:baseline;font:16px;flex-direction:column;display:flex;">
                                <p
                                    style="margin-bottom:8px;font-size:28px;line-height:36px;vertical-align:baseline;border:0px none rgb(255, 255, 255);padding:0px;font-weight:700;" data-aos="fade-up" data-aos-delay="100">
                                    Transparent trading conditions</p>
                                <p
                                    style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(181, 181, 181);margin:0px 0px 12px;padding:0px;font-weight:400;margin-bottom:12px;" data-aos="fade-up" data-aos-delay="100">
                                    Fees from 0% with no hidden costs.</p><a href="https://app.glidelogiccopytrading.com/register"
                                    style="padding:0px;text-decoration:none solid rgb(255, 255, 255);vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;font-weight:500;cursor:pointer;align-items:center;gap:4px;width: fit-content;font-size:14px;line-height:20px;display:flex;">Start
                                    trading <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="width: 16px;height:16px;">
                                        <path
                                            d="M4.5 11.25C4.08579 11.25 3.75 11.5858 3.75 12C3.75 12.4142 4.08579 12.75 4.5 12.75V11.25ZM20.0303 12.5303C20.3232 12.2374 20.3232 11.7626 20.0303 11.4697L15.2574 6.6967C14.9645 6.40381 14.4896 6.40381 14.1967 6.6967C13.9038 6.98959 13.9038 7.46447 14.1967 7.75736L18.4393 12L14.1967 16.2426C13.9038 16.5355 13.9038 17.0104 14.1967 17.3033C14.4896 17.5962 14.9645 17.5962 15.2574 17.3033L20.0303 12.5303ZM4.5 12.75H19.5V11.25H4.5V12.75Z"
                                            fill="currentcolor" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div style="vertical-align:baseline;font:16px;border-bottom:0px none rgb(0, 0, 0);padding-bottom:0px;">
                        <div style="gap:16px;vertical-align:baseline;font:16px;display:flex;align-items: center;">
                            <img alt="support" loading="lazy" width="288" height="288" decoding="async"
                                data-nimg="1" src="/assets/support.webp"
                                style="color: transparent;vertical-align:baseline;font:16px;border:0px none rgba(0, 0, 0, 0);margin:4px 0px 0px;padding:0px;width: 32px;height:32px;margin-top:4px;" / data-aos="zoom-in" data-aos-delay="100">
                            <div style="vertical-align:baseline;font:16px;flex-direction:column;display:flex;">
                                <p
                                    style="margin-bottom:8px;font-size:28px;line-height:36px;vertical-align:baseline;border:0px none rgb(255, 255, 255);padding:0px;font-weight:700;" data-aos="fade-up" data-aos-delay="100">
                                    Always by your side</p>
                                <p
                                    style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(181, 181, 181);margin:0px 0px 12px;padding:0px;font-weight:400;margin-bottom:12px;" data-aos="fade-up" data-aos-delay="100">
                                    24/7 live support with a 30-second average response time.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section bg-light" style="background: var(--inst-bg-sec); border-top: 1px solid var(--inst-border); border-bottom: 1px solid var(--inst-border)">
            <div class="page__container" data-aos="zoom-in"
                style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                <div class="fade-up">
                    <h3 style="color: var(--inst-text);margin-top:0">Fast, Seamless Navigation</h3>
                    <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                        The interface is built for speed — switch between markets, charts, and orders in seconds with
                        minimal clicks. Whether you're a beginner or a pro, everything is exactly where you'd expect it to
                        be.
                    </p>
                </div>
                <div class="fade-up">
                    <h3 style="color: var(--inst-text);margin-top:0">Powerful Built-In Charts</h3>
                    <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                        Analyze the market with interactive charts, technical indicators, and drawing tools — all directly
                        in the platform. No need for third-party tools to stay ahead of the trends.
                    </p>
                </div>
                <div class="fade-up">
                    <h3 style="color: var(--inst-text);margin-top:0">Lightning-Fast Order Execution</h3>
                    <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                        Place trades instantly with one-click execution and manage them easily with advanced order types
                        like stop-loss and limit orders. Every action is responsive and reliable.
                    </p>
                </div>
                <div class="fade-up">
                    <h3 style="color: var(--inst-text);margin-top:0">Real-Time Data & Smart Alerts</h3>
                    <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                        Stay in control with live price feeds and customizable alerts. Get notified of price movements or
                        trade activity the moment it happens — no delays, no missed opportunities.
                    </p>
                </div>
            </div>
            <div class="page__container">
                <div style="margin: 32px 0;">
                    <h3 style="color: var(--inst-text); margin-top: 0;">Seamless trading with secure funding options</h3>
                    <p style="color: var(--inst-text);" data-aos="fade-up" data-aos-delay="100">
                        Fund your account quickly and securely with a variety of trusted payment methods. Our platform
                        ensures your deposits and withdrawals are processed efficiently, so you can focus on trading with
                        confidence and peace of mind.
                    </p>
                </div>
            </div>
            <div style="overflow: hidden; width: 100%; position: relative; height: 60px;">
                <div class="scrolling-strip"
                    style="display: flex; align-items: center; white-space: nowrap; animation: scroll-strip 20s linear infinite;">
                    <img src="/assets/strip-b.svg" style="height: 100px;" / data-aos="zoom-in" data-aos-delay="100">
                    <img src="/assets/strip-b.svg" style="height: 100px;" / data-aos="zoom-in" data-aos-delay="100">
                    <img src="/assets/strip-b.svg" style="height: 100px;" / data-aos="zoom-in" data-aos-delay="100">
                    <img src="/assets/strip-b.svg" style="height: 100px;" / data-aos="zoom-in" data-aos-delay="100">
                </div>
            </div>
            <style>
                @keyframes scroll-strip {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(-50%);
                    }
                }

                .scrolling-strip {
                    width: 200%;
                }
            </style>
        </section>
        <section class="p-home-m-seoblog p-home__section page__container">
            <div
                style="border:0px solid rgb(229, 231, 235);background:rgba(0, 0, 0, 0) url('https://naga.com/images/markets/tradeOn/stock-cfds.jpeg') no-repeat scroll 0% 0% / cover padding-box border-box;border-radius:21px;padding:87px 87px 63px;display:flex;-webkit-box-pack:justify;justify-content:space-between;border-width:0px;border-style:solid;">
                <div
                    style="border:0px solid rgb(229, 231, 235);margin-right:20px;max-width:320px;width: 100%;border-width:0px;border-style:solid;">
                    <div color="white"
                        style="font-size:32px;border:0px solid rgb(229, 231, 235);border-width:0px;border-style:solid;font-weight:700;line-height:35.2px;margin-bottom:42px;letter-spacing:-0.64px;">
                        Trade Stock derivatives:</div>
                    <div style="color: #fff" data-aos="slide-up">
                        <strong>Access a Wide Range of Instruments –</strong> Trade options, futures, and other stock
                        derivatives across
                        major global markets.
                    </div>
                    <div style="color: #fff" data-aos="slide-up">
                        <strong>Leverage Market Opportunities –</strong> Use derivatives to hedge, speculate, or enhance
                        portfolio
                        performance with strategic exposure.
                    </div>
                    <div style="color: #fff" data-aos="slide-up">
                        <strong>Advanced Tools & Real-Time Data –</strong> Make informed decisions with powerful trading
                        tools, analytics,
                        and up-to-the-second market data.
                    </div>
                </div>
                <div
                    style="border:0px solid rgb(229, 231, 235);max-width:500px;width: 100%;border-width:0px;border-style:solid;">
                    <div
                        style="border:0px solid rgb(229, 231, 235);border-width:0px;border-style:solid;position:relative;overflow:hidden;width: 100%;line-height:0px;">
                        <span
                            style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative;display:block;overflow:hidden;width: initial;height:387.57px;opacity:1;border:0px none rgb(34, 34, 34);margin:0px;padding:0px;position:relative;border-width:0px;border-style:none;"><span
                                style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 77.5148% 0px 0px;display:block;width: initial;height:387.57px;opacity:1;border:0px none rgb(34, 34, 34);margin:0px;padding:387.57px 0px 0px;border-width:0px;border-style:none;"></span></span>
                    </div>
                </div>
            </div>
        </section>
        <section class="p-home-m-seoblog p-home__section page__container">
            <div class="p-home-m-seoblog__head-wrap">
                <div class="p-home-m-seoblog__head-text-wrap">
                    <h2 class="com-c-title p-home-m-seoblog__title" data-trans="seoblog_title" data-aos="fade-up">Mirror Trading</h2>

                </div>
            </div>
            <div class="p-home-m-seoblog__list-wrap" style="max-width: 60%">
                <ul class="p-home-m-seoblog__list" style="padding: 0;">
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="/option-trading"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-img-wrap">
                                <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                        class="p-home-m-seoblog__link-card-title">Copy Option Trading
                                        <br /> Copy trading is a type of trading where you copy the trades performed by
                                        another, more experienced trader. It can be manual, semi-automatic or fully
                                        automatic.</span></div>
                        </a></li>
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="/advance-trading"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                    class="p-home-m-seoblog__link-card-title">Advance Trading <br />
                                    The trade entry and exit rules can be based on simple conditions such as a moving
                                    average crossover or they can be complicated strategies that require a comprehensive
                                    understanding of the programming language specific to the user's trading platform.
                                </span></div>
                        </a></li>
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="live-trading"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                    class="p-home-m-seoblog__link-card-title">Cryptocurrency Trading <br />
                                    Trade popular cryptocurrencies like Bitcoin, Ethereum, and more with ease. Our platform
                                    offers secure
                                    transactions, real-time pricing, and advanced tools to help you capitalize on the
                                    dynamic crypto
                                    market—whether you're a beginner or an experienced trader.
                        </a></li>
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in">
                        <a href="/risk-management" class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;">
                                <span class="p-home-m-seoblog__link-card-title">
                                    Risk Management Tools <br />
                                    Utilize advanced risk management features such as stop-loss, take-profit, and negative
                                    balance protection to help safeguard your investments and trade with greater confidence.
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
                </span>
            </div>
        </section>
        <section class="section bg-light" style="background: var(--inst-bg-sec); border-top: 1px solid var(--inst-border); border-bottom: 1px solid var(--inst-border)">
            <div class="page__container">
                <h2 class="com-c-title" data-aos="slide-up" style="" data-aos="fade-up">Why
                    trade Forex with us?</h2>
                <p data-aos="slide-up" style="">All
                    you need to become a
                    trading guru gathered in one place: education, analytics, video lessons,<br /> trading tips, market
                    news, and so much more!</p>
                <div style="display: flex">
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;width:60%">
                        <div data-aos="slide-up">
                            <img src="/assets/pair.svg" / data-aos="zoom-in" data-aos-delay="100">
                            <h3 style="color: var(--inst-text);margin-top:0">60+ Currency Pairs</h3>
                            <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                                Trade more than 60 currency pairs including Major, Minor, and Exotics.
                            </p>
                        </div>
                        <div data-aos="slide-up">
                            <img src="/assets/leverage.svg" / data-aos="zoom-in" data-aos-delay="100">
                            <h3 style="color: var(--inst-text);margin-top:0">Up to 1:2000 Leverage</h3>
                            <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                                Take advantage of leverage up to 1:2000 to potentially earn larger profits with a smaller
                                initial investment.
                            </p>
                        </div>
                        <div data-aos="slide-up">
                            <img src="/assets/spread.svg" / data-aos="zoom-in" data-aos-delay="100">
                            <h3 style="color: var(--inst-text);margin-top:0">Ultra-tight spreads</h3>
                            <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                                With 0.0 pips as the lowest spreads, increase your profits on each trade.
                            </p>
                        </div>
                        <div data-aos="slide-up">
                            <img src="/assets/speed.svg" / data-aos="zoom-in" data-aos-delay="100">
                            <h3 style="color: var(--inst-text);margin-top:0">High Execution Speed</h3>
                            <p style="color: var(--inst-text)" data-aos="fade-up" data-aos-delay="100">
                                Order execution from 0.1 seconds for a smoother and fast trading experience.
                            </p>
                        </div>
                    </div>
                    <div class="about-card">
                        <div class="tradingview-widget-container" data-aos="zoom-in">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/"
                                    rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on
                                        TradingView</span></a></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="p-home-m-seoblog p-home__section page__container" style="background: linear-gradient(transparent 0%,#000 95%),radial-gradient(194.14% 91.43% at 2.43% 88.15%,rgba(10,10,10,.8) 0%,rgba(10,10,10,0) 100%),conic-gradient(from 5deg at 92.78% 73.8%,rgba(65,64,62,.4) 0deg,rgba(37,37,35,.4) 360deg),conic-gradient(from -49deg at 85.69% 75.64%,rgba(98,97,97,.3) 0deg,rgba(37,37,37,.3) 360deg),#0a0a0a">
            <div style="padding-top:120px;padding-bottom:120px;display:flex;width: 100%;flex-direction:column;">
                <h2
                    style="font-size:54px;line-height:56.7px;letter-spacing:-0.5px;text-align:center;text-wrap:pretty;font-weight:700;margin:0px;" data-aos="fade-up">
                    <span style="color:var(--inst-accent);">Why</span>
                    copy trading?
                </h2>
                <div
                    style="padding-top:64px;padding-bottom:40px;flex-direction:row;justify-content:center;flex-wrap:wrap;width: 100%;display:flex;">
                    <div style="max-width:calc(33.33% - 27px);justify-content:center;flex-direction:row;display:flex;">
                        <div
                            style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;border-width:0px;border-bottom-color:rgba(64, 74, 94, 0.5);border-bottom-width:0px;align-items:center;flex-direction:column;display:flex;box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-style:solid;">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;display:block;overflow:hidden;width: initial;height:85px;opacity:1;position:relative;max-width:100%;border-width:0px;border-style:none;"><span
                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;display:block;width: initial;height:85px;opacity:1;max-width:100%;border-width:0px;border-style:none;"><img
                                        alt="" aria-hidden="true" src="/assets/icon-1.png"
                                        style="display: block;height:85px;filter:invert(1)" / data-aos="zoom-in" data-aos-delay="100"></span></span>
                            <h4 
                                data-aos="slide-up" style="padding-top:36px;line-height:28.8px;font-weight:700;font-size:24px;text-align:center;padding-bottom:12px;text-wrap:pretty;margin:0px;">
                                Get results while others do the work</h4>
                            <p
                                data-aos="slide-up" style="font-size:16px;line-height:24px;text-align:center;text-wrap:pretty;margin:0px;">
                                Spend less time analyzing markets or manually setting strategies. Sit back and watch as your
                                portfolio replicates automatically.</p>
                        </div>
                        <div style="display:flex;">
                            <div role="separator"
                                style="box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-width:0px 0px 0px 1px;border-style:none none none solid;border-top-style:none;border-right-style:none;border-bottom-style:none;border-top-border-right-border-bottom-border-image:none;align-self:stretch;height: auto;border-left-color:rgba(64, 74, 94, 0.5);border-left-style:solid;">
                            </div>
                        </div>
                    </div>
                    <div style="max-width:calc(33.33% - 27px);justify-content:center;flex-direction:row;display:flex;">
                        <div
                            style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;border-width:0px;border-bottom-color:rgba(64, 74, 94, 0.5);border-bottom-width:0px;align-items:center;flex-direction:column;display:flex;box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-style:solid;">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;display:block;overflow:hidden;width: initial;height:85px;opacity:1;position:relative;max-width:100%;border-width:0px;border-style:none;"><span
                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;display:block;width: initial;height:85px;opacity:1;max-width:100%;border-width:0px;border-style:none;"><img
                                        alt="" aria-hidden="true" src="/assets/icon-2.png"
                                        style="display: block;height:85px;filter:invert(1)" / data-aos="zoom-in" data-aos-delay="100"></span></span>
                            <h4
                                data-aos="slide-up" style="padding-top:36px;line-height:28.8px;font-weight:700;font-size:24px;text-align:center;padding-bottom:12px;text-wrap:pretty;margin:0px;">
                                A trading masterclass in real-time</h4>
                            <p
                                data-aos="slide-up" style="font-size:16px;line-height:24px;text-align:center;text-wrap:pretty;margin:0px;">
                                Gain valuable insights into market trends, strategies, and risk management — all while
                                observing real-world trading in action.</p>
                        </div>
                        <div style="display:flex;">
                            <div role="separator"
                                style="box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-width:0px 0px 0px 1px;border-style:none none none solid;border-top-style:none;border-right-style:none;border-bottom-style:none;border-top-border-right-border-bottom-border-image:none;align-self:stretch;height: auto;border-left-color:rgba(64, 74, 94, 0.5);border-left-style:solid;">
                            </div>
                        </div>
                    </div>
                    <div style="max-width:calc(33.33% - 27px);justify-content:center;flex-direction:row;display:flex;">
                        <div
                            style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;border-width:0px;border-bottom-color:rgba(64, 74, 94, 0.5);border-bottom-width:0px;align-items:center;flex-direction:column;display:flex;box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-style:solid;">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;display:block;overflow:hidden;width: initial;height:85px;opacity:1;position:relative;max-width:100%;border-width:0px;border-style:none;"><span
                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;display:block;width: initial;height:85px;opacity:1;max-width:100%;border-width:0px;border-style:none;"><img
                                        alt="" aria-hidden="true" src="/assets/icon-3.png"
                                        style="display: block;height:85px;filter:invert(1)" / data-aos="zoom-in" data-aos-delay="100"></span></span>
                            <h4
                                data-aos="slide-up" style="padding-top:36px;line-height:28.8px;font-weight:700;font-size:24px;text-align:center;padding-bottom:12px;text-wrap:pretty;margin:0px;">
                                Trade at the same price as the top traders</h4>
                            <p
                                data-aos="slide-up" style="font-size:16px;line-height:24px;text-align:center;text-wrap:pretty;margin:0px;">
                                Get the same execution price as the trader you are copying through a built-in price-matching
                                algorithm.</p>
                        </div>
                        <div style="display:flex;">
                        </div>
                    </div>
                </div>
                <div style="display:block;">
                    <div role="separator"
                        style="box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-width:1px 0px 0px;border-style:solid none none;border-right-style:none;border-bottom-style:none;border-left-style:none;border-right-border-bottom-border-left-border-image:none;border-top-color:rgba(64, 74, 94, 0.5);border-top-style:solid;margin:0px;">
                    </div>
                </div>
                <div
                    style="padding-top:64px;padding-bottom:0px;flex-direction:row;justify-content:center;flex-wrap:wrap;width: 100%;display:flex;">
                    <div style="max-width:calc(33.33% - 27px);justify-content:center;flex-direction:row;display:flex;">
                        <div
                            style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;border-width:0px;border-bottom-color:rgba(64, 74, 94, 0.5);border-bottom-width:0px;align-items:center;flex-direction:column;display:flex;box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-style:solid;">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;display:block;overflow:hidden;width: initial;height:85px;opacity:1;position:relative;max-width:100%;border-width:0px;border-style:none;"><span
                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;display:block;width: initial;height:85px;opacity:1;max-width:100%;border-width:0px;border-style:none;"><img
                                        alt="" aria-hidden="true" src="/assets/icon-4.png"
                                        style="display: block;height:85px;filter:invert(1)" / data-aos="zoom-in" data-aos-delay="100"></span></span>
                            <h4
                                data-aos="slide-up" style="padding-top:36px;line-height:28.8px;font-weight:700;font-size:24px;text-align:center;padding-bottom:12px;text-wrap:pretty;margin:0px;">
                                Maintain full control</h4>
                            <p
                                data-aos="slide-up" style="font-size:16px;line-height:24px;text-align:center;text-wrap:pretty;margin:0px;">
                                Customize your risk exposure with individual Stop Loss and Take Profit limits for each
                                trade.</p>
                        </div>
                        <div style="display:flex;">
                            <div role="separator"
                                style="box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-width:0px 0px 0px 1px;border-style:none none none solid;border-top-style:none;border-right-style:none;border-bottom-style:none;border-top-border-right-border-bottom-border-image:none;align-self:stretch;height: auto;border-left-color:rgba(64, 74, 94, 0.5);border-left-style:solid;">
                            </div>
                        </div>
                    </div>
                    <div style="max-width:calc(33.33% - 27px);justify-content:center;flex-direction:row;display:flex;">
                        <div
                            style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;border-width:0px;border-bottom-color:rgba(64, 74, 94, 0.5);border-bottom-width:0px;align-items:center;flex-direction:column;display:flex;box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-style:solid;">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;display:block;overflow:hidden;width: initial;height:85px;opacity:1;position:relative;max-width:100%;border-width:0px;border-style:none;"><span
                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;display:block;width: initial;height:85px;opacity:1;max-width:100%;border-width:0px;border-style:none;"><img
                                        alt="" aria-hidden="true" src="/assets/icon-5.png"
                                        style="display: block;height:85px;filter:invert(1)" / data-aos="zoom-in" data-aos-delay="100"></span></span>
                            <h4
                                data-aos="slide-up" style="padding-top:36px;line-height:28.8px;font-weight:700;font-size:24px;text-align:center;padding-bottom:12px;text-wrap:pretty;margin:0px;">
                                Real traders, real results</h4>
                            <p
                                data-aos="slide-up" style="font-size:16px;line-height:24px;text-align:center;text-wrap:pretty;margin:0px;">
                                Tap into the expertise of real traders and mirror their tried and tested strategies to
                                achieve your desired results.</p>
                        </div>
                        <div style="display:flex;">
                            <div role="separator"
                                style="box-sizing:border-box;border: 0px solid rgb(229, 231, 235);border-width:0px 0px 0px 1px;border-style:none none none solid;border-top-style:none;border-right-style:none;border-bottom-style:none;border-top-border-right-border-bottom-border-image:none;align-self:stretch;height: auto;border-left-color:rgba(64, 74, 94, 0.5);border-left-style:solid;">
                            </div>
                        </div>
                    </div>
                    <div style="max-width:calc(33.33% - 27px);justify-content:center;flex-direction:row;display:flex;">
                        <div
                            style="padding-top:0px;padding-bottom:0px;padding-left:40px;padding-right:40px;border-width:0px;align-items:center;flex-direction:column;display:flex;box-sizing:border-box;border:0px solid rgb(229, 231, 235);border-style:solid;">
                            <span
                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;display:block;overflow:hidden;width: initial;height:85px;opacity:1;position:relative;max-width:100%;border-width:0px;border-style:none;"><span
                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;display:block;width: initial;height:85px;opacity:1;max-width:100%;border-width:0px;border-style:none;"><img
                                        alt="" aria-hidden="true" src="/assets/icon-6.png"
                                        style="display: block;height:85px;filter:invert(1)" / data-aos="zoom-in" data-aos-delay="100"></span></span>
                            <h4
                                data-aos="slide-up" style="padding-top:36px;line-height:28.8px;font-weight:700;font-size:24px;text-align:center;padding-bottom:12px;text-wrap:pretty;margin:0px;">
                                Complete flexibility</h4>
                            <p
                                data-aos="slide-up" style="font-size:16px;line-height:24px;text-align:center;text-wrap:pretty;margin:0px;">
                                Enjoy the freedom to start, stop, or modify your copy trading settings at any time, adapting
                                to changing market conditions.</p>
                        </div>
                        <div style="display:flex;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="p-home-m-seoblog p-home__section page__container">
            <div class="p-home-m-seoblog__head-wrap">
                <div class="p-home-m-seoblog__head-text-wrap">
                    <h2 class="com-c-title p-home-m-seoblog__title" data-trans="seoblog_title" data-aos="fade-up">Stocks</h2>
                </div>
            </div>
            <div class="p-home-m-seoblog__list-wrap" style="max-width: 60%">
                <ul class="p-home-m-seoblog__list" style="padding: 0;">
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="/swing-trading"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-img-wrap">
                                <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                        class="p-home-m-seoblog__link-card-title">Swing Trading <br /> Swing trading is a
                                        style of trading that attempts to capture short- to medium-term gains in a stock (or
                                        any financial instrument) over a period of a few days to several weeks. Swing
                                        traders primarily use technical analysis to look for trading opportunities.</span>
                                </div>
                        </a></li>
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="/futures"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                    class="p-home-m-seoblog__link-card-title">Futures <br />
                                    Futures contracts also exist for bonds and even bitcoin. Some traders like trading
                                    futures because they can take a substantial position (the amount invested) while putting
                                    up a relatively small amount of cash. That gives them greater potential for leverage
                                    than just owning the securities directly.
                                </span></div>
                        </a></li>
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="option-trading"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                    class="p-home-m-seoblog__link-card-title">Options <br />
                                    Buying stocks and holding on to them with a view to making long term gains is after all,
                                    one of the more common investment strategies. It's also a perfectly sensible to way
                                    invest, providing you have some idea about which stocks
                                </span></div>
                        </a></li>
                    <li class="p-home-m-seoblog__link" data-aos="zoom-in"><a href="#"
                            class="p-home-m-seoblog__link-card">
                            <div class="p-home-m-seoblog__link-card-img-wrap">
                                <div class="p-home-m-seoblog__link-card-title-wrap" style="color: #fff;"><span
                                        class="p-home-m-seoblog__link-card-title">Oil and Gas <br /> with {{ $settings->site_name }} Copy
                                        Trading
                                        Trade</span></div>
                        </a></li>
                </ul>
            </div>
        </section>
        <section class="p-home-m-seo-for-everyone p-home__section page__container">
            <h2 class="com-c-title p-home-m-seo-for-everyone__title" data-aos="slide-up" data-aos="fade-up">Find Yourself
                on {{ $settings->site_name }}</h2>
            <div class="p-home-m-seo-for-everyone__list-wrap">
                <ul style="display: flex;padding:0;flex-wrap: wrap;">
                    <div style="width: 50%;">
                        <li class="p-home-m-seo-for-everyone__item"
                            style="margin-right: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/social-bg.jpg') !important">
                            <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up">Clear Investment
                                Processes</h3>
                            <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up" style="padding: 0;color:#fff">
                                Our transparent investment processes detail how each investment team identifies and
                                implements investment opportunities and the risk/return profile to be expected. We believe
                                that strict adherence to these guidelines is one of the most effective forms of risk
                                management.
                            </p>
                        </li>
                    </div>
                    <div style="width: 50%;">
                        <li class="p-home-m-seo-for-everyone__item"
                            style="margin-left: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/chat-bg.jpg') !important">
                            <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up" style="color: var(--inst-text)">ESG
                                Integration</h3>
                            <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up"
                                style="padding: 0;color: var(--inst-text)">
                                As a signatory of the United Nations-supported Principles for Responsible Investment (UN
                                PRI) initiative, we're committed to investing responsibly and supported by a global team of
                                dedicated ESG specialists whose recommendations help shape the investment process.
                            </p>
                        </li>
                    </div>
                    <div style="width: 50%;">
                        <li class="p-home-m-seo-for-everyone__item"
                            style="margin-right: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/social-bg.jpg') !important">
                            <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up">Robust Oversight</h3>
                            <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up" style="padding: 0;color:#fff">
                                Portfolio risk management is supplemented by our independent risk and quantitative analytics
                                team—which partners with investment teams to measure behavioral biases and other risks but
                                reports to senior investment management—and an operational risk management function that
                                assesses risk across the complex.
                            </p>
                        </li>
                    </div>
                    <div style="width: 50%;">
                        <li class="p-home-m-seo-for-everyone__item"
                            style="margin-left: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/chat-bg.jpg') !important">
                            <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up" style="color: var(--inst-text)">
                                High-Conviction,
                                Risk-Aware Portfolios</h3>
                            <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up"
                                style="padding: 0;color: var(--inst-text)">
                                Our focus on proprietary, security-level research allows us to build high-conviction,
                                differentiated portfolios. Our risk management processes provide valuable insight to help
                                our teams understand potential outcomes.
                            </p>
                        </li>
                    </div>
                </ul>
            </div><button
                class="_633ZZh0WP6 btn btn-primary p-home-c-button-desktop p-home-m-seo-for-everyone__button"
                data-trans="home_start_trading" type="button" data-test="home-page-achievements">Get Started</button>
        </section>
        <section class="p-home-m-seodevices p-home__section">
            <div class="page__container">
                <div
                    style="opacity: 1; transition: transform 0.8s cubic-bezier(0.15, 0.55, 0.55, 1) 0.1s, opacity 0.65s cubic-bezier(0.15, 0.55, 0.55, 1) 0.1s; transform-style: preserve-3d; transform-origin: center bottom; transform: none;transition:transform 0.8s cubic-bezier(0.15, 0.55, 0.55, 1) 0.1s, opacity 0.65s cubic-bezier(0.15, 0.55, 0.55, 1) 0.1s;transform-style:preserve-3d;transform-origin:570px 466px;transform:none;grid-column:1 / -1;background-border-radius:12px;vertical-align:baseline;font:16px;">
                    <div data-event-block-name="rewards_banner"
                        style="justify-content:space-between;gap:24px;width: 100%;max-width:944px;padding:98px 24px 0px;display:flex;--color-trend-negative: #ff5d53;--color-trend-positive: #52cf88;--color-heading: #fff;--color-subtitle: #b5b5b5;--color-text-secondary: #b5b5b5;--color-text-primary: #fff;--color-accent-heading-fragment: #fff;--color-btn-primary-shadow: rgba(55,96,255,.5);--color-btn-primary-border: #0a0a0a;--color-btn-primary-bg: #3760ff;--color-btn-primary-text: #fff;--color-btn-primary-hover-bg: #2955ff;--color-btn-primary-active-bg: #0034ff;--color-btn-filled-border: rgba(55,96,255,.5);--color-btn-filled-bg: #fff;--color-btn-filled-text: #3760ff;--color-btn-filled-hover-bg: #3760ff;--color-btn-filled-hover-text: #fff;--color-btn-filled-active-bg: #fff;--color-btn-filled-active-border: #8ba3ff;--color-btn-filled-active-text: #5a7cff;--color-btn-outline-text: #fff;--color-btn-outline-border: #fff;--color-btn-outline-bg: transparent;--color-btn-outline-hover-border: #3760ff;--color-btn-outline-hover-bg: #3760ff;--color-btn-outline-hover-text: #fff;--color-btn-outline-active-text: #8ba3ff;--color-btn-outline-active-border: #8ba3ff;--color-btn-outline-active-bg: transparent;--color-btn-link-text: #fff;--color-btn-link-hover-text: #5a7cff;--color-btn-link-active-text: #8ba3ff;--border-radius-cta-block-container: 18px;--border-radius-sections-group: 12px;--border-radius-card: 8px;--padding-card: 8px;--color-card-bg: #fff;--color-table-heading-text: #b5b5b5;--color-table-cell-text: #fff;--color-table-row-bg: #141414;--color-table-stripe-row-bg: #0a0a0a;--color-tab-text: #fff;--color-tab-border: transparent;--color-tab-active-text: #fff;--color-tab-hover-text: #fff;--color-tab-active-border: #3760ff;--color-benefit-static-card-bg: #0a0a0a;--color-banner-bg: #212121;--color-award-card-bg: #141414;--color-app-banner-bg: #383838;--color-app-banner-close: #969697;margin: 0px auto;vertical-align:baseline;font:16px;border:0px none rgb(0, 0, 0);">
                        <div style="max-width:494px;vertical-align:baseline;font:16px;">
                            <h3
                                style="font-size:40px;line-height:52px;font-weight:700;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">
                                Pay less, trade more</h3>
                            <p
                                style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;" data-aos="fade-up" data-aos-delay="100">
                                When you trade with us, you can start small and still earn big.</p>
                            <ul
                                style="row-gap:12px;padding-top:24px;display:grid;list-style:outside none none;vertical-align:baseline;font:16px;border:0px none rgb(0, 0, 0);margin:0px;padding:24px 0px 0px;">
                                <li
                                    style="grid-template-columns:24px 408.148px;column-gap:8px;display:grid;vertical-align:baseline;font:16px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none"
                                        style="width: 100%;height:24px;">
                                        <g clip-path="url(#clip0_729_2133)" style="">
                                            <path d="M12 3.75V20.25" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                            <path d="M9.75 20.25H14.25" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                            <path d="M5.25 8.25L18.75 5.25" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                            <path
                                                d="M2.25 15.75C2.25 17.4066 4.125 18 5.25 18C6.375 18 8.25 17.4066 8.25 15.75L5.25 8.25L2.25 15.75Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                            <path
                                                d="M15.75 12.75C15.75 14.4066 17.625 15 18.75 15C19.875 15 21.75 14.4066 21.75 12.75L18.75 5.25L15.75 12.75Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                        </g>
                                        <defs style="">
                                            <clipPath style="">
                                                <rect width="24" height="24" fill="currentColor" style="">
                                                </rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p
                                        style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;" data-aos="fade-up" data-aos-delay="100">
                                        Open larger trades with less money using leverage</p>
                                </li>
                                <li
                                    style="grid-template-columns:24px 408.148px;column-gap:8px;display:grid;vertical-align:baseline;font:16px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none"
                                        style="width: 100%;height:24px;">
                                        <g clip-path="url(#clip0_4816_25857)" style="">
                                            <path d="M12 2.25V21.75" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                            <path
                                                d="M17.25 8.25C17.25 7.75754 17.153 7.26991 16.9645 6.81494C16.7761 6.35997 16.4999 5.94657 16.1517 5.59835C15.8034 5.25013 15.39 4.97391 14.9351 4.78545C14.4801 4.597 13.9925 4.5 13.5 4.5H10.5C9.50544 4.5 8.55161 4.89509 7.84835 5.59835C7.14509 6.30161 6.75 7.25544 6.75 8.25C6.75 9.24456 7.14509 10.1984 7.84835 10.9017C8.55161 11.6049 9.50544 12 10.5 12H14.25C15.2446 12 16.1984 12.3951 16.9017 13.0983C17.6049 13.8016 18 14.7554 18 15.75C18 16.7446 17.6049 17.6984 16.9017 18.4017C16.1984 19.1049 15.2446 19.5 14.25 19.5H9.75C8.75544 19.5 7.80161 19.1049 7.09835 18.4017C6.39509 17.6984 6 16.7446 6 15.75"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                        </g>
                                        <defs style="">
                                            <clipPath style="scrollbar-width:none;">
                                                <rect width="24" height="24" fill="white" style="">
                                                </rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p
                                        style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;" data-aos="fade-up" data-aos-delay="100">
                                        Hold your trades open for longer with cheap funding rates</p>
                                </li>
                                <li
                                    style="grid-template-columns:24px 408.148px;column-gap:8px;display:grid;vertical-align:baseline;font:16px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none"
                                        style="width: 100%;height:24px;">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.736 3.18057C21.0505 3.45014 21.087 3.92361 20.8174 4.23811L15.3181 10.6539C15.0712 10.9419 14.6482 11.0003 14.3326 10.7899L9.24937 7.40105L4.1661 10.7899C3.82146 11.0197 3.35581 10.9265 3.12604 10.5819C2.89628 10.2372 2.98941 9.77158 3.33405 9.54181L8.83334 5.87562C9.08527 5.70767 9.41347 5.70767 9.66539 5.87562L14.6117 9.17317L19.6785 3.26192C19.9481 2.94743 20.4215 2.911 20.736 3.18057ZM3.75008 14.9151C4.16429 14.9151 4.50008 15.2508 4.50008 15.6651V20.2478C4.50008 20.662 4.16429 20.9978 3.75008 20.9978C3.33587 20.9978 3.00008 20.662 3.00008 20.2478V15.6651C3.00008 15.2508 3.33587 14.9151 3.75008 14.9151ZM9.99947 12.9155C9.99947 12.5013 9.66368 12.1655 9.24947 12.1655C8.83526 12.1655 8.49947 12.5013 8.49947 12.9155V20.2479C8.49947 20.6621 8.83526 20.9979 9.24947 20.9979C9.66368 20.9979 9.99947 20.6621 9.99947 20.2479V12.9155ZM14.7487 14.9151C15.1629 14.9151 15.4987 15.2508 15.4987 15.6651V20.2478C15.4987 20.662 15.1629 20.9978 14.7487 20.9978C14.3345 20.9978 13.9987 20.662 13.9987 20.2478V15.6651C13.9987 15.2508 14.3345 14.9151 14.7487 14.9151ZM20.9979 11.083C20.9979 10.6688 20.6621 10.333 20.2479 10.333C19.8337 10.333 19.4979 10.6688 19.4979 11.083V20.2485C19.4979 20.6627 19.8337 20.9985 20.2479 20.9985C20.6621 20.9985 20.9979 20.6627 20.9979 20.2485V11.083Z"
                                            fill="currentColor" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                    </svg>
                                    <p
                                        style="font-size:16px;line-height:24px;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;" data-aos="fade-up" data-aos-delay="100">
                                        Keep more of your profits with low trading fees</p>
                                </li>
                            </ul>
                            <div
                                style="flex-direction:row;align-items:center;gap:12px;display:flex;vertical-align:baseline;font:16px;">
                                <a data-event-label="Get Started" href="https://app.glidelogiccopytrading.com/register"
                                    style="margin-bottom:32px;width: auto;margin-top:32px;background:rgb(55, 96, 255) none repeat scroll 0% 0% / auto padding-box border-box;box-shadow:rgba(55, 96, 255, 0.5) 0px 4px 0px 0px, rgb(10, 10, 10) 0px 0px 0px 1px inset;padding-right:12px;padding-inline-end:12px;font-size:16px;line-height:24px;font-weight:500;border-radius:8px;padding:12px 12px 12px 24px;appearance:none;cursor:pointer;user-select:none;outline:rgb(255, 255, 255) none 0px;justify-content:center;align-items:center;text-decoration:none solid rgb(255, 255, 255);display:flex;vertical-align:baseline;border:0px none rgb(255, 255, 255);">Get
                                    Started<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        style="margin-left:8px;margin-inline-start:8px;width: 24px;height:24px;">
                                        <path
                                            d="M4.5 11.25C4.08579 11.25 3.75 11.5858 3.75 12C3.75 12.4142 4.08579 12.75 4.5 12.75V11.25ZM20.0303 12.5303C20.3232 12.2374 20.3232 11.7626 20.0303 11.4697L15.2574 6.6967C14.9645 6.40381 14.4896 6.40381 14.1967 6.6967C13.9038 6.98959 13.9038 7.46447 14.1967 7.75736L18.4393 12L14.1967 16.2426C13.9038 16.5355 13.9038 17.0104 14.1967 17.3033C14.4896 17.5962 14.9645 17.5962 15.2574 17.3033L20.0303 12.5303ZM4.5 12.75H19.5V11.25H4.5V12.75Z"
                                            fill="currentcolor" style="" data-aos="fade-up" data-aos-delay="100"></path>
                                    </svg></a><span
                                    style="font-size:14px;line-height:20px;vertical-align:baseline;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">Leverage
                                    may magnify your losses</span>
                            </div>
                        </div><img alt="" role="presentation" loading="lazy" width="390" height="368"
                            decoding="async" data-nimg="1"
                            style="color:transparentmargin:0px;margin:0px;width: 100%;max-width:390px;height: auto;display:block;vertical-align:baseline;font:16px;border:0px none rgba(0, 0, 0, 0);padding:0px;"
                            src="/assets/image.fcb36e3b.svg" / data-aos="zoom-in" data-aos-delay="100">
                    </div>
                </div>
            </div>
        </section>
        <section class="p-home-m-new-features p-home__section">
            <div class="page__container">
                <h2 class="com-c-title p-home-m-new-features__title" data-trans="home_new_features_title" data-aos="fade-up">Trading at your
                    fingertips</h2>
                <p class="com-c-description p-home-m-new-features__desc" data-trans="home_new_features_desc" data-aos="fade-up" data-aos-delay="100">New features,
                    latest webinars and more...</p>
                <div class="p-home-m-new-features-c-card p-home-m-new-features-c-card--ltr p-home-m-new-features-c-card_color_positive p-home-m-new-features-c-card_type_experience p-home-m-new-features__card"
                    style="background-color: var(--inst-bg-sec);fff;" data-aos="slide-up">
                    <div style="display: flex;padding:20px">
                        <div style="width: 50%;">
                            <h3>
                                Powerful Trading Platforms to help you succeed
                            </h3>
                            <p data-aos="fade-up" data-aos-delay="100">
                                Clients in over 200 countries and territories trade stocks, options, futures, currencies,
                                bonds, funds and more on 150 global markets from a single unified platform.
                            </p>
                            <p data-aos="fade-up" data-aos-delay="100">
                                Spot opportunities and calibrate complete portfolio performance. Keep your performance track
                                record with PortfolioAnalyst inception reporting and historical aggregation at no cost.
                            </p>
                            <p data-aos="fade-up" data-aos-delay="100">
                                Our mission is to bring advanced portfolio analytics to everyone who needs them – both
                                professionals and individuals. The best way to do that is to offer them at no cost, with no
                                strings.
                            </p>
                        </div>
                        <div style="width: 50%;display:flex;align-items:center">
                            <video autoplay muted loop style="width:100%; border-radius: 8px;">
                                <source src="/assets/video.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="page__container">
                <div class="p-home-m-seo-become-a-trader__content-wrap">
                    <h2 class="com-c-title p-home-m-seo-become-a-trader__title" data-aos="slide-up" data-aos="fade-up">Become
                        a
                        Pro Trader</h2>
                    <div class="p-home-m-seo-become-a-trader__content">
                        <div class="p-home-m-seo-become-a-trader__item-wrap" style="height: 500px;">
                            <div class="p-home-m-seo-become-a-trader__item-wrap-mask">
                                <div class="p-home-m-seo-become-a-trader__item-wrap-content">
                                    <h2 class="com-c-title p-home-m-seo-become-a-trader__item-head" data-aos="slide-up" data-aos="fade-up">A
                                        reliable trading platform is the
                                        foundation of
                                        success</h2>
                                    <p class="p-home-m-seo-become-a-trader__item-text"
                                        data-trans="become_a_trader_item_2_text_1" data-aos="fade-up" data-aos-delay="100">
                                        Every trader wants to profit in the best conditions and doesn’t want to fear for the
                                        safety of
                                        personal funds. The first obvious thing a novice trader does is to study different
                                        online
                                        trading sites.</p>
                                    <p class="p-home-m-seo-become-a-trader__item-text" data-aos="slide-up">
                                        The main criteria for a successful internet trading platform are international
                                        reputation,
                                        unwavering reliability, constant support at all stages, and unique useful trading
                                        features.
                                        These qualities are combined in the award-winning {{ $settings->site_name }} broker
                                        and
                                        electronic trading
                                        platform.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
            </div>
            <div class="home-page-pixe-container"></div>
            <style>
    .com-footer_dir_ltr {
        position: relative;
        z-index: 1;
    }

    .com-footer_dir_ltr::before {
        content: "";
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        background-image: url('../assets/header-campus.webp');
        z-index: -1;
        opacity: 0.9;
    }
</style>
<section class="section">
    <div class="page__container">
        <h2 class="com-c-title p-home-m-seo-for-everyone__title" data-aos="slide-up" data-aos="fade-up">Our Values</h2>
        <div style="display: grid;grid-template-columns: repeat(3, 1fr);gap: 20px;margin-top: 20px;">
            <div class="p-home-m-seo-for-everyone__item"
                style="margin-left: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/chat-bg.jpg') !important;background-size: cover;">
                <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up" style="color: var(--inst-text)">Transparency</h3>
                <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up" style="padding: 0;color: var(--inst-text)">
                    We believe in open and honest communication. All trading performance, strategies, and fees are
                    clearly disclosed so users can make informed decisions with full confidence.
                </p>
            </div>
            <div class="p-home-m-seo-for-everyone__item"
                style="margin-left: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/chat-bg.jpg') !important;background-size: cover;">
                <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up" style="color: var(--inst-text)">
                    Trust & Security</h3>
                <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up" style="padding: 0;color: var(--inst-text)">
                    Our platform is built with robust security measures and a commitment to safeguarding our users'
                    funds and data. We prioritize ethical practices to build long-term trust with every trader.
                </p>
            </div>
            <div class="p-home-m-seo-for-everyone__item"
                style="margin-left: 10px;margin-bottom:15px;background-image: url('https://glidelogiccopytrading.com/assets/chat-bg.jpg') !important;background-size: cover;">
                <h3 class="p-home-m-seo-for-everyone__item-head" data-aos="slide-up" style="color: var(--inst-text)">
                    Empowerment</h3>
                <p class="p-home-m-seo-for-everyone__item-list" data-aos="slide-up" style="padding: 0;color: var(--inst-text)">
                    We simplify investing by making professional trading accessible to everyone. Through intuitive tools
                    and expert-curated strategies, we help users grow their portfolios with ease and confidence.
                </p>
            </div>
        </div>
    </div>
</section>
<section>
    <img src="/assets/trade_everywhere.jpg" alt="Trade Anywhere" style="width: 100%; height: auto;" / data-aos="zoom-in" data-aos-delay="100">
</section>
<section>
    <div class="page__container">
        <h2 class="com-c-title p-home-m-seo-become-a-trader__item-head" data-trans="become_a_trader_item_1_head" data-aos="fade-up">
            Achievements</h2>
        <div style="display: flex;justify-content: space-between;align-items: center;flex-wrap: nowrap;">
            <img src="/assets/best-partners-program-global-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
            <img src="/assets/top-trusted-financial-institution-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
            <img src="/assets/most-trusted-forex-broker-global-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
            <img src="/assets/best-fx-broker-global-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
            <img src="/assets/best-customer-support-global-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
            <img src="/assets/best-partners-program-global-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
            <img src="/assets/most-transparent-broker-asia-2024-min.svg" / data-aos="zoom-in" data-aos-delay="100">
        </div>
    </div>
</section>
<section
    style="scrollbar-width:none;background-image:url('https://glidelogiccopytrading.com/assets/66585fe0e1dc7e70cc75d804_cta-10.webp');background-position:50% 0px;background-repeat:no-repeat;background-size:cover;padding-top:116px;padding-bottom:48px;display:block;">
    <div style="padding-left:105.203px;padding-right:105.203px;scrollbar-width:none;column-gap:16px;row-gap:16px;">
        <div
            style="scrollbar-width:none;margin-right: auto !important;margin-left: auto !important;width: 100%;max-width:1024px;">
            <div
                style="scrollbar-width:none;padding:48px;gap:60px;border-radius:24px;background-justify-content:space-between;align-items:center;display:flex;">
                <div style="scrollbar-width:none;">
                    <div
                        style="scrollbar-width:none;margin-top:0px;margin-right:0px;margin-left:0px;margin:0px 0px 16px;">
                        <h2
                            style="scrollbar-width:none;margin-top:0px;margin-bottom:0px;font-size: 2.5rem;font-weight:800;line-height:55.2px;" data-aos="fade-up">
                            Trade with a trusted broker
                        </h2>
                    </div>
                    <div style="scrollbar-width:none;">
                        Use our demo account and learn how to trade by using risk-free virtual funds.</div>
                </div>
                <div
                    style="scrollbar-width:none;gap:8px;flex-flow:row nowrap;flex: 0 0 auto;flex-wrap:nowrap;justify-content:flex-start;align-items:center;display:flex;">
                    <a href="https://app.glidelogiccopytrading.com/register"
                        style="scrollbar-width:none;gap:12px;display:flex;justify-content:center;align-items:center;border-radius:96px;background-text-align:center;white-space:nowrap;min-width:96px;min-height:48px;padding:12px 16px;font-weight:800;text-decoration:none solid rgb(255, 255, 255);transition:background-color 0.16s cubic-bezier(0.72, 0, 0.24, 1);position:relative;max-width:100%;">
                        <div style="scrollbar-width:none;">Try
                            free demo</div>
                    </a><a href="https://app.glidelogiccopytrading.com/register"
                        style="scrollbar-width:none;gap:8px;text-align:center;letter-spacing:0.56px;background-border-radius:96px;justify-content:center;padding:16px 24px;font-size:16px;font-weight:800;line-height:16px;text-decoration:none solid rgb(255, 255, 255);transition:background-color 0.15s cubic-bezier(0.65, 0, 0.35, 1), color 0.15s cubic-bezier(0.65, 0, 0.35, 1);display:flex;max-width:100%;">
                        <div style="scrollbar-width:none;">
                            Trader's Hub</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div
    style="border-radius:18px;background:rgba(0, 0, 0, 0) linear-gradient(229deg, rgb(75, 75, 75) 1.87%, rgb(10, 10, 10) 95.11%) repeat scroll 0% 0% / auto padding-box border-box;vertical-align:baseline;font-size:12px;margin:0px;padding:0px;">
    <div
        style="padding:40px;max-width:1300px;margin: 0px auto;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);">
        <div
            style="flex-direction:row;justify-content:space-between;align-items:flex-start;gap:32px;display:flex;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
            <div
                style="flex-direction:column;gap:24px;justify-content:space-between;display:flex;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                <div
                    style="gap:24px;display:grid;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                    <a href="/"
                        style="flex-shrink:0;width: 109px;text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;"><img
                            src="https://glidelogiccopytrading.com/assets/logo.png" width="100" / data-aos="zoom-in" data-aos-delay="100"></a>
                </div>
            </div>
            <nav
                style="--tablet-num-of-columns: 5;justify-content:space-between;flex:1 1 0%;gap:0px;max-width:1045px;display:flex;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                <div
                    style="flex-basis:20%;padding-right:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px 12px 0px 0px;">
                    <div
                        style="word-break:break-all;flex-basis:100%;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                        <h3
                            style="font-size:16px;line-height:24px;font-weight:600;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">
                            Trades</h3>
                        <ul
                            style="margin-top:12px;list-style:outside none none;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/swing-trading"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Swing
                                    Trading</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/futures"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">FX
                                    &amp; Futures</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/option-trading"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Buy
                                    Options</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/oil-and-gas"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">
                                    Oil & Gas</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    style="flex-basis:20%;padding-right:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px 12px 0px 0px;">
                    <div
                        style="word-break:break-all;flex-basis:100%;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                        <h3
                            style="font-size:16px;line-height:24px;font-weight:600;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">
                            Tools</h3>
                        <ul
                            style="margin-top:12px;list-style:outside none none;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/option-trading"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Option
                                    Copy Trading</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/advance-trading"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">FX
                                    &amp; Advance Trading</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="live-trading"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Buy
                                    Live Trading</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/option-copy-trading"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Copy
                                    Trading</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    style="flex-basis:20%;padding-right:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px 12px 0px 0px;">
                    <div
                        style="word-break:break-all;flex-basis:100%;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                        <h3
                            style="font-size:16px;line-height:24px;font-weight:600;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">
                            Company</h3>
                        <ul
                            style="margin-top:12px;list-style:outside none none;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/about"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">About
                                    us</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/insurance"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Insurance</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="https://app.glidelogiccopytrading.com/register"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Demo
                                    Account</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    style="flex-basis:20%;padding-right:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px 12px 0px 0px;">
                    <div
                        style="word-break:break-all;flex-basis:100%;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                        <h3
                            style="font-size:16px;line-height:24px;font-weight:600;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">
                            Support</h3>
                        <ul
                            style="margin-top:12px;list-style:outside none none;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/contact"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Contact
                                    Us</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/system-status"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">System
                                    Status</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/news"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Latest
                                    market news</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/referral"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Refer
                                    a Friend</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    style="flex-basis:20%;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                    <div
                        style="word-break:break-all;flex-basis:100%;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                        <h3
                            style="font-size:16px;line-height:24px;font-weight:600;vertical-align:baseline;border:0px none rgb(255, 255, 255);margin:0px;padding:0px;">
                            Legals</h3>
                        <ul
                            style="margin-top:12px;list-style:outside none none;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/Client_Agreement_Dec_2023.pdf"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Terms
                                    & Conditions</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/Privacy_Policy_Mar_2023.pdf"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">Privacy
                                    Policy</a>
                            </li>
                            <li
                                style="margin-bottom:12px;vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);padding:0px;">
                                <a href="/AML_Policy.pdf"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">AML
                                    Policy</a>
                            </li>
                            <li
                                style="vertical-align:baseline;font-size:12px;border:0px none rgb(181, 181, 181);margin:0px;padding:0px;">
                                <a href="/sec_glsec.pdf"
                                    style="text-decoration:none solid rgb(226, 226, 226);vertical-align:baseline;font-size:12px;border:0px none rgb(226, 226, 226);margin:0px;padding:0px;">regulations(SEC)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        
    </div>
</div>

        </div>
    </div>
    </div>
    
    
    

    <!-- Smartsupp Live Chat script -->
    

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: false,
                offset: 100
            });
        });
    </script>
@endsection
