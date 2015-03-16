</div>
<div class="span9">
	<div><?php echo urldecode($message); ?></div>
    <div id='table_div'></div>

    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'ID');
            data.addColumn('string', 'Name');
			data.addColumn('string', 'Active');
            data.addColumn('string', 'Institution');
            data.addColumn('string', 'City');
            data.addColumn('string', 'Province');
            data.addColumn('string', 'Country');
            data.addRows([
<?php
$siteurl = site_url('/admin/invigilators/viewinvigilator/');
foreach ($listinvigilators as $row) {
    echo "['<a href= ".$siteurl."/".$row['id'].">" . $row['id'] . "</a>','" . $row['fname'] . " " . $row['lname'] . "','".$row['active'] . "','" . $row['institution']. "','" . $row['city']."','" . $row['province']."','". $row['country']."'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 8, page: 'enable'});


        }
        
        
    </script>

</div>
