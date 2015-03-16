</div>
<div class="span9">
    <div class="well">Welcome <?php echo $invigilator[0]['fname']; ?>, please create your password for this application:</div>

    <?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'createpassword');
    echo form_open('passwords/createpassword/'.$invigilator[0]['id'], $attributes);
    ?>

    <div class="control-group">
        <label class="control-label" for="password1">New Password</label>
        <div class="controls">
            <input type="password" name="password1" id="password1" placeholder="New Password" value="<?php echo set_value('password1'); ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="password2">Please Type Again</label>
        <div class="controls">
            <input type="password" name="password2" id="password2" placeholder="Please Type Again" value="<?php echo set_value('password2'); ?>">
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-success">Create Password</button>
        </div>
    </div>
</form>

<div class="span3">
    <?php echo "<span style='color:red'" . validation_errors() . "</span>"; ?>
</div>
</div>