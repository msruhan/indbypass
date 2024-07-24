<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 me-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Balance</p>
                            <h4 class="card-title"><?= number_format($credit, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 me-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Credit</p>
                            <h4 class="card-title"><?= number_format($total_credit, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 me-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Order</p>
                            <h4 class="card-title"><?= $total_order ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ms-md-auto">
        <a href="<?= site_url('member/dashboard/addfund') ?>" class="btn btn-primary btn-round"> + Add Fund</a>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Available</div>
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
                <div class="card-title">Rejected</div>
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
                <div class="card-title">Pending</div>
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

<script>
    var appraovedPercentage = <?= $appraovedPercentage ?>;
    var rejectPercentage = <?= $rejectPercentage ?>;
    var pendingPercentage = <?= $pendingPercentage ?>;
    var base_url = "<?= base_url() ?>";
</script>