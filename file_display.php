<?php
// Include header and database connection
include 'header.php';
include 'db.php';

// Define the getFileExtension function
function getFileExtension($fileName) {
    return pathinfo($fileName, PATHINFO_EXTENSION);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Lightbox CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }

        .thumbnail-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background-color: #ffffff; /* Set your desired background color */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .thumbnail {
            margin: 10px;
        }

        .thumbnail img {
            width: 150px;
            height: 150px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
$file_query = "SELECT * FROM bill_list";
$file_list = $con->query($file_query);

echo '<div class="thumbnail-container">';
while ($row = $file_list->fetch_assoc()) {
    $fileNames = explode(',', $row['file_names']);

    foreach ($fileNames as $fileName) {
        $extension = getFileExtension($fileName);
        $fileUrl = 'bills_uploaded/' . $fileName;

        if ($extension === 'pdf') {
            // Display PDF thumbnail and open in a viewer on click
            echo '<div class="thumbnail">';
            echo '<a href="' . $fileUrl . '" data-lightbox="pdf" data-title="' . $row['title'] . '">';
            echo '<img src="assets/img/pdficon.png" alt="PDF Thumbnail">';
            echo '</a>';
            echo '</div>';
        } elseif (in_array($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
            // Display image thumbnail and open in a lightbox on click
            echo '<div class="thumbnail">';
            echo '<a href="' . $fileUrl . '" data-lightbox="images" data-title="' . $row['title'] . '">';
            echo '<img src="' . $fileUrl . '" alt="Image Thumbnail">';
            echo '</a>';
            echo '</div>';
        }
    }
}
echo '</div>';
?>

<!-- Lightbox JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>
