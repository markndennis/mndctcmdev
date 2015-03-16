<!DOCTYPE html>
<html>
    <head>
        <title>CTCMA Safety Exam</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--        <meta http-equiv="Cache-Control" content="no-cache"> -->
        <link href="<?php echo base_url('/assets/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!--         <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script> -->
		<script src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>
        <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row-fluid">

                <div class="span12">
                    <a href="<?php echo site_url('main/welcome'); ?>"><img src="<?php echo base_url('/assets/images/ctcmalogodev.jpg'); ?>"></a>
                    
                    <div class="pull-right">
                        <div class="muted">
                            <h4><?php echo $pagetitle; ?></h4>
                        </div>
                    </div>
                    <br/>
                   
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $("li.top").hover(function(){
                        $(this).toggleClass("active");
                                
                    });
                });
            </script>






