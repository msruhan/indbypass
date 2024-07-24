<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Group Update</h3>
        </div>
       <?php echo form_open_multipart("admin/group/update",array('id'=>"menu-validate")); ?> 
       <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                       <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', $data[0]['Title']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Discount (%):</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-minus"></i>
                        </span>
                       <?php echo form_input(array('name'=>"Discount",'id'=>"Discount", 'class'=>"form-control", 'value'=>set_value('Discount', $data[0]['Discount']))); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
