<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Heart Disease Prediction</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
 body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }
        </style>
<body>
<div class="container mt-5">
<div class="card">
<div class="card-header text-center">
<h3>Heart Disease Prediction</h3>
<p>Enter patient details to predict heart disease risk</p>
</div>
<div class="card-body">
<form action="predict.php" method="POST" id="predictionForm">
<div class="form-row">
<div class="form-group col-md-6">
<label for="age">Age</label>
<input type="number" class="form-control" name="age" required>
</div>
<div class="form-group col-md-6">
<label for="gender">Gender</label>
<select class="form-control" name="gender" required>
<option value="1">Male</option>
<option value="0">Female</option>
</select>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="blood_pressure">Blood Pressure</label>
<input type="number" class="form-control" name="blood_pressure" required>
</div>
<div class="form-group col-md-6">
<label for="cholesterol">Cholesterol Level</label>
<input type="number" class="form-control" name="cholesterol" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="blood_sugar">Blood Sugar Level</label>
<input type="number" class="form-control" name="blood_sugar" required>
</div>
<div class="form-group col-md-6">
<label for="smoking">Smoking Habits</label>
<select class="form-control" name="smoking" required>
<option value="1">Smoker</option>
<option value="0">Non-Smoker</option>
</select>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="chest_pain">Chest Pain Type</label>
<select class="form-control" name="chest_pain" required>
<option value="1">Typical Angina</option>
<option value="2">Atypical Angina</option>
<option value="3">Non-anginal Pain</option>
<option value="4">Asymptomatic</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="max_heart_rate">Max Heart Rate Achieved</label>
<input type="number" class="form-control" name="max_heart_rate" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="st_depression">ST Depression</label>
<input type="number" class="form-control" name="st_depression" required>
</div>
</div>
<button type="submit" class="btn btn-primary btn-block">Predict Risk</button>
</form>
</div>
</div>
</div>
<br>
<br>
<br>
<!-- JS and Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
