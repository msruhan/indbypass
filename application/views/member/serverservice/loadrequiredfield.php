<?php 
if( !empty($services) ):
?>
<div class="form-group">
    <label class="control-label">Service Type</label>
    <div class="col-12">
        <select name="RequiredFields[service_type_id]" class="form-control" required>
            <?php foreach ($services as $s): ?>
            <option value="<?php echo $s['id']; ?>"><?php echo $s['name']; ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<?php
endif; 
?>

<?php 
if($RequiredFields): 
  $fields = explode('|', $RequiredFields);
  foreach($fields as $field):
?>
<div class="form-group">
    <label class="control-label"><?php echo ucwords(strtolower($field)); ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value($field); ?>" name="RequiredFields[<?php echo $field ?>]"
            placeholder="<?php echo ucwords(strtolower($field)) ?>" class="form-control">
    </div>
</div>
<?php 
  endforeach;
endif; 
?>