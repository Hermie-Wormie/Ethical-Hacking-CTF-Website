<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['is_admin'] != 1) {
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

// Function to recursively scan directory
function scanDirectory($dir, $baseDir = '') {
    $files = [];
    $items = scandir($dir);
    
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $fullPath = $dir . '/' . $item;
        $relativePath = $baseDir ? $baseDir . '/' . $item : $item;
        
        if (is_dir($fullPath)) {
            $files = array_merge($files, scanDirectory($fullPath, $relativePath));
        } else {
            // Skip PHP files and htaccess
            if (pathinfo($item, PATHINFO_EXTENSION) === 'php' || $item === '.htaccess') {
                continue;
            }
            
            $files[] = [
                'name' => $item,
                'path' => $relativePath,
                'size' => filesize($fullPath),
                'modified' => filemtime($fullPath),
                'type' => pathinfo($item, PATHINFO_EXTENSION)
            ];
        }
    }
    
    return $files;
}

$hiddenFiles = scanDirectory(__DIR__);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hidden Files - Admin Access Only</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .breadcrumb {
            margin-bottom: 20px;
            color: #666;
        }
        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead {
            background: #343a40;
            color: white;
        }
        th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:hover {
            background: #f8f9fa;
        }
        .file-icon {
            display: inline-block;
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }
        .file-link {
            color: #007bff;
            text-decoration: none;
        }
        .file-link:hover {
            text-decoration: underline;
        }
        .file-size {
            color: #666;
            font-size: 14px;
        }
        .file-date {
            color: #666;
            font-size: 14px;
        }
        .no-files {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 Hidden Files Directory</h1>
        <div class="warning">
            ⚠️ <strong>Admin Only Area</strong> - This directory contains sensitive files accessible only to administrators.
        </div>
        
        <div class="breadcrumb">
            <a href="../admin/dashboard.php">← Back to Dashboard</a>
        </div>

        <?php if (count($hiddenFiles) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Size</th>
                        <th>Last Modified</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hiddenFiles as $file): ?>
                        <tr>
                            <td>
                                <span class="file-icon">📄</span>
                                <a href="access.php?file=<?php echo urlencode($file['path']); ?>" class="file-link" target="_blank">
                                    <?php echo htmlspecialchars($file['path']); ?>
                                </a>
                            </td>
                            <td class="file-size">
                                <?php 
                                $size = $file['size'];
                                if ($size < 1024) {
                                    echo $size . ' B';
                                } elseif ($size < 1048576) {
                                    echo round($size / 1024, 2) . ' KB';
                                } else {
                                    echo round($size / 1048576, 2) . ' MB';
                                }
                                ?>
                            </td>
                            <td class="file-date">
                                <?php echo date('Y-m-d H:i:s', $file['modified']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-files">
                <h3>No files found in this directory</h3>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
