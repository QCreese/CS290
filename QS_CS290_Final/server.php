<?php
header("Access-Control-Allow-Origin: http://localhost");


// Sample products data (replace with your actual data source)
$products = [
    ['id' => 1, 'name' => 'Product 1', 'description' => 'A stylish and durable backpack for everyday use.', 'price' => 10],
    ['id' => 2, 'name' => 'Product 2', 'description' => 'A comfortable and versatile pair of sneakers for any occasion.', 'price' => 20],
    // Add more products as needed
];

// Endpoint to filter products by price range
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'filter' && isset($_GET['priceRange'])) {
    $priceRange = $_GET['priceRange'];
    $minPrice = 0;
    $maxPrice = PHP_INT_MAX;

    // Parse price range
    if ($priceRange === '0-20') {
        $maxPrice = 20;
    } elseif ($priceRange === '20-50') {
        $minPrice = 20;
        $maxPrice = 50;
    } elseif ($priceRange === '50+') {
        $minPrice = 50;
    }

    // Filter products by price range
    $filteredProducts = array_filter($products, function ($product) use ($minPrice, $maxPrice) {
        return $product['price'] >= $minPrice && $product['price'] <= $maxPrice;
    });

    header('Content-Type: application/json');
    echo json_encode(array_values($filteredProducts));
} else {
    http_response_code(404);
    echo 'Not Found';
}
