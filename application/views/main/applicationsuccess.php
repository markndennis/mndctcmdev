</div>
<div class="span7">
    <h3>Success!</h3> 
    Your exam request has been completed. Please print this exam confirmation and submit along with payment to the College within 5 business days at:<br><br>
    <strong><address>CTCMA Safety Program Exam<br>1664 West 8th Avenue Vancouver,<br> BC V6J 1V4</address></strong>
        <h3><u>Examinee Details:</u></h3>
        <?php
        echo
        "Examinee Name:<strong> " . $examinee[0]['fname'] . " " . $examinee[0]['lname'] . "</strong><br> Registration Number: <strong>" .
        $examinee[0]['regnum'] . "</strong><br> Exam: <strong>" .
        $examinee[0]['examprofile'] . "</strong><br> Proposed Exam Date: <strong>" .
        $examinee[0]['examdate'] . "</strong><br>"
        ?>
        <h3><u>Invigilator Details:</u></h3>
        <?php
        echo
			"Invigilator Name:<strong> " . $invig[0]['fname'] . " " . $invig[0]['lname'] . "</strong><br>". "Institution Name: <strong>" . $invig[0]['institution'] ."</strong><br>Invigilator Contact Info: <br><strong>".
        $invig[0]['contactinfo'] . "</strong><br>"
        ?>
        <br><strong>Money Order or Certified Cheque</strong><ul>
            <li>Acupuncturist Safety Program Examination $75.00</li>
            <li>Herbalists Safety Program Examination $75.00</li>
            <li>Dr.TCM Safety Course & Examination $75.00</li>
            <li>Reciprocity Safety Course & Examination $75.00</li>
        </ul>
        <br><strong>Note:</strong>
        <p>Once your application is processed, you will receive another email confirmation. If you do not receive an email within 2-3 weeks, you should contact the College at <a href="mailto:info@ctcma.bc.ca">info@ctcma.bc.ca</a></p>
        <p>Please print an additional copy of this page for your own records.</p><br>
        <input type="button" class="btn btn-success"onclick ="javascript:window.print()" value="Click to Print This Page">
</div>