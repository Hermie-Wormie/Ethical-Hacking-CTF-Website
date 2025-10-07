<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(404);
    echo "<h1>Not Found</h1>";
    echo "<p>The requested URL was not found on this server.</p>";
    echo "<hr>";
    echo "<i>Apache/2.4.58 (Ubuntu) Server at " . $_SERVER['HTTP_HOST'] . " Port " . $_SERVER['SERVER_PORT'] . "</i>";
    exit();
}

// Include database connection
require_once '../dbconnect.php';

// Fetch all users from the database
$query = "SELECT member_id, first_name, last_name, email, is_admin FROM Users ORDER BY member_id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f4; 
            margin: 0;
            padding: 0;
        }
        .container { 
            width: 90%; 
            max-width: 1200px;
            margin: 40px auto; 
            background: #fff; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { 
            color: #333; 
            margin-bottom: 10px;
        }
        .nav { 
            margin-bottom: 30px; 
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }
        .nav a { 
            margin-right: 15px; 
            text-decoration: none; 
            color: #007bff; 
            font-weight: 500;
        }
        .nav a:hover { 
            text-decoration: underline; 
        }
        .user-stats {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 30px;
            display: flex;
            gap: 30px;
        }
        .stat-item {
            flex: 1;
        }
        .stat-item h3 {
            margin: 0;
            color: #666;
            font-size: 14px;
            font-weight: normal;
        }
        .stat-item p {
            margin: 5px 0 0 0;
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        thead {
            background: #007bff;
            color: white;
        }
        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:hover {
            background: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-admin {
            background: #28a745;
            color: white;
        }
        .badge-user {
            background: #6c757d;
            color: white;
        }
        .no-users {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛡️ Admin Dashboard</h1>
        <p style="color: #666; margin-bottom: 20px;">Welcome back, <?php echo htmlspecialchars($_SESSION['first_name'] ?? 'Admin'); ?>!</p>
        
        <div class="nav">
            <a href="manage_users.php">Manage Users</a>
            <a href="site_settings.php">Site Settings</a>
            <a href="view_logs.php">View Logs</a>
            <a href="../logout.php">Logout</a>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="user-stats">
                <div class="stat-item">
                    <h3>Total Users</h3>
                    <p><?php echo $result->num_rows; ?></p>
                </div>
                <div class="stat-item">
                    <h3>Admin Users</h3>
                    <p>
                        <?php
                        $result->data_seek(0);
                        $admin_count = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($row['is_admin'] == 1) $admin_count++;
                        }
                        echo $admin_count;
                        $result->data_seek(0);
                        ?>
                    </p>
                </div>
                <div class="stat-item">
                    <h3>Regular Users</h3>
                    <p><?php echo $result->num_rows - $admin_count; ?></p>
                </div>
            </div>

            <h2 style="margin-bottom: 15px; color: #333;">👥 All Registered Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['member_id']); ?></td>
                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <?php if ($user['is_admin'] == 1): ?>
                                    <span class="badge badge-admin">Admin</span>
                                <?php else: ?>
                                    <span class="badge badge-user">User</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-users">
                <h3>No users found in the database.</h3>
            </div>
        <?php endif; ?>
    </div>

    <?php
    // Close database connection
    if (isset($conn)) {
        $conn->close();
    }
    ?>
</body>
</html>
