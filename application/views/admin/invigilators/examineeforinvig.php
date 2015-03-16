</div>
<div class="span10">
    <div class="well">The following approved examinees have nominated you as their invigilator and have not completed their exam:</div>
    <!--    <div style="height:300px; overflow:auto; ">-->
    <div id='table_div'>Loading Examinees ...</div>
    

    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pin');
            data.addColumn('string', 'First Name');
            data.addColumn('string', 'Last Name');
            data.addColumn('string', 'Exam Profile');
            data.addColumn('string', 'Exam Date');
            data.addColumn('string', 'AStatus');
            data.addColumn('string', 'EStatus');
            data.addRows([
                
<?php
$siteurl = site_url('/admin/invigilators/invigapproval/');
foreach ($listexaminees as $row) {
    echo "['<a href=".$siteurl."/".$row['id'].">" . $row['pin'] . "</a>','" . $row['fname'] . "','" . $row['lname'] . "','" . $row['examprofile'] . "','" . $row['examdate'] . "','" . $row['astatus'] . "','" . $row['estatus'] . "'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 8, page: 'enable'});


        }
        //google.visualization.events.addListener(table, 'select', selectHandler);

//        $(this).click(function() {
//            alert($(this).html());
//            alert('clicked');
//        });
//        //alert(sel.toSource());

        
    </script>

</div>
<!--</div>     -->
