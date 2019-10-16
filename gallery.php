<?php 
require_once 'C:\xampp\htdocs\cs602\term_Project\config.php';
require_once ROOT_PATH.'model/database.php';

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

<!--Store Gallery-->
<link rel="stylesheet" type="text/css" href="css/main.css">
<div class="row">
    <div class="column"> 
        <?php 
        $i=0;
        foreach($products as $product):?>
        <img class="gallery" src= 'public/images/<?php echo $product['productCode'];?>.jpg'>
        </a>
        <div class="imageInfo">
            <label id="size">Size</label>
            <br>
            <form action='cart/cart_index.php?action=buy' name="action" method='POST'> 
            <ul class="gallery_list">
            <li><select name="size"> 
                <option value="size">4x6</option>
                <option value="size">8.5x11</option>
                <option value="size">11x17</option>
            </select></li>
            <label><?php echo $product['productName']?></label>
            <input type="hidden" name="productName"
                                value="<?php echo $product['productName']; ?>">
                                <br>
            <label><?php echo $product['description'];?></label>
            <input type="hidden" name="description"
                                value="<?php echo $product['description']; ?>">
                                <br>
            <label><?php echo $product['listPrice'];?></label>
            <input type="hidden" name="price"
                                value="<?php echo $product['listPricee']; ?>">
                                <br>
            </ul>
            <b>Quantity:</b>&nbsp;
            <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" name="art" value="buy">
    </form>
            <?php 

            if(++$i==6) 
            {
            echo "<br>";
            echo 'More Coming Soon...';
            break;
            }
            endforeach;?>
            </form>
        </div>
    </div>
</div>  