<div aria-hidden="false" aria-labelledby="myLargeModalLabel" role="dialog" tabindex="-1" id="method<?php echo $ID; ?>" class="modal fade bs-contact-modal-lg in" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 id="myLargeModalLabel" class="modal-title"><?php echo $this->lang->line('services_description') ?></h4>
        </div>
        <div class="modal-body">
            <?php echo nl2br($Description) ?>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>