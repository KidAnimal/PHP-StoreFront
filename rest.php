<?php
require_once('model/database.php');

$format = filter_input(INPUT_GET, 'format');

if (isset($format)) {
    if ($format == 'xml')
        echo header("Content-type: text/xml");
    else if ($format == 'json')
        echo header("Content-type: application/json");
    else
        exit;
} else {
    $format = 'xml';
    echo header("Content-type: text/xml");
}

    // Get all products
    $query = 'SELECT * FROM products
                           ORDER BY productID';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();


$action = filter_input(INPUT_GET, 'action');

if ($action == 'products') {
    if ($format == 'json') {
        echo json_encode($products, JSON_PRETTY_PRINT); 
    }
    else {
        $doc = new DOMDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $root = $doc->createElement('products');
        $root = $doc->appendChild($root);

        foreach ($products as $product) {
            $productNode = $doc->createElement('product');
            $productNode = $root->appendChild($productNode);
            
            foreach($product as $key => $value) {
                $i = $doc->createElement($key, $value);
                $productNode->appendChild($i);
            }
        }

        echo $doc->saveXML() . "\n";
    }
}
else if ($action == 'orders') {

    $product_id = filter_input(INPUT_GET, 'product');
    

    $queryOrders = 'SELECT * FROM orderitems
                  WHERE productID = :product_id
                  ORDER BY orderID';
    $statement3 = $db->prepare($queryOrders);
    $statement3->bindValue(':product_id', $product_id);
    $statement3->execute();
    $orders = $statement3->fetchAll(PDO::FETCH_ASSOC);
    $statement3->closeCursor();

    if ($format == 'json') {
        echo json_encode($orders, JSON_PRETTY_PRINT); 
    }
    else {
        $doc = new DOMDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $root = $doc->createElement('orders');
        $root = $doc->appendChild($root);

        foreach ($orders as $order) {
            $orderNode = $doc->createElement('order');
            $orderNode = $root->appendChild($orderNode);
            
            foreach($order as $key => $value) {
                $i = $doc->createElement($key, $value);
                $orderNode->appendChild($i);
            }
        }

        echo $doc->saveXML() . "\n";
    }

}
?>