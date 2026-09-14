<?php
/*
|--------------------------------------------------------------------------
| Единый Header для RU / HU
|--------------------------------------------------------------------------
| Если страница сама не задала язык, считаем её русской.
*/

$headerRequestUri = (string) ($_SERVER['REQUEST_URI'] ?? '');

$currentLocale = $currentLocale ?? (
    strpos($headerRequestUri, '/new-home/hu/') !== false
        ? 'hu'
        : 'ru'
);

if (!in_array($currentLocale, ['ru', 'hu'], true)) {
    $currentLocale = 'ru';
}

$isHu = $currentLocale === 'hu';

$headerText = $isHu
    ? [
        'official_aria' => 'A budapesti Orosz Kulturális Központ hivatalos honlapjának megnyitása',
        'official_title' => 'Orosz Kulturális Központ Budapesten',
        'telegram_aria' => 'A budapesti Orosz Kulturális Központ Telegram-csatornájának megnyitása',
        'telegram_title' => 'A budapesti Orosz Kulturális Központ Telegram-csatornája',
        'logo_aria' => 'Ugrás a magyar nyelvű főoldalra',
        'logo_alt' => 'Orosz Kulturális Központ Budapesten',

        'contacts' => 'Kapcsolat',
        'contacts_aria' => 'Kapcsolat',
        'search' => 'Keresés',
        'search_aria' => 'Keresés az oldalon',

        'accessibility' => 'Gyengénlátó verzió',
        'accessibility_open_aria' => 'Gyengénlátó verzió beállításainak megnyitása',
        'accessibility_title' => 'Gyengénlátó verzió',
        'accessibility_close' => 'Bezárás',

        'font_size' => 'Betűméret',
        'font_normal' => 'Normál',
        'font_large' => 'Nagy',
        'font_xlarge' => 'Nagyon nagy',

        'contrast' => 'Kontraszt',
        'contrast_normal' => 'Normál',
        'contrast_dark' => 'Fekete háttér',

        'spacing' => 'Nagyobb térköz',
        'spacing_off' => 'Kikapcsolva',
        'spacing_on' => 'Bekapcsolva',

        'reset' => 'Normál verzió',

        'language_aria' => 'Nyelvválasztás',
        'nav_aria' => 'Főmenü',

        'about' => 'A központról',
        'news' => 'Hírek és programok',
        'study' => 'Tanulás Oroszországban',
        'russian' => 'Orosz nyelvtanulás',
        'projects' => 'Projektek és programok',
        'compatriots' => 'Honfitársainknak',
    ]
    : [
        'official_aria' => 'Открыть официальный сайт РКЦ в Будапеште',
        'official_title' => 'Сайт Российского культурного центра в Будапеште',
        'telegram_aria' => 'Открыть Telegram-канал РКЦ в Будапеште',
        'telegram_title' => 'Telegram-канал Российского культурного центра в Будапеште',
        'logo_aria' => 'Перейти на главную страницу',
        'logo_alt' => 'Российский культурный центр в Будапеште',

        'contacts' => 'Контакты',
        'contacts_aria' => 'Открыть контакты',
        'search' => 'Поиск',
        'search_aria' => 'Поиск по сайту',

        'accessibility' => 'Версия для слабовидящих',
        'accessibility_open_aria' => 'Открыть настройки версии для слабовидящих',
        'accessibility_title' => 'Версия для слабовидящих',
        'accessibility_close' => 'Закрыть',

        'font_size' => 'Размер текста',
        'font_normal' => 'Обычный',
        'font_large' => 'Крупный',
        'font_xlarge' => 'Очень крупный',

        'contrast' => 'Контраст',
        'contrast_normal' => 'Обычный',
        'contrast_dark' => 'Чёрный фон',

        'spacing' => 'Интервалы',
        'spacing_off' => 'Обычные',
        'spacing_on' => 'Увеличенные',

        'reset' => 'Обычная версия',

        'language_aria' => 'Выбор языка',
        'nav_aria' => 'Главное меню',

        'about' => 'О центре',
        'news' => 'Новости и анонсы',
        'study' => 'Обучение в России',
        'russian' => 'Изучение русского языка',
        'projects' => 'Проекты и программы',
        'compatriots' => 'Соотечественникам',
    ];

