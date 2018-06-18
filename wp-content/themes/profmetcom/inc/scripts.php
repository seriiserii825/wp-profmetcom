<?php
function profmetcom_scripts() {
    wp_enqueue_style( 'profmetcom-style', get_stylesheet_uri() );
    wp_enqueue_style('profmetcom-font-awesome', get_template_directory_uri().'/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('profmetcom-jquery-fullpage', get_template_directory_uri().'/assets/libs/jqueryFullPage/jquery.fullPage.css');

    wp_deregister_script( 'jquery' );

    wp_enqueue_script('profmetcom-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

    wp_enqueue_script( 'profmetcom-yandex-api-maps', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', '20151215', ['profmetcom-jquery'], 'null', true );
    wp_enqueue_script( 'profmetcom-jquery-migrate', get_template_directory_uri().'/assets/libs/jquery-migrate/jquery-migrate.min.js', ['profmetcom-jquery'], 'null', true );
    wp_enqueue_script( 'profmetcom-jquery-easing', get_template_directory_uri().'/assets/libs/jqueryFullPage/jquery.easings.min.js', ['profmetcom-jquery'], 'null', true );
    wp_enqueue_script( 'profmetcom-jquery-fullPage', get_template_directory_uri().'/assets/libs/jqueryFullPage/jquery.fullPage.js', ['profmetcom-jquery'], 'null', true );
    wp_enqueue_script( 'profmetcom-jquery-easyScroll', get_template_directory_uri().'/assets/libs/jquery-easy-scroll/jquery.easeScroll.js', ['profmetcom-jquery'], 'null', true );

    if(is_home() && is_front_page()){
        wp_enqueue_script( 'profmetcom-index', get_template_directory_uri().'/assets/js/index.js', ['profmetcom-jquery'], 'null', true );
    }
    wp_enqueue_script( 'profmetcom-main', get_template_directory_uri().'/assets/js/main.js', ['profmetcom-jquery'], 'null', true );
}
add_action( 'wp_enqueue_scripts', 'profmetcom_scripts' );