<?php if(isset($alert_message) && strlen(trim($alert_message)) > 0): ?>
    <?php
    $type = array(
        'Error' => 'danger',
        'Warning' => 'warning',
        'Success' => 'success'
    );
    ?>
    <div class="alert alert-<?php echo $type[$alert_type]?>" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span><br />
        <?php echo $alert_message?>
    </div>
<?php endif;?>