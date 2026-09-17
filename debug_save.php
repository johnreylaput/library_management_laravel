<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$base = 'http://localhost:8000';
$cookieFile = tempnam(sys_get_temp_dir(), 'cookie');

// Login
$ch = curl_init($base . '/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
$resp = curl_exec($ch);
curl_close($ch);
preg_match('/name="_token"[^value]*value="([^"]*)"/', $resp, $m);
$token = $m[1] ?? '';

$ch = curl_init($base . '/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'username' => 'admin',
    'password' => 'admin123',
    '_token' => $token,
]));
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);

// Get create form token
$ch = curl_init($base . '/books/create');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$resp = curl_exec($ch);
preg_match('/name="_token"[^value]*value="([^"]*)"/', $resp, $m2);
$token2 = $m2[1] ?? '';
curl_close($ch);

// POST with only 4 fields
$postData = http_build_query([
    '_token' => $token2,
    'author' => 'Test User',
    'subject' => 'Test Subject',
    'year' => '2024',
    'publication' => 'Local',
]);

$ch = curl_init($base . '/books');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$resp = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "POST Response headers:\n";
echo $resp;

// Check if book exists
$book = App\Models\Book::where('author', 'Test User')->first();
echo "\nBook exists: " . ($book ? 'YES' : 'NO') . "\n";
if ($book) {
    echo "ID: {$book->id}\n";
    echo "Author: {$book->author}\n";
    echo "Subject: {$book->subject}\n";
    echo "Year: {$book->year}\n";
    echo "Publication: {$book->publication}\n";
}

// Check validation errors - try without going through HTTP
$request = Illuminate\Http\Request::create('/books', 'POST', [
    'author' => 'Direct Test',
    'subject' => 'Direct Subject',
    'year' => '2024',
    'publication' => 'Local',
]);
$request->setSession(new Illuminate\Session\Store(new Illuminate\Session\Store('test')));

// Check the model
echo "\nModel fillable: " . json_encode((new App\Models\Book())->getFillable()) . "\n";

// Try creating directly
try {
    $testBook = App\Models\Book::create([
        'author' => 'Direct Test',
        'subject' => 'Direct Subject',
        'year' => '2024',
        'publication' => 'Local',
    ]);
    echo "Direct create: SUCCESS\n";
    $testBook->forceDelete();
} catch (\Exception $e) {
    echo "Direct create: ERROR - " . $e->getMessage() . "\n";
}

@unlink($cookieFile);
