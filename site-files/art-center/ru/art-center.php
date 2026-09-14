<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Настройки страницы
|--------------------------------------------------------------------------
*/

$pageTitle =
    'Центр детского творчества «АРТ центр»';

$pageDescription =
    'Творческие занятия для детей и подростков: современный танец, акробатика, сценическое движение, актёрское мастерство и музыкальные постановки.';

$pageLead =
    'Центр детского творчества «АРТ центр» — это безграничное творческое пространство для детей и подростков, где каждый может реализовать себя в качестве настоящего артиста сцены.';

$currentLocale =
    'ru';

/*
|--------------------------------------------------------------------------
| Ссылка на официальную страницу
|--------------------------------------------------------------------------
|
| Когда будет известен точный адрес страницы «АРТ центра» на официальном
| сайте РКЦ, замените только значение между одинарными кавычками.
|
*/

$officialPageUrl =
    'https://hungary.rs.gov.ru/';

/*
|--------------------------------------------------------------------------
| Фотографии
|--------------------------------------------------------------------------
|
| Все четыре файла нужно загрузить в каталог /new-home/img/
| без изменения их имён.
|
*/

$mainImage = [
    'src' =>
        '/new-home/img/art-center-stage-performance-budapest.jpg',
    'alt' =>
        'Участники «АРТ центра» исполняют пластическую композицию на сцене Российского культурного центра в Будапеште',
    'caption' =>
        'Сценическая постановка участников «АРТ центра»',
    'width' => 1600,
    'height' => 900,
];

