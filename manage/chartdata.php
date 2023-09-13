<?php

//#################### WORKING!!



if (isset($_POST['chartdata'])) {
    require_once './appserv/classes/controller.class.php';
    $getsummary = new controller();
    $monthlySummaryData = $getsummary->getmonthlysummary();

    if ($monthlySummaryData !== false) {
        $monthlySummary = []; // Initialize an array to store the monthly summary values

        foreach ($monthlySummaryData as $entry) {
            $monthlySummary[] = $entry['total_gross']; // Assuming the 'total_gross' property holds the data
        }

        header('Content-Type: application/json');
        echo json_encode($monthlySummary);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error fetching monthly summary data']);
    }

}





else {
    // Handle other cases, e.g., GET requests
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}
