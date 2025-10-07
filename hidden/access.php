<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['is_admin'] != 1) {
    // Not authorized - show 404 error to hide the existence of this folder
    http_response_code(404);
    echo "<!DOCTYPE html>";
    echo "<html><head><title>404 Not Found</title></head><body>";
    echo "<h1>Not Found</h1>";
    echo "<p>The requested URL was not found on this server.</p>";
    echo "<hr>";
    echo "<i>Apache/2.4.58 (Ubuntu) Server at " . htmlspecialchars($_SERVER['HTTP_HOST']) . " Port " . htmlspecialchars($_SERVER['SERVER_PORT']) . "</i>";
    echo "</body></html>";
    exit();
}

// Get the requested file from the URL parameter
$file = isset($_GET['file']) ? $_GET['file'] : '';

// Validate the file parameter to prevent directory traversal
if (empty($file) || strpos($file, '..') !== false || strpos($file, '/') === 0) {
    http_response_code(400);
    die("Invalid file request");
}

// Build the full file path
$filePath = __DIR__ . '/' . $file;

// Check if file exists
if (!file_exists($filePath)) {
    http_response_code(404);
    die("File not found");
}

// Check if the path is actually within the hidden directory (security check)
$realFilePath = realpath($filePath);
$realHiddenPath = realpath(__DIR__);

if (strpos($realFilePath, $realHiddenPath) !== 0) {
    http_response_code(403);
    die("Access denied");
}

// Get file info
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $filePath);
finfo_close($finfo);

// Set appropriate headers
header('Content-Type: ' . $mimeType);
header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
header('Content-Length: ' . filesize($filePath));

// Output the file
readfile($filePath);
exit();
?>
