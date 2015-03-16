<style>
    #popjump{width: 100px;}
</style>

<div class="row-fluid">
    <div class="span2" style="height: 450px;">
        <div class='thumbnail' style="background:#ffffcc;">
            <strong>Time Remaining:</strong>
            <div id="mins"></div>
            <div id="secs"></div>
        </div>
        <br/>
        Jump to Question:
        <div id="jump"></div>
    </div>
    <script>
        $(document).ready(function() {


            var t = 3600;
            var m = 0;
            var s = 0;
            popjump();

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
                }

                if (m <= 0 && s <= 0) {
                    m = 0;
                    s = 0;
                    location.reload();
                }
                ;

                //alert('s is ' + s);
                $('#mins').html(m + ' Mins');
                $('#secs').html(s + ' Secs');


            }
            ;


            function posttime() {
                $.post('');
                //location.reload();

            }
            ;

            function popjump() {
                $stuffy = '';
                for ($x = 1; $x <= 20; $x++) {
                    $stuffy = $stuffy + '<option>' + $x + '</option>';
                }
                $('#jump').html('<select id="popjump">' + $stuffy + '</select>');
            }
            ;


        });
    </script>