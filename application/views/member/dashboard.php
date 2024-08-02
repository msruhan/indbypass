<html>
	<head>
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
			<div>
				<h3 class="fw-bold mb-3">User Dashboard</h3>
				<h6 class="op-7 mb-2">Welcome to INDOBYPASS!</h6>
			</div>
			<div class="ms-md-auto py-2 py-md-0">
				<a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
				<a href="<?= site_url('member/dashboard/addfund') ?>" class="btn btn-primary btn-round"> + Add Fund</a>
			</div>
		</div>
	</head>
	<body>
		<!-- Card Chart -->
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-primary card-round">
				<div class="card-body">
					<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
						<i class="fas fa-wallet"></i>
						</div>
					</div>
					<div class="col-7 col-stats">
						<div class="numbers">
						<p class="card-category">Balance</p>
						<h4 class="card-title"><?= number_format($credit, 2) ?></h4>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-info card-round">
				<div class="card-body">
					<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
						<i class="fas fa-money-check"></i>
						</div>
					</div>
					<div class="col-7 col-stats">
						<div class="numbers">
						<p class="card-category">Total Credit</p>
						<h4 class="card-title"><?= number_format($total_credit, 2) ?></h4>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-success card-round">
				<div class="card-body">
					<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
						<i class="fas fa-layer-group"></i>
						</div>
					</div>
					<div class="col-7 col-stats">
						<div class="numbers">
						<p class="card-category">Total IMEI Order</p>
						<h4 class="card-title"><?= $total_order ?></h4>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-secondary card-round">
				<div class="card-body">
					<div class="row">
					<div class="col-5">
						<div class="icon-big text-center">
						<i class="fas fa-server"></i>
						</div>
					</div>
					<div class="col-7 col-stats">
						<div class="numbers">
						<p class="card-category">Total Server Order</p>
						<h4 class="card-title"><?= $total_order ?></h4>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<!-- Pie Chart -->
		<div class="row">
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Order Success</div>
					</div>
					<div class="card-body">
						<div class="chart-container">
							<canvas id="doughnutChartAvailable" style="margin-top: -30px;margin-bottom: -20px"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Order Rejected</div>
					</div>
					<div class="card-body">
						<div class="chart-container">
							<canvas id="doughnutChartRejected" style="margin-top: -30px;margin-bottom: -20px"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Order Pending</div>
					</div>
					<div class="card-body">
						<div class="chart-container">
							<canvas id="doughnutChartPending" style="margin-top: -30px;margin-bottom: -20px"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
				<div class="card card-profile">
					<div class="card-header" style="height: 83px">
						<div class="profile-picture">
							<div class="avatar avatar-xl">
								<img src="<?= base_url() ?>assets/assets_members/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="user-profile text-center">
							<div class="name">
								<?= $this->session->userdata('MemberFirstName') . " " . $this->session->userdata("MemberLastName"); ?>
							</div>
							<div class="job"><?php echo $this->session->userdata("MemberEmail"); ?></div>
							<div class="desc">I knew that you would do this!</div>
							<div class="social-media">
								<a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
									<span class="btn-label just-icon"><i class="icon-social-twitter"></i>
									</span>
								</a>
								<a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
									<span class="btn-label just-icon"><i class="icon-social-facebook"></i>
									</span>
								</a>
								<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
									<span class="btn-label just-icon"><i class="icon-social-instagram"></i>
									</span>
								</a>
							</div>
							<div class="view-profile">
								<a href="<?= site_url('member/dashboard/profile') ?>" class="btn btn-secondary w-100">View Full Profile</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Total Order Statistics -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-head-row">
							<div class="card-title">Total Order Statistics 2024</div>
							<div class="card-tools">
								<a href="#" class="btn btn-label-success btn-round btn-sm me-2">
									<span class="btn-label">
										<i class="fa fa-pencil"></i>
									</span>
									Export
								</a>
								<a href="#" class="btn btn-label-info btn-round btn-sm">
									<span class="btn-label">
										<i class="fa fa-print"></i>
									</span>
									Print
								</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="chart-container" style="min-height: 375px">
							<canvas id="statisticsChart"></canvas>
						</div>
						<div id="myChartLegend"></div>
					</div>
				</div>
			</div>				
		</div>
		<!-- Customized Card -->
		<div class="row">
			<div class="col-md-7">
				<div class="card">
					<div class="card-header">
						<div class="card-head-row card-tools-still-right">
							<div class="card-title">Recent Activity</div>
							<div class="card-tools">
								<div class="dropdown">
									<button class="btn btn-icon btn-clean" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-h"></i>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<ol class="activity-feed">
							<li class="feed-item feed-item-secondary">
								<time class="date" datetime="9-25">Sep 25</time>
								<span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
							</li>
							<li class="feed-item feed-item-success">
								<time class="date" datetime="9-24">Sep 24</time>
								<span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
							</li>
							<li class="feed-item feed-item-info">
								<time class="date" datetime="9-23">Sep 23</time>
								<span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
							</li>
							<li class="feed-item feed-item-warning">
								<time class="date" datetime="9-21">Sep 21</time>
								<span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
							</li>
							<li class="feed-item feed-item-danger">
								<time class="date" datetime="9-18">Sep 18</time>
								<span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
							</li>
							<li class="feed-item">
								<time class="date" datetime="9-17">Sep 17</time>
								<span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
							</li>
						</ol>
					</div>
				</div>
				<div class="card card-round">
					<div class="card-body">
						<div class="card-title fw-mediumbold">INDOBYPASS TEAM</div>
						<div class="card-list">
							<div class="item-list">
								<div class="avatar">
									<img
									src="<?= base_url() ?>assets/img/profile/FOUNDER.png" 
									alt="..."
									class="avatar-img rounded-circle"
									/>
								</div>
								<div class="info-user ms-3">
									<div class="username">Masruhan</div>
									<div class="status">Founder</div>
								</div>
								<a href="https://wa.me/6285158856462?text=Halo%20Founder%20INDOBYPASS%20" target="_blank" class="btn btn-icon btn-sm">
									<i class="fab fa-whatsapp"></i>
								</a>
								<a href="https://t.me/indobypassfounder" target="_blank" class="btn btn-icon btn-sm">
									<i class="fab fa-telegram"></i>
								</a>
							</div>
							<div class="item-list">
								<div class="avatar">
									<img
									src="<?= base_url() ?>assets/img/profile/COFOUNDER.png" 
									alt="..."
									class="avatar-img rounded-circle"
									/> 
								</div>
								<div class="info-user ms-3">
									<div class="username">AL Fajri</div>
									<div class="status">CO-Founder</div>
								</div>
								<a href="https://wa.me/6289612322511?text=Halo%20CO-Founder%20INDOBYPASS%20" target="_blank" class="btn btn-icon btn-sm">
									<i class="fab fa-whatsapp"></i>
								</a>
								<a href="https://t.me/al1010" target="_blank" class="btn btn-icon btn-sm">
									<i class="fab fa-telegram"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="card card-post card-round">
				<img class="card-img-top" src="<?= base_url() ?>assets/img/opensubmit.png"  alt="Card image cap" />
				<div class="card-body">
					<div class="d-flex">
					<div class="avatar">
						<img
						src="<?= base_url() ?>assets/img/profile/FOUNDER.png" 
						alt="..."
						class="avatar-img rounded-circle"
						/>
					</div>
					<div class="info-post ms-2">
						<p class="username">Founder INDOBYPASS</p>
						<p class="date text-muted">20 Jul 24</p>
					</div>
					</div>
					<div class="separator-solid"></div>
					<p class="card-category text-info mb-1"><a href="#">BYPASS XR-15 PM</a></p>
					<h3 class="card-title">
					<a href="#"> Launching New Tools!</a>
					</h3>
					<p class="card-text">
					We are launching new tools to help you to unlock your device. Stay tuned! 
					</p>
					<!-- <a href="#" class="btn btn-primary btn-rounded btn-sm">Read More</a> -->
				</div>
				</div>
			</div>
		</div>
		
		<script src="/indbypass/assets/assets_members/js/plugin/chart.js/chart.min.js"></script>
		<script src="/indbypass/assets/assets_members/js/jquery-3.6.0.js"></script>
		<script src="/indbypass/assets/assets_members/js/bootstrap-notify.min.js"></script>
		<script src="/indbypass/assets/assets_members/js/circles.js"></script>
		<script src="/indbypass/assets/assets_members/js/demo.js"></script>
	</body>
</html>

<script>
    var appraovedPercentage = <?= $appraovedPercentage ?>;
    var rejectPercentage = <?= $rejectPercentage ?>;
    var pendingPercentage = <?= $pendingPercentage ?>;
    var base_url = "<?= base_url() ?>";
</script>




