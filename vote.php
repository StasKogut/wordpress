
<?php
/*
Plugin Name: vote
Plugin URI:
Description: Плагин считает голоса
Version: 1.0
Author: Kogut
Author URI:
License: GPL2
*/
?>

<?php

require __DIR__.'/functions.php';
add_filter ('the_content', 'add_post_content');
add_action('init','do_session');
add_action('wp_enqueue_scripts','vote_scripts');
add_action('wp_ajax_nopriv_vote_test','wp_ajax_vote_test');
add_action('wp_ajax_vote_test','wp_ajax_vote_test');
add_action('wp_ajax_nopriv_vote_test_dis','wp_ajax_vote_test_dis');
add_action('wp_ajax_vote_test_dis','wp_ajax_vote_test_dis');
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );



function enqueue_load_fa() {
    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );

}




?>
