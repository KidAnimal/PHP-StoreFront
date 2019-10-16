<?php
// Start session management and include necessary functions
session_start();
require_once 'C:\xampp\htdocs\cs602\term_Project\config.php';
require_once ROOT_PATH.'model/database.php';
require_once ROOT_PATH.'model/admin_db.php';

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) 
    {
        $action = 'show_admin_menu';
    }
}

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_admin'])) {
    $action = 'login';
}

// Perform the specified action
switch($action) {
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($email, $password)) {
            $_SESSION['is_valid_admin'] = true;
            include('views/admin_menu.php');
        } else {
            $login_message = 'You must login to view this page.';
            include('admin/admin_Login.php');
        }
        break;
    case 'show_admin_menu':
        include('views/admin_menu.php');
        break;
    case 'show_product_manager':
        include('views/product_Manager.php');
        break;
    case 'show_order_manager':
        include('views/order_Manager.php');
        break;
    case 'upload_art':
        include('util/art_Index.php');
        break;
    case 'logout':
        $_SESSION = array();   // Clear all session data from memory
        session_destroy();     // Clean up the session ID
        $login_message = 'You have been logged out.';
        include('admin/admin_Login.php');
        break;
}
?>