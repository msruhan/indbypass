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

<div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="fas fa-users"></i>
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
                          <i class="fas fa-user-check"></i>
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
                          <i class="fas fa-chart-pie"></i>
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
                          <i class="far fa-check-circle"></i>
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

<!-- <div class="col-md-8">
    <div class="card card-round">
        <div class="card-header">
            <div class="card-head-row">
                <div class="card-title">User Statistics</div>
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
</div> -->

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
            <div class="card-header" style="height: 62px">
                <div class="profile-picture">
                    <div class="avatar avatar-xl">
                        <img src="<?= base_url() ?>assets/img/profile/profile.jpg" alt="..." class="avatar-img rounded-circle" />
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
                        <a href="<?= site_url('member/dashboard/profile') ?>" class="btn btn-secondary w-100">View Full
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">User Statisticsyyy</div>
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
						<div class="col-md-4">
							<div class="card card-primary">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Daily Sales</div>
										<div class="card-tools">
											<div class="dropdown">
												<button class="btn btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Export
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-category">March 25 - April 02</div>
								</div>
								<div class="card-body pb-0">
									<div class="mb-4 mt-2">
										<h1>$4,578.58</h1>
									</div>
									<div class="pull-in">
										<canvas id="dailySalesChart"></canvas>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body pb-0">
									<div class="h1 fw-bold float-end text-primary">+5%</div>
									<h2 class="mb-2">17</h2>
									<p class="text-muted">Users online</p>
									<div class="pull-in sparkline-fix">
										<div id="lineChart"></div>
									</div>
								</div>
							</div>
						</div>
					</div>


                    <div class="row">
						<div class="col-md-6">
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
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Support Tickets</div>
										<div class="card-tools">
											<ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
												<li class="nav-item">
													<a class="nav-link" id="pills-today" data-bs-toggle="pill" href="#pills-today" role="tab" aria-selected="true">Today</a>
												</li>
												<li class="nav-item">
													<a class="nav-link active" id="pills-week" data-bs-toggle="pill" href="#pills-week" role="tab" aria-selected="false">Week</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="pills-month" data-bs-toggle="pill" href="#pills-month" role="tab" aria-selected="false">Month</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<div class="avatar avatar-online">
											<span class="avatar-title rounded-circle border border-white bg-info">J</span>
										</div>
										<div class="flex-1 ms-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span class="text-warning ps-3">pending</span></h6>
											<span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
										</div>
										<div class="float-end pt-1">
											<small class="text-muted">8:40 PM</small>
										</div>
									</div>
									<div class="separator-dashed"></div>
									<div class="d-flex">
										<div class="avatar avatar-offline">
											<span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
										</div>
										<div class="flex-1 ms-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span class="text-success ps-3">open</span></h6>
											<span class="text-muted">I have some query regarding the license issue.</span>
										</div>
										<div class="float-end pt-1">
											<small class="text-muted">1 Day Ago</small>
										</div>
									</div>
									<div class="separator-dashed"></div>
									<div class="d-flex">
										<div class="avatar avatar-away">
											<span class="avatar-title rounded-circle border border-white bg-danger">L</span>
										</div>
										<div class="flex-1 ms-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span class="text-muted ps-3">closed</span></h6>
											<span class="text-muted">Is there any update plan for RTL version near future?</span>
										</div>
										<div class="float-end pt-1">
											<small class="text-muted">2 Days Ago</small>
										</div>
									</div>
									<div class="separator-dashed"></div>
									<div class="d-flex">
										<div class="avatar avatar-offline">
											<span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
										</div>
										<div class="flex-1 ms-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">Peter Parker <span class="text-success ps-3">open</span></h6>
											<span class="text-muted">I have some query regarding the license issue.</span>
										</div>
										<div class="float-end pt-1">
											<small class="text-muted">2 Day Ago</small>
										</div>
									</div>
									<div class="separator-dashed"></div>
									<div class="d-flex">
										<div class="avatar avatar-away">
											<span class="avatar-title rounded-circle border border-white bg-danger">L</span>
										</div>
										<div class="flex-1 ms-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted ps-3">closed</span></h6>
											<span class="text-muted">Is there any update plan for RTL version near future?</span>
										</div>
										<div class="float-end pt-1">
											<small class="text-muted">2 Days Ago</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
	</script>
</body>
</html>


<script>
    var appraovedPercentage = <?= $appraovedPercentage ?>;
    var rejectPercentage = <?= $rejectPercentage ?>;
    var pendingPercentage = <?= $pendingPercentage ?>;
    var base_url = "<?= base_url() ?>";
</script>


<script src="../../assets/assets_members/js/demo.js"></script>