$homeUrl = $isHu
    ? '/new-home/hu/'
    : '/new-home/';

$searchUrl = $isHu
    ? '/new-home/under-construction.php?lang=hu'
    : '/new-home/search.php';

$aboutUrl = $isHu
    ? '/new-home/hu/the-russian-culture-centre-in-budapest.php'
    : '/new-home/the-russian-culture-centre-in-budapest.php';

$newsUrl = $isHu
    ? '/new-home/hu/media/'
    : '/new-home/ru/media/';

$educationUrl = $isHu
    ? '/new-home/hu/education-in-russia.php'
    : '/new-home/education-in-russia.php';

$compatriotsUrl = $isHu
    ? '/new-home/hu/compatriots.php'
    : '/new-home/compatriots.php';

$temporaryUrl = $isHu
    ? '/new-home/under-construction.php?lang=hu'
    : '/new-home/under-construction.php';

$headerRequestPath = (string) (
    parse_url($headerRequestUri, PHP_URL_PATH) ?? ''
);

$headerIsAboutPage =
    basename($headerRequestPath) ===
    'the-russian-culture-centre-in-budapest.php';

$headerIsMediaPage =
    strpos($headerRequestPath, '/media/') !== false;

$headerIsEducationPage =
    basename($headerRequestPath) ===
    'education-in-russia.php';

$headerIsCompatriotsPage =
    basename($headerRequestPath) ===
    'compatriots.php';

$headerIsArtCenterPage =
    basename($headerRequestPath) ===
    'art-center.php';

$ruLanguageUrl = '/new-home/';
$huLanguageUrl = '/new-home/hu/';

if ($headerIsAboutPage) {
    $ruLanguageUrl =
        '/new-home/the-russian-culture-centre-in-budapest.php';
    $huLanguageUrl =
        '/new-home/hu/the-russian-culture-centre-in-budapest.php';
} elseif ($headerIsMediaPage) {
    $ruLanguageUrl = '/new-home/ru/media/';
    $huLanguageUrl = '/new-home/hu/media/';
} elseif ($headerIsEducationPage) {
    $ruLanguageUrl = '/new-home/education-in-russia.php';
    $huLanguageUrl = '/new-home/hu/education-in-russia.php';
} elseif ($headerIsCompatriotsPage) {
    $ruLanguageUrl = '/new-home/compatriots.php';
    $huLanguageUrl = '/new-home/hu/compatriots.php';
} elseif ($headerIsArtCenterPage) {
    $ruLanguageUrl = '/new-home/art-center.php';
    $huLanguageUrl = '/new-home/hu/art-center.php';
}
?>

<!-- ==================================================
                     HEADER
================================================== -->

<header
    class="site-header"
    data-header-build="20260914-art-center-navigation-v1"
    data-locale="<?= htmlspecialchars($currentLocale, ENT_QUOTES, 'UTF-8') ?>"
