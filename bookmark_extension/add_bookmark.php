<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed']));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name'], $data['url'], $data['categories'], $data['description'])) {
    $websiteName = $conn->real_escape_string($data['name']);
    $websiteUrl = $conn->real_escape_string($data['url']);
    $description = $conn->real_escape_string($data['description']);

    $domain = parse_url($websiteUrl, PHP_URL_HOST);
    $logo = "https://www.google.com/s2/favicons?sz=256&domain=" . $domain;

    // पहले चेक करें कि वेबसाइट पहले से database में है या नहीं
    $checkSql = "SELECT id, category FROM websites WHERE site_link = '$websiteUrl'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // वेबसाइट पहले से मौजूद है, उसका ID और category निकालें
        $row = $result->fetch_assoc();
        $websiteId = $row['id'];
        $existingCategories = explode(',', $row['category']); // पहले से मौजूद categories को array में बदलें

        // New categories को पुराने के साथ merge करें और unique रखें
        $updatedCategories = array_unique(array_merge($existingCategories, $data['categories']));
        $finalCategoryList = implode(',', $updatedCategories); // फिर से string में बदलें

        // वेबसाइट की categories अपडेट करें
        $updateSql = "UPDATE websites SET category = '$finalCategoryList' WHERE id = '$websiteId'";
        if ($conn->query($updateSql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        // अगर वेबसाइट नई है तो insert करें
        $newCategories = implode(',', $data['categories']); // Array को comma-separated string में बदलें
        $insertSql = "INSERT INTO websites (site_name, site_link, logo, description, category, visibility) 
                      VALUES ('$websiteName', '$websiteUrl', '$logo', '$description', '$newCategories', 'Public')";

        if ($conn->query($insertSql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing data']);
}

$conn->close();
?>
