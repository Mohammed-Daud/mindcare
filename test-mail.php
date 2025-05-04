<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Set up error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Starting email test...<br>";

try {
    $email = $_GET['email'] ?? 'test@example.com';
    $resetUrl = url("/password/reset/test-token?email={$email}");
    
    echo "Attempting to send email to: {$email}<br>";
    echo "Using reset URL: {$resetUrl}<br>";
    
    // Get mail configuration
    echo "Mail configuration:<br>";
    echo "Driver: " . config('mail.default') . "<br>";
    echo "Host: " . config('mail.mailers.smtp.host') . "<br>";
    echo "Port: " . config('mail.mailers.smtp.port') . "<br>";
    echo "From address: " . config('mail.from.address') . "<br>";
    
    // Send the email
    Mail::to($email)->send(new PasswordReset($resetUrl, 'user'));
    
    echo "<br>Email sent successfully!<br>";
} catch (\Exception $e) {
    echo "<br>Error sending email: " . $e->getMessage() . "<br>";
    echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
}