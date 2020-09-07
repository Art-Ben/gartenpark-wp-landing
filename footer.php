<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MetkasPostach
 */

?>
		<footer class="footer">
			<div class="footer__cont">
                <div class="innerCont">
                    <div class="footer__menu">
                        <a href="<?= get_home_url();?>/impressum/" class="link">Impressum</a>
                        <a href="<?= get_home_url();?>/datenschutz/" class="link">Datenschutz</a>
                    </div>
                    <div class="footer__socials">
                        <a href="https://www.facebook.com/wienerkomfortwohnungen" class="link facebook"></a>
                        <a href="https://www.instagram.com/wienerkomfortwohnungen/" class="link insta"></a>
                        <a href="https://twitter.com/WKW_PR" class="link twitter"></a>
                        <a href="https://www.youtube.com/channel/UC6umTchoHGeIJ-JXrN7axJA" class="link youtube"></a>
                        <a href="https://www.linkedin.com/company/wienerkomfortwohnungen" class="link linkedin"></a>
                    </div>
                </div>
            </div>
		</footer>
		<?php wp_footer(); ?>
		
		<?php
			if( !$_COOKIE['cookieBanner'] == 'yes' ) {
		?>

		<div class="cookieBanner">
            Diese Website verwendet Cookies. Durch die Nutzung der Website stimmen Sie der Verwendung von Cookies zu. <a href="<?= get_home_url() ?>/datenschutz/">Datenschutzinformationen</a> <button class="acceptCookie">Schließen</button>
		</div>
		<?php
			}
		?>
	</body>
</html>
