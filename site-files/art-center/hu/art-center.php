<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Oldalbeállítások
|--------------------------------------------------------------------------
*/

$pageTitle =
    '„ART Center” Gyermekművészeti Központ';

$pageDescription =
    'Kreatív foglalkozások gyermekeknek és fiataloknak: modern tánc, akrobatika, színpadi mozgás, színjátszás és zenés előadások.';

$pageLead =
    'Az „ART Center” Gyermekművészeti Központ határtalan alkotói tér gyermekek és fiatalok számára, ahol mindenki igazi színpadi előadóként bontakoztathatja ki tehetségét.';

$currentLocale =
    'hu';

/*
|--------------------------------------------------------------------------
| Hivatkozás a hivatalos oldalra
|--------------------------------------------------------------------------
|
| Amikor rendelkezésre áll az „ART Center” pontos hivatalos oldala,
| csak az idézőjelek közötti webcímet kell kicserélni.
|
*/

$officialPageUrl =
    'https://hungary.rs.gov.ru/';

/*
|--------------------------------------------------------------------------
| Fényképek
|--------------------------------------------------------------------------
|
| Mind a négy fájlt változatlan névvel kell feltölteni
| a /new-home/img/ könyvtárba.
|
*/

$mainImage = [
    'src' =>
        '/new-home/img/9fd8de_9-maya-rossijskij-kulturnyj-czentr-v-budapeshte-predstavil-meropritiya-v-oznamenovenii-80-j-godovshhine-pobedy-v-velikoj-otechestvennoj-vojne.-foto-3.jpg',
    'alt' =>
        'Az „ART Center” résztvevői mozgásszínházi kompozíciót adnak elő a Budapesti Orosz Kulturális Központ színpadán',
    'caption' =>
        'Az „ART Center” résztvevőinek színpadi előadása',
    'width' => 1600,
    'height' => 900,
];

$galleryImages = [
    [
        'src' =>
            '/new-home/img/Screenshot_20260911_134502_edit_334295669352787.jpg',
        'alt' =>
            'Az „ART Center” résztvevői modern koreográfiai gyakorlatokat végeznek',
        'caption' =>
            'Modern koreográfiai próba',
        'width' => 1080,
        'height' => 608,
    ],
    [
        'src' =>
            '/new-home/img/Screenshot_20260911_134131_edit_334315567264394.jpg',
        'alt' =>
            'Az „ART Center” táncelőadása színes színpadi textilekkel',
        'caption' =>
            'Zenés mozgásszínházi kompozíció',
        'width' => 1080,
        'height' => 608,
    ],
    [
        'src' =>
            '/new-home/img/Screenshot_20260911_135112.jpg',
        'alt' =>
            'Az „ART Center” együttese színpadi előadás közben',
        'caption' =>
            'Közös munka egy színpadi karakter megformálásán',
        'width' => 1080,
        'height' => 608,
    ],
];

$slides = array_merge([$mainImage], $galleryImages);

