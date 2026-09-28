<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

foreach (App\Models\Book::all() as $b) {
    echo $b->id . ' ' . $b->title . ' ' . $b->cover_image . PHP_EOL;
}