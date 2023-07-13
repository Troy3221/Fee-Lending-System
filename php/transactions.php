	<?php
	include_once "session.php";
	include_once "userdata.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transcations</title>
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
						<h2 class="text-start text-white ps-3">Transaction Records</h2><br>
					</div>
				</div>

				<div class="row">
					<div class="p-4 shadow-4 rounded-3 bg-white">
						<div class="row">
							<div class="col table-responsive-xxl">
								<table class="table">
									<?php
										$id = $_SESSION['user-id'];

										$sql = "SELECT * FROM trans_record WHERE acc_no = '$id' ORDER BY trans_no DESC";
										$result = $config -> query($sql);

										if($result -> num_rows > 0) {
											while($row = $result -> fetch_assoc()) {
												echo '
													<tr>
														<td>
															<div class="row">
																<div class="col-10 text-start p-3 ps-5">
																	<div class="row">
																		'.$row["trans_type"].'
																	</div>

																	<div class="row">
																		<small class="text-black-50">'.date("F d, Y", strtotime($row["trans_date"])).'</small>
																	</div>
																</div>

																<div class="col-2 p-3 text-start">
																	PHP '.$row["trans_amount"].'
																</div>
															</div>
														</td>
													</tr>
												';
											}
										} else {
											echo '
												<br>
												<div class="alert alert-warning" role="alert">
							                      No Records Found
							                    </div>
											';
										}
										mysqli_close($config);
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>