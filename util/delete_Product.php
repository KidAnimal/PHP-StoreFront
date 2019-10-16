<?php
require_once('C:\xampp\htdocs\cs602\term_Project\config.php');
require_once(ROOT_PATH.'/model/database.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id');

// Delete the product from the database
if ($product_id != false) {
    $query = 'DELETE FROM TERM_PROJECT
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('../views/product_Manager.php');