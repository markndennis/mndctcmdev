<div class="row-fluid">
    <div class="span3">
        Welcome <?php echo $this->session->userdata('name'); ?>!
        <ul class="nav nav-tabs nav-stacked">
            <li>
                <a href="<?php echo site_url('/admin/invigilators/addinvigilator'); ?>">Add Invigilator</a>
            </li>
            
            </li>
            <li>
                <a href="<?php echo site_url('/main/logout'); ?>">Logout</a>




        </ul>


