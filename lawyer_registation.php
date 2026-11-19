<header class = "bg-success">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
	
	<script>
		function MySucessFn(){
			swal({
				title: "Dear Lawyer...Your Registration Sucessfully Complete! Please Wait for Approval",
				text: "",
				type: "success",
				
				showConfirmButton: true,
			},
			window.load = function(){
				window.location='http://localhost/lawyermanagementsystem/lawyer_register.php';
			});
		}
		function MyCheckFn(){
			swal({
				title: "Sorry Lawyer!! This Email already exists..Please Fill up the form again",
				text: "",
				type: "warning",
				
				showConfirmButton: true,
			},
			window.load = function(){
				window.location='http://localhost/lawyermanagementsystem/lawyer_register.php';
			});
		}
	</script>
</header>
<?php
	include_once 'db_con/dbCon.php';
	
	$okFlag = TRUE;
	if($okFlag){
		function generateRandomString()  {
            $characters = '0123456789';
            $length = 5;
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
			}
            return $randomString;
		}
		if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] != ''){
			//echo 123;exit;
			$target_dir = "images/upload/";
			$newName = date('YmdHis_');
			$newName .= basename($_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . $newName;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
				} else {
				$uploadOk = 0;
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 5000000) {
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "JPG" &&$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$checkFlag = FALSE;
				// if everything is ok, try to upload file
				} else {
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					} else {
					$checkFlag = FALSE;
				}
			}
			//echo $newName;exit;
			}else{
			$newName = $_POST['image'];
			//echo $newName;exit;
		}
		
		$u_id = uniqid('Lawyer');
		$first_Name = trim($_REQUEST['first_Name'] ?? '');
		$last_Name = trim($_REQUEST['last_Name'] ?? '');
		$contact_Number = trim($_REQUEST['contact_number'] ?? '');
		$email = trim($_REQUEST['email'] ?? '');
		$university_College = trim($_REQUEST['university_College'] ?? '');
		$degree = trim($_REQUEST['degree'] ?? '');
		$passing_year = trim($_REQUEST['passing_year'] ?? '');
		$full_address = trim($_REQUEST['full_address'] ?? '');
		$city = trim($_REQUEST['city'] ?? '');
		$zip_code = trim($_REQUEST['zip_code'] ?? '');
		$practise_Length = trim($_REQUEST['practise_Length'] ?? '');
		$case_handle = $_POST['case_handle'] ?? [];
		$chk = '';
		if (is_array($case_handle) && count($case_handle) > 0) {
			$chk = implode(',', array_map('trim', $case_handle));
		}
		$speciality = trim($_REQUEST['speciality'] ?? '');

		$password = generateRandomString();

		include 'send_mail_lawyer.php';

		$conn = connect();
		// Check duplicate value using prepared statement
		$dupStmt = $conn->prepare("SELECT 1 FROM user WHERE email = ?");
		if ($dupStmt) {
			$dupStmt->bind_param('s', $email);
			$dupStmt->execute();
			$dupStmt->store_result();
			if ($dupStmt->num_rows > 0) {
				$dupStmt->close();
				// log duplicate attempt
				$logMsg = date('c') . " | DUPLICATE_EMAIL | email:$email | first:$first_Name | last:$last_Name\n";
				@file_put_contents(__DIR__ . '/registration_debug.log', $logMsg, FILE_APPEND);
				echo "<script type= 'text/javascript'>MyCheckFn();</script>";
				exit;
			}
			$dupStmt->close();
		}

		// Use transaction and prepared statements for consistent inserts
		mysqli_begin_transaction($conn);
		try {
			$status = 'Pending';
			$role = 'Lawyer';
			$stmt = $conn->prepare("INSERT INTO `user` (`u_id`,`first_Name`, `last_Name`, `email`, `password`, `status`, `role`) VALUES (?,?,?,?,?,?,?)");
			if (!$stmt) throw new Exception($conn->error);
			$stmt->bind_param('sssssss', $u_id, $first_Name, $last_Name, $email, $password, $status, $role);
			if (!$stmt->execute()) throw new Exception($stmt->error);
			$stmt->close();

			$stmt2 = $conn->prepare("INSERT INTO `lawyer` (`lawyer_id`, `contact_Number`, `university_College`, `degree`, `passing_year`, `full_address`, `city`, `zip_code`, `practise_Length`, `case_handle`, `speciality`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
			if (!$stmt2) throw new Exception($conn->error);
			$stmt2->bind_param('ssssssssssss', $u_id, $contact_Number, $university_College, $degree, $passing_year, $full_address, $city, $zip_code, $practise_Length, $chk, $speciality, $newName);
			if (!$stmt2->execute()) throw new Exception($stmt2->error);
			$stmt2->close();

			mysqli_commit($conn);
			// log successful registration
			$logMsg = date('c') . " | REGISTER_SUCCESS | u_id:$u_id | email:$email | first:$first_Name | last:$last_Name\n";
			@file_put_contents(__DIR__ . '/registration_debug.log', $logMsg, FILE_APPEND);
			echo "<script type= 'text/javascript'>MySucessFn();</script>";
		} catch (Exception $e) {
			mysqli_rollback($conn);
			error_log('Registration error: ' . $e->getMessage());
			$errMsg = date('c') . " | REGISTER_ERROR | msg:". $e->getMessage() . " | email:$email | first:$first_Name | last:$last_Name\n";
			@file_put_contents(__DIR__ . '/registration_debug.log', $errMsg, FILE_APPEND);
			echo "<script type= 'text/javascript'>MyCheckFn();</script>";
		}
        
	}
	}
?>