<?php
	include_once "session.php";
	include_once "userdata.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Accounts</title>
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
						<h2 class="text-white text-start ps-3">Account Information</h2><br>
					</div>
				</div>

				<!--View Information-->
				<div class="row">
					<div class="col">
						<div class="p-4 shadow-4 rounded-3 bg-white">
							<div class="container-fluid">
								<?php
					              if(isset($_GET['Success'])) {
					                echo '<div class="alert alert-success" role="alert">
					                      Information Updated
					                      </div>';
					              }

					              if(isset($_GET['Error'])) {
					                echo '<div class="alert alert-danger" role="alert">
					                      Unable to Edit Information
					                      </div>';
					              }

					              ?>
					              <br>
								<div class="row text-start">
									<div class="col-md-6">
										<label for="user-first" class="d-flex justify-content-start ps-3">
											First Name</label>
										<div class="card shadow-sm rounded-3" id="user-first">
											<div class="card-body">
												<h6 class="ps-4">
													<?php
														echo $_SESSION['first'];
													?>
												</h6>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<label for="user-first" class="d-flex justify-content-start ps-3">
											Last Name</label>
										<div class="card shadow-sm rounded">
											<div class="card-body">
												 <h6 class="ps-4">
												 	<?php
														echo $_SESSION['last'];
													?>
												 </h6>
											</div>
										</div>
									</div>
								</div>

								<br>

								<div class="row text-start">
									<div class="col-md-6">
										<label for="user-first" class="d-flex justify-content-start ps-3">
											Email Address</label>
										<div class="card shadow-sm rounded-3" id="user-first">
											<div class="card-body">
												<h6 class="ps-4">
													<?php
														echo $_SESSION['email'];
													?>
												</h6>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<label for="user-first" class="d-flex justify-content-start ps-3">
											Mobile Number</label>
										<div class="card shadow-sm rounded">
											<div class="card-body">
												 <h6 class="ps-4">
													<?php
														echo $_SESSION['mobile'];
													?>
												</h6>
											</div>
										</div>
									</div>
								</div>

								<br>

								<div class="row text-start">
									<div class="col-md-6">
										<label for="user-first" class="d-flex justify-content-start ps-3">
											Birth Date</label>
										<div class="card shadow-sm rounded-3" id="user-first">
											<div class="card-body">
												<h6 class="ps-4">
													<?php
														echo $_SESSION['bday'];
													?>
												</h6>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<label for="user-first" class="d-flex justify-content-start ps-3">
											Age</label>
										<div class="card shadow-sm rounded">
											<div class="card-body">
												 <h6 class="ps-4">
													<?php
														echo $_SESSION['age'];
													?>
												</h6>
											</div>
										</div>
									</div>
								</div>

								<br>

								<label for="user-first" class="d-flex justify-content-start ps-3">
									Address</label>
								<div class="card shadow-sm rounded">
									<div class="card-body">
										<h6 class="ps-4 text-start">
											<?php
												echo $_SESSION['address'];
											?>
										</h6>
									</div>
								</div>

								<br>

								<div class="col d-flex justify-content-end">
									<button type="button" class="btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#editInformation">Edit Information</button>
								</div>

								<div class="modal fade" id="editInformation" tabindex="-1" aria-labelledby="editInformationLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>

											<div class="modal-body">
												<div class="container-fluid">
													<br><h4>Edit Information</h4>
													<div class="row">
														<form class="form-control border-0 p-5" method="post" action="update_query.php">
															<div class="col">
																<div class="row">
																	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																		<label for="user-first" class="d-flex justify-content-start ps-3">First Name</label>
																		<input type="text" name="user-first" id="user-first" class="form-control" value="<?php echo $_SESSION['first']; ?>">
																	</div>

																	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																		<label for="user-last" class="d-flex justify-content-start ps-3">Last Name</label>
																		<input type="text" name="user-last" id="user-last" class="form-control" value="<?php echo $_SESSION['last']; ?>">
																	</div>
																</div>

																<div class="row">
																	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																		<label for="user-email" class="d-flex justify-content-start ps-3">Email Address</label>
																		<input type="text" name="user-email" id="user-email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
																	</div>

																	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																		<label for="user-mobile" class="d-flex justify-content-start ps-3">Mobile Number</label>
																		<input type="number" name="user-mobile" id="user-mobile" class="form-control" value="<?php echo $_SESSION['mobile']; ?>">
																	</div>
																</div>

																<div class="row">
																	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																		<label for="user-bday" class="d-flex justify-content-start ps-3">Birth Date</label>
																		<input type="date" name="user-bday" id="user-bday" class="form-control" value="<?php echo $_SESSION['bday']; ?>">
																	</div>

																	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																		<label for="user-age" class="d-flex justify-content-start ps-3">Age</label>
																		<input type="number" name="user-age" id="user-age" class="form-control" value="<?php echo $_SESSION['age']; ?>">
																	</div>
																</div>

																<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
																	<label for="user-add" class="d-flex justify-content-start ps-3">Address</label>
																	<textarea class="form-control" id="user-add" name="user-add" rows="4"><?php echo $_SESSION['address']; ?></textarea>
																</div>

										        				<button type="submit" name="submit" class="btn-primary">Save changes</button>

															</div>
														</form>
													</div>
												</div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
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