<?php
	include_once "session.php";
	include_once "userdata.php";
	include_once "database.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Clients</title>
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
		<div class="col py-3 d-flex justify-content-center overflow-auto">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<br>
						<h2 class="text-white text-start ps-3">Management Accounts</h2><br>
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
											<th scope="col">#</th>
											<th scope="col">First Name</th>
											<th scope="col">Last Name</th>
											<th scope="col" style="display: none;">Email Address</th>
											<th scope="col" style="display: none;">Mobile number</th>
											<th scope="col" style="display: none;">Birthdate</th>
											<th scope="col" style="display: none;">Age</th>
											<th scope="col" style="display: none;">Address</th>
											<th scope="col">Username</th>
											<th scope="col" style="display: none;">Password</th>
											<th scope="col">Privilege</th>
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


										?>

										<tr>
											<td scope="row"><?php  echo $data ['acc_no']?></td>
											<td><?php  echo $data ['first_name']?></td>
											<td><?php  echo $data ['last_name']?></td>
											<td style="display: none;"><?php  echo $data ['email_add']?></td>
											<td style="display: none;"><?php  echo $data ['mobile_no']?></td>
											<td style="display: none;"><?php  echo $data ['birth_date']?></td>
											<td style="display: none;"><?php  echo $data ['age']?></td>
											<td style="display: none;"><?php  echo $data ['address']?></td>
											<td><?php  echo $data ['username']?></td>
											<td style="display: none;" ><?php echo $data ['password']?></td>
											<td> <?php  echo $data ['acc_priv']?></td>
											<td style="display: none;" ><?php echo $data ['date_registered']?></td>

											<td>
												<div class="d-flex flex-row justify-content-center">
									                 <div>
									                	<input class="btn btn-primary editbtn" type="button" name="edit-user" value="Edit"   data-bs-toggle="modal" data-bs-target="#showUserData">
									                </div>

									                <div class="ps-2">
									                	<input class="btn btn-danger deletebtn" type="button" name="delete-user" value="Delete"data-bs-toggle="modal" data-bs-target="#deletemodal">
									                </div>

									                <div class="ps-2">
									                </div>
									            </div>
											</td>
										</tr>
										<?php 
									}
										?>
									</tbody>
								</table>
							</div>
						</div>


						<!--Edit Modal-->
						<div class="modal fade" id="showUserData" tabindex="-1" aria-labelledby="showUserData" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<div class="modal-body m-5">
										<div class="container-fluid">
											<h4>Account Information</h4><br>
											<div class="row">
												<script type="text/javascript">
													if (true) {}

												</script>
												<form class="form-control border-0" method="post" action="edit_user.php">
													<div class="col">
														<div class="row">
															<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
																<label for="acc-no" class="d-flex justify-content-start ps-3">Account Number</label>
																<input type="hidden" name="acc-no" id="acc-no" class="form-control">
															</div>
														</div>

														<div class="row">
															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="fname" class="d-flex justify-content-start ps-3">First Name</label>
																<input type="text" name="fname" id="fname" class="form-control"  >
																
															</div>

															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="lname" class="d-flex justify-content-start ps-3">Last Name</label>
																<input type="text" name="lname" id="lname" class="form-control" >
															</div>
														</div>

														<div class="row">
															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="email-add" class="d-flex justify-content-start ps-3">Email Address</label>
																<input type="text" name="email-add" id="email-add" class="form-control" >
															</div>

															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="mobile-no" class="d-flex justify-content-start ps-3">Mobile Number</label>
																<input type="text" name="mobile-no" id="mobile-no" class="form-control" >
															</div>
														</div>

														<div class="row">
															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="birth-date" class="d-flex justify-content-start ps-3">Birth Date</label>
																<input type="date" name="birth-date" id="birth-date" class="form-control" >
															</div>

															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="age" class="d-flex justify-content-start ps-3">Age</label>
																<input type="text" name="age" id="age" class="form-control" >
															</div>
														</div>

														<div class="row">
															<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
																<label for="user-address" class="d-flex justify-content-start ps-3">Address</label>
																<textarea class="form-control" name="user-address" id="user-address" rows="3"></textarea>
															</div>
														</div>

														<hr>

														<div class="row">
															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="user-name" class="d-flex justify-content-start ps-3">Username</label>
																<input type="text" name="user-name" id="user-name" class="form-control" >
															</div>

															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
																<label for="user-pass" class="d-flex justify-content-start ps-3">Password</label>
																<input type="password" name="user-pass" id="user-pass" class="form-control" >
															</div>
														</div>

														<div class="row">
															<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
																<label for="date-registered" class="d-flex justify-content-start ps-3">Registered Date</label>
																<input type="date" name="date-registered" id="date-registered" class="form-control" value="" readonly>
															</div>
														</div>

														<div class="row">
															<div class="col">
																<br><br>
																<input class="btn btn-primary w-25" type="submit" name="save-changes" value="Save">
																
																
															</div>
														</div>
													</div>

												</form>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

						<!--Delete Modal-->
						<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form class="form-control border-0" method="post" action="delete_user.php">
										<input type="hidden" name="delete_id" id="delete_id">
										<h4> Do you want to delete this user?</h4>
										<div class="modal-footer">
											<input class="btn btn-danger btn_close" type="button" data-bs-dismiss="modal" aria-labelledby="Close" value="NO"> 
											<input type="submit" name="deletedata" class="btn btn-primary" value="YES">
										</div>
									</form>
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
		$('.editbtn').on('click',function(){
			$('#showUserData').modal('show');

			$tr =$(this).closest('tr');

			var data = $tr.children("td").map(function(){
				return $(this).text();

			}).get();

			console.log(data);

			$('#acc-no').val(data[0]);
			$('#fname').val(data[1]);
			$('#lname').val(data[2])
			$('#email-add').val(data[3]);
			$('#mobile-no').val(data[4]);
			$('#birth-date').val(data[5]);
			$('#age').val(data[6]);
			$('#user-address').val(data[7]);
			$('#user-name').val(data[8]);
			$('#user-pass').val(data[9]);
			$('#date-registered').val(data[11]);

		})
	});

</script>

</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-close').on('click',function(){
			$('#showUserData').modal('hide');
		})
	});



</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-close').on('click',function(){
			$('#deletemodal').modal('hide');
		})
	});
	
</script>
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btn_close').on('click',function(){
			$('#deletemodal').modal('hide');
		})
	});
	
</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('.deletebtn').on('click', function(){

        $('#deletemodal').modal('show');


        $tr = $(this).closest('tr');

        var data =  $tr.children("td").map(function(){
          return $(this).text();


        }).get();

        console.log(data);


        $('#delete_id').val(data[0]);


      })
    });
  </script>

<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>

