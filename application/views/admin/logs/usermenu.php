<div class="row-fluid">
                <div class="span3">
                    Welcome <?php echo $this->session->userdata('name'); ?>!

                    <ul class="nav nav-tabs nav-stacked">
                        <li>
                            <a href="<?php echo site_url('/admin/logger/savelog');?>">Email/Clear Log</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/admin/examinees/logout');?>">Logout</a>
                        </li>
                    </ul>


