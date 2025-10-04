<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $age   = $_POST['age'];

    try {
        // Save to text file
        $textData = "Name: $name | Email: $email | Age: $age" . PHP_EOL;
        if (file_put_contents("data.txt", $textData, FILE_APPEND) === false) {
            throw new Exception("Failed to write to data.txt");
        }

        // Save to CSV file
        $csvFile = fopen("data.csv", "a");
        if ($csvFile === false) {
            throw new Exception("Failed to open data.csv");
        }
        fputcsv($csvFile, array($name, $email, $age));
        fclose($csvFile);

        echo "<p style='color:green;'>Data saved successfully!</p>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        echo "<p>Current directory: " . getcwd() . "</p>";
        echo "<p>Directory writable: " . (is_writable('.') ? 'Yes' : 'No') . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>
    <h2>Submit Your Details</h2>
 
    <form method="POST">
        <h2>Created by Vedant Bhatt-24ce013</h2>
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Age: <input type="number" name="age" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
