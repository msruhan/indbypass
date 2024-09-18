<div id="modal<?php echo $ID; ?>" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Extra Information</h4>
            </div>
            <div class="modal-body">
                <p><?php echo nl2br($ExtraInformation) ?></p>
                <p>Country and Carrier info: <?php echo $iCloudCarrierInfo ?></p>
                <p>Apple ID Hint : <?php echo $iCloudAppleIDHint ?></p>
                <p>Photo of Activation Lock Screenshot: <?php echo $iCloudActivationLockScreenshot ?></p>
                <p>Photo of IMEI Number Screenshot: <?php echo $iCloudIMEINumberScreenshot ?></p>
                <p>Apple ID (Email): <?php echo $iCloudAppleIdEmail ?></p>
                <p>Photo of Apple ID Screenshot: <?php echo $iCloudAppleIdScreenshot ?></p>
                <p>Apple ID Info: <?php echo $iCloudAppleIdInfo ?></p>
                <p>Phone Number: <?php echo $iCloudPhoneNumber ?></p>
                <p>iCloud ID: <?php echo $iCloudID ?></p>
                <p>Password: <?php echo $iCloudPassword ?></p>
                <p>UDID: <?php echo $iCloudUDID ?></p>
                <p>ICCID: <?php echo $iCloudICCID ?></p>
                <p>Clear Video - Activation Process, Must Show: <?php echo $iCloudVideo ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
        </div>
    </div>
</div>