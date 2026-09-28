<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$count = App\Models\User::count();
echo 'Users count: ' . $count . PHP_EOL;

$u = App\Models\User::first();
if ($u) {
    echo 'First user: ' . $u->username . ' / ' . $u->role . PHP_EOL;
    echo 'Status: ' . $u->status . PHP_EOL;
    echo 'Password set: ' . ($u->password ? 'yes' : 'no') . PHP_EOL;
    echo 'Password starts with: ' . substr($u->password, 0, 20) . PHP_EOL;
} else {
    echo 'No users found' . PHP_EOL;
}

// Check sessions table
try {
    $sessions = DB::table('sessions')->count();
    echo 'Sessions count: ' . $sessions . PHP_EOL;
} catch (\Exception $e) {
    echo 'Sessions table error: ' . $e->getMessage() . PHP_EOL;
}

// Check if admin user exists with correct password
$admin = App\Models\User::where('username', 'admin')->first();
if ($admin) {
    echo 'Admin found: ' . $admin->username . PHP_EOL;
    echo 'Admin role: ' . $admin->role . PHP_EOL;
    echo 'Admin status: ' . $admin->status . PHP_EOL;
    echo 'Admin password hash valid: ' . (Hash::check('admin123', $admin->password) ? 'yes' : 'no') . PHP_EOL;
} else {
    echo 'Admin user not found!' . PHP_EOL;
}
