<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
foreach (DB::table('products')->select('id', 'name', 'image')->get() as $p) {
    echo $p->id . "|" . $p->name . "|" . $p->image . "\n";
}
