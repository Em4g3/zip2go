<?php
$extractPath = __DIR__;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['zip_file'])) {
        $zipFile = $_POST['zip_file'];

        // Create a new ZipArchive instance
        $zip = new ZipArchive;

        // Open the zip file
        if ($zip->open($zipFile) === TRUE) {
        
            $zip->extractTo($extractPath);

            
            $zip->close();

            $answer = 'Extraction successful!';
        } else {
            $answer = 'Failed to open the zip file.';
        }
    } else {
        $answer = 'Please select a zip file.';
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Zip2Go</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <center><h1>Zip2Go</h1></center>
    <?php
      echo '<center><h2 style="color: #e01642">'.$answer.'</h2></center>';
    ?>
   <center><p style="color: #e01642"></p></center><div class="container d-flex align-items-center">
<div class="card card-secondary mx-auto text-center">
<div class="card-body">
    <form method="post" enctype="multipart/form-data">
        <label for="zip_file">Select a ZIP file:</label>
        <select name="zip_file" id="zip_file">
            <option value="">Select a file</option>
            <?php
            
            $zipDirectory = __DIR__;

            
            $zipFiles = glob($zipDirectory . '/*.zip');

            foreach ($zipFiles as $file) {
                echo '<option value="' . $file . '">' . basename($file) . '</option>';
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Unzip">
    </form>
</div>
</div>
</div>
</body>
</html>
