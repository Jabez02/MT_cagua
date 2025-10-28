<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Review;

echo "Total reviews: " . Review::count() . PHP_EOL;
echo "Verified reviews: " . Review::where('is_verified', true)->count() . PHP_EOL;
echo "Public reviews: " . Review::where('is_public', true)->count() . PHP_EOL;
echo "Verified AND public reviews: " . Review::where('is_verified', true)->where('is_public', true)->count() . PHP_EOL;

echo PHP_EOL . "Review details:" . PHP_EOL;
Review::all()->each(function($r) {
    echo "ID: {$r->id}, User: {$r->user_id}, Rating: {$r->rating}, Verified: " . ($r->is_verified ? 'Yes' : 'No') . ", Public: " . ($r->is_public ? 'Yes' : 'No') . ", Images: " . json_encode($r->images) . PHP_EOL;
});