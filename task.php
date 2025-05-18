<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the input data from the form
    $inputData = $_POST['textData'];

    // Prepare the data to be saved in JSON format
    $dataArray = ['text' => $inputData];
    $jsonData = json_encode($dataArray, JSON_PRETTY_PRINT);

    // Define the JSON file path
    $filePath = 'data.json';

    // Save the JSON data to the file
    if (file_put_contents($filePath, $jsonData)) {
        echo "Data successfully saved to $filePath!";
    } else {
        echo "Failed to save data.";
    }
}
?>

<!-- HTML Form to take input -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Text to JSON</title>
</head>

<body>
    <form method="POST">

        <br><br>
        <label for="textData">Enter Task:</label>
        <input type="text" id="textData" name="textData" required>
        <button type="submit">Save to JSON</button>
    </form>


</body>




</html>