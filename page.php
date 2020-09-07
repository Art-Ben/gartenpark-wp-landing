<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gartenpark
 */

get_header();
	echo '<div class="basicPage">
			<section class="heroSection">
                <a href="'. get_home_url() .'" class="heroSection__logoLine">
                    <img src="'. get_template_directory_uri() .'/dist/images/logo-grey.svg" alt="Gartenpark Korneuburg" class="logo">
                </a>
                <div class="heroSection__thumb">
                    <img src="'. get_template_directory_uri() .'/dist/images/hero-new_bg.png" alt="Gartenpark Korneuburg">
                </div>
			</section>
			<div class="basicPage__cont">
				<h1 class="tit">'. get_the_title() .'</h1>
				<div class="content">
	';

	while ( have_posts() ) :
		the_post();

		the_content();

	endwhile;

	echo '
			</div>
		</div>
	</div>
';
get_footer();
