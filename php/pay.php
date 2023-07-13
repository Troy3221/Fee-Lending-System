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
</head>
<body>

<div class="container-fluid">
	<div class="row flex-nowrap">
	<!--Navigation Sidebar-->
	<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white shadow">
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
				<div class="row">
					<div class="col">
						<br>
						<h2 class="text-white text-start ps-3">Pay Bill</h2><br>
					</div>
				</div>

				<!--Installment Information-->
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
										PHP 
										<?php
											echo $_SESSION['balance'];
										?>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>

				<form action="transact.php" method="post" enctype="multipart/form-data">
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
										<select name="payment_method" class="form-select" aria-label="Biller Name">
											<option selected>Select Payment Method</option>
											<option value="sendwave">SENDWAVE</option>
											<option value="paypal">PAYPAL</option>
											<option value="mpesa">MPESA</option>
											<option value="autopay">AUTOPAY</option>
											<option value="cashapp">CASHAPP</option>
											<option value="pesapal">PESAPAL</option>
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
										<input class="form-control" type="text" name="account_no" id="account_no">
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col text-start">
										<p class="mb-1">Account Name</p>
									</div>
								</div>

								<div class="row">
									<div class="col">
										<input class="form-control" type="text" name="account_name" id="account_name">
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
										<input class="form-control" type="text" name="amount_transfer" id="amount_transfer" placeholder="0.00">
									</div>
								</div>

								<br><br>

								<button type="submit" name="submit" class="btn btn-success w-100">Pay Now</button>
							</div>

							<?php 
								if(isset($_GET['msg'])) {

									if($_GET['msg'] == "paymentsuccess") {
										echo '<div class="alert alert-success" role="alert">
										Payment successful!
									</div>';
									}

								}
							?>
						</div>		
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>