$escape = static function (string $value): string {
    return htmlspecialchars(
        $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
};

$requestScheme = (
    !empty($_SERVER['HTTPS']) &&
    $_SERVER['HTTPS'] !== 'off'
)
    ? 'https'
    : 'http';

$requestHost = trim(
    (string) ($_SERVER['HTTP_HOST'] ?? 'ruscenter.hu')
);

$requestPath = (string) parse_url(
    (string) (
        $_SERVER['REQUEST_URI'] ??
        '/new-home/hu/art-center.php'
    ),
    PHP_URL_PATH
);

$shareUrl =
    $requestScheme . '://' . $requestHost . $requestPath;

$shareTitle =
    $pageTitle;

$encodedShareUrl =
    rawurlencode($shareUrl);

$encodedShareTitle =
    rawurlencode($shareTitle);

$shareLabels = [
    'panel' => 'Az oldal megosztása',
    'title' => 'Megosztás',
    'max' => 'Megosztás a MAX-on',
    'vk' => 'Megosztás a VKontakte-on',
    'ok' => 'Megosztás az Odnoklassniki oldalon',
    'telegram' => 'Megosztás a Telegramon',
    'print' => 'Nyomtatható változat',
    'copied' => 'A hivatkozás másolva',
    'copy_failed' =>
        'Másolja ki a hivatkozást a böngésző címsorából',
];

?>
<!DOCTYPE html>

<html lang="<?= $escape($currentLocale) ?>">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="<?= $escape($pageDescription) ?>"
    >

    <title><?= $escape($pageTitle) ?></title>

    <link
        rel="icon"
        href="/new-home/favicon.ico"
    >

    <link
        rel="alternate"
        hreflang="ru"
        href="https://ruscenter.hu/new-home/art-center.php"
    >

    <link
        rel="alternate"
        hreflang="hu"
        href="https://ruscenter.hu/new-home/hu/art-center.php"
    >

    <link
        rel="stylesheet"
        href="/new-home/css/header.css?v=20260910-1"
    >

    <link
        rel="stylesheet"
        href="/new-home/css/page-template.css?v=20260910-1"
    >

    <link
        rel="stylesheet"
        href="/new-home/css/footer.css?v=20260813-4"
    >

    <style>

        .art-center-page {
            padding: 42px 20px 70px;
        }

        .art-center-page .standard-page__header {
            margin: 0 0 34px;
        }

        .art-center-page .standard-page__title-banner {
            display: inline-block;
            width: auto;
            max-width: 100%;
            margin: 0 0 18px;
            padding: 0;
            background: transparent;
            box-shadow: none;
            border-radius: 0;
        }

        .art-center-page .standard-page__title {
            display: inline-block;
            width: auto;
            max-width: 100%;
            margin: 0;
            padding: 18px 30px;
            color: #ffffff;
            background: #223b82;
            font-size: clamp(28px, 4vw, 44px);
            line-height: 1.15;
            font-weight: 700;
        }

        .art-center-back {
            margin: 0 0 22px;
        }

        .art-center-back a {
            color: #223b82;
            text-decoration: none;
            font-weight: 600;
        }

        .art-center-back a:hover,
        .art-center-back a:focus-visible {
            text-decoration: underline;
        }

        .art-center-page__content,
        .art-center-page__aside-column,
        .art-center-page__sidebar {
            min-width: 0;
        }

        .art-center-page__content a,
        .art-center-page__sidebar a:not(.art-center-back a) {
            color: #175cd3;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        .art-center-page__content a:hover,
        .art-center-page__sidebar a:not(.art-center-back a):hover {
            color: #0b4aa2;
            text-decoration-thickness: 2px;
        }

        .art-center-section {
            scroll-margin-top: 28px;
            margin-top: 38px;
        }

        .art-center-section:first-child {
            margin-top: 0;
        }

        .art-center-section h2 {
            margin: 0 0 16px;
            color: #101828;
            font-size: clamp(24px, 3vw, 32px);
            line-height: 1.2;
        }

        .art-center-section p,
        .art-center-section li {
            color: #344054;
            line-height: 1.75;
        }

        .art-center-directions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin: 22px 0 0;
            padding: 0;
            list-style: none;
        }

        .art-center-directions li {
            position: relative;
            margin: 0;
            padding: 18px 18px 18px 48px;
            border: 1px solid #e4e7ec;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(16, 24, 40, 0.05);
        }

        .art-center-directions li::before {
            content: '\2713';
            position: absolute;
            top: 18px;
            left: 18px;
            display: grid;
            width: 22px;
            height: 22px;
            place-items: center;
            border-radius: 50%;
            color: #ffffff;
            background: #175cd3;
            font-size: 13px;
            font-weight: 700;
        }


        .art-center-slider {
            scroll-margin-top: 28px;
            margin: 0 0 42px;
        }

        .art-center-slider__viewport {
            position: relative;
            overflow: hidden;
            border: 1px solid #e4e7ec;
            border-radius: 22px;
            background: #eef2f7;
            box-shadow:
                0 18px 44px rgba(16, 24, 40, 0.12);
        }

        .art-center-slider__track {
            display: flex;
            margin: 0;
            padding: 0;
            transform: translate3d(0, 0, 0);
            transition: transform 420ms ease;
            cursor: grab;
            touch-action: pan-y;
            user-select: none;
            will-change: transform;
        }

        .art-center-slider__track.is-dragging {
            transition: none;
            cursor: grabbing;
        }

        .art-center-slider__slide {
            position: relative;
            flex: 0 0 100%;
            min-width: 0;
            margin: 0;
        }

        .art-center-slider__frame {
            overflow: hidden;
            aspect-ratio: 16 / 9;
            background: #eef2f7;
        }

        .art-center-slider__image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }

        .art-center-slider__caption {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            margin: 0;
            padding: 52px 76px 20px 22px;
            color: #ffffff;
            background:
                linear-gradient(
                    180deg,
                    rgba(16, 24, 40, 0) 0%,
                    rgba(16, 24, 40, 0.78) 100%
                );
            font-size: 14px;
            line-height: 1.45;
            font-weight: 500;
        }

        .art-center-slider__arrow {
            position: absolute;
            z-index: 3;
            top: 50%;
            display: none;
            width: 46px;
            height: 46px;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 50%;
            color: #223b82;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 8px 24px rgba(16, 24, 40, 0.20);
            font: 700 31px/1 Arial, Helvetica, sans-serif;
            cursor: pointer;
            transform: translateY(-50%);
            transition:
                background-color 180ms ease,
                transform 180ms ease;
        }

        .art-center-slider.is-ready
        .art-center-slider__arrow {
            display: flex;
        }

        .art-center-slider__arrow:hover,
        .art-center-slider__arrow:focus-visible {
            background: #ffffff;
            transform: translateY(-50%) scale(1.05);
        }

        .art-center-slider__arrow--previous {
            left: 16px;
        }

        .art-center-slider__arrow--next {
            right: 16px;
        }

        .art-center-slider__navigation {
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-top: 15px;
        }

        .art-center-slider.is-ready
        .art-center-slider__navigation {
            display: flex;
        }

        .art-center-slider__dots {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .art-center-slider__dot {
            width: 11px;
            height: 11px;
            padding: 0;
            border: 1px solid #98a2b3;
            border-radius: 50%;
            background: #ffffff;
            cursor: pointer;
            transition:
                width 180ms ease,
                border-radius 180ms ease,
                background-color 180ms ease;
        }

        .art-center-slider__dot[aria-current="true"] {
            width: 30px;
            border-color: #223b82;
            border-radius: 999px;
            background: #223b82;
        }

        .art-center-slider__counter {
            margin: 0;
            color: #667085;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .art-center-sidebar__block +
        .art-center-sidebar__block {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #e4e7ec;
        }

        .art-center-sidebar__title {
            margin: 0 0 14px;
            color: #101828;
            font-size: 19px;
            line-height: 1.35;
        }

        .art-center-sidebar__nav {
            display: grid;
            gap: 4px;
        }

        .art-center-sidebar__nav a {
            display: block;
            padding: 9px 10px;
            border-radius: 9px;
            color: #344054;
            text-decoration: none;
            font-weight: 500;
        }

        .art-center-sidebar__nav a:hover,
        .art-center-sidebar__nav a:focus-visible {
            color: #1849a9;
            background: #eff6ff;
        }

        .art-center-contact {
            padding: 16px;
            border: 1px solid #b2ccff;
            border-radius: 14px;
            background: #eff6ff;
        }

        .art-center-contact p {
            margin: 0;
            color: #344054;
            line-height: 1.55;
        }

        .art-center-share-panel {
            width: 100%;
            margin: 0 0 22px;
            padding: 16px;
            border: 1px solid #e2e6ee;
            border-radius: 12px;
            background: #f8f9fc;
            box-sizing: border-box;
        }

        .art-center-share-title {
            margin: 0 0 12px;
            color: #333333;
            font-size: 15px;
            font-weight: 700;
        }

        .art-center-share-group {
            display: flex;
            flex-wrap: nowrap;
            gap: 6px;
        }

        .art-center-share-button {
            display: inline-flex;
            flex: 1 1 0;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0;
            border: 0;
            border-radius: 8px;
            background: transparent;
            text-decoration: none;
            cursor: pointer;
        }

        .art-center-share-button:hover {
            filter: brightness(0.92);
            text-decoration: none;
        }

        .art-center-share-logo {
            display: block;
            width: 30px;
            height: 30px;
            max-width: 30px;
            max-height: 30px;
            object-fit: contain;
        }

        .art-center-print-button {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin: 14px 0 0;
            padding: 10px 0 0;
            border: 0;
            border-top: 1px solid #dde2eb;
            background: transparent;
            color: #5367a5;
            font: 600 14px/1.35 Arial, Helvetica, sans-serif;
            cursor: pointer;
        }

        .art-center-print-button:hover {
            color: #1849a9;
        }

        .art-center-print-icon {
            font-size: 18px;
        }

        .art-center-share-status {
            min-height: 16px;
            margin: 7px 0 0;
            color: #687083;
            font-size: 12px;
        }

        .art-center-page a:focus-visible {
            outline: 3px solid rgba(23, 92, 211, 0.30);
            outline-offset: 3px;
        }


        @media (max-width: 760px) {
            .art-center-directions {
                grid-template-columns: 1fr;
            }

            .art-center-slider {
                margin-bottom: 36px;
            }

            .art-center-slider__viewport {
                overflow: visible;
                border: 0;
                border-radius: 0;
                background: transparent;
                box-shadow: none;
            }

            .art-center-slider__track,
            .art-center-slider__track.is-dragging {
                display: grid;
                gap: 22px;
                transform: none !important;
                transition: none;
                cursor: default;
                touch-action: auto;
            }

            .art-center-slider__slide {
                position: static;
                display: block;
            }

            .art-center-slider__frame {
                overflow: hidden;
                border: 1px solid #e4e7ec;
                border-radius: 16px;
                box-shadow:
                    0 10px 28px rgba(16, 24, 40, 0.08);
            }

            .art-center-slider__caption {
                position: static;
                margin: 10px 0 0;
                padding: 0 6px;
                color: #667085;
                background: transparent;
                font-size: 14px;
                font-weight: 400;
                text-align: center;
            }

            .art-center-slider.is-ready
            .art-center-slider__arrow,
            .art-center-slider.is-ready
            .art-center-slider__navigation {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .art-center-page {
                padding: 24px 14px 50px;
            }

            .art-center-page .standard-page__header {
                margin-bottom: 28px;
            }

            .art-center-page .standard-page__title-banner {
                display: block;
                width: 100%;
                margin-bottom: 16px;
            }

            .art-center-page .standard-page__title {
                display: block;
                width: 100%;
                padding: 15px 18px;
                font-size: 27px;
            }
        }

        @media print {
            .site-header,
            .site-footer,
            .standard-page__breadcrumbs,
            .art-center-back,
            .art-center-page__aside-column {
                display: none !important;
            }

            .standard-page,
            .standard-page__container,
            .standard-page__layout,
            .art-center-page__content {
                display: block;
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 0;
            }

            .art-center-directions {
                grid-template-columns: 1fr 1fr;
            }

            .art-center-slider__viewport,
            .art-center-slider__frame {
                box-shadow: none;
            }

            .art-center-slider__arrow,
            .art-center-slider__navigation {
                display: none !important;
            }
        }

    </style>

</head>

<body>

<?php
require_once __DIR__ .
    '/../includes/header.php';
?>

<main class="standard-page art-center-page">

    <div class="standard-page__container">

        <p class="art-center-back">
            <a href="/new-home/hu/">
                ← Vissza a kezdőlapra
            </a>
        </p>

        <header class="standard-page__header">

            <div class="standard-page__title-banner">

                <h1 class="standard-page__title">
                    <?= $escape($pageTitle) ?>
                </h1>

            </div>

            <p class="standard-page__lead" id="about">
                <?= $escape($pageLead) ?>
            </p>

        </header>

        <div class="standard-page__layout">

            <article
                class="standard-page__content art-center-page__content"
            >


                <section
                    class="art-center-slider"
                    id="gallery"
                    aria-label="Az „ART Center” fényképei"
                    aria-roledescription="képgaléria"
                    tabindex="0"
                    data-art-slider
                >

                    <div class="art-center-slider__viewport">

                        <div
                            class="art-center-slider__track"
                            data-art-slider-track
                        >

                            <?php foreach ($slides as $index => $image): ?>

                                <figure
                                    class="art-center-slider__slide"
                                    data-art-slider-slide
                                    aria-label="<?= ($index + 1) . ' / ' . count($slides) ?>"
                                >

                                    <div class="art-center-slider__frame">
                                        <img
                                            class="art-center-slider__image"
                                            src="<?= $escape($image['src']) ?>"
                                            alt="<?= $escape($image['alt']) ?>"
                                            width="<?= (int) $image['width'] ?>"
                                            height="<?= (int) $image['height'] ?>"
                                            loading="<?= $index === 0 ? 'eager' : 'lazy' ?>"
                                            decoding="async"
                                            draggable="false"
                                        >
                                    </div>

                                    <figcaption
                                        class="art-center-slider__caption"
                                    >
                                        <?= $escape($image['caption']) ?>
                                    </figcaption>

                                </figure>

                            <?php endforeach; ?>

                        </div>

                        <button
                            class="art-center-slider__arrow art-center-slider__arrow--previous"
                            type="button"
                            aria-label="Előző fénykép"
                            data-art-slider-previous
                        >&#8249;</button>

                        <button
                            class="art-center-slider__arrow art-center-slider__arrow--next"
                            type="button"
                            aria-label="Következő fénykép"
                            data-art-slider-next
                        >&#8250;</button>

                    </div>

                    <div class="art-center-slider__navigation">

                        <div
                            class="art-center-slider__dots"
                            aria-label="Fénykép kiválasztása"
                        >
                            <?php foreach ($slides as $index => $image): ?>
                                <button
                                    class="art-center-slider__dot"
                                    type="button"
                                    aria-label="<?= $index + 1 ?>. fénykép megjelenítése"
                                    aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                                    data-art-slider-dot="<?= $index ?>"
                                ></button>
                            <?php endforeach; ?>
                        </div>

                        <p
                            class="art-center-slider__counter"
                            aria-live="polite"
                            data-art-slider-counter
                        >
                            1 / <?= count($slides) ?>
                        </p>

                    </div>

                </section>

                <section
                    class="art-center-section"
                    id="directions"
                >

                    <h2>Mit tanulnak a résztvevők?</h2>

                    <p>
                        Modern tánctechnikákat, az akrobatika
                        és a színpadi mozgás alapjait, valamint
                        a színpadi tánc különböző irányzatait tanuljuk.
                        Gyakoroljuk a színjátszást és az érzelmi
                        kifejezőkészséget, különféle színpadi
                        karaktereket formálunk meg és keltünk életre.
                    </p>

                    <ul class="art-center-directions">
                        <li>Modern és színpadi táncirányzatok</li>
                        <li>Az akrobatika és a színpadi mozgás alapjai</li>
                        <li>Színjátszás és érzelmi kifejezőkészség</li>
                        <li>Színpadi karakterek megalkotása és életre keltése</li>
                    </ul>

                </section>

                <section
                    class="art-center-section"
                    id="team"
                >

                    <h2>Alkotás és csapatmunka</h2>

                    <p>
                        Megtanulunk énekelve táncolni és tánc közben
                        énekelni, a rendezői elképzelést gesztusokkal
                        és a test plasztikus mozgásával közvetíteni.
                        Új alkotói képességeket fedezünk fel magunkban,
                        nem félünk különbözőnek és színesnek lenni,
                        és megtanulunk egy hasonlóan gondolkodó
                        csapatban dolgozni.
                    </p>

                </section>

                <section
                    class="art-center-section"
                    id="productions"
                >

                    <h2>Saját előadások</h2>

                    <p>
                        Koncertműsorokat, interaktív és mozgásszínházi
                        előadásokat, valamint zenés színpadi
                        produkciókat hozunk létre.
                    </p>

                </section>

            </article>

            <div class="art-center-page__aside-column">

                <aside
                    class="art-center-share-panel"
                    aria-label="<?= $escape($shareLabels['panel']) ?>"
                    data-share-url="<?= $escape($shareUrl) ?>"
                    data-share-title="<?= $escape($shareTitle) ?>"
                >

                    <p class="art-center-share-title">
                        <?= $escape($shareLabels['title']) ?>
                    </p>

                    <div class="art-center-share-group">

                        <a
                            class="art-center-share-button"
                            href="https://web.max.ru/"
                            target="_blank"
                            rel="noopener noreferrer"
                            referrerpolicy="no-referrer"
                            data-copy-share
                            data-open-after-copy="https://web.max.ru/"
                            aria-label="<?= $escape($shareLabels['max']) ?>"
                            title="<?= $escape($shareLabels['max']) ?>"
                        >
                            <img
                                class="art-center-share-logo"
                                src="/new-home/img/social/max.svg"
                                alt=""
                                aria-hidden="true"
                                width="30"
                                height="30"
                            >
                        </a>

                        <a
                            class="art-center-share-button"
                            href="https://vk.com/share.php?url=<?= $encodedShareUrl ?>&amp;title=<?= $encodedShareTitle ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            referrerpolicy="no-referrer"
                            aria-label="<?= $escape($shareLabels['vk']) ?>"
                            title="<?= $escape($shareLabels['vk']) ?>"
                        >
                            <img
                                class="art-center-share-logo"
                                src="/new-home/img/social/vk.svg"
                                alt=""
                                aria-hidden="true"
                                width="30"
                                height="30"
                            >
                        </a>

                        <a
                            class="art-center-share-button"
                            href="https://connect.ok.ru/offer?url=<?= $encodedShareUrl ?>&amp;title=<?= $encodedShareTitle ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            referrerpolicy="no-referrer"
                            aria-label="<?= $escape($shareLabels['ok']) ?>"
                            title="<?= $escape($shareLabels['ok']) ?>"
                        >
                            <img
                                class="art-center-share-logo"
                                src="/new-home/img/social/ok.svg"
                                alt=""
                                aria-hidden="true"
                                width="30"
                                height="30"
                            >
                        </a>

                        <a
                            class="art-center-share-button"
                            href="https://t.me/share/url?url=<?= $encodedShareUrl ?>&amp;text=<?= $encodedShareTitle ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            referrerpolicy="no-referrer"
                            aria-label="<?= $escape($shareLabels['telegram']) ?>"
                            title="<?= $escape($shareLabels['telegram']) ?>"
                        >
                            <img
                                class="art-center-share-logo"
                                src="/new-home/img/social/telegram.svg"
                                alt=""
                                aria-hidden="true"
                                width="30"
                                height="30"
                            >
                        </a>

                    </div>

                    <button
                        class="art-center-print-button"
                        type="button"
                        data-print-page
                    >
                        <span
                            class="art-center-print-icon"
                            aria-hidden="true"
                        >&#128424;</span>

                        <?= $escape($shareLabels['print']) ?>
                    </button>

                    <p
                        class="art-center-share-status"
                        data-share-status
                        aria-live="polite"
                    ></p>

                </aside>

                <aside
                    class="standard-page__sidebar art-center-page__sidebar"
                    aria-labelledby="page-sidebar-title"
                >

                    <div class="art-center-sidebar__block">

                        <h2
                            class="art-center-sidebar__title"
                            id="page-sidebar-title"
                        >
                            Ezen az oldalon
                        </h2>

                        <nav
                            class="art-center-sidebar__nav"
                            aria-label="Az oldal szakaszai"
                        >
                            <a href="#about">Az „ART Centerről”</a>
                            <a href="#directions">Foglalkozási területek</a>
                            <a href="#team">Alkotás és csapatmunka</a>
                            <a href="#productions">Előadások</a>
                            <a href="#gallery">Galéria</a>
                        </nav>

                    </div>

                    <div class="art-center-sidebar__block">

                        <h2 class="art-center-sidebar__title">
                            További információ
                        </h2>

                        <div class="art-center-contact">
                            <p>
                                <a
                                    href="<?= $escape($officialPageUrl) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >További részletes információ a Budapesti Orosz Kulturális Központ hivatalos honlapján</a>
                            </p>
                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </div>

</main>

<?php
require_once __DIR__ .
    '/../includes/footer.php';
?>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const artSlider = document.querySelector('[data-art-slider]');

    if (artSlider) {
        const sliderTrack =
            artSlider.querySelector('[data-art-slider-track]');
        const sliderSlides = Array.from(
            artSlider.querySelectorAll('[data-art-slider-slide]')
        );
        const sliderDots = Array.from(
            artSlider.querySelectorAll('[data-art-slider-dot]')
        );
        const previousButton =
            artSlider.querySelector('[data-art-slider-previous]');
        const nextButton =
            artSlider.querySelector('[data-art-slider-next]');
        const sliderCounter =
            artSlider.querySelector('[data-art-slider-counter]');
        const desktopSlider =
            window.matchMedia('(min-width: 761px)');

        let currentSlide = 0;
        let dragStartX = 0;
        let dragDistance = 0;
        let isDragging = false;

        const renderSlider = function () {
            const desktopMode = desktopSlider.matches;

            if (desktopMode) {
                sliderTrack.style.transform =
                    'translate3d(-' +
                    (currentSlide * 100) +
                    '%, 0, 0)';
            } else {
                sliderTrack.style.transform = '';
            }

            sliderSlides.forEach(function (slide, index) {
                slide.setAttribute(
                    'aria-hidden',
                    desktopMode && index !== currentSlide
                        ? 'true'
                        : 'false'
                );
            });

            sliderDots.forEach(function (dot, index) {
                dot.setAttribute(
                    'aria-current',
                    index === currentSlide ? 'true' : 'false'
                );
            });

            if (sliderCounter) {
                sliderCounter.textContent =
                    (currentSlide + 1) +
                    ' / ' +
                    sliderSlides.length;
            }
        };

        const showSlide = function (index) {
            if (!desktopSlider.matches || sliderSlides.length < 2) {
                return;
            }

            currentSlide =
                (index + sliderSlides.length) %
                sliderSlides.length;

            sliderTrack.style.transition = '';
            renderSlider();
        };

        if (sliderSlides.length > 1) {
            artSlider.classList.add('is-ready');

            previousButton.addEventListener('click', function () {
                showSlide(currentSlide - 1);
            });

            nextButton.addEventListener('click', function () {
                showSlide(currentSlide + 1);
            });

            sliderDots.forEach(function (dot) {
                dot.addEventListener('click', function () {
                    showSlide(Number(dot.dataset.artSliderDot));
                });
            });

            artSlider.addEventListener('keydown', function (event) {
                if (!desktopSlider.matches) {
                    return;
                }

                if (event.key === 'ArrowLeft') {
                    event.preventDefault();
                    showSlide(currentSlide - 1);
                }

                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    showSlide(currentSlide + 1);
                }
            });

            sliderTrack.addEventListener('pointerdown', function (event) {
                if (
                    !desktopSlider.matches ||
                    event.button !== 0
                ) {
                    return;
                }

                isDragging = true;
                dragStartX = event.clientX;
                dragDistance = 0;
                sliderTrack.classList.add('is-dragging');
                sliderTrack.setPointerCapture(event.pointerId);
            });

            sliderTrack.addEventListener('pointermove', function (event) {
                if (!isDragging || !desktopSlider.matches) {
                    return;
                }

                dragDistance = event.clientX - dragStartX;

                sliderTrack.style.transform =
                    'translate3d(calc(-' +
                    (currentSlide * 100) +
                    '% + ' +
                    dragDistance +
                    'px), 0, 0)';
            });

            const finishDragging = function (event) {
                if (!isDragging) {
                    return;
                }

                isDragging = false;
                sliderTrack.classList.remove('is-dragging');

                if (
                    sliderTrack.hasPointerCapture &&
                    sliderTrack.hasPointerCapture(event.pointerId)
                ) {
                    sliderTrack.releasePointerCapture(event.pointerId);
                }

                const threshold = Math.min(
                    90,
                    sliderTrack.clientWidth * 0.14
                );

                if (dragDistance <= -threshold) {
                    showSlide(currentSlide + 1);
                } else if (dragDistance >= threshold) {
                    showSlide(currentSlide - 1);
                } else {
                    sliderTrack.style.transition = '';
                    renderSlider();
                }

                dragDistance = 0;
            };

            sliderTrack.addEventListener(
                'pointerup',
                finishDragging
            );
            sliderTrack.addEventListener(
                'pointercancel',
                finishDragging
            );

            sliderTrack.addEventListener('dragstart', function (event) {
                event.preventDefault();
            });
        }

        if (desktopSlider.addEventListener) {
            desktopSlider.addEventListener(
                'change',
                renderSlider
            );
        } else {
            desktopSlider.addListener(renderSlider);
        }

        renderSlider();
    }

    const panel = document.querySelector('.art-center-share-panel');

    if (!panel) {
        return;
    }

    const shareUrl = panel.dataset.shareUrl || window.location.href;
    const shareTitle = panel.dataset.shareTitle || document.title;
    const status = panel.querySelector('[data-share-status]');
    const copiedMessage = <?= json_encode(
        $shareLabels['copied'],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    ) ?>;
    const copyFailedMessage = <?= json_encode(
        $shareLabels['copy_failed'],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    ) ?>;

    panel.querySelectorAll('[data-copy-share]').forEach(function (button) {
        button.addEventListener('click', async function (event) {
            event.preventDefault();

            try {
                if (
                    navigator.share &&
                    window.matchMedia('(max-width: 900px)').matches
                ) {
                    await navigator.share({
                        title: shareTitle,
                        url: shareUrl
                    });
                    return;
                }

                const destination = button.dataset.openAfterCopy;

                if (destination) {
                    window.open(
                        destination,
                        '_blank',
                        'noopener,noreferrer'
                    );
                }

                await navigator.clipboard.writeText(shareUrl);

                if (status) {
                    status.textContent = copiedMessage;
                }
            } catch (error) {
                if (status) {
                    status.textContent = copyFailedMessage;
                }
            }
        });
    });

    const printButton = panel.querySelector('[data-print-page]');

    if (printButton) {
        printButton.addEventListener('click', function () {
            window.print();
        });
    }
});
</script>

</body>

</html>
