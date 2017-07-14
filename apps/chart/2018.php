<?php
require_once("phpChart_Lite/conf.php");
$m01 = 0; $m02 = 0; $m03 = 0; $m04 = 0; $m05= 0; $m06 = 0; $m07 = 0; $m08 = 0; $m09 = 0; $m10 = 0; $m11 = 0; $m12 = 0;
$query = $db->prepare("SELECT * FROM trouble");
$query->execute();
if ($query->rowCount()>0) {
  while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    //echo $row->postdate;
    $a = $row->postdate;
    //list($m,$d,$y)=explode('-',$a);
    $b = date('Y-m-d', strtotime($a));
    if (date('Y', strtotime($b)) == 2018) {
      if (date('m', strtotime($b)) == 1) {
        $m01++;
      }
      if (date('m', strtotime($b)) == 2) {
        $m02++;
      }
      if (date('m', strtotime($b)) == 3) {
        $m03++;
      }
      if (date('m', strtotime($b)) == 4) {
        $m04++;
      }
      if (date('m', strtotime($b)) == 5) {
        $m05++;
      }
      if (date('m', strtotime($b)) == 6) {
        $m06++;
      }
      if (date('m', strtotime($b)) == 7) {
        $m07++;
      }
      if (date('m', strtotime($b)) == 8) {
        $m08++;
      }
      if (date('m', strtotime($b)) == 9) {
        $m09++;
      }
      if (date('m', strtotime($b)) == 10) {
        $m10++;
      }
      if (date('m', strtotime($b)) == 11) {
        $m11++;
      }
      if (date('m', strtotime($b)) == 12) {
        $m12++;
      }
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
            array("y" => $m01, "label" => "Jan"),
            array("y" => $m02, "label" => "Feb"),
            array("y" => $m03, "label" => "Mar"),
            array("y" => $m04, "label" => "Apr"),
            array("y" => $m05, "label" => "May"),
            array("y" => $m06, "label" => "Jun"),
            array("y" => $m07, "label" => "Jul"),
            array("y" => $m08, "label" => "Aug"),
            array("y" => $m09, "label" => "Sep"),
            array("y" => $m10, "label" => "Oct"),
            array("y" => $m11, "label" => "Nov"),
            array("y" => $m12, "label" => "Dec"),
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

        <div id="chartContainer"></div>
 
        <script type="text/javascript">
 
            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme3",
                    animationEnabled: true,
                    title: {
                        text: "2018"
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
