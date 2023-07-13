<?php
	include_once "session.php";
	include_once "userdata.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style-min.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../css/brands.css">
	<link rel="stylesheet" type="text/css" href="../css/solid.css">
	<link rel="shortcut icon" href="../img/loan-icon.ico">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container-fluid">
	<div class="row flex-nowrap">
		<!--Navigation Sidebar-->
		<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white shadow">
			<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 min-vh-100">
				<span class="fs-5 d-none d-sm-inline fw-bold">Admin</span>

				<hr>

				<ul class="nav nav-pills flex-column mb-sm-auto mb-0 ms-2 align-items-start" id="menu">
					<li class="nav-item nav-list">
						<a href="dashboard.php" class="nav-link align-middle px-0 text-wrap">
							<i class="fas fa-regular fa-gauge bi me-2"></i>	
							<span class="d-none d-sm-inline fw-bold">Dashboard</span>
						</a>
					</li>

					<li class="nav-item nav-list">
						<a href="manage-accounts.php" class="nav-link align-middle px-0">
							<i class="fas fa-regular fa-user bi me-2"></i>	
							<span class="d-none d-sm-inline fw-bold">Accounts</span>
						</a>
					</li>

					<li class="nav-item nav-list">
						<a href="manage-clients.php" class="nav-link align-middle px-0">
							<i class="fas fa-regular fa-user-group bi me-2"></i>	
							<span class="d-none d-sm-inline fw-bold">Manage Clients</span>
						</a>
					</li>

					<li class="nav-item nav-list">
						<a href="loan-management.php" class="nav-link align-middle px-0">
							<i class="fas fa-regular fa-hand-holding-dollar bi me-2"></i>	
							<span class="d-none d-sm-inline fw-bold">Loan Management</span>
						</a>
					</li>

					<li class="nav-item nav-list">
						<a href="archive-data.php" class="nav-link align-middle px-0">
						<i class="fa-solid fa-box-archive bi me-2"></i>
							<span class="d-none d-sm-inline fw-bold">Archived Data</span>
						</a>
					</li>

					<li class="nav-item nav-list">
						<a href="admin-settings.php" class="nav-link align-middle px-0">
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
						<h2 class="text-start text-white ps-3">Settings</h2><br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 py-1">
						<div class="p-4 bg-white shadow-4 rounded-3">
							<div class="row">
								<div class="col text-start ps-3 fw-bold">
									<label for="lang-list" class="form-label">Language</label>
								</div>
								
							</div>

							<div class="row">
								<div class="col d-flex justify-content-center">
									<input class="form-control" list="language" id="lang-list" placeholder="English (Default)">
									<datalist id="language"> 
										<option value="English (US)">
										<option value="English (UK)">
									</datalist>
								</div>
							</div>
						</div>
					</div>
				</div>

				<hr class="text-white">

				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 py-1">
						<div class="p-4 bg-white shadow-4 rounded-3">
							<div class="row">
								<div class="col text-start ps-3 fw-bold">
									<label for="lang-list" class="form-label">More Settings</label>
								</div>
							</div>

							<br>

							<div class="row">
								<div class="col">
									<div class="row">
										<div class="col-lg-6 col-md-12 col-sm-12 py-2">
											 <div class="card shadow-sm rounded-3">
											 	 <div class="card-body">
											 	 	<div class="col fw-bold">
														SMS Notification(s)
													</div>

													<div class="col">
														<div class="form-check form-switch d-flex justify-content-center">
														  <input class="form-check-input" type="checkbox" id="sms-notif">
														</div>
													</div>
											 	 </div>
											 </div>
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">
											<div class="card shadow-sm rounded-3 py-2">
											 	 <div class="card-body">
											 	 	<div class="col fw-bold py">
														Push Notification(s)
													</div>

													<div class="col">
														<div class="form-check form-switch d-flex justify-content-center">
														  <input class="form-check-input" type="checkbox" id="push-notif">
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
		</div>
	</div>
</div>

<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>

