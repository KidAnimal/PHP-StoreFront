<main>
    <h1>Your Cart</h1>
        <p>To remove an item from your cart, change its quantity to 0.</p>
        <form action="." method="post">
            <input type="hidden" name="action" value="update">
            <table id="cart">
            <tr id="cart_header">
                <th class="left">ID</th>
                <th class="left">Name</th>
                <th class="right">Price</th>
                <th class="right">Quantity</th>
                <th class="right">Total</th>
            </tr>
            <?php foreach ($cart as $product_id => $item) : ?>
            <tr>
                <td><?php echo htmlspecialchars($item['productName']); ?></td>
                <td class="right">
                    <input type="text" size="3" class="right"
                           name="items[<?php echo $product_id; ?>]"
                           value="<?php echo $item['quantity']; ?>">
                </td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['itemPrice']); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr id="cart_footer" >
                <td colspan="3" class="right" ><b>Subtotal</b></td>
                <td class="right">
                    <?php echo sprintf('$%.2f', cart_subtotal()); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="right">
                    <input type="submit" value="Update Cart">
                </td>
            </tr>
            </table>
        </form>

    <p>Return to: <a href="../">Home</a></p>
    <!-- if cart has items, display the Checkout link -->
    <?php if (cart_product_count() > 0) : ?>
        <p>
            Proceed to: <a href="../checkout">Checkout</a>
        </p>
    <?php endif; ?>
</main>