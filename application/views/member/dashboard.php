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
					<div class="col-3">
						<div class="icon-big text-center">
						<i class="fas fa-wallet"></i>
						</div>
					</div>
					<div class="col-9 col-stats">
						<div class="numbers">
						<p class="card-category">Balance</p>
						<h4 class="card-title"><?= format_currency($credit) ?></h4>
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
					<div class="col-3">
						<div class="icon-big text-center">
						<i class="fas fa-money-check"></i>
						</div>
					</div>
					<div class="col-9 col-stats">
						<div class="numbers">
						<p class="card-category">Total Credit</p>
						<h4 class="card-title"><?= format_currency($total_credit) ?></h4>
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
					<div class="col-3">
						<div class="icon-big text-center">
						<i class="fas fa-layer-group"></i>
						</div>
					</div>
					<div class="col-9 col-stats">
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
					<div class="col-3">
						<div class="icon-big text-center">
						<i class="fas fa-server"></i>
						</div>
					</div>
					<div class="col-9 col-stats">
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
							<div class="card-title">Total Order Statistics <?= date('Y') ?></div>
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
							<canvas id="statisticsChartDashboard"></canvas>
						</div>
						<div id="myChartLegendDashboard"></div>
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
							<?php 
								$feed_color = array('secondary', 'success', 'info', 'warning', 'danger', 'primary');
							?>
							<?php foreach ($recentActivity as $recentActivity) { ?>
								<?php
									$date = new DateTime($recentActivity['CreatedDate']);
									$formatted_date = strtoupper($date->format("M d"));
								?>
								<li class="feed-item feed-item-<?= $feed_color[array_rand($feed_color)] ?>">
									<time class="date" datetime="9-25"><?= $formatted_date ?></time>
									<span class="text"><?= $recentActivity['Title'] ?></span>
								</li>
							<?php } ?>
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
				<img class="card-img-top" src="<?= base_url() ?>assets/img/profile/activity/<?= $activity['ImageName'] ? $activity['ImageName'] : 'opensubmit.png' ?>"  alt="Card image cap" />
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
						<p class="username"><?= $activity['UserCreated'] ?></p>
						<p class="date text-muted">
							<?php
								$date = new DateTime($activity['CreatedDate']);
								$formatted_date = $date->format("d M y");
								$formatted_date = strtoupper(substr_replace($formatted_date, ' ', 3, 0));

								echo $formatted_date
							?>
					</div>
					</div>
					<div class="separator-solid"></div>
					<p class="card-category text-info mb-1"><a href="#"> <?= $activity['Category'] ?></a></p>
					<h3 class="card-title">
					<a href="#"> <?= $activity['Title'] ?></a>
					</h3>
					<p class="card-text">
					<?= $activity['Text'] ?>
					</p>
					<!-- <a href="#" class="btn btn-primary btn-rounded btn-sm">Read More</a> -->
				</div>
				</div>
			</div>
		</div>
		
		<script src="<?= base_url() ?>/assets/assets_members/js/plugin/chart.js/chart.min.js"></script>
		<script src="<?= base_url() ?>/assets/assets_members/js/bootstrap-notify.min.js"></script>
		<!-- <script src="<?= base_url() ?>/assets/assets_members/js/jquery-3.6.0.js"></script> -->
		<!-- <script src="<?= base_url() ?>/assets/assets_members/js/circles.js"></script> -->
		<!-- <script src="<?= base_url() ?>/assets/assets_members/js/demo.js"></script> -->
	</body>
</html>

<script>
    var appraovedPercentage = <?= $appraovedPercentage ?>;
    var rejectPercentage = <?= $rejectPercentage ?>;
    var pendingPercentage = <?= $pendingPercentage ?>;
    var pendingStatistic = <?= $pendingStatistic ?>;
    var rejectStatistic = <?= $rejectStatistic ?>;
    var successStatistic = <?= $successStatistic ?>;
    var base_url = "<?= base_url() ?>";

	//Chart
	const pending_count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	pendingStatistic.forEach(element => {
		const month = element.month_year.split('-')[1];
		pending_count[parseInt(month) - 1] = parseInt(element.count);
	});

	const reject_count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	rejectStatistic.forEach(element => {
		const month = element.month_year.split('-')[1];
		reject_count[parseInt(month) - 1] = parseInt(element.count);
	});

	const success_count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	successStatistic.forEach(element => {
		const month = element.month_year.split('-')[1];
		success_count[parseInt(month) - 1] = parseInt(element.count);
	});

	var ctxStatistics = document.getElementById('statisticsChartDashboard').getContext('2d');

	// Create the chart
	var statisticsChart = new Chart(ctxStatistics, {
		type: 'line',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
				label: "Reject",
				borderColor: '#f3545d',
				pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
				pointRadius: 0,
				backgroundColor: 'rgba(243, 84, 93, 0.4)',
				legendColor: '#f3545d',
				fill: true,
				borderWidth: 2,
				data: reject_count
			}, {
				label: "Pending",
				borderColor: '#fdaf4b',
				pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
				pointRadius: 0,
				backgroundColor: 'rgba(253, 175, 75, 0.4)',
				legendColor: '#fdaf4b',
				fill: true,
				borderWidth: 2,
				data: pending_count
			}, {
				label: "Success",
				borderColor: '#177dff',
				pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
				pointRadius: 0,
				backgroundColor: 'rgba(23, 125, 255, 0.4)',
				legendColor: '#177dff',
				fill: true,
				borderWidth: 2,
				data: success_count
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			legend: {
				display: false
			},
			tooltips: {
				bodySpacing: 4,
				mode: "nearest",
				intersect: 0,
				position: "nearest",
				xPadding: 10,
				yPadding: 10,
				caretPadding: 10
			},
			layout: {
				padding: { left: 5, right: 5, top: 15, bottom: 15 }
			},
			scales: {
				yAxes: [{
					ticks: {
						fontStyle: "500",
						beginAtZero: false,
						maxTicksLimit: 5,
						padding: 10
					},
					gridLines: {
						drawTicks: false,
						display: false
					}
				}],
				xAxes: [{
					gridLines: {
						zeroLineColor: "transparent"
					},
					ticks: {
						padding: 10,
						fontStyle: "500"
					}
				}]
			},
			legendCallback: function (chart) {
				var text = [];
				text.push('<ul class="' + chart.id + '-legend html-legend">');
				for (var i = 0; i < chart.data.datasets.length; i++) {
					text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
					if (chart.data.datasets[i].label) {
						text.push(chart.data.datasets[i].label);
					}
					text.push('</li>');
				}
				text.push('</ul>');
				return text.join('');
			}
		}
	});
</script>