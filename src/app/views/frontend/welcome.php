<?php
include_once "app/views/frontend/templates/partials/header.php";


?>

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <h2>Bienvendio a la web donde descubrirás la historia de la física</h2>
                    <p>Decubre los hitos que han cambiado la historia de la humanidad de la mano de sus protagonistas</p>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/IsaacNewton.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/IsaacNewton.png" title="IsaakNewton" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                            <a href="https://es.wikipedia.org/wiki/Isaac_Newton" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/AlbertEinstein.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/AlbertEinstein.png" title="AlbertEinstein" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                            <a href="https://es.wikipedia.org/wiki/Albert_Einstein" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/MaxPlanck.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/MaxPlanck.png" title="MaxPlanck" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                            <a href="https://es.wikipedia.org/wiki/Max_Planck" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/ErwinSchrodinger.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="/app/views/frontend/templates/PhotoFolio/assets/img/gallery/ErwinSchrodinger.png" title="ErwinSchrodinger" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                            <a href="https://es.wikipedia.org/wiki/Erwin_Schr%C3%B6dinger" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->

            </div>

        </div>

    </section><!-- /Gallery Section -->

<?php
include_once "app/views/frontend/templates/partials/footer.php";