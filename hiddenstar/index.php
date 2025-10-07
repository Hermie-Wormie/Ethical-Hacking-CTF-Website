<?php
session_start();

// Check if admin is logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Admin is logged in - show directory contents or file list
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Password Files</title>
        <style>
            body { font-family: Arial; padding: 40px; background: #f4f4f4; }
            .container { background: white; padding: 30px; border-radius: 8px; max-width: 800px; margin: auto; }
            a { display: block; padding: 10px; margin: 5px 0; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
            a:hover { background: #0056b3; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Password Files</h1>
            <a href="db_dump.sql.bak" download>📁 Download db_dump.sql.bak</a>
            <a href="notes.txt" download>📄 Download notes.txt</a>
            <br>
            <a href="../admin/dashboard.php">← Back to Dashboard</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Not logged in as admin - show fake 404
http_response_code(404);
echo "<h1>Not Found</h1>";
echo "<p>The requested URL was not found on this server.</p>";
echo "<hr>";
echo "<i>Apache/2.4.58 (Ubuntu) Server at " . $_SERVER['HTTP_HOST'] . " Port " . $_SERVER['SERVER_PORT'] . "</i>";
exit();
?>
