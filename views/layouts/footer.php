    <div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2015</p>
                <p class="pull-right">System of monitoring</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/main.js"></script>x
<script>
  $(document).ready(function(){
           //задача оценена
           $(".set_ts").click(function () {
            $.post("/ts_update", {
                temperature: $('[name="temperature"]').val(),
                speed: $('[name="speed"]').val(),
            }, function (data) {
                console.log(data);
                var parsed = JSON.parse(data);
                $("#result_t").html(parsed.temperature + "°С");
                $("#result_s").html(parsed.speed + "об/сек");
            });
            return false;
        });

           $(".set_pressure").click(function () {
            $.post("/presure_update", {
                pressure: $('[name="pressure"]').val(),
            }, function (data) {
                console.log(data);
                $("#result_p").html(data+"Па");
            });
            return false;
        });




       });
   </script>

</body>
</html>