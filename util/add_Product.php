<?php
require_once('C:\xampp\htdocs\cs602\term_Project\config.php');
// Get the course data
$categoryID=filter_input(INPUT_POST,'categoryID');
$productCode=filter_input(INPUT_POST,'productCode');
$product_name = filter_input(INPUT_POST, 'product_name');
$art_description = filter_input(INPUT_POST, 'art_description');
$price = filter_input(INPUT_POST,'price');

// Validate inputs
if ($categoryID == null || $categoryID == false || $product_name == null ||
    $product_name == false || $price==null||$price==false) 
{
    $error = "Invalid course data. Check all fields and try again.";
    include(ROOT_PATH.'/model/database_error.php');
} 
else  
{
    require_once(ROOT_PATH.'/model/database.php');

    $query = 'INSERT INTO products
                 (categoryID,productCode,productName,description,listPrice)
              VALUES
                 (:categoryID,:productCode,:product_name, :art_description,:price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID',$categoryID);
    $statement->bindValue(':productCode',$productCode);
    $statement->bindValue(':product_name',$product_name);
    $statement->bindValue(':art_description', $art_description);
    $statement->bindValue(':price',$price);
    $statement->execute();
    $statement->closeCursor();

    // Display the Course List page
    include(ROOT_PATH.'/views/product_Manager.php');
}
?>