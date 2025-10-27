<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$app = require dirname(__DIR__) . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hike;

$hikes = Hike::orderBy('date', 'asc')->orderBy('start_time', 'asc')->paginate(10);

echo "total: " . Hike::count() . PHP_EOL;
echo "page items: " . count($hikes->items()) . PHP_EOL;

foreach ($hikes as $h) {
    echo $h->id . " | " . $h->date . " " . $h->start_time . " | " . $h->trail . PHP_EOL;
}