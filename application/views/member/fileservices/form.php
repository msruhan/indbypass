<?php if(!empty($price)): ?>
	<div class="form-group">
    <label class="col-sm-3 control-label">Price</label>
    <div class="col-sm-9 text"><?php echo $price; ?> <?php echo $this->lang->line('header_credits') ?></div>
  </div>
<?php endif; ?>

<?php if(!empty($delivery_time)) : ?>
	<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo $this->lang->line('file_fields_delivery_time') ?></label>
    <div class="col-sm-9 text"><?php echo $delivery_time; ?></div>
  </div>
<?php endif; ?>

<?php if(!empty($description) ): ?>
	<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo $this->lang->line('file_fields_description') ?></label>
    <div class="col-sm-9 text"><?php echo $description; ?>
    </div>
  </div>
<?php endif; ?>
<?php if(!empty($allowed_extension) ): ?>
	<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo $this->lang->line('file_fields_allowed_entensions') ?></label>
    <div class="col-sm-9 text"><?php echo $allowed_extension; ?>
    </div>
  </div>
<?php endif; ?>