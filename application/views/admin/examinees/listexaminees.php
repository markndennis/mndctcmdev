</div>
<div class="span10">
    <!--    <div style="height:300px; overflow:auto; ">-->
    <div id='table_div'></div>
    <div id="sel"></div>

    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'System Id');
            data.addColumn('string', 'First Name');
            data.addColumn('string', 'Last Name');
            data.addColumn('string', 'Exam Profile');
            data.addColumn('string', 'EStatus');
            data.addColumn('string', 'AStatus');
            data.addColumn('string', 'Created');
            data.addRows([
<?php
$siteurl = site_url('/admin/examinees/viewexaminee/');
foreach ($listexaminees as $row) {
    echo "['<a href=".$siteurl ."/" .$row['id'].">". $row['id'] . "</a>','" . $row['fname'] . "','" . $row['lname'] . "','" . $row['examprofile'] . "','" . $row['estatus']  . "','" . $row['astatus'] . "','" .date("Y-m-d",strtotime($row['created'])) . "'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
			//table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 8, page: 'enable'});
			table.draw(data, {showRowNumber: false, allowHtml: true});


        }
        
        
    </script>

</div>
<!--</div>     -->
