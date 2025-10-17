<?php

$target_dir = "uploads/";

if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
    
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $image_name = basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $message = "";

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded. " . $message;
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message = "The file ". htmlspecialchars($image_name). " has been uploaded successfully!";
            $uploaded_image_path = $target_file;
        } else {
            $message = "Sorry, there was an error uploading your file (check 'uploads/' directory permissions).";
        }
    }
} elseif (isset($_POST['submit'])) {
    $message = "An error occurred during file upload. Please check the file size and type.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload and Display</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: auto; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 5px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .uploaded-img { margin-top: 20px; border: 1px solid #ccc; padding: 10px; }
        .uploaded-img img { max-width: 100%; height: auto; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload and Display Image </h1>

        <?php 
        if (isset($message)) {
            $class = (isset($uploaded_image_path)) ? 'success' : 'error';
            echo "<div class='message $class'>$message</div>";
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Select image to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <br><br>
            <input type="submit" value="Upload Image" name="submit">
        </form>

        <?php
        if (isset($uploaded_image_path)) {
            echo '<div class="uploaded-img">';
            echo '<h3>Uploaded Image:</h3>';
            echo '<img src="' . htmlspecialchars($uploaded_image_path) . '" alt="Uploaded Image">';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
