</div>
<div class="span3"></div>
<div class="span9">
    <div class="well">To change your password please provide the information requested below:</div>

    <?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'changepassword');
    echo form_open('passwords/changepassword', $attributes);
    ?>

    <div class="control-group">
        <label class="control-label" for="username">User Name</label>
        <div class="controls">
            <input type="text" name="username" id="username" placeholder="User Name" value="<?php echo set_value('username'); ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="password" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
        </div>
    </div>

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
            <button type="submit" class="btn">Change Password</button>
        </div>
    </div>
</form>

<div class="span3">
<?php echo "<span style='color:red'" . validation_errors() . "</span>"; ?>
</div>
</div>