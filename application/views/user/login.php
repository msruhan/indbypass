<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= site_url() ?>img/indobypass_icon_new.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= site_url() ?>assets/assets_members/css/bootstrap.min.css" />

	<title><?php echo $this->settings['app_name']; ?>:: <?php echo $title; ?></title>
</head>

<body>

    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
        <style>
            .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(218, 41%, 35%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(218, 41%, 45%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%);
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }

            .divider:after,
            .divider:before {
                content: "";
                flex: 1;
                height: 1px;
                background: #eee;
            }
        </style>

        <div class="container px-4 py-5 px-md-5 text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        <img src="<?= site_url() ?>img/indobypass_logo_new.png" width="100%" alt="">
                    </h1>
                    <p class="opacity-70" style="color: hsl(218, 81%, 85%)">
                        <marquee behavior="scroll" direction="right">iCloud MEID / GSM BYPASS WITH SIGNAL SERVICE ON</marquee>
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <h3 style="margin-top: 13px; text-align: center">Sign in</h3>
                            <?= $this->session->flashdata('message') ?>

                            <?php echo form_open('login', array('role' => 'form', 'method' => 'post')); ?>
                            <div class="form-group mt-3">
                                <label for="" class="mb-1"><?php echo $this->lang->line('login_lb_email') ?></label>
                                <input type="email" name="Email" value="<?php echo set_value('Email'); ?>" class="form-control" placeholder="<?php echo $this->lang->line('login_lb_email') ?>" required="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="mb-1"><?php echo $this->lang->line('login_lb_password') ?></label>
                                <input type="password" name="Password" class="form-control" placeholder="<?php echo $this->lang->line('login_lb_password') ?>" required="">
                            </div>
                            <div class="form-group mt-3 d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('login_btn_login') ?></button>
                                <a href="<?php echo site_url('forgot_password'); ?>" class="text-body"><?php echo $this->lang->line('login_forgot_password') ?>?</a>
                            </div>
                            <?php echo form_close(); ?>

                            <!-- Register buttons -->
                            <div class="divider d-flex align-items-center my-2">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                            </div>

                            <a class="btn col-12 text-white" style="background-color: #3b5998" href="<?php echo site_url('services_list'); ?>"
                                role="button">
                                Services
                            </a>
                            <a class="btn col-12 text-white mt-2" style="background-color: #55acee" <a href="https://t.me/unlockqueen"
                                role="button">
                                <i class="fab fa-twitter me-2"></i>Telegram</a>
                            <div class="text-center mt-5">
                                <p class="mb-0">Don't have an account? <a <a href="<?php echo site_url('register'); ?>" class="text-secondary fw-bold"><?php echo $this->lang->line('login_register_now') ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= site_url() ?>assets/assets_members/js/core/bootstrap.min.js"></script>

</body>

</html>