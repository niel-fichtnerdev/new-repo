<?php

if (isset($_POST['topproducts'])) {
    require_once './appserv/classes/controller.class.php';

    // Assuming the controller class has a method named getTopProducts()
    $controller = new controller();
    $topproducts = $controller->gettop5products();

    if ($topproducts !== false) {
        $productLabels = [];
        $productData = [];

        foreach ($topproducts as $entry) {
            $productLabels[] = $entry['fname'];
            $productData[] = $entry['product_count'];
        }

        $data = [
            'productLabels' => $productLabels,
            'productData' => $productData
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error fetching top products data']);
    }
}
