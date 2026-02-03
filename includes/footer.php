    <!--Site Footer Start-->
    <!--Site Footer Start-->
    <?php
    // Attempt to use existing settings from header or fetch new
    if (!isset($settingsData) || empty($settingsData)) {
        require_once __DIR__ . '/db_connect.php';
        try {
            $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
            $settingsData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        } catch (PDOException $e) { $settingsData = []; }
    }

    // Defaults (Flattened keys from DB)
    $email = $settingsData['email'] ?? 'contact@etaam.sn';
    $phone = $settingsData['phone'] ?? '+221 33 800 12 34';
    $address = $settingsData['address'] ?? "Ziguinchor, Sénégal\nKénia - Université Assane Seck";
    $logo = !empty($settingsData['logo']) ? $settingsData['logo'] : 'assets/images/resources/footer-logo.png';
    
    $fb = $settingsData['facebook'] ?? '#';
    $tw = $settingsData['twitter'] ?? '#';
    $li = $settingsData['linkedin'] ?? '#';
    ?>
    <footer class="site-footer">
        <div class="site-footer-bg-1 wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms"
            style="background-image: url(assets/images/shapes/site-footer-shape-1.png);">
        </div>
        <div class="site-footer-bg-2 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms"
            style="background-image: url(assets/images/shapes/site-footer-shape-2.png);">
        </div>
        <div class="site-footer__top">
            <div class="container">
                <div class="site-footer__top-inner">
                    <div class="site-footer__top-left">
                        <div class="site-footer__top-icon">
                            <span class="icon-artificial-intelligence"></span>
                        </div>
                        <h3 class="site-footer__top-title">Surmontez vos défis technologiques avec ETAAM</h3>
                    </div>
                    <div class="site-footer__top-right">
                        <a href="about.php" class="thm-btn site-footer__btn">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-footer__middle">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__column footer-widget__about">
                            <div class="footer-widget__logo">
                                <a href="index.php"><img src="<?php echo $logo; ?>" alt="" style="max-height: 80px; width: auto;"></a>
                            </div>
                            <div class="footer-widget__about-text-box">
                                <p class="footer-widget__about-text">Abonnez-vous pour recevoir nos dernières actualités
                                    et ressources.</p>
                            </div>
                            <form class="footer-widget__newsletter-form">
                                <div class="footer-widget__newsletter-input-box">
                                    <input type="email" placeholder="Votre adresse email" name="email">
                                    <button type="submit" class="footer-widget__newsletter-btn"><img
                                            src="assets/images/icon/footer-widget-newsletter-send-icon.png"
                                            alt=""></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__column footer-widget__links clearfix">
                            <h3 class="footer-widget__title">Liens Utiles</h3>
                            <ul class="footer-widget__links-list list-unstyled clearfix">
                                <li><a href="about.php">À propos</a></li>
                                <li><a href="team.php">Team</a></li>
                                <li><a href="marketing-forum.php">Solutions Marketing</a></li>
                                <li><a href="forum.php">Communauté Forum</a></li>

                                <li><a href="projects-page-1.php">Nos Projets</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__column footer-widget__contact clearfix">
                            <div class="footer-widget__header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
                                <h3 class="footer-widget__title" style="margin-bottom: 0;">Contactez-nous</h3>
                                <div class="site-footer__social">
                                    <a href="<?php echo $tw; ?>"><i class="fab fa-twitter"></i></a>
                                    <a href="<?php echo $fb; ?>"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="<?php echo $li; ?>"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <ul class="footer-widget__contact-list list-unstyled clearfix">
                                <li>
                                    <div class="icon">
                                        <span class="icon-telephone"></span>
                                    </div>
                                    <div class="text">
                                        <p><a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>"><?php echo $phone; ?></a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <div class="text">
                                        <p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <div class="text">
                                        <p><?php echo nl2br($address); ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-footer__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="site-footer__bottom-inner">
                            <p class="site-footer__bottom-text">© ETAAM 2026 - Tous droits réservés | <a
                                    href="#">Ziguinchor, Sénégal</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Site Footer End-->


    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.php" aria-label="logo image"><img src="assets/images/resources/footer-logo.png"
                        width="155" alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>"><?php echo $phone; ?></a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="<?php echo $tw; ?>" class="fab fa-twitter"></a>
                    <a href="<?php echo $fb; ?>" class="fab fa-facebook-square"></a>
                    <a href="#" class="fab fa-pinterest-p"></a>
                    <a href="<?php echo $li; ?>" class="fab fa-linkedin"></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">rechercher ici</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Rechercher ici..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="icon-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="assets/vendors/odometer/odometer.min.js"></script>
    <script src="assets/vendors/swiper/swiper.min.js"></script>
    <script src="assets/vendors/tiny-slider/tiny-slider.min.js"></script>
    <script src="assets/vendors/wnumb/wNumb.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/isotope/isotope.js"></script>
    <script src="assets/vendors/countdown/countdown.min.js"></script>
    <script src="assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="assets/vendors/vegas/vegas.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/timepicker/timePicker.js"></script>




    <!-- template js -->
    <script src="assets/js/notech.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/newsletter.js"></script>


</body>

</html>
