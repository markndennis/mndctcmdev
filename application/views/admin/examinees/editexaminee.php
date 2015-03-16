</div>

<div class="span6">
    <?php
    $attributes = $attributes = array('class' => 'form-horizontal', 'id' => 'editexaminee');
    echo form_open('admin/examinees/editexaminee/' . $result[0]['id'], $attributes);
    ?>
    <!--    <form method="post" class="form-horizontal">-->
    <div class="control-group">
        <label class="control-label" for="pin">Pin</label>
        <div class="controls">
            <input type="text" name="pin" id="pin" value="<?php echo $result[0]['pin']; ?>" disabled>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="fname">First Name</label>
        <div class="controls">
            <input type="text" name="fname" id="fname" value="<?php echo $result[0]['fname']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lname">Last Name</label>
        <div class="controls">
            <input type="text" name="lname" id="lname"  value="<?php echo $result[0]['lname']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lname">Date of Birth</label>
        <div class="controls">
            <input type="text" name="dob" id="dob"  value="<?php echo $result[0]['dob']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="regnum">Registration #</label>
        <div class="controls">
            <input type="text" name="regnum" id="regnum"  value="<?php echo $result[0]['regnum']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <input type="text" name="email" id="email" value="<?php echo $result[0]['email']; ?>"> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="exam">Exam</label>
        <div class="controls">
            <input type="text" name="examprofile" id="examprofile" value="<?php echo $result[0]['examprofile']; ?>" disabled> 
        </div> 
    </div>



    <div class="control-group">
        <label class="control-label" for="status">Approval Status</label>
        <div class="controls">
            <select name="astatus" id="astatus">
                <?php
                if ($result[0]['astatus'] === "Approved") {
                    echo "<option value='Approved' selected>Approved</option>";
                    echo "<option value='Not Approved'>Not Approved</option>";
                } else {
                    echo "<option value='Not Approved' selected>Not Approved</option>";
                    echo "<option value='Approved'>Approved</option>";
                }
                ?>

            </select>

        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="invigid">Invigilator</label>
        <div class="controls">
            <select name="invigid" id="invigid">
                <?php
                foreach ($invig as $row) {
                    if ($result[0]['invigilatorID'] === $row['id']) {
                        echo "<option value='" . $row['id'] . "' selected>" . $row['fname'] . " " . $row['lname'] . " - " . $row['city'] . "</option>";
                    } else {
                        echo "<option value='" . $row['id'] . "'>" . $row['fname'] . " " . $row['lname'] . " - " . $row['city'] . "</option>";
                    }
                }
                ?>

            </select>
             <!-- <input type="text" name="invigid" id="invigid" value="<?php echo $invigid; ?>"> -->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="created">Exam Date</label>
        <div class="controls">
            <input type="text" name="examdate" id="examdate" value="<?php echo $result[0]['examdate']; ?>" readonly> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="created">Created</label>
        <div class="controls">
            <input type="text" name="create" id="created" value="<?php echo $result[0]['created']; ?>" disabled> 
        </div> 
    </div>


    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="reset" class="btn btn-warning" onclick="window.location.href = '<?php echo site_url('admin/examinees/listexaminees'); ?>'">Cancel</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo site_url('admin/examinees/viewexaminee/'.$result[0]['id']); ?>'">Back</button>
            
        </div>
    </div>
</form>

</div>
<div class="span4">
    <?php echo "<span style='color:red'" . validation_errors() . "</span>"; ?>
<!--    <a href="<?php echo site_url('exam/myexam/getresults/' . $result[0]['id']); ?>">Results</a>-->

</div>

<script>
    $(document).ready(function() {
        $(function() {

            $("#dob").datepicker({
//                showOn: "button",
//                buttonImage: "./assets/images/calendar.gif",
//                buttonImageOnly: true,
                changeMonth: true,
                changeYear: true,
                yearRange: "1930:2020",
                dateFormat: "yy-mm-dd",
                defaultDate: new Date('1985, 01, 01')
            });
            
            $("#examdate").datepicker({
            showOn: "button",
            buttonImage: "./assets/images/calendar.gif",
            buttonImageOnly: true,
            changeMonth: false,
            changeYear: false,
            dateFormat: "yy-mm-dd",
            minDate: 1
            //defaultDate: new Date('1985, 01, 01')
        });
        });
    });

</script>