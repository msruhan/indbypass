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

        <div class="container px-4 py-5 px-md-5 text-lg-start my-5" style="height: 88vh">
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
                            <h3 style="margin-top: 13px; text-align: center">Forget Password</h3>
                            <?= $this->session->flashdata('message') ?>
                            <?= form_error('Email', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
                            <?php echo form_open('forgot_password', array('role' =>'form','method' =>'post' )); ?>
                                <div class="form-group mb-2">
                                    <label for=""><?php echo $this->lang->line('forgot_password_lb_email') ?></label>
                                    <input type="email" name="Email" class="form-control" value="" placeholder="<?php echo $this->lang->line('forgot_password_lb_email') ?>">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm"><?php echo $this->lang->line('forgot_password_btn_submit') ?></button>
                                </div>
                            <?php echo form_close(); ?>

                            <div class="text-center mt-5">
                                <p class="mb-0">Already have an account? <a <a href="<?php echo site_url('login'); ?>" class="text-secondary fw-bold">Login</a></p>
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