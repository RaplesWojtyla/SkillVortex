<div class="header-top">
	<div class="container">
		<div class="logo">
			<a href="index.php">SKILL VORTEX</a>
		</div>
		<div class="header-top-right">
			<div class="dropdown">
				<a href="#" id="topbarUserDropdown"
					class="user-dropdown d-flex align-items-center dropend dropdown-toggle" data-bs-toggle="dropdown"
					aria-expanded="false">
					<div class="avatar avatar-md2">
						<img src="../dist/assets/compiled/jpg/1.jpg" alt="Avatar" />
					</div>
					<div class="text">
						<h6 class="user-dropdown-name">
							<?=$_SESSION['fullname']?>
						</h6>
						<p class="user-dropdown-status text-sm text-muted">
							<?=$_SESSION['status']?>
						</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
					<li>
						<button type="button" class="dropdown-item" data-bs-toggle="modal"
							data-bs-target="#profileModal">
							My Account
						</button>
					</li>
					<li>
						<button type="button" class="dropdown-item" data-bs-toggle="modal"
							data-bs-target="#changePasswordModal">
							Change Password
						</button>
					</li>
					<li>
						<hr class="dropdown-divider" />
					</li>
					<li><a class="dropdown-item" href="../authentication/logout.php">Logout</a></li>
				</ul>
				<form method="POST">
					<!-- Profile Modal -->
					<div class="modal fade" id="profileModal" data-bs-backdrop="static" data-bs-keyboard="false"
						tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="staticBackdropLabel">Profile</h5>
								</div>
								<div class="modal-body">
									<div class="form-body">
										<div class="row">
											<div class="col-md-4">
												<label for="nama_lengkap">Nama Lengkap</label>
											</div>
											<div class="col-md-8">
												<div class="form-group has-icon-left">
													<div class="position-relative">
														<input name="nama_lengkap" type="text" class="form-control"
															value="<?=$_SESSION['fullname']?>" id="nama_lengkap">
														<div class="form-control-icon">
															<i class="bi bi-person"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label for="username">Username</label>
											</div>
											<div class="col-md-8">
												<div class="form-group has-icon-left">
													<div class="position-relative">
														<input name="username" type="text" class="form-control"
															value="<?=$_SESSION['username']?>" id="username">
														<div class="form-control-icon">
															<i class="bi bi-person-bounding-box"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label for="email">Email</label>
											</div>
											<div class="col-md-8">
												<div class="form-group has-icon-left">
													<div class="position-relative">
														<input name="email" type="email" class="form-control"
															value="<?=$_SESSION['email']?>" id="email" readonly>
														<div class="form-control-icon">
															<i class="bi bi-envelope"></i>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Close</button>
									<button name="updateProfileBtn" type="submit"
										class="btn btn-primary">Update</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Change Password Modal -->
					<div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false"
						tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
								</div>
								<div class="modal-body">
									<div class="form-body">
										<div class="row">
											<div class="col-md-4">
												<label for="password_lama">Password Lama</label>
											</div>
											<div class="col-md-8">
												<div class="form-group has-icon-left">
													<div class="position-relative">
														<input name="password_lama" type="password" class="form-control"
															id="password">
														<div class="form-control-icon">
															<i class="bi bi-shield-lock"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label for="password_baru">Password Baru</label>
											</div>
											<div class="col-md-8">
												<div class="form-group has-icon-left">
													<div class="position-relative">
														<input name="password_baru" type="password" class="form-control"
															id="password2">
														<div class="form-control-icon">
															<i class="bi bi-shield-lock"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
											</div>
											<div class="col-md-8">
												<div class="form-group has-icon-left">
													<div class="position-relative">
														<input name="konfirmasi_password_baru" type="password"
															class="form-control" id="konfirmasi_password_baru">
														<div class="form-control-icon">
															<i class="bi bi-shield-lock"></i>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Close</button>
									<button name="updatePasswordBtn" type="submit"
										class="btn btn-primary">Change</button>
								</div>
							</div>
						</div>
					</div>

					<?php
						if (isset($_POST['updateProfileBtn']))
						{
							$_SESSION['fullname'] = $_POST['nama_lengkap'];
							$_SESSION['username'] = $_POST['username'];
							$email = $_POST['email'];
							query("UPDATE users SET username = '$_SESSION[username]', nama_lengkap = '$_SESSION[fullname]' WHERE email = '$email'");
							echo"
								<script>
									window.location = `$_SERVER[REQUEST_URI]`
								</script>
							";
						}
						else if (isset($_POST['updatePasswordBtn']))
						{
							if (changePassword($_POST))
							{
								echo"
									<script>
										alert('Password Berhasil Diubah')
										window.location = `$_SERVER[REQUEST_URI]`
									</script>
								";
							}
							else
							{
								echo"
									<script>
										window.location = `$_SERVER[REQUEST_URI]`
									</script>
								";
							}
						}
						
					?>

				</form>
			</div>
			<!-- Burger button responsive -->
			<a href="#" class="burger-btn d-block d-xl-none">
				<i class="bi bi-justify fs-3"></i>
			</a>


		</div>
	</div>
