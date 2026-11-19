<?php
session_start();
include("db_con/dbCon.php");

$message = "";
$error = "";
$logs = [];

if (isset($_POST['setup'])) {
    try {
        $logs[] = "Connecting to MySQL server...";
        // Connect to MySQL server (using setup=true, which doesn't specify a DB)
        $conn = connect(true);
        if (!$conn) {
            throw new Exception("Could not connect to the local MySQL server. Please ensure that MySQL is running (e.g. via XAMPP Control Panel) and uses the default credentials (root with no password).");
        }
        $logs[] = "Connected successfully to MySQL server.";

        // Create database
        $logs[] = "Creating database `lawyermanagement` if not exists...";
        $dbName = "lawyermanagement";
        if ($conn->query("CREATE DATABASE IF NOT EXISTS `$dbName`")) {
            $logs[] = "Database `lawyermanagement` created or already exists.";
        } else {
            throw new Exception("Error creating database: " . $conn->error);
        }

        // Select the database
        $conn->select_db($dbName);
        $logs[] = "Selected database `$dbName`.";

        // Read SQL file
        $sqlPath = "SQL_database/lawyermanagement.sql";
        if (!file_exists($sqlPath)) {
            throw new Exception("SQL file not found at: $sqlPath");
        }

        $logs[] = "Reading schema and seeds from `SQL_database/lawyermanagement.sql`...";
        $sql = file_get_contents($sqlPath);

        // Execute SQL queries
        $queries = explode(";\n", $sql);
        $queryCount = 0;
        $successCount = 0;

        // Alternative split by semicolon if line breaks differ
        if (count($queries) <= 1) {
            $queries = explode(";\r\n", $sql);
        }
        if (count($queries) <= 1) {
            // Fallback: simple split, keeping in mind complex statements
            $queries = preg_split('/;\s*$/m', $sql);
        }

        foreach ($queries as $query) {
            $query = trim($query);
            if (empty($query)) {
                continue;
            }
            
            // Skip comments
            if (substr($query, 0, 2) == '--' || substr($query, 0, 2) == '/*') {
                continue;
            }

            $queryCount++;
            if ($conn->query($query)) {
                $successCount++;
            } else {
                // Log warning but continue if it's drop/insert issues that are non-critical
                $logs[] = "<span class='text-warning'>[Warning]</span> Query #$queryCount failed: " . htmlspecialchars($conn->error);
            }
        }

        $logs[] = "Executed $successCount of $queryCount statements successfully.";
        $message = "Database Setup Completed Successfully!";
    } catch (Exception $e) {
        $error = $e->getMessage();
        $logs[] = "<span class='text-danger'>[Error]</span> Setup failed: " . htmlspecialchars($error);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Database Setup Wizard - Lawyer Management System</title>
    <!-- Modern Typography & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(20, 28, 47, 0.6);
            --border-color: rgba(255, 255, 255, 0.08);
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --success: #10b981;
            --error: #ef4444;
            --text-main: #f3f4f6;
            --text-secondary: #9ca3af;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at 50% 50%, #111827 0%, #030712 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        /* Ambient Glow Objects */
        .ambient-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0) 70%);
            top: 10%;
            left: 15%;
            z-index: 1;
            pointer-events: none;
            filter: blur(40px);
        }

        .ambient-glow-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 70%);
            bottom: 10%;
            right: 15%;
            z-index: 1;
            pointer-events: none;
            filter: blur(40px);
        }

        .setup-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 650px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary), var(--success));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
            display: inline-block;
            filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.4));
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            background: linear-gradient(to right, #ffffff, #d1d5db);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .status-card {
            margin-top: 25px;
            padding: 20px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(10, 15, 30, 0.5);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .status-badge.success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .status-badge.error {
            background: rgba(239, 68, 68, 0.15);
            color: var(--error);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .log-terminal {
            background: #05070c;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 15px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.85rem;
            max-height: 250px;
            overflow-y: auto;
            color: #a7f3d0;
            margin-top: 15px;
            text-align: left;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.8);
        }

        .log-line {
            margin-bottom: 6px;
            line-height: 1.4;
            border-bottom: 1px solid rgba(255,255,255,0.02);
            padding-bottom: 4px;
        }

        .text-warning { color: #f59e0b; }
        .text-danger { color: var(--error); }

        .btn-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
            transition: all 0.2s ease;
            margin-top: 25px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(59, 130, 246, 0.5);
            background: linear-gradient(135deg, var(--primary-hover), #1d4ed8);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            margin-top: 20px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-1px);
        }

        .footer {
            margin-top: 30px;
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="ambient-glow"></div>
    <div class="ambient-glow-2"></div>

    <div class="setup-container">
        <div class="logo-section">
            <div class="logo-icon"><i class="fas fa-balance-scale"></i></div>
            <h1>Database Setup Wizard</h1>
            <p class="subtitle">Lawyer Management System Localhost Setup</p>
        </div>

        <?php if (empty($message) && empty($error)): ?>
            <div class="status-card" style="text-align: center;">
                <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 10px;">
                    This setup wizard will automatically create the <strong>lawyermanagement</strong> database on your local MySQL server and import the schema & default seed values from:
                </p>
                <code style="display: inline-block; background: rgba(0,0,0,0.3); padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; color: #a7f3d0; border: 1px solid rgba(255,255,255,0.05);">SQL_database/lawyermanagement.sql</code>
                
                <form method="POST" action="">
                    <button type="submit" name="setup" class="btn-submit">
                        <i class="fas fa-magic"></i> Start Setup & Import Database
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="status-card" style="text-align: center;">
                <?php if (!empty($message)): ?>
                    <div class="status-badge success">
                        <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                    </div>
                <?php else: ?>
                    <div class="status-badge error">
                        <i class="fas fa-exclamation-triangle"></i> Database Import Error
                    </div>
                <?php endif; ?>

                <p style="color: var(--text-secondary); font-size: 0.9rem;">Setup logs:</p>
                
                <div class="log-terminal">
                    <?php foreach ($logs as $log): ?>
                        <div class="log-line">
                            <span style="color: #6ee7b7; margin-right: 8px;">&gt;</span> <?php echo $log; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($message)): ?>
                    <a href="index.php" class="btn-secondary">
                        Go to Home Page <i class="fas fa-arrow-right"></i>
                    </a>
                <?php else: ?>
                    <a href="db_setup.php" class="btn-secondary">
                        <i class="fas fa-redo"></i> Try Again
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="footer">
            Lawyer Management System &bull; Clean modern localhost execution helper
        </div>
    </div>
</body>
</html>
