</div>
<div class="span9">
    <?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'addexaminee');
    echo form_open('main/application', $attributes);
    ?>
    Please carefully read the following before you apply for the exam:
    <ul>
        <li>Carefully read the Safety Program Examination Guide and familiarize
            yourself with the exam request and procedures.</li>
        <li>You must contact the Invigilation Centre to make an appointment, confirm
            the time required, and discuss applicable fees.</li>
        <li>If you do not live within 200 km of an Approved Invigilator, you may
            propose a new invigilator; however, your request must be submitted a
            minimum of 60 days prior to your intended exam write date.</li>
        <li>CTCMA Safety Program Examinations are only available to applicants
            who are CTCMA registrants (including student registrants) and exam
            candidates.</li>
        <li>Only money order or certified cheque made payable to CTCMA is
            accepted. No refund or exchange.</li>
        <li>Duplication or sharing content of assessments to others in any manner is
            strictly prohibited.</li>
    </ul><br>
    <table class="table table-bordered">
        <tr>
            <td> <label for="invigid"><b>Invigilator:</b></label></td>
            <td> <label for="exam"><b>Exam:</b></label></td>
        </tr>
        <tr><td><select name="invigid" id="invigid" style="width:300px">

                    <?php
                    foreach ($invigs as $row) {
                        echo "<option value='" . $row['id'] . "'>" .$row['id'] . " " .$row['fname'] . " " . $row['lname'] . " - " . $row['institution'] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select name="exam" id="exam">
                    <option value="Acupuncturist" selected>Acupuncturist</option>
                    <option value="Herbalist">Herbalist</option>
                    <option value="Reciprocity">Reciprocity</option>
                    <option value="Doctor of TCM">Doctor of TCM</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> <label for="fname"><b>First Name:</b></label></td>
            <td> <label for="lname"><b>Last Name:</b></label></td>
        </tr>
        <tr>
            <td><input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>"></td>
            <td><input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>"></td>
        </tr>
        <tr>
            <td><label for="regnum"><b>Registration # if applicable (ie.FA01234):</b></label></td>
            <td><label for="email"><b>Email:</b></label></td>
        </tr>
        <tr>
            <td><input type="text" name="regnum" id="regnum" placeholder="Registration Number" value="<?php echo set_value('regnum'); ?>"></td>
            <td> <input type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>"></td>
        </tr>
        <tr><td><label for="dob"><b>Date of Birth<br>(YYYY-MM-DD):</b></label></td><td><input type="text" name="dob"  class="input-small" id="dob"> </td>
        <tr><td><label for="examdate"><b>Intended Exam Date<br> (YYYY-MM-DD):</b></label></td><td><input type="text" name="examdate" class="input-small" id="examdate" readonly></td></tr>
        <tr><td colspan="2">
                <div class="checkbox">
                    <input type="checkbox" id="agree" name="agree" value="agree" required> I declare that I have read the above and all the information provided above are true, complete, and correct.</div>              
            </td>
        <tr><td><button type="submit" class="btn btn-success">Apply for Exam</button></td><td><?php echo "<span style='color:red'" . validation_errors() . "</span>"; ?></td></tr>

    </table>

</form>
<br/><br/>

</div>



<script>
    $(document).ready(function() {

        $("#dob").datepicker({
            showOn: "button",
            buttonImage: "./assets/images/calendar.gif",
            buttonImageOnly: true,
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
            minDate: 45
                    //defaultDate: new Date('1985, 01, 01')
        });

        $("#commentForm").validate();
    });



</script>