</div>

<nav class="main-navbar ">
	<div class="container">
		<ul class="d-flex justify-content-center ">
			<li class="menu-item">
				<h5>
					<a href="index.php" class="menu-link">
						<span><i class="bi bi-grid-fill"></i>Dashboard</span>
					</a>
				</h5>
			</li>



			<li class="menu-item">
				<h5>
					<a href="enroll_courses.php" class="menu-link">
						<span><i class="bi bi-person-fill"></i>Courses</span>
					</a>
				</h5>
			</li>

			<li class="menu-item has-sub">
				<h5>
					<a href="#" class="menu-link">
						<span><i class="bi bi-clipboard-data-fill"></i>Scoreboard</span>
					</a>
				</h5>
				<div class="submenu">
					<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
					<div class="submenu-group-wrapper">
						<ul class="submenu-group">

				<?php
					$e_student = $_SESSION['email'];
					$res = query("SELECT * FROM vw_courses_student WHERE e_student='$e_student' ");

					foreach($res as $data)
					{
               	?>

							<li class="submenu-item">
								<a href="all_quiz_scoreboard.php?kode_course=<?=$data['kode_course']?>"
									class="submenu-link">
									<?=$data['judul_course']?>
								</a>
							</li>

				<?php } ?>

						</ul>
					</div>
				</div>
			</li>

			<li class="menu-item">
				<h5>
					<a href="req_student.php" class="menu-link">
						<span><i class="bi bi-envelope-exclamation-fill"></i>Request</span>
					</a>
				</h5>
			</li>

			<li class="menu-item">
				<h5>
					<a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal2">
						<span><i class="bi bi-chat-right-text-fill"></i>Feedback</span>
					</a>
				</h5>
			</li>

			<li class="menu-item">
				<h5>
					<a href="service_center.php" class="menu-link">
						<span><i class="bi bi-person-lines-fill"></i>Service Center</span>
					</a>
				</h5>
			</li>

			<div class="theme-toggle d-flex gap-2 align-items-center ms-auto">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--system-uicons" width="27" height="27"
					preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
					<g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
						stroke-linejoin="round">
						<path
							d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
							opacity=".3"></path>
						<g transform="translate(-210 -1)">
							<path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
							<circle cx="220.5" cy="11.5" r="4"></circle>
							<path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
						</g>
					</g>
				</svg>
				<div class="form-check form-switch fs-5">
					<input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer" />
					<label class="form-check-label"></label>
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--mdi" width="27" height="27" preserveAspectRatio="xMidYMid meet"
					viewBox="0 0 24 24">
					<path fill="currentColor"
						d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
					</path>
				</svg>
			</div>

		</ul>
	</div>

	<!-- Modal Feedback -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel">Feedback</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<form action="" method="POST">
					<div class="modal-body">
						<div class="form-floating">
							<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
								name="feedback"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button name='kirim' type='submit' class='btn btn-primary'>
							Kirim
						</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">
							Close
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
    if (isset($_POST['kirim']))
    {
      $pesan = $_POST['feedback'];
      $res = query("INSERT INTO feedback (e_pengirim , isi_pesan , e_penerima) VALUES ('$_SESSION[email]' , '$pesan' ,'skillvortex4@gmail.com')");

      if ($res)
      {
        echo"
			<script>
				alert('Feedback terikirim.')
				window.location = `$_SERVER[REQUEST_URI]`
			</script>
        ";
      }
    }
  ?>

</nav>