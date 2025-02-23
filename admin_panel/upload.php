<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site_name = $_POST["site_name"];
    $description = $_POST["description"];
     $category = $_POST["category"]; 
    $site_link = $_POST["site_link"];
    
    $image = $_FILES["image"]["name"];
    $target_dir = "uploads/";
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
   $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO websites (site_name, description, category, site_link, image) 
                VALUES ('$site_name', '$description', '$category', '$site_link', '$image')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "message" => "Data inserted successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error uploading file."]);
    }
     

}
$conn->close();
?>
