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
        <h3 class="fw-bold">Place Order</h3>
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
                <a href="#">Place Server Order</a>
            </li>
        </ul>
    </div>
</div>
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
</div>
<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
        <?= $this->session->flashdata('message') ?>
        <?= form_error('ServerServiceID', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('Email', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('Note', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('RequiredFields', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Place Server Order</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php echo form_open('member/serverrequest/insert', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal', 'onsubmit' => 'openLoading()')); ?>
                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('imei_fields_method') ?></label>
                        <div class="col-12">
                            <select name="ServerServiceID" id="ServerServiceID" class="form-control" required>
                                <option value=""><?php echo $this->lang->line('imei_fields_select') ?></option>
                                <?php foreach($serverorders as $box): ?>
                                <?php if(!empty($box['services'])): ?>
                                <optgroup label="<?php echo $box['Title'] ?>">
                                    <?php foreach($box['services'] as $service): ?>
                                    <option value="<?php echo $service['ID'] ?>"
                                        <?php echo set_select('ServerServiceID', $service['ID']); ?>>
                                        <?php echo $service['Title'].'- Only '.format_currency($service['Price']).' credit required'; ?>
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
                            <textarea name="Notes" placeholder="<?php echo $this->lang->line('imei_request_note') ?>"
                                class="form-control"><?php echo set_value('Notes'); ?></textarea>
                        </div>
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
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Description</div>
            </div>
            <div class="card-body pb-0">
                <div id="load-field-text"><i class="text-muted" id="desc_service">Description for service selected!</i>
                </div>
                <div class="separator-dashed"></div>
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

    $('#ServerServiceID').select2();
    $('#ServerServiceID').change(function(e) {
        var id = $(this).val();
        if (id != "") {
            $.ajax({
                type: "post",
                url: "<?php echo site_url('member/serverrequest/formfields'); ?>",
                data: {
                    "service_id": id
                },
                cache: false,
                success: function(data) {
                    $("#load-field").html('');
                    $("#load-field").html(data);
                }
            });

            $.ajax({
                type: "post",
                url: "<?php echo site_url('member/serverrequest/formfieldstext'); ?>",
                dataType: "json",
                data: {
                    "service_id": id
                },
                cache: false,
                success: function(data) {

                    $("#load-field-text").html('');
                    var html = '';
                    if (data.Price) {
                        // set html if data exist
                        html +=
                            '<div class="form-group">' +
                            '<label class="col-sm-3 control-label"><?php echo $this->lang->line('imei_fields_price') ?></label>' +
                            '<div class="col-sm-9 text">' + data.Price +
                            ' <?php echo $this->lang->line('header_credits') ?></div>' +
                            '</div>'
                    }

                    if (data.Delivery_time) {
                        // set html if data exist
                        html +=
                            '<div class="form-group">' +
                            '<label class="col-sm-3 control-label"><?php echo $this->lang->line('imei_fields_delivery_time') ?></label>' +
                            '<div class="col-sm-9 text">' + data.Delivery_time +
                            '</div>' +
                            '</div>'
                    }

                    if (data.Description) {
                        // set html if data exist
                        html +=
                            '<div class="form-group">' +
                            '<label class="col-sm-3 control-label"><?php echo $this->lang->line('imei_fields_description') ?></label>' +
                            '<div class="col-sm-9 text"><textarea id="autoExpandTextarea"></textarea>'
                            '</div>' +
                            '</div>'
                    }

                    $("#load-field-text").html(html);

                    if (data.Description) {
                        // Use setTimeout to ensure the DOM has been updated
                        setTimeout(() => {
                            const textarea = document.getElementById('autoExpandTextarea');
                            
                            if (textarea) {
                                function setTextAndResize(text) {
                                    textarea.value = text;
                                    textarea.style.height = 'auto';
                                    textarea.style.height = textarea.scrollHeight + 'px';
                                    textarea.style.overflow = 'hidden';
                                    textarea.style.resize = 'none';
                                    textarea.style.border = 'none';
                                }

                                const longText = data.Description;

                                setTextAndResize(longText);
                            } else {
                                console.error('Textarea not found');
                            }
                        }, 0);
                    }
                }
            });
        } else {
            $("#load-field").html('');
            $("#load-field-text").html('');
        }
    });
});
</script>