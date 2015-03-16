<div class="row-fluid">
                <div class="span2">
                    Welcome <?php echo $this->session->userdata('name'); ?>!

                    <ul class="nav nav-tabs nav-stacked">
<!--                        <li>
                            <a href="<?php echo site_url('/admin/examinees/addexaminee');?>">Add Examinee</a>
                        </li>-->
                        <li>
                            <a href="<?php echo site_url('/admin/examinees/logout');?>">Logout</a>
                        </li>
                    </ul>


