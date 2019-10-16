<?php
require_once 'C:\xampp\htdocs\cs602\term_Project\config.php';
require_once ROOT_PATH.'util/file_util.php';  // the get_file_list function
require_once ROOT_PATH.'util/image_util.php'; // the process_image function

$image_dir = ROOT_PATH.'public/images';
//$image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = '';
    }
}

switch ($action) {
    case 'upload':        
        if (isset($_FILES['file1'])) {
            $filename = $_FILES['file1']['name'];
            if (empty($filename)) {
                break;
            }
            $source = $_FILES['file1']['tmp_name'];
            $target = $image_dir . DIRECTORY_SEPARATOR . $filename;
            move_uploaded_file($source, $target);

            // create the '400' and '100' versions of the image
            process_image($image_dir, $filename);
            header("Location: ../admin_Index.php?action=upload_art");
        }
        break;
    case 'delete':
        $filename = filter_input(INPUT_GET, 'filename', 
                FILTER_SANITIZE_STRING);
        $target = $image_dir . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($target)) {
            unlink($target);
        header("Location: ../admin_Index.php?action=upload_art");
        }
        break;
        
}

$files = get_file_list($image_dir);
include(ROOT_PATH.'util/upload_Art.php');
?>