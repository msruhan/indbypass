<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong><?php echo $this->lang->line('error_success'); ?> </strong> <?php echo $this->session->flashdata("success"); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata("fail")): ?>
    <div class="alert alert-danger fade in">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <strong><?php echo $this->lang->line('error_failed'); ?> </strong> <?php echo $this->session->flashdata("fail"); ?>
     </div>
<?php endif; ?>
<?php echo validation_errors('<div class="alert alert-danger fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>FAILED! </strong>','</div>'); ?>