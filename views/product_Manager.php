<?php
require_once('C:\xampp\htdocs\cs602\term_Project\config.php');
require_once(ROOT_PATH.'model/database.php');

// Get all products
$query = 'SELECT * FROM PRODUCTS
                       ORDER BY productID';
$statement2 = $db->prepare($query);
$statement2->execute();
$products = $statement2->fetchAll();
$statement2->closeCursor();

// Get all Categories
$query = 'SELECT * FROM CATEGORIES
                       ORDER BY categoryID';
$statement2 = $db->prepare($query);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

?>
<!DOCTYPE HTML> 
<HTML lang='en'>
<head>  
    <title>Featured Products</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>

<body> 
<main> 
    <h1 class="producthead">Product Manager</h1>
       <div class="category_Aside">
            <aside>
                <table> 
                    <tr>
                        <th>Category ID</th> 
                        <th>Category Name</th>  
                    </tr>
                    <?php foreach($categories as $category) : ?>
                    <tr> 
                        <td><?php echo $category['categoryID']; ?></td>
                        <td><?php echo $category['categoryName']; ?></td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </aside> 
            <section> 
            <h1 class="producthead">Product List</h1>
            <table class="product_Table"> 
                <tr> 
                    <th>Product Name</th> 
                    <th>Product Description</th>
                    <th class="right">Product Price</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['productName']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['listPrice']; ?></td>
                        <td><form action="util/delete_Product.php" method="post">
                            <input type="hidden" name="product_id"
                                value="<?php echo $product['productID']; ?>">
                            <input type="hidden" name="category_id"
                                value="<?php echo $product['categoryID']; ?>">
                            <input type="hidden" name="product_code"
                                value="<?php echo $product['productCode']; ?>">
                            <input type="hidden" name="date_added"
                                value="<?php echo $product['dateAdded']; ?>">
                            <input type="submit" value="delete">
                        </form></td>
                    </tr>
                    <?php endforeach; ?>
                </table>     
            </div>
    <!-- add code for the form here -->
   <div class="formproduct">
    <form action="util/add_Product.php" method="post" name="addProduct" id="addProduct">

            <label>Category ID</label> 
            <input type="text" name="categoryID"><br>
            <label>Product Code</label> 
            <input type="text" name="productCode"><br>
            <label>Product Name:</label>
            <input type="text" name="product_name"><br>
            <label>Description:</label>
            <input type="text" name= "art_description"><br> 
            <label>List Price:</label>
            <input type="text" name= "price"><br>  
            <label>&nbsp;</label>
            <input type="submit" value="Add Product"><br>

        </form>
    </section>
    </div>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Kid Animl</p>
</footer>
</body>
</html>
