        <footer>
            <div class="em-container">
                <div class="em-row footer-widgets">
                    <div class="em-col-3 footer-widget footer-widget-1"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="em-col-3 footer-widget footer-widget-2"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <div class="em-col-3 footer-widget footer-widget-3">
                        <h3>Connect with Me</h3>
                        <ul class="social-media">
                            <li id="social-media-facebook"><a href="https://www.facebook.com/erikdmitchell"><i class="fab fa-facebook"></i></a></li>
                            <li id="social-media-twitter"><a href="https://twitter.com/erikdmitchell"><i class="fab fa-twitter"></i></a></li>
                            <li id="social-media-instagram"><a href="https://instagram.com/erikdmitchell"><i class="fab fa-instagram"></i></a></li>
                            <li id="social-media-linkedin"><a href="https://www.linkedin.com/in/erikdmitchell"><i class="fab fa-linkedin"></i></a></li>
                            <li id="social-media-github"><a href="https://github.com/erikdmitchell"><i class="fab fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="copyright"><?php echo get_bloginfo( 'name' ); ?> &copy; <?php echo date( 'Y' ); ?></div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>
