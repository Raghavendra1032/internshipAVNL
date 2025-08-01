<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "visitor_db";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("INSERT INTO visitors (
  letter_no, firm, visitor_name, designation, officer, officer_desig, section,
  purpose, from_date, to_date, photo
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssss",
  $data['letterNo'], $data['firm'], $data['visitorName'], $data['designation'],
  $data['officer'], $data['officerDesig'], $data['section'], $data['purpose'],
  $data['fromDate'], $data['toDate'], $data['photo']
);

if ($stmt->execute()) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "error" => $stmt->error]);
}

$conn->close();
?>
