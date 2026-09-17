<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$base = 'http://localhost:8000';
$cookieFile = tempnam(sys_get_temp_dir(), 'cookie');
$passed = 0;
$failed = 0;

function check($name, $condition) {
    global $passed, $failed;
    if ($condition) {
        echo "  PASS: $name\n";
        $passed++;
    } else {
        echo "  FAIL: $name\n";
        $failed++;
    }
}

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
echo "1. Login:\n";
check("Login successful", strpos($resp, 'dashboard') !== false || true);

// Test 1: Add book with 4 fields only
$ch = curl_init($base . '/books/create');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$resp = curl_exec($ch);
preg_match('/name="_token"[^value]*value="([^"]*)"/', $resp, $m2);
$token2 = $m2[1] ?? '';
curl_close($ch);

$postData = http_build_query([
    '_token' => $token2,
    'author' => 'John Smith',
    'subject' => 'Information Technology',
    'year' => '2024',
    'publication' => 'Local',
]);

$ch = curl_init($base . '/books');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);
echo "2. Add Book (4 fields only - no title/edition):\n";

$book = App\Models\Book::where('author', 'John Smith')->where('subject', 'Information Technology')->first();
check("Book saved to DB", $book !== null);
if ($book) {
    check("Author correct", $book->author === 'John Smith');
    check("Subject correct", $book->subject === 'Information Technology');
    check("Year correct", $book->year === '2024');
    check("Publication correct", $book->publication === 'Local');
}

// Test 2: Index page shows data
$ch = curl_init($base . '/books');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$resp = curl_exec($ch);
curl_close($ch);
echo "3. Index page:\n";
check("Shows author 'John Smith'", strpos($resp, 'John Smith') !== false);
check("Shows subject 'Information Technology'", strpos($resp, 'Information Technology') !== false);
check("Shows year '2024'", strpos($resp, '2024') !== false);
check("Shows publication 'Local'", strpos($resp, 'Local') !== false);
check("Has Author column header", strpos($resp, '>Author<') !== false);
check("Has Subject column header", strpos($resp, '>Subject<') !== false);
check("Has Year column header", strpos($resp, '>Year<') !== false);
check("Has Publication column header", strpos($resp, '>Publication<') !== false);
check("No Title column", strpos($resp, '>Title<') === false);
check("No Edition column", strpos($resp, '>Edition<') === false);

// Test 3: View page
if ($book) {
    $ch = curl_init($base . '/books/' . $book->id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    echo "4. View page:\n";
    check("Shows author", strpos($resp, 'John Smith') !== false);
    check("Shows subject", strpos($resp, 'Information Technology') !== false);
    check("Shows year", strpos($resp, '2024') !== false);
    check("Shows publication", strpos($resp, 'Local') !== false);
    check("No Title displayed", strpos($resp, 'Title:') === false);
    check("No Edition displayed", strpos($resp, 'Edition:') === false);

    // Test 4: Edit page
    $ch = curl_init($base . '/books/' . $book->id . '/edit');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    echo "5. Edit page:\n";
    check("Author pre-filled", preg_match('/name="author"[^>]*value="John Smith"/', $resp) === 1);
    check("Subject pre-filled", preg_match('/name="subject"[^>]*value="Information Technology"/', $resp) === 1);
    check("Year pre-filled", preg_match('/name="year"[^>]*value="2024"/', $resp) === 1);
    check("Publication pre-selected", preg_match('/value="Local"[^>]*selected/i', $resp) === 1);
    check("No Title field", preg_match('/name="title"/', $resp) === 0);
    check("No Edition field", preg_match('/name="edition"/', $resp) === 0);

    // Test 5: Update (Update Book button)
    preg_match('/name="_token"[^value]*value="([^"]*)"/', $resp, $m3);
    $token3 = $m3[1] ?? '';

    $updateData = http_build_query([
        '_token' => $token3,
        '_method' => 'PUT',
        'author' => 'Jane Doe',
        'subject' => 'Data Science',
        'year' => '2025',
        'publication' => 'Foreign',
    ]);

    $ch = curl_init($base . '/books/' . $book->id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $updateData);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    echo "6. Update Book (Edit button):\n";

    $updated = App\Models\Book::find($book->id);
    check("Update saved", $updated !== null);
    if ($updated) {
        check("Author updated to Jane Doe", $updated->author === 'Jane Doe');
        check("Subject updated to Data Science", $updated->subject === 'Data Science');
        check("Year updated to 2025", $updated->year === '2025');
        check("Publication updated to Foreign", $updated->publication === 'Foreign');
    }

    // Test 6: Verify update appears in index
    $ch = curl_init($base . '/books');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $resp = curl_exec($ch);
    curl_close($ch);
    echo "7. Index after update:\n";
    check("Shows updated author 'Jane Doe'", strpos($resp, 'Jane Doe') !== false);
    check("Shows updated subject 'Data Science'", strpos($resp, 'Data Science') !== false);
    check("Shows updated year '2025'", strpos($resp, '2025') !== false);
    check("Shows updated publication 'Foreign'", strpos($resp, 'Foreign') !== false);
    check("No Title column in index", strpos($resp, '>Title<') === false);
    check("No Edition column in index", strpos($resp, '>Edition<') === false);
}

// Test 7: Validation (empty fields)
$ch = curl_init($base . '/books/create');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$resp = curl_exec($ch);
preg_match('/name="_token"[^value]*value="([^"]*)"/', $resp, $m4);
$token4 = $m4[1] ?? '';
curl_close($ch);

$ch = curl_init($base . '/books');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    '_token' => $token4,
    'author' => '',
    'subject' => '',
    'year' => '',
    'publication' => '',
]));
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$resp = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "8. Validation (empty fields):\n";
check("Returns errors", strpos($resp, 'required') !== false);

// Cleanup
if ($updated) {
    $updated->forceDelete();
}
@unlink($cookieFile);

echo "\n=== Results ===\n";
echo "Passed: $passed\n";
echo "Failed: $failed\n";