>

    <div class="header-top">

        <!-- Официальные ресурсы -->
        <div class="socials">

            <a
                class="social-link social-link--official"
                href="https://hungary.rs.gov.ru/"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?= htmlspecialchars($headerText['official_aria'], ENT_QUOTES, 'UTF-8') ?>"
                title="<?= htmlspecialchars($headerText['official_title'], ENT_QUOTES, 'UTF-8') ?>"
            >
                <img
                    class="social-icon"
                    src="/new-home/img/social/official-site.svg"
                    alt=""
                    aria-hidden="true"
                >
            </a>

            <a
                class="social-link social-link--telegram"
                href="https://t.me/oroszhaz"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?= htmlspecialchars($headerText['telegram_aria'], ENT_QUOTES, 'UTF-8') ?>"
                title="<?= htmlspecialchars($headerText['telegram_title'], ENT_QUOTES, 'UTF-8') ?>"
            >
                <img
                    class="social-icon"
                    src="/new-home/img/social/telegram.svg"
                    alt=""
                    aria-hidden="true"
                >
            </a>

        </div>

        <!-- Логотип -->
        <a
            class="logo"
            href="<?= htmlspecialchars($homeUrl, ENT_QUOTES, 'UTF-8') ?>"
            aria-label="<?= htmlspecialchars($headerText['logo_aria'], ENT_QUOTES, 'UTF-8') ?>"
        >
            <img
                src="/img/orosz-kulturális-központ.web-site.png"
                alt="<?= htmlspecialchars($headerText['logo_alt'], ENT_QUOTES, 'UTF-8') ?>"
            >
        </a>

        <!-- Современная панель действий -->
        <div class="top-actions">

            <div class="utility-row">

                <a
                    class="utility-link utility-link--contact"
                    href="https://hungary.rs.gov.ru/about-russian-houses/"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?= htmlspecialchars($headerText['contacts_aria'], ENT_QUOTES, 'UTF-8') ?>"
                >
                    <svg class="utility-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M7.2 3.5h2.3l1.2 4.1-1.7 1.4a14.4 14.4 0 0 0 6 6l1.4-1.7 4.1 1.2v2.3a3 3 0 0 1-3 3C10 19.8 4.2 14 4.2 6.5a3 3 0 0 1 3-3Z"/>
                    </svg>
                    <span><?= htmlspecialchars($headerText['contacts'], ENT_QUOTES, 'UTF-8') ?></span>
                </a>

                <a
                    class="utility-link"
                    href="<?= htmlspecialchars($searchUrl, ENT_QUOTES, 'UTF-8') ?>"
                    aria-label="<?= htmlspecialchars($headerText['search_aria'], ENT_QUOTES, 'UTF-8') ?>"
                >
                    <svg class="utility-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="6.5"></circle>
                        <path d="m16 16 4.2 4.2"></path>
                    </svg>
                    <span><?= htmlspecialchars($headerText['search'], ENT_QUOTES, 'UTF-8') ?></span>
                </a>

                <div
                    class="language-switcher"
                    role="group"
                    aria-label="<?= htmlspecialchars($headerText['language_aria'], ENT_QUOTES, 'UTF-8') ?>"
                >
                    <a
                        class="lang-link<?= !$isHu ? ' is-active' : '' ?>"
                        href="<?= htmlspecialchars($ruLanguageUrl, ENT_QUOTES, 'UTF-8') ?>"
                        lang="ru"
                        hreflang="ru"
                        <?= !$isHu ? 'aria-current="page"' : '' ?>
                    >
                        RU
                    </a>

                    <a
                        class="lang-link<?= $isHu ? ' is-active' : '' ?>"
                        href="<?= htmlspecialchars($huLanguageUrl, ENT_QUOTES, 'UTF-8') ?>"
                        lang="hu"
                        hreflang="hu"
                        <?= $isHu ? 'aria-current="page"' : '' ?>
                    >
                        HU
                    </a>
                </div>

            </div>

            <button
                class="accessibility-trigger"
                type="button"
                data-a11y-open
                aria-expanded="false"
                aria-controls="a11y-panel"
                aria-label="<?= htmlspecialchars($headerText['accessibility_open_aria'], ENT_QUOTES, 'UTF-8') ?>"
            >
                <svg class="accessibility-eye" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"></path>
                    <circle cx="12" cy="12" r="2.8"></circle>
                </svg>
                <span><?= htmlspecialchars($headerText['accessibility'], ENT_QUOTES, 'UTF-8') ?></span>
            </button>

        </div>

    </div>

    <!-- Панель версии для слабовидящих -->
    <section
        class="a11y-panel"
        id="a11y-panel"
        aria-label="<?= htmlspecialchars($headerText['accessibility_title'], ENT_QUOTES, 'UTF-8') ?>"
        hidden
    >
        <div class="a11y-panel-inner">

            <div class="a11y-panel-heading">
                <div class="a11y-panel-title">
                    <svg class="accessibility-eye" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"></path>
                        <circle cx="12" cy="12" r="2.8"></circle>
                    </svg>
                    <strong><?= htmlspecialchars($headerText['accessibility_title'], ENT_QUOTES, 'UTF-8') ?></strong>
                </div>

                <button
                    class="a11y-close"
                    type="button"
                    data-a11y-close
                    aria-label="<?= htmlspecialchars($headerText['accessibility_close'], ENT_QUOTES, 'UTF-8') ?>"
                >
                    ×
                </button>
            </div>

            <div class="a11y-controls">

                <div class="a11y-control">
                    <span class="a11y-control-label">
                        <?= htmlspecialchars($headerText['font_size'], ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <div class="a11y-button-group" role="group">
                        <button type="button" data-a11y-font="normal">
                            A
                            <span><?= htmlspecialchars($headerText['font_normal'], ENT_QUOTES, 'UTF-8') ?></span>
                        </button>

                        <button type="button" data-a11y-font="large">
                            A+
                            <span><?= htmlspecialchars($headerText['font_large'], ENT_QUOTES, 'UTF-8') ?></span>
                        </button>

                        <button type="button" data-a11y-font="xlarge">
                            A++
                            <span><?= htmlspecialchars($headerText['font_xlarge'], ENT_QUOTES, 'UTF-8') ?></span>
                        </button>
                    </div>
                </div>

                <div class="a11y-control">
                    <span class="a11y-control-label">
                        <?= htmlspecialchars($headerText['contrast'], ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <div class="a11y-button-group" role="group">
                        <button type="button" data-a11y-theme="normal">
                            <?= htmlspecialchars($headerText['contrast_normal'], ENT_QUOTES, 'UTF-8') ?>
                        </button>

                        <button type="button" data-a11y-theme="dark">
                            <?= htmlspecialchars($headerText['contrast_dark'], ENT_QUOTES, 'UTF-8') ?>
                        </button>
                    </div>
                </div>

                <div class="a11y-control">
                    <span class="a11y-control-label">
                        <?= htmlspecialchars($headerText['spacing'], ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <div class="a11y-button-group" role="group">
                        <button type="button" data-a11y-spacing="normal">
                            <?= htmlspecialchars($headerText['spacing_off'], ENT_QUOTES, 'UTF-8') ?>
                        </button>

                        <button type="button" data-a11y-spacing="large">
                            <?= htmlspecialchars($headerText['spacing_on'], ENT_QUOTES, 'UTF-8') ?>
                        </button>
                    </div>
                </div>

                <button
                    class="a11y-reset"
                    type="button"
                    data-a11y-reset
                >
                    <?= htmlspecialchars($headerText['reset'], ENT_QUOTES, 'UTF-8') ?>
                </button>

            </div>

        </div>
    </section>

    <!-- Главное меню -->
    <nav
        class="main-nav"
        aria-label="<?= htmlspecialchars($headerText['nav_aria'], ENT_QUOTES, 'UTF-8') ?>"
    >

        <a
            href="<?= htmlspecialchars($aboutUrl, ENT_QUOTES, 'UTF-8') ?>"
            <?= $headerIsAboutPage ? 'aria-current="page"' : '' ?>
        >
            <?= htmlspecialchars($headerText['about'], ENT_QUOTES, 'UTF-8') ?>
        </a>

        <a
            href="<?= htmlspecialchars($newsUrl, ENT_QUOTES, 'UTF-8') ?>"
            <?= $headerIsMediaPage ? 'aria-current="page"' : '' ?>
        >
            <?= htmlspecialchars($headerText['news'], ENT_QUOTES, 'UTF-8') ?>
        </a>

        <a
            href="<?= htmlspecialchars($educationUrl, ENT_QUOTES, 'UTF-8') ?>"
            <?= $headerIsEducationPage ? 'aria-current="page"' : '' ?>
        >
            <?= htmlspecialchars($headerText['study'], ENT_QUOTES, 'UTF-8') ?>
        </a>

        <a href="<?= htmlspecialchars($temporaryUrl, ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars($headerText['russian'], ENT_QUOTES, 'UTF-8') ?>
        </a>

        <a href="<?= htmlspecialchars($temporaryUrl, ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars($headerText['projects'], ENT_QUOTES, 'UTF-8') ?>
        </a>

        <a
            href="<?= htmlspecialchars($compatriotsUrl, ENT_QUOTES, 'UTF-8') ?>"
            <?= $headerIsCompatriotsPage ? 'aria-current="page"' : '' ?>
        >
            <?= htmlspecialchars($headerText['compatriots'], ENT_QUOTES, 'UTF-8') ?>
        </a>

    </nav>

</header>

<script src="/new-home/js/accessibility.js" defer></script>