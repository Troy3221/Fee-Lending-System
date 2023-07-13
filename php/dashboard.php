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
						<h2 class="text-white text-start ps-3">Dashboard</h2><br>
					</div>
				</div>

				<!--Header Card-->
				<div class="row">
					<!--Welcome Card-->
					<div class="col-12">
						<div class="card">
							<div class="card-body m-5">
								<div class="row">
									<div class="col-12 text-start">
										<div class="row">
											<div class="col-xxl-8 col-sm-12">
												<h4>Welcome Back, Admin</h4><br>
												<small>
													Welcome to your personal dashboard!<br>
													We got you covered in real-time data management and monitoring.
												</small>
											</div>

											<div class="col-xxl-4 col-sm-12 mt-4">
												<img src="../img/at-work.svg" class="img-fluid"> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<br>

				<!--Charts-->
				<div class="row">
					<!--Pie Chart-->
					<div class="col-xxl-4 col-lg-4 col-md-4 col-sm-12 text-start">
						<div class="card">
							<div class="card-body m-4">
								<div class="row">
									<div class="col-10">
										<h6>Loan Types</h6>
									</div>

									<div class="col-2 text-end text-decoration-none">
										<a href="#" class="">
											<i class="fa-solid fa-ellipsis-vertical text-dark"></i>
										</a>
									</div>
								</div>

								<?php
								$conn = new mysqli('localhost','root','','loaning_system');

								$result =  mysqli_query($conn,"SELECT COUNT(*) as loan_type FROM loan_destination WHERE loan_type ='Student Loans'");

								$result2 =  mysqli_query($conn,"SELECT COUNT(*) as loan_type FROM loan_destination WHERE loan_type ='Mortgages'");

								$result3 =  mysqli_query($conn,"SELECT COUNT(*) as loan_type FROM loan_destination WHERE loan_type ='Credit Card'");
								

								while($row=mysqli_fetch_array($result))
								{
									$loan_type=$row['loan_type'];
									
								}
								while($row=mysqli_fetch_array($result2))
								{
									$loan_type3=$row['loan_type'];
									
								}
								while($row=mysqli_fetch_array($result3))
								{
									$loan_type2=$row['loan_type'];
									
								}


								?>

								<div>
								<canvas id="pieChart"></canvas>
								</div>
								<div class="row">
									<div class="col chart-container m-4">
									<script>
									const piedata = {
									labels: [
										'Student Loans',
										'Credit Card',
										'Mortgages'
									],
									datasets: [{
										data: [<?php echo json_encode($loan_type)?>,<?php echo json_encode($loan_type2)?>,<?php echo json_encode($loan_type3)?>],
										backgroundColor: [
										'rgb(255, 99, 132)',
										'rgb(54, 162, 235)',
										'rgb(255, 205, 86)'
										],
										hoverOffset: 4
									}]
									};
									const config2 = {
									type: 'pie',
									data: piedata,
									};
									</script>
									<script>
									const pieChart = new Chart(
										document.getElementById('pieChart'),
										config2
									);
									</script>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--Line Chart-->
					<div class="col-xxl-8 col-lg-8 col-md-8 col-sm-12 text-start">
						<div class="card">
							<div class="card-body m-4">
								<div class="row">
									<div class="col-10">
										<h6>Number of Registered Users</h6>
									</div>

									<div class="col-2 text-end text-decoration-none">
										<a href="#" class="">
											<i class="fa-solid fa-ellipsis-vertical text-dark"></i>
										</a>
									</div>
								</div>

								<?php
									$conn = new mysqli('localhost','root','','loaning_system');
									$query = $conn->query("SELECT * FROM accounts");


									foreach($query as $data){
										$date = $data['date_registered'];
										$user = $data['acc_no'];
									}
								?>

								<div>
								<canvas id="myChart"></canvas>
								</div>
								<div class="row">
									<div class="col chart-container m-4">
									<script>
										const labels = [
															'February',
															'March',
															'April',
															'May',
															'June',
														];
										const data = {
										labels: labels,
										datasets: [{
											label: 'Users',
											data: <?php echo json_encode($user)?>,
											backgroundColor: [
											'rgba(255, 99, 132, 0.2)',
											'rgba(255, 159, 64, 0.2)',
											'rgba(255, 205, 86, 0.2)',
											'rgba(75, 192, 192, 0.2)',
											'rgba(54, 162, 235, 0.2)',
											'rgba(153, 102, 255, 0.2)',
											'rgba(201, 203, 207, 0.2)'
											],
											borderColor: [
											'rgb(255, 99, 132)',
											'rgb(255, 159, 64)',
											'rgb(255, 205, 86)',
											'rgb(75, 192, 192)',
											'rgb(54, 162, 235)',
											'rgb(153, 102, 255)',
											'rgb(201, 203, 207)'
											],
											borderWidth: 1
										}]
										};

										const config = {
										type: 'bar',
										data: data,
										options: {
											scales: {
											y: {
												beginAtZero: true
											}
											}
										},
										};
									</script>
									<script>
										const myChart = new Chart(
											document.getElementById('myChart'),
											config
										);
									</script>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<!--Footer-->
				<footer class="footer mt-3 py-3 bg-white">
					<div class="row m-5">
						<div class="col-lg-6 col-md-12 col-sm-12 text-muted text-start">
							Sypher School Fee Lending System
							<p class="fw-bold mt-4 my-0">Disclamer</p>
							<small>
								Devoloped by Troy Inc Cooperation.<br>
								For BISF project <br><br>
								Course code 2208
							</small>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12 text-muted">
						<img class="login-vector mt-2" src="../img/logo.png">
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>

