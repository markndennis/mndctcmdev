</div>

<div class="span5">

    <form method="post" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="id">Id</label>
            <div class="controls">
                <input type="text" name="id" id="id" placeholder="id" value="<?php echo set_value('id', $result[0]['id']); ?>" disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fname">First Name</label>
            <div class="controls">
                <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo set_value('fname', $result[0]['fname']); ?>" disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="lname">Last Name</label>
            <div class="controls">
                <input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo set_value('lname', $result[0]['lname']); ?>"disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email', $result[0]['email']); ?>"disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="city">City</label>
            <div class="controls">
                <input type="text" name="city" id="city" placeholder="city" value="<?php echo set_value('city', $result[0]['city']); ?>"disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="province">Province</label>
            <div class="controls">
                <input type="text" name="province" id="province" placeholder="Province" value="<?php echo set_value('province', $result[0]['province']); ?>"disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="country">Country</label>
            <div class="controls">
                <input type="text" name="city" id="country" placeholder="Country" value="<?php echo set_value('country', $result[0]['country']); ?>"disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="institution">Institution</label>
            <div class="controls">
                <input type="text" name="institution" id="institution" placeholder="Institution" value="<?php echo set_value('institution', $result[0]['institution']); ?>"disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="username">Username</label>
            <div class="controls">
                <input type="text" name="username" id="username" placeholder="username" value="<?php echo set_value('username', $result[0]['username']); ?>" disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="username">Password</label>
            <div class="controls">
                <input type="text" name="password" id="password" placeholder="Password" value="<?php echo set_value('password', $result[0]['password']); ?>" disabled>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="contact">Published Contact Info</label>
            <div class="controls">
                <textarea  name="contact" id="contact" placeholder="Published Contact Info" disabled><?php echo set_value('contact', $result[0]['contactinfo']); ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="active">Active</label>
            <div class="controls">
                <input type="text" name="active" id="active" placeholder="Password" value="<?php echo set_value('active', $result[0]['active']); ?>" disabled>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo site_url('/admin/invigilators/listinvigilators'); ?>';" id="delete" style="width: 225px;">Back</button>
            </div>


        </div>
    </form>
    
</div>
<div class="span4">
    <a href='<?php echo site_url("/admin/invigilators/editinvigilator/" . $result[0]['id']); ?>'>Edit Invigilator</a><br>
    <a href='<?php echo site_url("/admin/invigilators/sendinvigwelcomeemail/" . $result[0]['id']); ?>'>Send Welcome Email</a><br>
    
    <a href='<?php echo site_url("/admin/invigilators/sendinvigpasswordemail/" . $result[0]['id']); ?>'>Send Password Email</a><br>

<!--    <a onclick="passwordemail()">Send Password Change Email</a>-->

</div>

<script>

                    $("#dialog").hide();
                    $("#change").hide();
                    $isactive = "<?php echo $result[0]['active']; ?>";
                    if ($isactive === "Y") {
                        $('#active').val("Y").prop("selected", true);
                    } else {
                        $('#active').val("N").prop("selected", true);
                    }


                    function modal() {
                        $("#dialog").dialog({
                            modal: true,
                            buttons: {
                                Ok: function() {
                                    $(this).dialog("close");
                                }
                            }
                        });
                    }
                    ;
                    $("#delete").on("click", function() {
                        modal();
                    });
//                    function passwordemail() {
//                        $("#change").dialog({
//                            modal: true,
//                            width: 400,
//                            buttons: {
//                                "Close": function() {
//                                    $(this).dialog("close");
//                                },
//                                "They are Saved": function() {
//                                    $(this).dialog("close");
//                                    window.location.href = "<?php echo site_url("/admin/invigilators/sendinvigpasswordemail/" . $result[0]['id']); ?>";
//                                }
//                            }
//                        })
//                    }
                    ;

</script>
