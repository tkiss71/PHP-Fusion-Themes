<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: MDashboard/acp_theme.php
| Author: RobiNN
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined('IN_FUSION')) {
    die('Access Denied');
}

define('MD', THEMES.'admin_themes/MDashboard/');
require_once INCLUDES.'theme_functions_include.php';
require_once MD.'acp_autoloader.php';

if (!defined('MD_LOCALE')) {
    if (file_exists(MD.'locale/'.LANGUAGE.'.php')) {
        define('MD_LOCALE', MD.'locale/'.LANGUAGE.'.php');
    } else {
        define('MD_LOCALE', MD.'locale/English.php');
    }
}

define('BOOTSTRAP', TRUE);
define('FONTAWESOME', TRUE);

define("IS_V9", (version_compare(fusion_get_settings('version'), '8.0', (strpos(fusion_get_settings('version'), '9.') === 0 ? '>' : '<'))) ? TRUE : FALSE);

if (isset($_COOKIE['sidebar-toggled']) && $_COOKIE['sidebar-toggled'] == 1) {
    define('THEME_BODY', '<body class="sidebar-toggled">');
}

function render_admin_panel() {
    new MDashboard\AdminPanel();
}

function render_admin_login() {
    new MDashboard\Login();
}

function render_admin_dashboard() {
    MDashboard\Dashboard::AdminDashboard();
}

function openside($title = FALSE, $class = NULL) {
    echo '<div class="sidepanel '.$class.'">';
    echo $title ? '<div class="sidepanel-header">'.$title.'</div>' : '';
    echo '<div class="sidepanel-body">';
}

function closeside($title = FALSE) {
    echo '</div>';
    echo $title ? '<div class="sidepanel-footer">'.$title.'</div>' : '';
    echo '</div>';
}

function opentable($title, $class = NULL) {
    MDashboard\AdminPanel::OpenTable($title, $class);
}

function closetable() {
    MDashboard\AdminPanel::CloseTable();
}

if (!IS_V9) {
    \PHPFusion\OutputHandler::addHandler(function ($output = '') {
        return strtr($output, [
            'class=\'textbox' => 'class=\'textbox form-control m-t-5 m-b-5',
            'class="textbox'  => 'class="textbox form-control m-t-5 m-b-5',
            'class=\'button'  => 'class=\'button btn btn-default',
            'class="button'   => 'class="button btn btn-default'
        ]);
    });
} else {
    if (fusion_get_settings('version') != '9.0') {
        \PHPFusion\Admins::getInstance()->setAdminBreadcrumbs();
    }
}
