<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "fitness_tracker");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recommendation = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $age = $_POST["age"];
  $weight = $_POST["weight"];
  $height = $_POST["height"];
  $goal = $_POST["goal"];
  $activity = $_POST["activity"];

  // Save to database
  $stmt = $conn->prepare("INSERT INTO users (name, age, weight, height, goal, activity) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("siidss", $name, $age, $weight, $height, $goal, $activity);
  $stmt->execute();
  $stmt->close();

  // Call Python AI script
  $escaped_name = escapeshellarg($name);
  $escaped_goal = escapeshellarg($goal);
  $escaped_activity = escapeshellarg($activity);

  $command = "python3 ai_recommendation.py $escaped_name $age $weight $height $escaped_goal $escaped_activity";
  $ai_output = shell_exec($command);
  $recommendation = trim($ai_output);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fitness Tracker</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(to right, #f9f9f9, #e6f7ff);
      font-family: 'Poppins', sans-serif;
    }
    .tracker-form {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
    }
    .recommendation {
      background-color: #dff0d8;
      border-left: 5px solid #3c763d;
      padding: 15px;
      margin-top: 20px;
      border-radius: 10px;
      color: #3c763d;
    }
  </style>
</head>
<body>

<div class="tracker-form">
  <h2>Fitness Tracker</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Name:</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Age:</label>
      <input type="number" name="age" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Weight (kg):</label>
      <input type="number" step="0.1" name="weight" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Height (cm):</label>
      <input type="number" step="0.1" name="height" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Activity Level:</label>
      <select name="activity" class="form-select" required>
        <option value="Sedentary">Sedentary</option>
        <option value="Lightly Active">Lightly Active</option>
        <option value="Active">Active</option>
        <option value="Very Active">Very Active</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Goal:</label>
      <select name="goal" class="form-select" required>
        <option value="Weight Loss">Weight Loss</option>
        <option value="Muscle Gain">Muscle Gain</option>
        <option value="Maintain">Maintain</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
  </form>

  <?php if ($recommendation): ?>
    <div class="recommendation">
      <strong>Recommended Plan:</strong><br>
      <?php echo $recommendation; ?>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
