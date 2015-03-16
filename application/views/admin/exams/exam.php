<style>
    td{width: 50%}
    .indent {padding-left: 22px ;}
    .hindent {padding-left: 22px ; text-indent: -22px ;}
    .handbook{
        visibility: hidden;

    }

    #seljump{width: 50px;}
    #timebox{
        background-color:#ffffcc;
    }
    #warning{
        visibility: hidden;
        background-color: red; 
        color: white; 
        padding: 10px;
    }

</style>
<body oncontextmenu="return false">
    <div class="row-fluid">
        <div class="span2" style="height: 450px;">
            <div class='thumbnail' id="timebox">
                <strong>Time Remaining:</strong>
                <div id="mins"></div>
                <div id="secs"></div>
            </div>
            <br/>
            <strong>Jump to Question:</strong>
            <div id="jump"></div>

            <div id="warning">Low Time Warning</div><br>
            <div><button class='btn btn-danger' id='finished'>Click Here to Finish Exam</button></div><br>
            <div id="handbook" ></div>
        </div><br>


        <div class="span10">


            <div id="dialog">Click confirm if you finished the exam and wish to submit. Otherwise, click cancel to return to the exam</div>
            <div id="quesinfo"></div>
            <button id='back' class="btn btn-success">back</button>&nbsp;
            <button id='forward' class="btn btn-success" >next</button>
            <div class="progress pull-right" id='update' style="width: 500px;">
                <div class="bar" id="bar"></div>
            </div>     


            <table class="table">
                <tr><td><div id='ques' class="hindent"></div></td><td> <div id="ques_c" class="hindent"></div></td></tr>
                <tr><td><div id='r1' class="indent"></div></td><td><div id="r1_c" class="indent"></div></td></tr>
                <tr><td><div id='r2' class="indent"></div></td><td><div id="r2_c" class="indent"></div></td></tr>
                <tr><td><div id='r3' class="indent"></div></td><td><div id="r3_c" class="indent"></div></td></tr>
                <tr><td><div id='r4' class="indent"></div></td><td><div id="r4_c" class="indent"></div></td></tr>

            </table>

        </div>


        <script>
            $(document).ready(function() {

                window.onbeforeunload = function() {
                    return "If you leave or reload this page the exam will be reset to question 1. Answers for completed questions will be saved.";
                };

                //convert PHP to Javascript Array
                var $quesarray = <?php echo json_encode($ques); ?>;
                var $response = <?php echo json_encode($answers); ?>;
                //alert($response);
                var $maxqnum = $quesarray.length;
                //alert ($maxqnum);
                var $id = <?php echo $id; ?>;
                var $baseurl = '<?php echo site_url(); ?>';
                var $examprofile = '<?php echo $examprofile; ?>';
                //alert($examprofile);
                var $qnum = 0;
                //var $response = new Array();
                var $radioval = 'NA';
                popjump();
                displayques($qnum);


                $('#back').click(function() {
                    postanswer($id, $quesarray[$qnum]['id'], $response[$qnum]['answer']);
                    $radioval = 'NA';
                    if ($qnum === 0) {
                        $qnum = $maxqnum - 1;
                    } else {
                        $qnum--;
                    }

                    //$('#qnum').val($qnum);
                    //popjump();
                    displayques($qnum);
                });

                $('#forward').click(function() {
                    postanswer($id, $quesarray[$qnum]['id'], $response[$qnum]['answer']);
                    $radioval = 'NA';
                    if ($qnum === $maxqnum - 1) {
                        $qnum = 0;
                    } else {
                        $qnum++;
                    }
                    //$('#qnum').val($qnum);
                    //alert($qnum);
                    //popjump();
                    //popjump();
                    displayques($qnum);
                });

                if ($examprofile == 'Acupuncturist' || $examprofile == 'Herbalist') {
                    $("#handbook").html("<a href='http://www.ctcma.bc.ca/assets/files/pdf_resources/Registrant/Safety%20Program%20Handbook/Safety_Program_Handbook.pdf' target='_blank'>Handbook English</a><br><a href='http://www.ctcma.bc.ca/assets/files/pdf_resources/Registrant/Safety%20Program%20Handbook/Safety_Program_Handbook-CH.pdf' target='_blank'>手册中文版</a>");

                } else {
                    $("#handbook").html("");
                }
                ;


                $("#finished").click(function() {
					postanswer($id, $quesarray[$qnum]['id'], $response[$qnum]['answer']);
                    $("#dialog").dialog("open");
                });


                $("#dialog").dialog({
                    autoOpen: false,
                    modal: true,
                    width: 450,
                    buttons: {
                        "CONFIRM - Submit Exam Now ": function() {
                            endexam();
                        },
                        "CANCEL": function() {
                            $(this).dialog("close");
                        }
                    }

                });

                function displayques($qnum) {
                    //display question $qnum;
                    $temp = Number($qnum) + 1;
                    if ($temp === $maxqnum) {
                        $('#forward').hide();
                    } else {
                        $('#forward').show();
                    }



                    $('#ques').html("<strong>" + $temp + ".&nbsp;&nbsp;" + $quesarray[$qnum]['qtext'] + "</strong>");
                    $('#r1').html("<label class='radio'><input type='radio' name='response' id='A' value='A'>" + $quesarray[$qnum]['r1'] + '</label>');
                    $('#r2').html('<label class="radio"><input type="radio" name="response" id="B" value="B">' + $quesarray[$qnum]['r2'] + '</label>');
                    $('#r3').html('<label class="radio"><input type="radio" name="response" id="C" value="C">' + $quesarray[$qnum]['r3'] + '</label>');
                    $('#r4').html('<label class="radio"><input type="radio" name="response" id="D" value="D">' + $quesarray[$qnum]['r4'] + '</label>');
                    $('#ques_c').html("<strong>" + $temp + ".&nbsp;&nbsp;" + $quesarray[$qnum]['qtext_c'] + "</strong>");
                    $('#r1_c').html('<label class="radio"><input type="radio" name="response_c" id="A_c" value="A">' + $quesarray[$qnum]['r1_c'] + '</label>');
                    $('#r2_c').html('<label class="radio"><input type="radio" name="response_c" id="B_c" value="B">' + $quesarray[$qnum]['r2_c'] + '</label>');
                    $('#r3_c').html('<label class="radio"><input type="radio" name="response_c" id="C_c" value="C">' + $quesarray[$qnum]['r3_c'] + '</label>');
                    $('#r4_c').html('<label class="radio"><input type="radio" name="response_c" id="D_c" value="D">' + $quesarray[$qnum]['r4_c'] + '</label>');
                    //for testing purposes display subtest and question id
                    //$('#quesinfo').html($quesarray[$qnum]['subtest'] + ' ' + $quesarray[$qnum]['qnum'] + ' ' + $quesarray[$qnum]['id'] + ' ' + $response[$qnum]['answer']);

                    //if english response selected, select chinese response and put selection in response array
                    $('input[name=response]input:radio').click(function() {
                        $radioval = $(this).val();
                        $select = '#' + $radioval + '_c';
                        $($select).prop("checked", true)
                        $response[$qnum]['answer'] = $radioval;
                        //alert($response[$qnum]['answer']);
                    });

                    //if chinese response selected, select english response and put selection in response array
                    $('input[name=response_c]input:radio').click(function() {
                        $radioval = $(this).val();
                        $select = '#' + $radioval;
                        $($select).prop("checked", true)
                        $response[$qnum]['answer'] = $radioval;
                    });

                    //check previously selected radio button from response array
                    $select = '#' + $response[$qnum]['answer'];
                    $($select).prop("checked", true);
                    $select_c = '#' + $response[$qnum]['answer'] + '_c';
                    $($select_c).prop("checked", true);
                    //alert($response);

                    $numanswered = countanswers();
                    $percentcomp = $numanswered / $maxqnum
                    $('#bar').css("width", $percentcomp * 100 + "%");
                    $compupdate = $numanswered + " of " + $maxqnum;
                    $('#bar').html($compupdate);
                    //alert($percentcomp);
                    popjump();
                }


                $('#done').click(function() {
                    endexam();
                });

                function countanswers() {
                    count = 0;
                    for ($row in $response) {
                        //alert($response[$row]['answer']);
                        if ($response[$row]['answer'] !== 'NA') {
                            count = count + 1;
                        }
                    }
                    return count;
                }
                ;
                function postanswer($id, $qid, $answer) {

                    $.ajax({
                        type: "GET",
                        url: $baseurl + "/exam/myexam/postanswer/" + $id + "/" + $qid + "/" + $answer,
                        //data: {qnum: $qnum},
                        //success: success,
                        dataType: "html"
                    });
                    posttime();
                }

                function popjump() {
                    $stuffy = '';
                    postanswer($id, $quesarray[$qnum]['id'], $response[$qnum]['answer']);
					
                    for ($x = 0; $x < $maxqnum; $x++) {
                        $temp = $x + 1;
                        if ($response[$x]['answer'] !== 'NA') {
                            //$color='#f7f7f7';
                            $color = 'background-color: #6495ED;color:#FFFFFF;';
                            $stuffy = $stuffy + '<option style="' + $color + '" value ="' + $x + '">' + $temp + "- answered" + '</option>';
                        } else {
                            $color = "background-color: #FFFFFF;";
                            $stuffy = $stuffy + '<option style="' + $color + '" value ="' + $x + '">' + $temp + '</option>';
                        }

                    }
                    $('#jump').html('<select id="seljump">' + '<option>#</option>' + $stuffy + '</select>');

                    $('#seljump').change(function() {
                        $qnum = $('#seljump').val();
                        //alert($qnum);
                        //popjump();
                        displayques($qnum);
                    });
                }



//                function thisdialog(){
//                    $("#dialog").dialog();
//                };


                // Time Control
                //var ttime = <?php echo $tottime; ?>;
                posttime(); // posttime to set t;
                var t = 0;
                posttime(); // posttime to set t;
                var m = 0;
                var s = 0;

                //t = parseInt($('#time').val())


                //alert(url);
                //alert(t);
                setInterval(timedisplay, 1000);
                setInterval(posttime, 10000);
                //                        

                function timedisplay() {
                    //alert('timer');
                    t = t - 1;
                    // $('#test').html(t);
                    m = Math.floor(t / 60);
                    s = t % 60;
                    if (m < 5) {
                        $('#warning').css('visibility', 'visible');
                        $('#timebox').css({'background-color': 'red', 'color': 'white'})
                    }

                    if (m <= 0 && s <= 0) {
                        m = 0;
                        s = 0;
                        endexam();
                    }
                    ;


                    //alert('s is ' + s);
                    $('#mins').html(m + ' Mins');
                    $('#secs').html(s + ' Secs');
                }


                function posttime() {
                    //alert(ttime-t);
                    //etime = ttime-t;
                    d = new Date();
                    d = d.getTime();
                    $.ajax({
                        type: "GET",                     
                        url: $baseurl + "/exam/myexam/posttime/" + $id + "/"+ d,
                        //url: $baseurl + "/exam/myexam/posttime/",
                        //data: {id: $id},
                        //cache: false,
                        //dataType: "html",
                        //data: {qnum: $qnum},
                        success: function(resp) {
                            //alert(t);
                            t = resp;
                            //alert(t);
                        }
//                        error: function(XHR, status, response) {
//                            alert('fail');
//                        }
                    });
                }


                function endexam() {
                    window.onbeforeunload = null;
                    //window.close();
                    window.location.href = $baseurl + "/exam/myexam/postfinishtime/" + $id;

                }
            });
        </script>
