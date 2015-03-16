<div class="span12">
    <div class="page-header">
        <h2>Exam Introduction for <?php echo $examinee[0]['fname'] . " " . $examinee[0]['lname']; ?><br/>
            <small>Please read these instructions in their entirety before beginning the exam ...</small>
        </h2>
    </div>
    <div>
        <ol>
            <li>You can immediately determine the remaining time limit for the exam in the yellow box on the left</li>
            <li>All questions are multiple choice.</li>
            <li>Only one question will be shown at a time.</li>
            <li>Your answer will not be saved until you press the green Back or Next buttons.  Once you press the green Back or Next button your answer will automatically be saved and you will go back or forward one question depending on the button pressed. </li>
            <li>You will have the opportunity to jump to any question at any time using the "jump to question" drop down list.</li>
            <li>Questions in the "jump to question" drop down list will indicate if they have been completed so you can quickly check which questions are awaiting answers.</li>
            <li>You may change your answer to any question at any time by simply jumping to it and saving a new answer.</li>
            <li>You will be given a low time warning when there are only 5 minutes remaining in the exam. The remaining time box will also turn red.</li>
            <li>At the conclusion of the time limit your exam will automatically be saved and submitted.</li>
            <li>Should you finish before the time limit you will have the opportunity to mark the exam complete and submit the entire exam.  This option will appear whenever you jump to the last question.</li>
            <li>Once an exam is marked complete and submitted there is no opportunity to log back into the exam and make any changes.</li>
            <li>Should your exam session end for any reason before the time limit and before you have submitted the entire exam your invigilator can sign you back into the exam with whatever time you had remaining when the session ended. The timer will stop until the exam session is re-established.</li>
            <li>All exam material is the property of the College of Traditional Chinese Medicine Practitioners and
Acupuncturists of British Columbia, all rights reserved. Duplication or sharing content of this exam with
others in any manner is strictly prohibited.</li>
<!--                 <li>CTCMA relies on candidates' feedback as one of the mechanisms for continued improvement of course
and examination material. Your completion of the Candidate Feedback is appreciated.</li> -->
            <li>Click on the following button to start the exam.</li>
        </ol>
        
        
            <span style="margin-left: 110px;">
                <button name="submit" class="btn btn-danger" onclick="window.location.href='<?php echo site_url('exam/myexam/poststarttime'."/". $examinee[0]['id']); ?>'">I, <strong><u><?php echo $examinee[0]['fname'] . " " . $examinee[0]['lname']; ?></strong></u> have read and understand the instructions and am ready to start the exam</button>
            </span>
       
    </div>
</div>
<div class='span3'>