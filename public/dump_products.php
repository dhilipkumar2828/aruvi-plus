<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $products = \DB::table('products')->get();
    foreach ($products as $p) {
        echo $p->id . " | " . $p->name . " | " . $p->image . " | " . $p->price . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
