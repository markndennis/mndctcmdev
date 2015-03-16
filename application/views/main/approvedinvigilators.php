</div>
<div class="span7">
    The following invigilators are approved by the College.  You can sort the list by clicking on any of the column titles:</br></br>
    <div id='table_div'></div>
    <div id="sel"></div>

    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'ID');
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Institution');
            data.addColumn('string', 'City');
            data.addColumn('string', 'Province');
            data.addColumn('string', 'Country');
            data.addRows([
<?php
$siteurl = site_url('/main/invigilatordetail');
foreach ($listinvigilators as $row) {
    echo "['<a href= ".$siteurl."/".$row['id'].">" . $row['id'] . "</a>','" . $row['fname'] . " " . $row['lname'] . "','" .$row['institution'] ."','" .$row['city'] ."','". $row['province']."','". $row['country']. "'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 20, page: 'enable'});


        }
        //google.visualization.events.addListener(table, 'select', selectHandler);

//        $(this).click(function() {
//            alert($(this).html());
//            alert('clicked');
//        });
//        //alert(sel.toSource());

        
    </script>

</div>
