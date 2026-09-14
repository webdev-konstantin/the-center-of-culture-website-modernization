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
    'Танец, сценическое движение, актёрское мастерство и совместное творчество для детей и подростков в Будапеште.';

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
        '/new-home/img/9fd8de_9-maya-rossijskij-kulturnyj-czentr-v-budapeshte-predstavil-meropritiya-v-oznamenovenii-80-j-godovshhine-pobedy-v-velikoj-otechestvennoj-vojne.-foto-3.jpg',
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
            '/new-home/img/Screenshot_20260911_134502_edit_334295669352787.jpg',
        'alt' =>
            'Участники «АРТ центра» выполняют упражнения на занятии по современной хореографии',
        'caption' =>
            'Репетиция современной хореографии',
        'width' => 1080,
        'height' => 608,
    ],
    [
        'src' =>
            '/new-home/img/Screenshot_20260911_134131_edit_334315567264394.jpg',
        'alt' =>
            'Танцевальная постановка «АРТ центра» с яркими сценическими тканями',
        'caption' =>
            'Музыкально-пластическая композиция',
        'width' => 1080,
        'height' => 608,
    ],
    [
        'src' =>
            '/new-home/img/Screenshot_20260911_135112.jpg',
        'alt' =>
            'Ансамбль «АРТ центра» во время сценического выступления',
        'caption' =>
            'Командная работа над сценическим образом',
        'width' => 1080,
        'height' => 608,
    ],
];

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

        .art-center-intro {
            margin: 0 0 30px;
            padding: 22px 24px;
            border: 1px solid #b2ccff;
            border-left: 5px solid #175cd3;
            border-radius: 16px;
            background:
                linear-gradient(
                    135deg,
                    #eff6ff 0%,
                    #f8fbff 100%
                );
            color: #1849a9;
            font-size: 18px;
            line-height: 1.7;
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

        .art-center-main-figure {
            margin: 30px 0 38px;
        }

        .art-center-main-frame {
            overflow: hidden;
            aspect-ratio: 16 / 9;
            border: 1px solid #e4e7ec;
            border-radius: 22px;
            background: #eef2f7;
            box-shadow:
                0 18px 44px rgba(16, 24, 40, 0.12);
        }

        .art-center-main-image,
        .art-center-gallery__image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .art-center-caption {
            margin: 12px 0 0;
            color: #667085;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 400;
            text-align: center;
        }

        .art-center-gallery {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin: 20px 0 0;
        }

        .art-center-gallery__item {
            min-width: 0;
            margin: 0;
        }

        .art-center-gallery__frame {
            overflow: hidden;
            aspect-ratio: 16 / 10;
            border: 1px solid #e4e7ec;
            border-radius: 16px;
            background: #eef2f7;
            box-shadow:
                0 10px 28px rgba(16, 24, 40, 0.08);
        }

        .art-center-gallery__item:nth-child(2)
        .art-center-gallery__image {
            object-position: center 34%;
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

        @media (max-width: 850px) {
            .art-center-gallery {
                grid-template-columns: 1fr;
            }

            .art-center-gallery__frame {
                aspect-ratio: 16 / 9;
            }
        }

        @media (max-width: 760px) {
            .art-center-directions {
                grid-template-columns: 1fr;
            }

            .art-center-intro {
                padding: 18px;
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

            .art-center-intro {
                font-size: 17px;
            }

            .art-center-main-frame {
                border-radius: 16px;
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

            .art-center-main-frame,
            .art-center-gallery__frame {
                box-shadow: none;
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

            <p class="standard-page__lead">
                <?= $escape($pageLead) ?>
            </p>

        </header>

        <div class="standard-page__layout">

            <article
                class="standard-page__content art-center-page__content"
            >

                <p class="art-center-intro" id="about">
                    Центр детского творчества «АРТ центр» — это
                    безграничное творческое пространство для детей
                    и подростков, где каждый может реализовать себя
                    в качестве настоящего артиста сцены.
                </p>

                <figure class="art-center-main-figure">

                    <div class="art-center-main-frame">
                        <img
                            class="art-center-main-image"
                            src="<?= $escape($mainImage['src']) ?>"
                            alt="<?= $escape($mainImage['alt']) ?>"
                            width="<?= (int) $mainImage['width'] ?>"
                            height="<?= (int) $mainImage['height'] ?>"
                            loading="eager"
                            decoding="async"
                        >
                    </div>

                    <figcaption class="art-center-caption">
                        <?= $escape($mainImage['caption']) ?>
                    </figcaption>

                </figure>

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

                <section
                    class="art-center-section"
                    id="gallery"
                >

                    <h2>Галерея «АРТ центра»</h2>

                    <div class="art-center-gallery">

                        <?php foreach ($galleryImages as $image): ?>

                            <figure class="art-center-gallery__item">

                                <div class="art-center-gallery__frame">
                                    <img
                                        class="art-center-gallery__image"
                                        src="<?= $escape($image['src']) ?>"
                                        alt="<?= $escape($image['alt']) ?>"
                                        width="<?= (int) $image['width'] ?>"
                                        height="<?= (int) $image['height'] ?>"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>

                                <figcaption class="art-center-caption">
                                    <?= $escape($image['caption']) ?>
                                </figcaption>

                            </figure>

                        <?php endforeach; ?>

                    </div>

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
