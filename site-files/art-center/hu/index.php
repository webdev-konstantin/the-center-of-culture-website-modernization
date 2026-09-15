<?php
$currentLocale = 'hu';
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Orosz Kulturális Központ Budapesten"
    >

    <title>Orosz Kulturális Központ Budapesten</title>

    <!-- Header -->
    <link
        rel="stylesheet"
        href="/new-home/css/header.css"
    >

    <!-- Hero -->
    <link
        rel="stylesheet"
        href="/new-home/css/hero.css"
    >

    <!-- Hírek karusszel -->
    <link
        rel="stylesheet"
        href="/new-home/css/content-carousel.css"
    >

    <!-- Stúdiók és tanfolyamok -->
    <link
        rel="stylesheet"
        href="/new-home/css/studios.css?v=20260830-1"
    >

    <!-- Footer -->
    <link
        rel="stylesheet"
        href="/new-home/css/footer.css?v=20260830-2"
    >
</head>

<body>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<main>

    <?php require __DIR__ . '/../includes/hero-slider.php'; ?>

    <!-- ==================================================
                         HÍREINK
    ================================================== -->

    <section
        class="content-carousel-section"
        id="news-section"
        aria-labelledby="news-title"
        data-carousel="content"
    >

        <div class="content-carousel-container">

            <header class="content-carousel-header">

                <div class="content-carousel-title-group">

                    <h2 id="news-title">
                        Híreink
                    </h2>

                    <a
                        class="content-carousel-all-link"
                        href="/new-home/hu/media/"
                    >
                        Hírek és média →
                    </a>

                </div>

            </header>

            <div class="content-carousel">

                <button
                    class="content-carousel-arrow content-carousel-arrow-prev"
                    type="button"
                    aria-label="Előző hírek"
                >
                    &#10094;
                </button>

                <div class="content-carousel-viewport">

                    <div class="content-carousel-track">

                        <?php
                        include __DIR__ .
                            '/../api/news-carousel.php';
                        ?>

                    </div>

                </div>

                <button
                    class="content-carousel-arrow content-carousel-arrow-next"
                    type="button"
                    aria-label="Következő hírek"
                >
                    &#10095;
                </button>

            </div>

            <div
                class="content-carousel-dots"
                aria-label="Hírek navigációja"
            ></div>

        </div>

    </section>


    <!-- ==================================================
                 STÚDIÓK ÉS TANFOLYAMOK
    ================================================== -->

    <section
        class="studios"
        aria-labelledby="studios-title"
    >

        <div class="studios-container">

            <header class="studios-header">

                <h2 id="studios-title">
                    Stúdiók és tanfolyamok
                </h2>

                <p>
                    Felnőtteknek és gyermekeknek
                </p>

            </header>

            <div class="studios-grid">

                <!-- 1. Orosz nyelv -->
                <article class="studio-card">

                    <a
                        class="studio-card-link"
                        href="/new-home/under-construction.php"
                        aria-label="Orosz nyelvtanulás"
                    >

                        <img
                            class="studio-card-image"
                            src="/new-home/img/tild3564-3765-4762-b834-323739636364__a_budapesti_orosz_ku.jpg"
                            alt="Orosznyelv-tanfolyam"
                        >

                        <div class="studio-card-overlay"></div>

                        <div class="studio-card-content">

                            <h3>
                                Orosz nyelvtanulás
                            </h3>

                            <p>
                                Orosznyelv-tanfolyamok
                            </p>

                        </div>

                    </a>

                </article>


                <!-- 2. Zongorastúdió -->
                <article class="studio-card">

                    <a
                        class="studio-card-link"
                        href="/new-home/under-construction.php"
                        aria-label="Zongorastúdió"
                    >

                        <img
                            class="studio-card-image"
                            src="/new-home/img/tild3862-3564-4130-a564-623530396634__zongorastdi_a_budape.png"
                            alt="Foglalkozás a zongorastúdióban"
                        >

                        <div class="studio-card-overlay"></div>

                        <div class="studio-card-content">

                            <h3>
                                Zongorastúdió
                            </h3>

                            <p>
                                Ötéves kortól várjuk a növendékeket
                                zongoraórákra kedden, szerdán és csütörtökön.
                            </p>

                        </div>

                    </a>

                </article>


                <!-- 3. ART Gyermekalkotó Központ -->
                <article class="studio-card">

                    <a
                        class="studio-card-link"
                        href="/new-home/hu/art-center.php"
                        aria-label="ART Gyermekalkotó Központ"
                    >

                        <img
                            class="studio-card-image"
                            src="/new-home/img/tild6162-3864-4964-b433-653134383064__332259290_9692369942.jpeg"
                            alt="Foglalkozás az ART Gyermekalkotó Központban"
                        >

                        <div class="studio-card-overlay"></div>

                        <div class="studio-card-content">

                            <h3>
                                „ART” Gyermekalkotó Központ
                            </h3>

                            <p>
                                Modern tánctechnikák, az akrobatika
                                és a színpadi mozgás alapjai,
                                valamint fellépések gyermekeknek
                                és fiataloknak.
                            </p>

                        </div>

                    </a>

                </article>


                <!-- 4. Artist Gyermekszínházi Stúdió -->
                <article class="studio-card">

                    <a
                        class="studio-card-link"
                        href="/new-home/under-construction.php"
                        aria-label="Artist Gyermekszínházi Stúdió"
                    >

                        <img
                            class="studio-card-image"
                            src="/new-home/img/tild3336-3565-4264-b762-323933326230__gyermeksznhzi_stdi_m.jpg"
                            alt="Foglalkozás a gyermekszínházi stúdióban"
                        >

                        <div class="studio-card-overlay"></div>

                        <div class="studio-card-content">

                            <h3>
                                „Artist” Gyermekszínházi Stúdió
                            </h3>

                            <p>
                                Olyan gyermekeket várunk, akik szeretnék
                                megtenni első lépéseiket a színpad világában,
                                és később akár életüket is
                                a színházhoz kötnék.
                            </p>

                        </div>

                    </a>

                </article>


                <!-- 5. Balettiskola -->
                <article class="studio-card">

                    <a
                        class="studio-card-link"
                        href="/new-home/under-construction.php"
                        aria-label="Ali Tankybajeva balettiskolája"
                    >

                        <img
                            class="studio-card-image"
                            src="/new-home/img/tild3662-3531-4765-b534-316165656534__balettstdi_a_budapes.png"
                            alt="Foglalkozás a balettiskolában"
                        >

                        <div class="studio-card-overlay"></div>

                        <div class="studio-card-content">

                            <h3>
                                Ali Tankybajeva balettiskolája
                            </h3>

                            <p>
                                Merüljön el a balett varázslatos világában!
                                Foglalkozásainkat felnőttek és gyermekek számára,
                                bármilyen előképzettséggel kínáljuk.
                            </p>

                        </div>

                    </a>

                </article>


                <!-- 6. Könyvtár -->
                <article class="studio-card">

                    <a
                        class="studio-card-link"
                        href="/new-home/under-construction.php"
                        aria-label="Könyvtár"
                    >

                        <img
                            class="studio-card-image"
                            src="/new-home/img/the_library_of_the_russian_culture_centre_of_budapest.jpeg"
                            alt="Az Orosz Kulturális Központ könyvtára"
                        >

                        <div class="studio-card-overlay"></div>

                        <div class="studio-card-content">

                            <h3>
                                Könyvtár
                            </h3>

                        </div>

                    </a>

                </article>

            </div>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script src="/new-home/js/hero.js?v=20260829-1"></script>
<script src="/new-home/js/content-carousel.js?v=20260813-1"></script>

</body>
</html>
