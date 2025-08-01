<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "visitor_db";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM visitors ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Visitor Records</title>
  <style>
    body { font-family: Arial; background: #f0f0f0; padding: 20px; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background: #333; color: white; }
    img { width: 100px; }
    h2 { text-align: center; margin-bottom: 20px; }
  </style>
</head>
<body>
  <h2>All Visitor Records</h2>
  <table>
    <thead>
      <tr>
        <th>Letter No</th>
        <th>Firm</th>
        <th>Visitor Name</th>
        <th>Designation</th>
        <th>Officer</th>
        <th>Officer's Designation</th>
        <th>Section</th>
        <th>Purpose</th>
        <th>From</th>
        <th>To</th>
        <th>Photo</th>
        <th>Date/Time</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['letter_no']) ?></td>
          <td><?= htmlspecialchars($row['firm']) ?></td>
          <td><?= htmlspecialchars($row['visitor_name']) ?></td>
          <td><?= htmlspecialchars($row['designation']) ?></td>
          <td><?= htmlspecialchars($row['officer']) ?></td>
          <td><?= htmlspecialchars($row['officer_desig']) ?></td>
          <td><?= htmlspecialchars($row['section']) ?></td>
          <td><?= htmlspecialchars($row['purpose']) ?></td>
          <td><?= htmlspecialchars($row['from_date']) ?></td>
          <td><?= htmlspecialchars($row['to_date']) ?></td>
          <td><img src="<?= $row['photo'] ?>" alt="Photo" /></td>
          <td><?= $row['created_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>

<?php $conn->close(); ?>
