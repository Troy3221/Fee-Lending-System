<?php
	include_once "session.php";
	include_once "userdata.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Accounts</title>
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
			<!--Main Content-->
		<div class="col py-3 d-flex justify-content-center overflow-auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<br>
						<h2 class="text-white text-start ps-3">User Management</h2><br>
					</div>
				</div>


				<!--Table-->
				<div class="row">
					<div class="col ">
						<div class="card">
							<div class="card-body rounded-3 m-4 table-responsive-sm">
								<table class="table table-hover align-middle">
									<thead>
										<tr>
											<th scope="col">Profile</th>
											<th scope="col">Account #</th>
											<th scope="col">First Name</th>
											<th scope="col">Last Name</th>
											<th scope="col" >Email Address</th>
											<th scope="col" style="display: none;">Mobile number</th>
											<th scope="col" style="display: none;">Birthdate</th>
											<th scope="col" style="display: none;">Age</th>
											<th scope="col" style="display: none;">Address</th>
											<th scope="col">Username</th>
											<th scope="col" style="display: none;">Password</th>
											<th scope="col"style="display: none;">Privilege</th>
											<th scope="col" style="display: none;">Date Registered</th>
											<th scope="col">Action</th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<?php 
										$records = mysqli_query($config," select * from accounts" );

										 while($data = mysqli_fetch_array ($records) )
										 {
											if ($data['profile_pic'] == "") {
												echo '
										 		<td><img class="rounded-circle mx-auto d-block" src="../img/profile.jpg" width="100px" height="100px"></td>';
											}
											else {
												echo '
										 		<td><img class="rounded-circle mx-auto d-block" src="data:image/jpg;charset=utf8;base64,'.base64_encode($data['profile_pic']).'" width="100px" height="100px"></td>';
											}
										?>
										
										<td scope="row"><?php  echo $data ['acc_no']?></td>
											<td><?php  echo $data ['first_name']?></td>
											<td><?php  echo $data ['last_name']?></td>
											<td ><?php  echo $data ['email_add']?></td>
											<td style="display: none;"><?php  echo $data ['mobile_no']?></td>
											<td style="display: none;"><?php  echo $data ['birth_date']?></td>
											<td style="display: none;"><?php  echo $data ['age']?></td>
											<td style="display: none;"><?php  echo $data ['address']?></td>
											<td><?php  echo $data ['username']?></td>
											<td style="display: none;" ><?php echo $data ['password']?></td>
											<td style="display: none;" ><?php echo $data ['acc_status']?></td>
											<td style="display: none;"> <?php  echo $data ['acc_priv']?></td>
											<td style="display: none;" ><?php echo $data ['date_registered']?></td>

											<td>
												<div class="d-flex flex-row justify-content-center">
									                 <div>
									                	<input class="btn btn-primary viewbtn" type="button" name="edit-user" value="View"   data-bs-toggle="modal" data-bs-target="#showAccount">
									                </div>

									                <div class="ps-2">
									                </div>
									            </div>
											</td>

										<tr>
										</tr>
										<?php 
									}
										?>
									</tr>
									</tbody>
								</table>
							</div>
						</div>


						<!--Edit Modal-->
						<div class="modal fade" id="showAccount" name="showAccount" aria-labelledby="editInformationLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									
							<div class="modal-body">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-12 text-start">
										<img src="../img/profile.jpg" class="img-fluid" max-width="400px">
										<form action="upload-profile.php" method="post" enctype="multipart/form-data"><br>
											<input class="form-control" type="file" name="image"><br>
											<input class="btn btn-primary w-100" type="submit" name="submit" value="Upload">
										</form>
									</div>

									<div class="col-xxl-8 col-lg-8 col-md-8 col-sm-12 text-start mt-3">
								
										<div class="row">
											<div class="col-12 pt-4">
												<ul class="nav nav-pills" id="personal-tab" role="tablist">
													<li class="nav-item" role="presentation">
														<button class="nav-link active" id="personal-info" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
														Personal Info
														</button>
													</li>

													<li class="nav-item" role="presentation" role="tablist">
														<button class="nav-link" id="personal-acc" data-bs-toggle="tab" data-bs-target="#acc" type="button" role="tab" aria-controls="acc" aria-selected="true">
														<i class="fas fa-user me-1"></i>
														Account
														</button>
													</li>
												</ul>
											</div>

											<div class="tab-content col-xxl-8 col-md-8 col-sm-12 ms-3 mt-3" id="myTabContent">
											<div class="tab-pane fade show text-start active" id="info" role="tabpanel" aria-labelledby="home-tab">
												<h4>Personal Information</h4>

												<div class="row ms-1">
													<div class="col-xxl-6 col-lg-6 col-md-12 col-sm-12 pt-3">
														<h6 style="font-weight:700;"> First Name:</h6>
													</div>

													<div class="col-xxl-6 col-lg-6 col-md-12 col-sm-12 pt-3" style="margin-left: -5em;">
														<input id ="fname" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
													<div class="col-xxl-6 col-lg-6 col-md-12 col-sm-12 pt-3" >
														<h6> Last Name:</h6>
													</div>
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3"  style="margin-left: -5em;">
														<input id ="lname" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>

												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Email Address:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="email-add" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Mobile Number:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="mobile-no" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Birth Date:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="birth-date" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Address:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="user-address" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

											</div>

											<div class="tab-pane fade text-start" id="acc" role="tabpanel" aria-labelledby="acc-tab">
												<h4>Account Information</h4>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Username:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="user-name" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Account Status:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="status" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Privilege:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="acc-priv" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>

												<div class="row ms-1">
													<div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12 pt-3">
														<h6>Date Registered:</h6>
													</div>

													<div class="col-xxl-8 col-lg-8 col-md-12 col-sm-12 pt-3">
														<input id ="date-registered" style ="border:none;box-shadow:none; font-weight: 700;" disabled>
													</div>
												</div>
											</div>

											<div class="tab-pane fade" id="acc" role="tabpanel" aria-labelledby="profile-tab"></div>
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
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.viewbtn').on('click',function(){
			$('#showAccount').modal('show');

			$tr =$(this).closest('tr');

			var data = $tr.children("td").map(function(){
				return $(this).text();

			}).get();

			console.log(data);
			$('#profile-pic').val(data[0]);
			$('#acc-no').val(data[1]);
			$('#fname').val(data[2]);
			$('#lname').val(data[3])
			$('#email-add').val(data[4]);
			$('#mobile-no').val(data[5]);
			$('#birth-date').val(data[6]);
			$('#age').val(data[7]);
			$('#user-address').val(data[8]);
			$('#user-name').val(data[9]);
			$('#user-pass').val(data[10]);
			$('#status').val(data[11]);
			$('#acc-priv').val(data[12]);
			$('#date-registered').val(data[13]);

		})
	});

</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-close').on('click',function(){
			$('#showAccount').modal('hide');
		})
	});
	
</script>

<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>

