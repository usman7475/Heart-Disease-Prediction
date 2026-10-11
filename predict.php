<?php

// Prepare the data to send in the request body
$data = array(
'age' => (int) $_POST['age'], // Ensure age is an integer
'gender' => ($_POST['gender'] == 'Male') ? 1 : 0, // Convert 'Male' to 1 and 'Female' to 0
'blood_pressure' => (int) $_POST['blood_pressure'], // Ensure blood pressure is an integer
'cholesterol' => (int) $_POST['cholesterol'], // Ensure cholesterol is an integer
'blood_sugar' => (int) $_POST['blood_sugar'], // Ensure blood sugar is an integer
'smoking' => ($_POST['smoking'] == 'Yes') ? 1 : 0, // Convert 'Yes' to 1 and 'No' to 0
'chest_pain' => (int) $_POST['chest_pain'], // Ensure chest pain is an integer
'max_heart_rate' => (int) $_POST['max_heart_rate'], // Ensure max heart rate is an integer
'st_depression' => (float) $_POST['st_depression'] // Ensure ST depression is a float
);

// Convert data to JSON
$json_data = json_encode($data);

// Set the cURL options
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5000/predict");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json', // Ensure we're sending JSON
'Content-Length: ' . strlen($json_data)
));

// Execute the cURL request and get the response
$response = curl_exec($ch);

// Check if the request was successful
if(curl_errno($ch)) {
$error = "Error occurred while connecting to Flask API: " . curl_error($ch);
} else {
// Parse and display the response from Flask
$response_data = json_decode($response, true);
if (isset($response_data['error'])) {
$error = $response_data['error'];
} else {
$prediction = $response_data['risk']; // Assuming the response contains a 'risk' field
}
}

// Close the cURL handle
curl_close($ch);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Heart Disease Prediction</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3t7h2DHxCkFzN4DdDeOlJj36ft5X4/gmxnmcJtnw4l" crossorigin="anonymous">
<style>
body {
background-color: #f4f4f4;
font-family: 'Arial', sans-serif;
}
.container {
margin-top: 50px;
}
.card {
padding: 20px;
}
.alert {
font-weight: bold;
}
</style>
</head>
<body>
<center> 
<div class="container">
<div class="card shadow-sm">
<h2 class="text-center">Heart Disease Risk Prediction</h2>

<!-- Display the Prediction Result -->
<?php if (isset($error)): ?>
<div class="alert alert-danger">
<strong>Error:</strong> <?php echo $error; ?>
</div>
<?php elseif (isset($prediction)): ?>
<div class="alert alert-success">
<h3 style="color: #009B4D;">Prediction Result:</h3>
<p>
<h2 style="color: #FFCC00;"><?php echo $prediction; ?></h2>
</p>
</div>
<?php else: ?>
<div class="alert alert-warning">
<strong>No prediction result available. Please check the input values and try again.</strong>
</div>
<?php endif; ?>

<!-- Button to Return to Home Page -->
<div class="text-center mt-4">
<a href="index.php" class="btn btn-primary">Go Back to Prediction Form</a>
</div>
</div>
</div>
</center>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybARdflQQvvKq2GZQak8e5b5c5Hk6/s21/nt1kY1R9bO4Yf7dF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0zS2X9+2Uw7VZ4xwpE6xxXZyC1sFq2V5On/Emyq+m5btpK2S" crossorigin="anonymous"></script>

</body>
</html>
