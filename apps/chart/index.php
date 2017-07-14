<?php
require_once("phpChart_Lite/conf.php");
$m01 = 0; $m02 = 0; $m03 = 0; $m04 = 0; $m05= 0; $m06 = 0; $m07 = 0; $m08 = 0; $m09 = 0; $m10 = 0;
$query = $db->prepare("SELECT * FROM trouble");
$query->execute();
if ($query->rowCount()>0) {
  while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    //echo $row->postdate;
    $a = $row->postdate;
    //list($m,$d,$y)=explode('-',$a);
    $b = date('Y-m-d', strtotime($a));
    if (date('Y', strtotime($b)) == date('Y', strtotime($b))) {
      if (date('Y', strtotime($b)) == 2011) {
        $m01++;
      }
      if (date('Y', strtotime($b)) == 2012) {
        $m02++;
      }
      if (date('Y', strtotime($b)) == 2013) {
        $m03++;
      }
      if (date('Y', strtotime($b)) == 2014) {
        $m04++;
      }
      if (date('Y', strtotime($b)) == 2015) {
        $m05++;
      }
      if (date('Y', strtotime($b)) == 2016) {
        $m06++;
      }
      if (date('Y', strtotime($b)) == 2017) {
        $m07++;
      }
      // if (date('Y', strtotime($b)) == 2018) {
      //   $m08++;
      // }
      // if (date('Y', strtotime($b)) == 2019) {
      //   $m09++;
      // }
      // if (date('Y', strtotime($b)) == 2020) {
      //   $m10++;
      // }

    }
  }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Title of the document</title>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>

    <?php
        $dataPoints = array(
            array("y" => $m01, "label" => "2011"),
            array("y" => $m02, "label" => "2012"),
            array("y" => $m03, "label" => "2013"),
            array("y" => $m04, "label" => "2014"),
            array("y" => $m05, "label" => "2015"),
            array("y" => $m06, "label" => "2016"),
            array("y" => $m07, "label" => "2017"),
            // array("y" => $m08, "label" => "2018"),
            // array("y" => $m09, "label" => "2019"),
            // array("y" => $m10, "label" => "2020"),

        );
    ?>

    <body>
   <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    เลือกปี
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="index.php?file=chart/2011">2011</a></li>
    <li><a href="index.php?file=chart/2012">2012</a></li>
    <li><a href="index.php?file=chart/2013">2013</a></li>
    <li><a href="index.php?file=chart/2014">2014</a></li>
    <li><a href="index.php?file=chart/2015">2015</a></li>
    <li><a href="index.php?file=chart/2016">2016</a></li>
    <li><a href="index.php?file=chart/2017">2017</a></li>
    <li><a href="index.php?file=chart/2018">2018</a></li>
    <li><a href="index.php?file=chart/2019">2019</a></li>
    <li><a href="index.php?file=chart/2020">2020</a></li>
  </ul>
</div>

    <!-- <br><br> --> 
        <div id="chartContainer"></div>

        <script type="text/javascript">

            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme3",
                    animationEnabled: true,
                    title: {
                        text: "จำนวนการแจ้งซ่อมแต่ละปี"
                    },
                    data: [
                    {
                        type: "column",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
                });
                chart.render();
            });
        </script>
    </body>

</html>
