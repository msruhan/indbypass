<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin | <?= $Title ?></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="shortcut icon" href="<?= base_url() ?>img/indobypass_icon_new.png">

    <!-- Fonts and icons -->
    <script src="<?= site_url() ?>assets/assets_members/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["<?= site_url() ?>assets/assets_members/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= site_url() ?>assets/assets_members/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= site_url() ?>assets/assets_members/css/plugins.min.css" />
    <link rel="stylesheet" href="<?= site_url() ?>assets/assets_members/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/assets_members/libs/dataTables/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/assets_members/libs/dataTables/custom.jquery.dataTables.css" />
</head>

<body>
    <div class="wrapper sidebar_minimize sidebar_minimize_hover">
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="#" class="logo">
                        <img src="<?= site_url() ?>img/indobypass_logo_new.png" alt="navbar brand" class="navbar-brand"
                            height="80" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Menus</h4>
                        </li>
                        <li
                            <?= $this->uri->uri_string(2)=='member/dashboard'?'class="nav-item active"':'class="nav-item"'; ?>>
                            <a href="<?= site_url() ?>member/dashboard">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li
                            <?= $this->uri->uri_string(2)=='member/imeirequest'?'class="nav-item active"':'class="nav-item"'; ?>>
                            <a href="<?= site_url() ?>member/imeirequest">
                                <i class="fas fa-pen-square"></i>
                                <p>IMEI Request</p>
                            </a>
                        </li>
                        <li
                            <?= $this->uri->uri_string(2)=='member/serverrequest'?'class="nav-item active"':'class="nav-item"'; ?>>
                            <a href="<?= site_url() ?>member/serverrequest">
                                <i class="fas fa-server"></i>
                                <p>Server Request</p>
                            </a>
                        </li>
                        <li
                            <?= $this->uri->uri_string(2)=='member/imeirequest/history'?'class="nav-item active"':'class="nav-item"'; ?>>
                            <a href="<?= site_url() ?>member/imeirequest/history">
                                <i class="fas fas fa-tablet-alt"></i>
                                <p>IMEI Order History</p>
                            </a>
                        </li>
                        <li
                            <?= $this->uri->uri_string(2)=='member/serverrequest/history'?'class="nav-item active"':'class="nav-item"'; ?>>
                            <a href="<?= site_url() ?>member/serverrequest/history">
                                <i class="fas fa-laptop-code"></i>
                                <p>Server Order History</p>
                            </a>
                        </li>
                        <!-- <li
                            <?= $this->uri->uri_string(2)=='member/dashboard/credits'?'class="nav-item active"':'class="nav-item"'; ?>>
                            <a href="<?= site_url() ?>member/dashboard/credits">
                                <i class="fas fa-credit-card"></i>
                                <p>Credits</p>
                            </a>
                        </li> -->
                        <li
                            <?= $this->uri->uri_string(2)=='member/imeirequest/listservices' || $this->uri->uri_string(2)=='member/serverrequest/listservices'?'class="nav-item active submenu"':'class="nav-item submenu"'; ?>>
                            <a data-bs-toggle="collapse" href="#base" <?= $this->uri->uri_string(2)=='member/imeirequest/listservices' || $this->uri->uri_string(2)=='member/serverrequest/listservices'?'aria-expanded="true"':'aria-expanded="false" class="collapsed"'; ?>>
                                <i class="fas fa-layer-group"></i>
                                <p>All Services</p>
                                <span class="caret"></span>
                            </a>
                            <div id="base" <?= $this->uri->uri_string(2)=='member/imeirequest/listservices' || $this->uri->uri_string(2)=='member/serverrequest/listservices'?'class="collapse show"':'class="collapse"'; ?>>
                                <ul class="nav nav-collapse">
                                    <li
                                        <?= $this->uri->uri_string(2)=='member/imeirequest/listservices'?'class="active"':''; ?>>
                                        <a href="<?= site_url() ?>member/imeirequest/listservices">
                                            <span class="sub-item">IMEI Services</span>
                                        </a>
                                    </li>
                                    <li
                                        <?= $this->uri->uri_string(2)=='member/serverrequest/listservices'?'class="active"':''; ?>>
                                        <a href="<?= site_url() ?>member/serverrequest/listservices">
                                            <span class="sub-item">Server Services</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="<?= site_url() ?>assets/assets_members/img/kaiadmin/logo_light.svg"
                                alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <img src="<?= base_url() ?>img/indobypass_icon_new.png" alt="" height="40">
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">1</span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have a new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="<?= site_url() ?>assets/assets_members/img/profile2.jpg"
                                                            alt="Img Profile" style="width:50px" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block text-muted">
                                                            Admin send messages to you
                                                        </span>
                                                        <h6 class="p-3"><?= $notif['push_notification'] ?></h6>
                                                        <span class="time"><?= $notif_updated['push_notification'] ?></span>
                                                    </div>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= site_url() ?>assets/assets_members/img/profile.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span
                                            class="fw-bold"><?= $this->session->userdata('MemberFirstName') . " " . $this->session->userdata("MemberLastName");?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= site_url() ?>assets/assets_members/img/profile.jpg"
                                                        alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?= $this->session->userdata('MemberFirstName') . " " . $this->session->userdata("MemberLastName");?>
                                                    </h4>
                                                    <p class="text-muted">
                                                        <?php echo $this->session->userdata("MemberEmail"); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"
                                                href="<?= site_url('member/dashboard/profile') ?>">My Profile</a>
                                            <a class="dropdown-item" href="<?= site_url('member/dashboard/credits') ?>">Payment History</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?= site_url('logout') ?>">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- content -->
            <div class="container">
                <div class="page-inner">
                    <script src="<?= site_url() ?>assets/assets_members/js/core/jquery-3.7.1.min.js"></script>

                    <?php $this->load->view($content); ?>
                </div>
            </div>
            <!-- content -->

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <div class="nav-link">
                                    <i class="fab fa-whatsapp"></i> +94-0787289764
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        © 2024 Copyright reserved worldwideunlockstore.com
                    </div>
                    <div>
                        <i class="fab fa-telegram-plane"></i> <a
                            href="https://t.me/joinchat/TXMvEoIyndr9lB-T">https://t.me/joinchat/TXMvEoIyndr9lB-T</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= site_url() ?>assets/assets_members/js/core/popper.min.js"></script>
    <script src="<?= site_url() ?>assets/assets_members/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= site_url() ?>assets/assets_members/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?= site_url() ?>assets/assets_members/js/plugin/chart.js/chart.min.js"></script>

    <!-- Datatables -->
    <script src="<?= site_url() ?>assets/assets_members/libs/dataTables/jquery.dataTables.min.js"></script>
    <script src="<?= site_url() ?>assets/assets_members/libs/dataTables/dataTables-input.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?= site_url() ?>assets/assets_members/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Sweet Alert -->
    <script src="<?= site_url() ?>assets/assets_members/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?= site_url() ?>assets/assets_members/js/kaiadmin.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

    <script type="text/javascript">
    function loading_processing() {
        loadingPannel = (function() {
            var lpDialog = $("" +
                "<div class='modal fade' id='lpDialog' data-backdrop='static' data-keyboard='false' style='width: 150px;height: 150px;margin:0 auto;display:table;left: 0;right:0;top: 50%;-webkit-transform:translateY(-50%);-moz-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);'>" +
                "<div class='modal-dialog' >" +
                "<div class='modal-content'>" +
                // "<div class='modal-header'><b>Loading...</b></div>" + //Processing
                "<div class='modal-body'>" +
                "<div style='text-align:center'>" +
                "<div class='spinner-border' role='status'>" +
                "<span class='visually-hidden'></span>" +
                "</div>" +
                "<br> Processing ..." +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>");
            return {
                show: function() {
                    lpDialog.modal('show');
                },
                hide: function() {
                    lpDialog.modal('hide');
                }
            };
        })();
    }
    </script>

    <script src="<?= site_url() ?>assets/assets_members/modules/<?= $content_js ?>"></script>

</body>

</html>