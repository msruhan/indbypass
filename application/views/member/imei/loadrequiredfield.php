<input type="hidden" name="field_type" value="<?php echo $field_type ?>">

<?php if($extra_information ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_request_extra_Info') ?></label>
    <div class="col-12">
        <textarea name="ExtraInformation" placeholder="<?php echo $this->lang->line('imei_request_extra_Info') ?>"
            class="form-control" style="height:200px;" required><?php echo set_value('ExtraInformation'); ?></textarea>
    </div>
</div>
<?php endif; ?>

<?php if($iCloudCarrierInfo ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_carrier_info') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudCarrierInfo'); ?>" name="iCloudCarrierInfo"
            placeholder="<?php echo $this->lang->line('imei_fields_carrier_info_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudAppleIDHint ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_apple_id_hint') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudAppleIDHint'); ?>" name="iCloudAppleIDHint"
            placeholder="<?php echo $this->lang->line('imei_fields_apple_id_hint_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudActivationLockScreenshot ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_lock_screenshot') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudActivationLockScreenshot'); ?>"
            name="iCloudActivationLockScreenshot"
            placeholder="<?php echo $this->lang->line('imei_fields_lock_screenshot_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudIMEINumberScreenshot ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_imei_screenshot') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudIMEINumberScreenshot'); ?>"
            name="iCloudIMEINumberScreenshot"
            placeholder="<?php echo $this->lang->line('imei_fields_imei_screenshot_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudAppleIdEmail ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_apple_id_email') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudAppleIdEmail'); ?>" name="iCloudAppleIdEmail"
            placeholder="<?php echo $this->lang->line('imei_fields_apple_id_email_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudAppleIdScreenshot ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_apple_id_screenshot') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudAppleIdScreenshot'); ?>" name="iCloudAppleIdScreenshot"
            placeholder="<?php echo $this->lang->line('imei_fields_apple_id_screenshot_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudAppleIdInfo ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_apple_id_info') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudAppleIdInfo'); ?>" name="iCloudAppleIdInfo"
            placeholder="<?php echo $this->lang->line('imei_fields_apple_id_info_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudPhoneNumber ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_phone_number') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudPhoneNumber'); ?>" name="iCloudPhoneNumber"
            placeholder="<?php echo $this->lang->line('imei_fields_phone_number_hint') ?>" class="form-control"
            required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudID ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_icloud_id') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudID'); ?>" name="iCloudID"
            placeholder="<?php echo $this->lang->line('imei_fields_icloud_id_hint') ?>" class="form-control" required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudPassword ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_password') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudPassword'); ?>" name="iCloudPassword"
            placeholder="<?php echo $this->lang->line('imei_fields_password_hint') ?>" class="form-control" required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudUDID ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_udid') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudUDID'); ?>" name="iCloudUDID"
            placeholder="<?php echo $this->lang->line('imei_fields_udid_hint') ?>" class="form-control" required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudICCID ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_iccid') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('iCloudICCID'); ?>" name="iCloudICCID"
            placeholder="<?php echo $this->lang->line('imei_fields_iccid_hint') ?>" class="form-control" required>
    </div>
</div>
<?php endif; ?>
<?php if($iCloudVideo ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_video') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('text'); ?>" name="iCloudVideo"
            placeholder="<?php echo $this->lang->line('imei_fields_video_hint') ?>" class="form-control" required>
    </div>
</div>
<?php endif; ?>

<?php if($providers !== NULL): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_netwok_provider') ?></label>
    <div class="col-12">
        <select name="ProviderID" id="ProviderID" class="form-control" required>
            <option value=""><?php echo $this->lang->line('') ?>
                <?php echo $this->lang->line('imei_fields_netwok_provider') ?></option>
            <?php foreach($providers as $val): ?>
            <option value="<?php echo $val['ApiProviderID'] ?>"><?php echo $val['Title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<?php endif; ?>

<?php if($models !== NULL): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_model') ?></label>
    <div class="col-12">
        <select name="ModelID" id="ModelID" class="form-control" required>
            <option value=""><?php echo $this->lang->line('imei_fields_select') ?>
                <?php echo $this->lang->line('imei_fields_model') ?></option>
            <?php foreach($models as $val): ?>
            <option value="<?php echo $val['ApiModelID'] ?>"><?php echo $val['ModelTitle'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<?php endif; ?>

<?php if($meps !== NULL): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_mep') ?></label>
    <div class="col-12">
        <select name="MEPID" id="MEPID" class="form-control" required>
            <option value=""><?php echo $this->lang->line('imei_fields_select') ?>
                <?php echo $this->lang->line('imei_fields_mep') ?></option>
            <?php foreach($meps as $v): ?>
            <option value="<?php echo $val['ApiMepID'] ?>"><?php echo $val['Title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<?php endif; ?>

<?php if($pin ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_pin') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('PIN'); ?>" name="PIN"
            placeholder="<?php echo $this->lang->line('imei_fields_pin') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>

<?php if($kbh ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_kbh') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('KBH'); ?>" name="KBH"
            placeholder="<?php echo $this->lang->line('imei_fields_kbh') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>

<?php if($prd ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_prd') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('PRD'); ?>" name="PRD"
            placeholder="<?php echo $this->lang->line('imei_fields_prd') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>
<?php if($type ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_type') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('Type'); ?>" name="Type"
            placeholder="<?php echo $this->lang->line('imei_fields_type') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>
<?php if($locks ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_locks') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('Locks'); ?>" name="Locks"
            placeholder="<?php echo $this->lang->line('imei_fields_locks') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>
<?php if($serial_number ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_srno') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('SerialNumber'); ?>" name="SerialNumber"
            placeholder="<?php echo $this->lang->line('imei_fields_srno') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>
<?php if($reference ): ?>
<div class="form-group">
    <label class="control-label"><?php echo $this->lang->line('imei_fields_reference') ?></label>
    <div class="col-12">
        <input type="text" value="<?php echo set_value('Reference'); ?>" name="Reference"
            placeholder="<?php echo $this->lang->line('imei_fields_reference') ?>" required class="form-control">
    </div>
</div>
<?php endif; ?>