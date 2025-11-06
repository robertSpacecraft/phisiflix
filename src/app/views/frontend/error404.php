<?php
include_once DIRECTORIO_FRONTEND."/templates/partials/header.php";
?>
    <section class="d-flex align-items-center min-vh-100 py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <div class="lc-block">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_kcsr6fcp.json" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-start ">
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <!-- <h1 class="fw-bold h4">PAGE NOT FOUND!<br></h1> -->
                        </div>
                    </div>
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <h1 class="display-1 fw-bold text-muted">Error 404</h1>

                        </div>
                    </div>
                    <div class="lc-block mb-5">
                        <div editable="rich">
                            <p class="rfs-11 fw-light">
                                Lo que estás buscando no está por aquí.
                                <?= isset($mensaje) ? "<br><small>$mensaje</small>" : "" ?>
                            </p>

                        </div>
                    </div>
                    <div class="lc-block">
                        <a class="btn btn-lg btn-secondary" href="/" role="button">vuelve home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php
include_once DIRECTORIO_FRONTEND."/templates/partials/footer.php";
