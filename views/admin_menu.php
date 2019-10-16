<?php
     require_once 'util/secure_conn.php';  // require a secure connection
     require_once 'util/valid_admin.php';  // require a valid admin user
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Kid Animal</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1>Kid Animal</h1>
        </header>
        <main>
            <h1>Admin Menu</h1>
            <p><a href="admin_Index.php?action=show_product_manager">Product Manager</a></p>
            <p><a href="admin_Index.php?action=show_order_manager">Order Manager</a></p>
            <p><a href="admin_Index.php?action=upload_art">Upload Art</a></p>
            <p><a href="admin_Index.php?action=logout">Logout</a></p>
        </main>
    </body>
</html>
