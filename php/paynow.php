<?php
include_once "session.php";
include_once "userdata.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pay Now</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style-min.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../css/brands.css">
	<link rel="stylesheet" type="text/css" href="../css/solid.css">
	<link rel="shortcut icon" href="../img/loan-icon.ico">
</head>

<body>

	<div class="container-fluid">
		<div class="row flex-nowrap">
			<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white shadow">
				<!--Navigation Sidebar-->
				<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 min-vh-100">
					<span class="fs-5 d-none d-sm-inline fw-bold">Menu</span>

					<hr>

					<ul class="nav nav-pills flex-column mb-sm-auto mb-0 ms-2 align-items-start" id="menu">
						<li class="nav-item nav-list">
							<a href="home.php" class="nav-link align-middle px-0 text-wrap">
								<i class="fas fa-regular fa-home bi me-2"></i>
								<span class="d-none d-sm-inline fw-bold">Home</span>
							</a>
						</li>

						<li class="nav-item nav-list">
							<a href="#install" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
								<i class="fas fa-regular fa-credit-card bi me-2"></i> <span class="ms-1 d-none d-sm-inline fw-bold">Installment</span> </a>
							<ul class="collapse show nav flex-column ms-1 text-start" id="install" data-bs-parent="#menu">
								<li class="w-100">
									<?php
									$status = $_SESSION['stats'];
									if($status == 'Terminated') {
										echo '
										<span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
											<a href="new-installment.php" class="nav-link px-0 disabled">
												<span class="d-none d-sm-inline">New Installment</span>
											</a>
										</span>
										';
									} else {
										echo '
										<a href="new-installment.php" class="nav-link px-0">
											<span class="d-none d-sm-inline">New Installment</span>
										</a>';
									}
									?>
								</li>

								<li>
									<a href="transactions.php" class="nav-link px-0">
										<span class="d-none d-sm-inline">Transaction Record</span>
									</a>
								</li>

								<li>
									<?php
									$status = $_SESSION['stats'];
									if($status == 'New' || $status == 'Repeat' || $status == 'Loyal' || $status == 'Terminated') {
										echo '
											<a href="paynow.php" class="nav-link px-0">
												<span class="d-none d-sm-inline">Pay Now</span>
											</a>
										';
									} else {
										echo '
											<a href="paynow.php" class="nav-link px-0 disabled">
												<span class="d-none d-sm-inline">Pay Now</span>
											</a>
										';
									}

									?>

								</li>
							</ul>
						</li>

						<li class="nav-item nav-list">
							<a href="accounts.php" class="nav-link align-middle px-0">
								<i class="fas fa-regular fa-user bi me-2"></i>
								<span class="d-none d-sm-inline fw-bold">Accounts</span>
							</a>
						</li>

						<li class="nav-item nav-list">
							<a href="settings.php" class="nav-link align-middle px-0">
								<i class="fas fa-regular fa-gear bi me-2"></i>
								<span class="d-none d-sm-inline fw-bold">Settings</span>
							</a>
						</li>
					</ul>

					<hr>

					<div class="dropdown pb-4">
						<a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fas fa-regular fa-circle-user bi me-2"></i>
							<span class="d-none d-sm-inline mx-1 fw-bold">
								<?php
								echo $_SESSION['first'];
								echo " ";
								echo $_SESSION['last'];
								?>
							</span>
						</a>
						<ul class="dropdown-menu text-small shadow">
							<li><a class="dropdown-item" href="#">Settings</a></li>
							<li><a class="dropdown-item" href="#">Profile</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="logout.php">Sign out</a></li>
						</ul>
					</div>
				</div>
			</div>

			<!--Main Content-->
			<div class="col py-3 d-flex justify-content-center overflow-auto">
				<div class="container-fluid">

					<!--Pay Bill Header-->
					<div class="row">
						<div class="col">
							<br>
							<h2 class="text-white text-start ps-3">Pay Bill</h2><br>
							<?php
								if (isset($_GET['msg'])) {

									if ($_GET['msg'] == "paymentsuccess") {
										echo '<div class="alert alert-success" role="alert">
										Payment successful!
									</div>';
									}

									elseif ($_GET['msg'] == "paymentfailed") {
										echo '<div class="alert alert-danger" role="alert">
										Payment Failed!
									</div>';
									}

									elseif ($_GET['msg'] == "updatestatuserror") {
										echo '<div class="alert alert-danger" role="alert">
										Status Update Error!
									</div>';
									}
								}
							?>
						</div>
					</div>

					<!--Account Information-->
					<div class="row">
						<div class="col py-1">
							<div class="p-4 bg-white shadow-4 rounded-3">
								
								<div class="row">
									<div class="col text-start">
										<p class="mb-1">Account Information</p>
									</div>
								</div>

								<div class="row">
									<div class="col text-start"><br>
										<h5 class="mb-1">
											<?php
											echo $_SESSION['user-id'];
											?>
										</h5>
										<small>Account Number</small>
									</div>
								</div>

								<div class="row">
									<div class="col text-end"><br>
										<small class="text-black-50">Remaining Balance</small>
											<h4 class="mb-1">
												<?php
													$id = $_SESSION['user-id'];

													$sql = "SELECT SUM(loan_amount) FROM loan_destination WHERE acc_no = '$id'";
													$result = mysqli_query($config, $sql);

													$row = mysqli_fetch_row($result);
													$count = $row[0];

													if ($count > 0) {
														echo 'PHP '.$row[0].'';
													}

													else {
														echo '<input class="form-control" type="text" name="referrence_no" id="referrence_no" required>';
													}
												?>
											</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
				
					<!--Form Start Here-->
					<form action="transact.php" method="post" enctype="multipart/form-data">
						
						<!--Referrence Number Title-->
						<div class="row">
							<div class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 py-2">
								<div class="p-4 bg-white shadow-4 rounded-3">
									<div class="row">
										<div class="col text-start">
											<p class="mb-1">Referrence Number</p>
										</div>
									</div>

									<!--Referrence Number-->
									<div class="row">
										<div class="col">
											<?php
												if (isset($_GET['msg'])) {
													if ($_GET['msg'] == "refnotfound") {
														echo '
															<input class="form-control is-invalid" type="text" name="referrence_no" id="referrence_no" placeholder="2022xxxxxxx" required>
															<div class="invalid-feedback text-start ms-2">
																<i class="fa-solid fa-circle-exclamation me-1"></i>Referrence number not found
															</div>
														';
													}
													else {
														echo '<input class="form-control" type="text" name="referrence_no" id="referrence_no" placeholder="2022xxxxxxx" required>';
													}
												}
												else {
													echo '<input class="form-control" type="text" name="referrence_no" id="referrence_no" placeholder="2022xxxxxxx" required>';
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--Payment Method-->
						<div class="row">
							<div class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 py-2">
								<div class="p-4 bg-white shadow-4 rounded-3">
									<div class="row">
										<div class="col text-start">
											<p class="mb-1">Payment Method</p>
										</div>
									</div>

									<div class="row">
										<div class="col">
											<select name="payment_method" class="form-select" aria-label="Biller Name" required>
												<option selected>Select Payment Method</option>
												<option value="SENDWAVE">SENDWAVE</option>
												<option value="PAYPAL">PAYPAL</option>
												<option value="MPESA">MPESA</option>
												<option value="CASHAPP">CASHAPP</option>
												<option value="PESAPAL">PESAPAL</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--Account Information-->
						<div class="row">
							<div class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 py-2">
								<div class="p-4 bg-white shadow-4 rounded-3">
									
									<div class="row">
										<div class="col text-start">
											<p class="mb-1">Account Number/Referrence Number</p>
										</div>
									</div>

									<div class="row">
										<div class="col">
											<input class="form-control" type="text" name="account_no" id="account_no" required>
										</div>
									</div>

									<br>

									<div class="row">
										<div class="col text-start">
											<p class="mb-1">Account Name/Sender Name</p>
										</div>
									</div>

									<div class="row">
										<div class="col">
											<input class="form-control" type="text" name="account_name" id="account_name" required>
										</div>
									</div>

									<br>

									<div class="row">
										<div class="col text-start">
											<p class="mb-1">Amount</p>
										</div>
									</div>

									<div class="row">
										<div class="col">
											<?php
												if (isset($_GET['msg'])) {
													if ($_GET['msg'] == "negativevalue") {
														echo '
															<input class="form-control is-invalid" type="text" name="amount_transfer" id="amount_transfer" placeholder="0.00" required>
															<div class="invalid-feedback text-start ms-2">
																<i class="fa-solid fa-circle-exclamation me-1"></i>Payment exceeds your remaining balance
															</div>
														';
													}
													else {
														echo '<input class="form-control" type="text" name="amount_transfer" id="amount_transfer" placeholder="0.00" required>';
													}
												}
												else {
													echo '<input class="form-control" type="text" name="amount_transfer" id="amount_transfer" placeholder="0.00" required>';
												}
											?>
										</div>
									</div>

									<br><br>

									<input type="submit" name="submit" class="btn btn-success w-100" value="Pay Now">

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
	
	</div>

	<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>

</html>

