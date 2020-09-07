<?php
global $templatePath;
$templatePath = dirname( __FILE__ );

// require basic functions
require_once $templatePath.'/inc/default-theme-settings.php';

// require init style / scripts
require_once $templatePath.'/inc/init_styles_scripts.php';

// require add theme functions
require_once $templatePath.'/inc/additional-functions.php';

// init application cpt
require_once $templatePath.'/inc/init_application_cpt.php';

// init acf option page
require_once $templatePath.'/inc/init_acf_optionpage.php';

// require ajax contact form
require_once $templatePath.'/inc/ajax-contact-form.php';