$galleryImages = [
    [
        'src' =>
            '/new-home/img/art-center-modern-dance-rehearsal.jpg',
        'alt' =>
            'Участники «АРТ центра» выполняют упражнения на занятии по современной хореографии',
        'caption' =>
            'Репетиция современной хореографии',
        'width' => 1080,
        'height' => 608,
    ],
    [
        'src' =>
            '/new-home/img/art-center-musical-theatre-performance.jpg',
        'alt' =>
            'Танцевальная постановка «АРТ центра» с яркими сценическими тканями',
        'caption' =>
            'Музыкально-пластическая композиция',
        'width' => 1080,
        'height' => 608,
    ],
    [
        'src' =>
            '/new-home/img/art-center-ensemble-stage-performance.jpg',
        'alt' =>
            'Ансамбль «АРТ центра» во время сценического выступления',
        'caption' =>
            'Командная работа над сценическим образом',
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
        '/new-home/art-center.php'
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
    'panel' => 'Поделиться страницей',
    'title' => 'Поделиться',
    'max' => 'Поделиться в MAX',
    'vk' => 'Поделиться во ВКонтакте',
    'ok' => 'Поделиться в Одноклассниках',
    'telegram' => 'Поделиться в Telegram',
    'print' => 'Версия для печати',
    'copied' => 'Ссылка скопирована',
    'copy_failed' =>
        'Скопируйте ссылку из адресной строки браузера',
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
            overflow: visible;
            position: relative;
            border-radius: 18px;
        }

        /* Without JavaScript, all photos remain visible. */
        .art-center-slider__track {
            display: grid;
            gap: 22px;
        }

        .art-center-slider__slide {
            min-width: 0;
            margin: 0;
        }

        .art-center-slider__frame {
            overflow: hidden;
            aspect-ratio: 16 / 9;
            border-radius: 18px;
            background: #eef2f7;
        }

        .art-center-slider__image {
            display: block;
            width: 100%;
            height: 100%;
            max-width: 100%;
            object-fit: contain;
            pointer-events: none;
        }

        .art-center-slider__caption {
            margin: 10px 0 0;
            padding: 0 6px;
            color: #667085;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 400;
            text-align: center;
        }

        .art-center-slider__arrow,
        .art-center-slider__navigation {
            display: none;
        }

        @media screen and (min-width: 761px) {
            .art-center-slider.is-ready .art-center-slider__viewport {
                overflow: hidden;
                border: 1px solid #e4e7ec;
                background: #ffffff;
                box-shadow: 0 14px 36px rgba(16, 24, 40, 0.10);
            }

            .art-center-slider.is-ready .art-center-slider__track {
                display: flex;
                gap: 0;
                transform: translate3d(0, 0, 0);
                transition: transform 360ms ease;
                cursor: grab;
                touch-action: pan-y;
                user-select: none;
            }

            .art-center-slider.is-ready .art-center-slider__track.is-dragging {
                transition: none;
                cursor: grabbing;
            }

            .art-center-slider.is-ready .art-center-slider__slide {
                flex: 0 0 100%;
            }

            .art-center-slider.is-ready .art-center-slider__frame {
                border-radius: 0;
            }

            .art-center-slider.is-ready .art-center-slider__caption {
                margin: 0;
                padding: 14px 20px;
            }

            .art-center-slider.is-ready .art-center-slider__arrow {
                position: absolute;
                z-index: 2;
                top: 42%;
                display: flex;
                width: 46px;
                height: 46px;
                align-items: center;
                justify-content: center;
                padding: 0;
                border: 1px solid #d0d5dd;
                border-radius: 50%;
                color: #223b82;
                background: #ffffff;
                box-shadow: 0 4px 16px rgba(16, 24, 40, 0.16);
                font: 700 31px/1 Arial, Helvetica, sans-serif;
                cursor: pointer;
                transform: translateY(-50%);
            }

            .art-center-slider__arrow--previous { left: 14px; }
            .art-center-slider__arrow--next { right: 14px; }

            .art-center-slider.is-ready .art-center-slider__navigation {
                display: block;
                margin-top: 16px;
            }

            .art-center-slider__thumbnails {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 12px;
            }

            .art-center-slider__thumbnail {
                display: block;
                min-width: 0;
                width: 100%;
                padding: 4px;
                overflow: hidden;
                box-sizing: border-box;
                border: 2px solid #d0d5dd;
                border-radius: 12px;
                background: #ffffff;
                cursor: pointer;
            }

            .art-center-slider__thumbnail:hover {
                border-color: #84adff;
            }

            .art-center-slider__thumbnail[aria-current="true"] {
                border-color: #223b82;
                background: #eaf0ff;
                box-shadow: 0 0 0 1px #223b82;
            }

            .art-center-slider__thumbnail-image {
                display: block;
                width: 100%;
                height: auto;
                aspect-ratio: 16 / 9;
                object-fit: cover;
                border-radius: 7px;
                pointer-events: none;
            }

            .art-center-slider__counter {
                margin: 10px 0 0;
                color: #667085;
                font-size: 13px;
                font-weight: 600;
                text-align: right;
            }
        }

        .art-center-slider:focus-visible,
        .art-center-slider button:focus-visible {
            outline: 3px solid #175cd3;
            outline-offset: 4px;
        }

        @media (prefers-reduced-motion: reduce) {
            .art-center-slider.is-ready .art-center-slider__track {
                transition: none;
            }
        }

        @media print {
            .art-center-slider__track {
                display: grid !important;
                gap: 18px;
                transform: none !important;
            }
            .art-center-slider__slide { break-inside: avoid; }
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
            .art-center-directions { grid-template-columns: 1fr; }
            .art-center-slider { margin-bottom: 36px; }
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
    '/includes/header.php';
?>

<main class="standard-page art-center-page">

    <div class="standard-page__container">

        <p class="art-center-back">
            <a href="/new-home/">
                ← Вернуться на главную
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
                    aria-label="Фотографии «АРТ центра»"
                    data-art-slider-role="карусель"
                    tabindex="-1"
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
                                    id="art-center-slide-<?= $index + 1 ?>"
                                    data-art-slider-slide
                                    aria-label="<?= ($index + 1) . ' из ' . count($slides) ?>"
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
                            aria-label="Предыдущая фотография"
                            data-art-slider-previous
                        >&#8249;</button>

                        <button
                            class="art-center-slider__arrow art-center-slider__arrow--next"
                            type="button"
                            aria-label="Следующая фотография"
                            data-art-slider-next
                        >&#8250;</button>

                    </div>

                    <div class="art-center-slider__navigation">

                        <div
                            class="art-center-slider__thumbnails"
                            aria-label="Выбор фотографии"
                        >
                            <?php foreach ($slides as $index => $image): ?>
                                <button
                                    class="art-center-slider__thumbnail"
                                    type="button"
                                    aria-label="Показать фотографию <?= $index + 1 ?>"
                                    aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                                    data-art-slider-thumbnail="<?= $index ?>"
                                    aria-controls="art-center-slide-<?= $index + 1 ?>"
                                >
                                    <img
                                        class="art-center-slider__thumbnail-image"
                                        src="<?= $escape($image['src']) ?>"
                                        alt=""
                                        width="160"
                                        height="90"
                                        loading="lazy"
                                        decoding="async"
                                        draggable="false"
                                    >
                                </button>
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

                    <h2>Чему учатся участники</h2>

                    <p>
                        Мы изучаем современные танцевальные техники,
                        основы акробатики и сценического движения,
                        эстрадные направления танца, практикуемся
                        в актёрском мастерстве и эмоциональной
                        выразительности, применяем и оживляем
                        разнообразные сценические образы.
                    </p>

                    <ul class="art-center-directions">
                        <li>Современные и эстрадные направления танца</li>
                        <li>Основы акробатики и сценического движения</li>
                        <li>Актёрское мастерство и эмоциональная выразительность</li>
                        <li>Создание и воплощение сценических образов</li>
                    </ul>

                </section>

                <section
                    class="art-center-section"
                    id="team"
                >

                    <h2>Творчество и команда</h2>

                    <p>
                        Мы учимся танцевать, припевая, и петь,
                        танцуя, доносить режиссёрский замысел
                        на языке жестов и пластики тела, открываем
                        в себе новые творческие способности,
                        не боимся быть разными и яркими, учимся
                        работать в команде единомышленников.
                    </p>

                </section>

                <section
                    class="art-center-section"
                    id="productions"
                >

                    <h2>Собственные постановки</h2>

                    <p>
                        Мы создаём концертные программы,
                        интерактивные и пластические спектакли,
                        музыкальные театрализованные представления.
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
                            На этой странице
                        </h2>

                        <nav
                            class="art-center-sidebar__nav"
                            aria-label="Разделы страницы"
                        >
                            <a href="#about">Об «АРТ центре»</a>
                            <a href="#directions">Направления занятий</a>
                            <a href="#team">Творчество и команда</a>
                            <a href="#productions">Постановки</a>
                            <a href="#gallery">Галерея</a>
                        </nav>

                    </div>

                    <div class="art-center-sidebar__block">

                        <h2 class="art-center-sidebar__title">
                            Дополнительная информация
                        </h2>

                        <div class="art-center-contact">
                            <p>
                                <a
                                    href="<?= $escape($officialPageUrl) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >Более подробная информация на официальном сайте РКЦ в Будапеште</a>
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
    '/includes/footer.php';
?>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const artSlider = document.querySelector('[data-art-slider]');

    if (artSlider) {
        const sliderTrack = artSlider.querySelector('[data-art-slider-track]');
        const slides = Array.from(artSlider.querySelectorAll('[data-art-slider-slide]'));
        const thumbnails = Array.from(artSlider.querySelectorAll('[data-art-slider-thumbnail]'));
        const previous = artSlider.querySelector('[data-art-slider-previous]');
        const next = artSlider.querySelector('[data-art-slider-next]');
        const counter = artSlider.querySelector('[data-art-slider-counter]');
        const desktop = window.matchMedia('screen and (min-width: 761px)');
        let current = 0;
        let pointer = null;
        let startX = 0;
        let distance = 0;
        let printing = false;

        const isDesktop = function () {
            return desktop.matches && !printing;
        };

        const render = function () {
            const active = isDesktop();
            artSlider.tabIndex = active ? 0 : -1;
            if (active) {
                artSlider.setAttribute('aria-roledescription', artSlider.dataset.artSliderRole);
            } else {
                artSlider.removeAttribute('aria-roledescription');
            }
            sliderTrack.style.transform = active
                ? 'translate3d(-' + (current * 100) + '%, 0, 0)'
                : '';
            slides.forEach(function (slide, index) {
                if (active && index !== current) {
                    slide.setAttribute('aria-hidden', 'true');
                } else {
                    slide.removeAttribute('aria-hidden');
                }
            });
            thumbnails.forEach(function (button, index) {
                button.setAttribute('aria-current', index === current ? 'true' : 'false');
            });
            counter.textContent = (current + 1) + ' / ' + slides.length;
        };

        const cancelDrag = function () {
            const captured = pointer;
            pointer = null;
            distance = 0;
            sliderTrack.classList.remove('is-dragging');
            if (captured !== null && sliderTrack.hasPointerCapture(captured)) {
                sliderTrack.releasePointerCapture(captured);
            }
        };

        const show = function (index) {
            if (!isDesktop() || !slides.length) return;
            cancelDrag();
            current = ((index % slides.length) + slides.length) % slides.length;
            render();
        };

        previous.addEventListener('click', function () { show(current - 1); });
        next.addEventListener('click', function () { show(current + 1); });
        thumbnails.forEach(function (button) {
            button.addEventListener('click', function () {
                show(Number(button.dataset.artSliderThumbnail));
            });
        });
        artSlider.addEventListener('keydown', function (event) {
            if (!isDesktop() || event.altKey || event.ctrlKey || event.metaKey) return;
            if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
                event.preventDefault();
                show(current + (event.key === 'ArrowLeft' ? -1 : 1));
            }
        });

        sliderTrack.addEventListener('pointerdown', function (event) {
            if (!isDesktop() || event.button !== 0 || !event.isPrimary || pointer !== null) return;
            pointer = event.pointerId;
            startX = event.clientX;
            distance = 0;
            sliderTrack.classList.add('is-dragging');
            sliderTrack.setPointerCapture(pointer);
        });
        sliderTrack.addEventListener('pointermove', function (event) {
            if (pointer !== event.pointerId || !isDesktop()) return;
            distance = event.clientX - startX;
            sliderTrack.style.transform =
                'translate3d(calc(-' + (current * 100) + '% + ' + distance + 'px), 0, 0)';
        });
        sliderTrack.addEventListener('pointerup', function (event) {
            if (pointer !== event.pointerId) return;
            const delta = event.clientX - startX;
            const threshold = Math.min(90, sliderTrack.clientWidth * 0.14);
            const step = Math.abs(delta) >= threshold ? (delta < 0 ? 1 : -1) : 0;
            cancelDrag();
            show(current + step);
        });
        ['pointercancel', 'lostpointercapture'].forEach(function (name) {
            sliderTrack.addEventListener(name, function (event) {
                if (pointer !== event.pointerId) return;
                cancelDrag();
                render();
            });
        });
        sliderTrack.addEventListener('dragstart', function (event) {
            if (isDesktop()) event.preventDefault();
        });
        const changeMode = function () {
            cancelDrag();
            render();
        };
        if (desktop.addEventListener) {
            desktop.addEventListener('change', changeMode);
        } else {
            desktop.addListener(changeMode);
        }
        window.addEventListener('beforeprint', function () {
            printing = true;
            changeMode();
        });
        window.addEventListener('afterprint', function () {
            printing = false;
            changeMode();
        });
        render();
        if (slides.length > 1) artSlider.classList.add('is-ready');
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
