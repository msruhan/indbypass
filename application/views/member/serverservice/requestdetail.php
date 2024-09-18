<style>
    @media screen and (max-width: 767px) {
        .main-panel .page-header .breadcrumbs {
            margin-left: 0;
            padding-top: 5px;
            padding-left: 5px;
            padding-bottom: 0;
            border-left: 0;
        }

        #autoExpandTextarea {
            border: none;
            resize: none;
        }
    }
</style>
<div class="page-header">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Server Service Detail</h3>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="<?= site_url() ?>member/dashboard">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Server Services</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Detail</a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Description
                    <h6><b><?= $data[0]['Title'] ?></b></h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <textarea id="autoExpandTextarea"></textarea>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Price</div>
            </div>
            <div class="card-body pb-0">
                <p><?= format_currency($data[0]['Price']) ?></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Information</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div id="payee_account" class="form-bg1 recevier-det">
                        <ul>
                            <li class="mt-2">Delivery Time : <b><?= $data[0]['DeliveryTime'] ?></b> </li>
                        </ul>
                        <ul>
                            <li class="mt-2">Required Fields : <b><?= $data[0]['RequiredFields'] ?></b> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Select2 -->
<script type="text/javascript">
    var base_url = "<?= base_url() ?>";

    function setTextAndResize(text) {
        const textarea = document.getElementById('autoExpandTextarea');
        textarea.value = text;
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
        textarea.style.overflow = 'hidden';
        textarea.style.resize = 'none';
        textarea.style.border = 'none';
    }

    const longText = `<?php echo $data[0]['Description'] ?>`;

    window.addEventListener('load', () => setTextAndResize(longText));
</script>