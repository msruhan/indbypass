<style>
    @media screen and (max-width: 767px) {
    .main-panel .page-header .breadcrumbs {
        margin-left: 0;
        padding-top: 5px;
        padding-left: 5px;
        padding-bottom: 0;
        border-left: 0;
    }
}
</style>
<div class="page-header">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">IMEI Request</h3>
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
                <a href="#">IMEI Request</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
        <?= $this->session->flashdata('message') ?>
        <?= form_error('IMEI', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('MethodID', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('Email', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('Note', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <div class="card">
            <div class="card-header">
                <div class="card-title">IMEI Code Request</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php echo form_open('member/imeirequest/insert', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal', 'onsubmit' => 'openLoading()')); ?>
                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('imei_fields_method') ?></label>
                        <div class="col-12">
                            <select name="MethodID" id="MethodID" class="form-control" width="100%" required>
                                <option value=""><?php echo $this->lang->line('imei_fields_select') ?></option>
                                <?php foreach($imeimethods as $network): ?>
                                <?php if(!empty($network['methods'])): ?>
                                <optgroup label="<?php echo $network['Title'] ?>">
                                    <?php foreach($network['methods'] as $method): ?>
                                    <option value="<?php echo $method['ID'] ?>"
                                        <?php echo set_select('MethodID', $method['ID']); ?>>
                                        <?php echo $method['Title'].'- Only '.$method['Price'].' credit required'; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div id="load-field"></div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('imei_fields_imei_sr') ?></label>
                        <div class="col-12">
                            <textarea name="IMEI" id="IMEI"
                                placeholder="<?php echo $this->lang->line('imei_fields_imei_sr') ?>"
                                class="form-control" minlength="12" required><?php echo set_value('IMEI'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('imei_fields_email') ?></label>
                        <div class="col-12">
                            <input type="email" name="Email"
                                placeholder="<?php echo $this->lang->line('imei_fields_email') ?>" class="form-control"
                                value="<?php echo set_value('Email'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('imei_request_note') ?></label>
                        <div class="col-12">
                            <textarea name="Note" placeholder="<?php echo $this->lang->line('imei_request_note') ?>"
                                class="form-control"><?php echo set_value('Note'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12 text-center">
                            <button type="submit"
                                class="btn btn-primary btn-sm"><?php echo $this->lang->line('imei_fields_submit') ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Description</div>
            </div>
            <div class="card-body pb-0">
                <div id="load-field-text"><i class="text-muted" id="desc_service">Description for service selected!</i>
                </div>
                <div class="separator-dashed"></div>
                <div class="mb-5">
                    <p class="card-title mb-2">IMEI History</p>
                    <div class="d-flex">
                        <button class="btn btn-label-success btn-round active w-100"
                            onclick="historyOrderTable('Issued')">
                            Available <i class="fas fa-check-circle"></i> </button>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <button class="btn btn-label-warning btn-round active w-100"
                            onclick="historyOrderTable('Pending')">
                            Pending <i class="fas fas fa-clock"></i> </button>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <button class="btn btn-label-danger btn-round active w-100"
                            onclick="historyOrderTable('Canceled')">
                            Canceled <i class="fas fa-times-circle"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal for datatable imei history -->
<!-- Modal -->
<div class="modal fade" id="historyOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">IMEI History Available</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive p-3">
                    <!-- Projects table -->
                    <table id="table_data_imei" class="table table-sm table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>IMEI</th>
                                <th>Service</th>
                                <th>Code</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.select2-container .select2-selection--single .select2-selection__rendered {
    /* line-height: 60px !important; */
    /* /* padding-left: 20px !important; */
    padding-top: 5px !important;
    */
}

.select2-container .select2-selection--single {
    height: 40px !important;
}
</style>
<!-- Select2 -->
<script type="text/javascript">
var base_url = "<?= base_url() ?>";
$(document).ready(function() {

    loading_processing();
    openLoading = function() {
        loadingPannel.show();
    }

    var id = $("#MethodID").val();
    if (id != "") {
        var data = $("#imeireq").serialize();
        $.ajax({
            type: "post",
            url: "<?php echo site_url('member/imeirequest/formfields'); ?>",
            data: data,
            cache: false,
            success: function(data) {
                $("#load-field").html('');
                $("#load-field").html(data);
            }
        });
    }
    $("#MethodID").change(function() {
        var id = $("#MethodID").val();
        if (id != "") {
            var data = $("#imeireq").serialize();
            $.ajax({
                type: "post",
                url: "<?php echo site_url('member/imeirequest/formfields'); ?>",
                data: data,
                cache: false,
                success: function(data) {
                    $("#desc_service").html('');
                    $("#load-field").html('');
                    $("#load-field").html(data);
                }
            });

            $.ajax({
                type: "post",
                url: "<?php echo site_url('member/imeirequest/formfieldstext'); ?>",
                dataType: "json",
                data: data,
                cache: false,
                success: function(data) {
                    $("#load-field-text").html('');
                    var html = '';
                    if (data.price) {
                        // set html if data exist
                        html +=
                            '<div class="form-group">' +
                            '<label class="col-sm-3 control-label"><?php echo $this->lang->line('imei_fields_price') ?></label>' +
                            '<div class="col-sm-9 text">' + data.price +
                            ' <?php echo $this->lang->line('header_credits') ?></div>' +
                            '</div>'
                    }

                    if (data.delivery_time) {
                        // set html if data exist
                        html +=
                            '<div class="form-group">' +
                            '<label class="col-sm-3 control-label"><?php echo $this->lang->line('imei_fields_delivery_time') ?></label>' +
                            '<div class="col-sm-9 text">' + data.delivery_time +
                            '</div>' +
                            '</div>'
                    }

                    if (data.description) {
                        // set html if data exist
                        html +=
                            '<div class="form-group">' +
                            '<label class="col-sm-3 control-label"><?php echo $this->lang->line('imei_fields_description') ?></label>' +
                            '<div class="col-sm-9 text">' + data.description +
                            '</div>' +
                            '</div>'
                    }

                    $("#load-field-text").html(html);

                }
            });
        } else {
            $("#load-field").html('');
        }
    });
    $('#MethodID').select2();

});
</script>