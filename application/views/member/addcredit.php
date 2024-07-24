<div class="page-header">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Add Fund</h3>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Add Fund</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
        <?= $this->session->flashdata('message') ?>
        <?= form_error('Credit', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <div class="card">
            <div class="card-header">
                <div class="card-title"><?php echo $this->lang->line('credit_fields_add_credit'); ?></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php echo form_open('member/checkout', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal', 'onsubmit' => 'openLoading()')); ?>
                    <div class="form-group">
                        <label
                            class="control-label"><?php echo $this->lang->line('credit_fields_no_of_credits'); ?></label>
                        <div class="col-8">
                            <input type="number" min="20" step="0.1" name="Credit"
                                placeholder="<?php echo $this->lang->line('credit_fields_no_of_credits'); ?>" required
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            class="control-label"><?php echo $this->lang->line('credit_fields_payment_type'); ?></label>
                        <div class="col-8">
                            <select name="payment_type" id="payment_type" class="form-control" required>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit"
                                class="btn btn-primary btn-sm"><?php echo $this->lang->line('credit_fields_add_credit'); ?></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <span style="color:red;"> Note:- <?php echo $paypal_settings[0]['percent'].'%' ?> will be
                                charged.br </span><br>
                            <span style="color:red;"> PAYPAL ACCEPT </span>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <div class="row mt-3">
                    <div class="column">
                        <p6 style="color:;">

                            <div id='gcw_mainFB0OlsZi4' class='gcw_mainFB0OlsZi4'></div>
                            <a id='gcw_siteFB0OlsZi4' href='https://freecurrencyrates.com/en/'>FreeCurrencyRates.com</a>
                            <script>
                            function reloadFB0OlsZi4() {
                                var sc = document.getElementById('scFB0OlsZi4');
                                if (sc) sc.parentNode.removeChild(sc);
                                sc = document.createElement('script');
                                sc.type = 'text/javascript';
                                sc.charset = 'UTF-8';
                                sc.async = true;
                                sc.id = 'scFB0OlsZi4';
                                sc.src =
                                    'https://freecurrencyrates.com/en/widget-vertical-editable?iso=USD-EUR-GBP-JPY-CNY-XUL-INR&df=1&p=FB0OlsZi4&v=fits&source=yahoo&width=245&width_title=0&firstrowvalue=1&thm=A6C9E2,FCFDFD,4297D7,5C9CCC,FFFFFF,C5DBEC,FCFDFD,2E6E9E,000000&title=Currency%20Converter&tzo=-330';
                                var div = document.getElementById('gcw_mainFB0OlsZi4');
                                div.parentNode.insertBefore(sc, div);
                            }
                            reloadFB0OlsZi4();
                            </script>
                            <!-- put custom styles here: .gcw_mainFB0OlsZi4{}, .gcw_headerFB0OlsZi4{}, .gcw_ratesFB0OlsZi4{}, .gcw_sourceFB0OlsZi4{} -->

                        </p6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Payment Details</div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div id="payee_account" class="form-bg1 recevier-det">
                        <p> We Accept More Payments </p>

                        <ul>
                            <li class="mt-2">Binance Payer ID : <b>171453088</b> </li>
                            <li class="mt-2">Payoneer ID : <b>15259876</b></li>
                            <li class="mt-2">Bitcoin Wallet Address : <b>1D8zbMuFWQTKN67itLR1ockph7oGQvRCT4</b> </li>
                            <li class="mt-2">USDT (TRC20) : <b>TPCShHKkNu3ApAAXcT6ER643TiKxYq4vYu</b> </li>
                            <li class="mt-2">VISA / MASTERCARD ACCEPT : <b>SEND YOUR FULL NAME , EMAIL , COUNTRY
                                    <a href="https://wa.me/message/LLSDOI7LDKZUC1"><br>
                                        <i class="fab fa-whatsapp"></i>WhatsApp</b>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#gcw_siteFB0OlsZi4 {
    font-size: x-small;
    text-align: center;
    width: 245px;
    display: block;
    margin: auto;
}
</style>
<script type="text/javascript">
var base_url = "<?= base_url() ?>";
$(document).ready(function() {

    loading_processing();
    openLoading = function() {
        loadingPannel.show();
    }

});
</script>