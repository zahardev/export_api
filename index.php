<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function export_api_autoload() {
    mso_hook_add('custom_page_404', 'export_api_show');
}

function export_api_deactivate($args = array()) {
    return $args;
}

function export_api_uninstall($args = array()) {
    return $args;
}

function export_api_show() {
    $s1 = mso_segment(1);
    $s2 = mso_segment(2);
    if( 'export_api' == $s1 && 'v1' == $s2 ){
        require_once __DIR__ . '/App/API.php';
        require_once(getinfo('common_dir') . 'page.php');
        require_once(getinfo('common_dir') . 'category.php');
        require_once(getinfo('common_dir') . 'comments.php');

        \Export_API\API::instance()->response();
    }
    return false;
}
