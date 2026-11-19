<?php
//Connect to database

function connect($setup = FALSE){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "lawyermanagement";

	// Disable mysqli throwing exceptions to handle errors manually/gracefully
	if (function_exists('mysqli_report')) {
		mysqli_report(MYSQLI_REPORT_OFF);
	}

	try {
		// Create connection
		if($setup) {
			$con = @new mysqli($servername, $username, $password);
		} else {
			$con = @new mysqli($servername, $username, $password, $database);
		}

		// Check connection
		if ($con->connect_error) {
			if (!$setup) {
				die("<div style='padding: 24px; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif; background: #0f172a; border: 1px solid rgba(244, 63, 94, 0.2); color: #f8fafc; border-radius: 16px; max-width: 600px; margin: 80px auto; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.5);'>
						<div style='display: flex; align-items: center; margin-bottom: 16px;'>
							<div style='background: rgba(244, 63, 94, 0.15); width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 16px;'>
								<svg style='width: 24px; height: 24px; color: #f43f5e;' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'></path></svg>
							</div>
							<h3 style='margin: 0; font-size: 1.25rem; font-weight: 700;'>Database Connection Failed</h3>
						</div>
						<p style='color: #94a3b8; font-size: 0.95rem; line-height: 1.5; margin-bottom: 16px;'>
							Could not establish a connection to the database <strong>$database</strong>. Please ensure your local MySQL server is running (e.g. XAMPP Control Panel).
						</p>
						<div style='background: rgba(0,0,0,0.2); padding: 12px; border-radius: 8px; font-family: monospace; font-size: 0.85rem; color: #f43f5e; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 20px;'>
							Error: " . htmlspecialchars($con->connect_error) . "
						</div>
						<hr style='border: 0; border-top: 1px solid rgba(255,255,255,0.08); margin: 20px 0;'/>
						<div style='text-align: right;'>
							<a href='db_setup.php' style='display: inline-block; background: #3b82f6; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: background 0.2s;'>Run Database Setup Wizard</a>
						</div>
					 </div>");
			}
			return false;
		}
		return $con;
	} catch (Throwable $e) {
		if (!$setup) {
			die("<div style='padding: 24px; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif; background: #0f172a; border: 1px solid rgba(244, 63, 94, 0.2); color: #f8fafc; border-radius: 16px; max-width: 600px; margin: 80px auto; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.5);'>
					<div style='display: flex; align-items: center; margin-bottom: 16px;'>
						<div style='background: rgba(244, 63, 94, 0.15); width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 16px;'>
							<svg style='width: 24px; height: 24px; color: #f43f5e;' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'></path></svg>
						</div>
						<h3 style='margin: 0; font-size: 1.25rem; font-weight: 700;'>Database Connection Error</h3>
					</div>
					<p style='color: #94a3b8; font-size: 0.95rem; line-height: 1.5; margin-bottom: 16px;'>
						An exception occurred while trying to connect to the MySQL database.
					</p>
					<div style='background: rgba(0,0,0,0.2); padding: 12px; border-radius: 8px; font-family: monospace; font-size: 0.85rem; color: #f43f5e; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 20px;'>
						Exception: " . htmlspecialchars($e->getMessage()) . "
					</div>
					<hr style='border: 0; border-top: 1px solid rgba(255,255,255,0.08); margin: 20px 0;'/>
					<div style='text-align: right;'>
						<a href='db_setup.php' style='display: inline-block; background: #3b82f6; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: background 0.2s;'>Run Database Setup Wizard</a>
					</div>
				 </div>");
		}
		return false;
	}
}
