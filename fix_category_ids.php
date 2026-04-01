<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;

$map = [
    'Testt' => 1,
    'God' => 2,
    'Jewelry' => 3,
    'Statues' => 4
];

foreach ($map as $name => $id) {
    echo "Updating $name to ID $id...\n";
    Product::where('category', $name)->update(['category_id' => $id]);
}

echo "Done mapping products to category IDs.\n";
