<?php
require_once('C:\xampp\htdocs\cs602\term_Project\config.php');
require_once(ROOT_PATH.'/model/database.php');

// Get all products
$query = 'SELECT * FROM ORDERS
                       INNER JOIN CUSTOMER ON ORDERS.customerId=CUSTOMER.customerID 
                       INNER JOIN ORDERITEMS ON ORDERS.orderID = ORDERITEMS.orderID
                       ';
$statement2 = $db->prepare($query);
$statement2->execute();
$orders = $statement2->fetchAll();
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
    <h1>Order Manager</h1> 
    <section> 
    <h1>Order List</h1>
    <table class="orderManage"> 
        <tr> 
            <th>Order ID</th> 
            <th>Customer Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th class="right">Product Price</th>
            <th class="right">Quantity Ordered</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?php echo $order['orderID']; ?></td>
                <td><?php echo $order['customerID']; ?></td>
                <td><?php echo $order['customerFirstName']; ?></td>
                <td><?php echo $order['customerLastName']; ?></td>
                <td><?php echo $order['itemPrice']; ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <!-- <td><form action="delete_Order.php" method="post">
                    <input type="hidden" name="product_id"
                           value="<?php //echo $order['productID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php //echo $order['categoryID']; ?>">
                    <input type="hidden" name="product_code"
                           value="<?php //echo $order['productCode']; ?>">
                    <input type="hidden" name="date_added"
                           value="<?php //echo $order['dateAdded']; ?>">
                    <input type="submit" value="delete">
                </form></td> -->
            </tr>
            <?php endforeach; ?>
        </table>     
        
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Kid Animl</p>
</footer>
</body>
</html>
