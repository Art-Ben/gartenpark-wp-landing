<?php
/**
 * Template for displaying front page
 */
get_header();
while( have_posts() ) {
    the_post();
    the_content();
}
?>

<section class="heroSection">
    <div class="heroSection__logoLine">
        <img src="<?= get_template_directory_uri();?>/dist/images/logo-grey.svg" alt="Gartenpark Korneuburg" class="logo">
    </div>
    <div class="heroSection__thumb">
        <img src="<?= get_template_directory_uri();?>/dist/images/hero-new_bg.png" alt="Gartenpark Korneuburg" class="show-desktop">
        <img src="<?= get_template_directory_uri();?>/dist/images/hero-new_bg--mob.png" alt="Gartenpark Korneuburg" class="show-mobile">
    </div>
</section>

<section class="intro">
    <img src="<?= get_template_directory_uri();?>/dist/images/intro__bg.svg" alt="Gartenpark Korneuburg" class="brand-logo">
    <div class="intro__title">
        Willkommen im Gartenpark Korneuburg
    </div>
    <div class="intro__lines">
        <span class="line">
            In Kürze erwarten Sie hier einzigartige Einblicke in das Wohnbauprojekt Gartenpark Korneuburg. Mit mehr als
            200 exklusiven Wohnungen, Gewerbe- und Gastronomie-Angeboten sowie einem der größten Ärztezentren
            Niederösterreichs. Nahe der Donau mit ihren zahlreichen Erholungsgebieten entstehen fünf Stadtvillen mit
            besonderem Qualitätsanspruch, eingebettet in eine liebevoll gestaltete Park-Anlage mit Außenpools, Obst- und
            Spielgärten.
        </span>

        <span class="line">
            Ausführliche Informationen finden Sie ab Oktober 2020 auf dieser Internetseite.
        </span>

        <span class="line">
            Sie interessieren sich für das Projekt? Sie wollen Ihren Lebensmittelpunkt in den Gartenpark Korneuburg
            verlegen und die Vorzüge dieses exklusiven Wohnbauprojektes genießen? Dann melden Sie sich gern bei uns. Wir
            freuen uns auf Sie.
        </span>

        <span class="line">
            Ihre Wiener Komfortwohnungen
        </span>
    </div>
</section>

<section class="awards">
    <div class="thumbGroup">
        <a href="https://wienerkomfortwohnungen.at">
            <img src="<?= get_template_directory_uri();?>/dist/images/komfortwungen.svg" alt="wienerkomfortwohnungen">
        </a>
    </div>
    <div class="content">
        <span class="tit">
            Wiener Komfortwohnungen
        </span>
        <div class="desc">
            Die Wiener Komfortwohnungen vereinen jahrzehntelange Erfahrung in der Metropolregion Wien. Wir kennen den
            Markt, die Menschen und ihre Wünsche. Denn wir bauen dort, wo wir selbst gerne wohnen. Hochwertig,
            nachhaltig und mit einer Atmosphäre zum Wohlfühlen. Deshalb stellen wir höchste Ansprüche an Architektur und
            Ausstattung. So entstehen Häuser, die sich perfekt in ihre Umgebung einfügen und beim Wohnkomfort Maßstäbe
            setzen.
        </div>
        <a href="https://www.wienerkomfortwohnungen.at/de/immobilien/" class="link" target="_blank">Weitere Projekte
            finden sie hier.</a>
    </div>
</section>

<section class="form">
    <div class="form__cont">
        <div class="customCtaForm">
            <div class="customCtaForm__cont">
                <div class="customCtaForm__instence">
                    <form action="javascript:void(0);" class="customCtaForm__form" method="post"
                        data-messages='{"error_empty":"Dieses Feld ist leer.","error_valid":"Dieses Feld füllt falsche Daten aus","success":"Vielen Dank für Ihre Nachricht. Wir werden uns in kürze mit Ihnen in Verbindung setzen."}'>
                        <div class="cont">
                            <div class="formGroup spec-between">
                                <input name="name" id="name" type="text" class="my-inpt spec-w-half" placeholder="Nachname">
                                <input name="lastname" id="lastname" type="text" class="my-inpt spec-w-half"
                                    placeholder="Vorname">
                            </div>

                            <div class="formGroup">
                                <input name="tel" id="tel" type="text" class="my-inpt" placeholder="Tel.">
                            </div>

                            <div class="formGroup">
                                <input name="email" id="email" type="text" class="my-inpt" placeholder="Mail">
                            </div>

                            <div class="formGroup selectgrp">
                                <select name="type" id="type" type="text" class="my-select">
                                    <option value="" selected disabled hidden>Ich interessiere mich für</option>
                                    <option value="Insvestoren">Investition</option>
                                    <option vale="Ärzte">Ärztezentrum</option>
                                    <option value="Mieter">Mietwohnungen</option>
                                    <option value="Für Komfortgäste">Komfortfertige Wohnungen</option>
                                </select>
                            </div>
                        </div>

                        <div class="formGroup stretch">
                            <textarea name="message" id="message" class="my-txt" placeholder="Nachricht"></textarea>
                        </div>

                        <div class="formGroup full">
                            <div class="my-checkbox-grp">
                                <label class="my-checkbox-grp_cont">
                                    Ich habe die <a href="<?= get_home_url(); ?>/datenschutz/" class="link">Datenschutzerklärung</a>
                                    gelesen und akzeptiere sie.
                                    <input type="checkbox" class="my-checkbox-grp_inpt">
                                    <span class="my-checkbox-grp_checkmark"></span>
                                </label>
                                <label class="my-checkbox-grp_cont">
                                    Ich möchte den <a href="<?= get_home_url(); ?>/datenschutz/" class="link">Newsletter</a> erhalten.
                                    <input type="checkbox" class="my-checkbox-grp_inpt" id="newsletter_chck">
                                    <span class="my-checkbox-grp_checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="my-sbm">
                                Senden
                            </button>
                        </div>
                        <div class="formGroup full special">
                            <div class="afterSubmitBlock"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();