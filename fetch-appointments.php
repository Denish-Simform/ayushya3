<?php

include("connection.php");

// Define a query to fetch appointment data from the appointment table
$query = "SELECT a.p_id as id, p.name as name, p.gender as gender, a.complaint as complaint FROM appointments a join patient p on p.id=a.p_id";

// Execute the query and store the results in a variable
$result = $conn->query($query);

// Check if there were any errors executing the query
if (!$result) {
    // If there was an error, return an error message
    echo "Failed to fetch appointment data: " . $conn->error;
    exit();
}

// Create an empty array to store the appointment data
$data = array();

// Loop through the rows returned by the query and add them to the data array
while ($row = $result->fetch_assoc()) {    
    $data[] = $row;
}

// Close the database connection
$conn->close();

// Return the appointment data as a JSON-encoded string
echo json_encode($data);
?>
