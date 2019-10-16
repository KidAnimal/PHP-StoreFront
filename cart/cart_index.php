
 <?php
require_once 'C:\xampp\htdocs\cs602\term_Project\config.php';
require_once ROOT_PATH.'/util/main.php';
require_once ROOT_PATH.'/model/validate.php';
require_once ROOT_PATH.'/model/cart.php';
require_once ROOT_PATH.'/model/product_db.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view';
    }
}

switch ($action) {
    case 'view':
        $cart = cart_get_items();
        break;
    case 'buy':
        $product_id=filter_input(INPUT_GET, 'product_id');
        $descript=filter_input(INPUT_GET,'description');
        $quantity=filter_input(INPUT_GET,'quantity');
        $size=filter_input(INPUT_GET,'size');
        
        cart_add_item($product_id,$descript, $size,$quantity);
        $cart = cart_get_items();
        
        break;
    case 'update':
        $items = filter_input(INPUT_POST, 'items', FILTER_DEFAULT, 
                FILTER_REQUIRE_ARRAY);
        foreach ($items as $product_id => $quantity ) {
            if ($size == 0) {
                cart_remove_item($product_id);
            } else {
                cart_update_item($product_id, $quantity);
            }
        }
        $cart = cart_get_items();
        break;
    default:
        //add_error("Unknown cart action: " . $action);
        echo("Uknown cart action: ". $action);
        break;
}
include ROOT_PATH.'cart/cart_view.php';

?>