<?php
require_once 'connection.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Process uploaded cover image
    $coverImage = $_FILES['cover_image']['name'];
    $targetDir = 'uploads/';
    $targetPath = $targetDir . $coverImage;
    #move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetPath);
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

    // Insert book details into the database
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $uploadOk = 1;
     // Check if file already exists
    if (file_exists($targetPath)) 
    {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    else if ($_FILES["cover_image"]["size"] > 5000000) 
    {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    else if($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png") 
    {
        echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 1) 
    {
        if(move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetPath))
        {
            $filename = basename($_FILES["cover_image"]["name"]);
            $filesize = $_FILES["cover_image"]["size"];
            $filetype = $_FILES["cover_image"]["type"];

            $query = "INSERT INTO books (title, author, description, coverImage) VALUES (:title, :author, :description, :coverImage)";
            $stmt = $con->prepare($query);
            $result = $stmt->execute([
                ':title' => $title,
                ':author' => $author,
                ':description' => $description,
                ':coverImage' => $coverImage
            ]);

            if($result) 
            {
                echo "book added successfully";
            } 
            else 
            {
                echo "some error occurred.";
            }
        } 
        else 
        {
            echo "Sorry, your file was not uploaded";
        }
    }
}
?>

   
    

   

    