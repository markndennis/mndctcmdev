</div>
<div class="span7">
    <p>The following invigilators have been approved by the college - click on a name for more information:</p>
    
        <table class="table">
            <thead>
                <tr><th>City</th><th>Name</th><th>Email</th></tr>
            </thead>
        </table>
    <div style="height:300px; overflow:auto;">
        <table class="table">
            <?php
            foreach ($invig as $item) {
                echo "<tr><td>" . $item['city'] . "</td>";
                echo "<td><a href='" . site_url('main/invigilatordetail/'.$item['id']) . "'>";
                echo $item['fname'] . " " . $item['lname'] . "</a></td><td>" . $item['email'] . "</td></tr>"; 
                
            }
            ?>
        </table>  
    </div>
</div>