<?php
require "header.php";
require "db_fns.php";
include('state.fns.php');

//get English word count
$engWordsInBankArray = getENGWordsInBank();
$engWordsInBank = count($engWordsInBankArray);

//get Telugu word count
$telWordsInBankArray = getTELWordsInBank();
$telWordsInBank = count($telWordsInBankArray);

//get URLs count
$URLArray = getURLArray();
$URLsInBank = count($URLArray);

//total word in database count
$wordsInBank = $telWordsInBank + $engWordsInBank;
?>

<html>
<head>
    <link href="stats_style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {

    var data = google.visualization.arrayToDataTable([
        [{"label":"number of characters","type":"string"}, 'number of words'],
        [<?php echo getEngLeng1();?> + " Characters", <?php echo getEngTop1();?>],
        [<?php echo getEngLeng2();?> + " Characters", <?php echo getEngTop2();?>],
        [<?php echo getEngLeng3();?> + " Characters", <?php echo getEngTop3();?>],
        [<?php echo getEngLeng4();?> + " Characters", <?php echo getEngTop4();?>],
        [<?php echo getEngLeng5();?> + " Characters", <?php echo getEngTop5();?>],
        [<?php echo getEngLeng6();?> + " Characters", <?php echo getEngTop6();?>],
        [<?php echo getEngLeng7();?> + " Characters", <?php echo getEngTop7();?>],
        [<?php echo getEngLeng8();?> + " Characters", <?php echo getEngTop8();?>],
        [<?php echo getEngLeng9();?> + " Characters", <?php echo getEngTop9();?>],
        [<?php echo getEngLeng10();?> + " Characters", <?php echo getEngTop10();?>]
    ]);

    var data2 = google.visualization.arrayToDataTable([
        ['characters of word', 'number of words'],
        [<?php echo getTelLeng1();?> + " Characters", <?php echo getTelTop1();?>],
        [<?php echo getTelLeng2();?> + " Characters", <?php echo getTelTop2();?>],
        [<?php echo getTelLeng3();?> + " Characters", <?php echo getTelTop3();?>],
        [<?php echo getTelLeng4();?> + " Characters", <?php echo getTelTop4();?>],
        [<?php echo getTelLeng5();?> + " Characters", <?php echo getTelTop5();?>],
        [<?php echo getTelLeng6();?> + " Characters", <?php echo getTelTop6();?>],
        [<?php echo getTelLeng7();?> + " Characters", <?php echo getTelTop7();?>],
        [<?php echo getTelLeng8();?> + " Characters", <?php echo getTelTop8();?>],
        [<?php echo getTelLeng9();?> + " Characters", <?php echo getTelTop9();?>],
        [<?php echo getTelLeng10();?> + " Characters", <?php echo getTelTop10();?>]
    ]);

    var data3 = google.visualization.arrayToDataTable([
        ['characters of word', 'number of words'],
        ['<?php echo getEngTopAlpha1();?>', <?php echo getEngTopAlphaCount1();?>],
        ['<?php echo getEngTopAlpha2();?>', <?php echo getEngTopAlphaCount2();?>],
        ['<?php echo getEngTopAlpha3();?>', <?php echo getEngTopAlphaCount3();?>],
        ['<?php echo getEngTopAlpha4();?>', <?php echo getEngTopAlphaCount4();?>],
        ['<?php echo getEngTopAlpha5();?>', <?php echo getEngTopAlphaCount5();?>],
        ['<?php echo getEngTopAlpha6();?>', <?php echo getEngTopAlphaCount6();?>],
        ['<?php echo getEngTopAlpha7();?>', <?php echo getEngTopAlphaCount7();?>],
        ['<?php echo getEngTopAlpha8();?>', <?php echo getEngTopAlphaCount8();?>],
        ['<?php echo getEngTopAlpha9();?>', <?php echo getEngTopAlphaCount9();?>],
        ['<?php echo getEngTopAlpha10();?>', <?php echo getEngTopAlphaCount10();?>]
    ]);

    var data4 = google.visualization.arrayToDataTable([
        ['characters of word', 'number of words'],
        ['<?php echo getTelTopAlpha1();?>', <?php echo getTelTopCount1();?>],
        ['<?php echo getTelTopAlpha2();?>', <?php echo getTelTopCount2();?>],
        ['<?php echo getTelTopAlpha3();?>', <?php echo getTelTopCount3();?>],
        ['<?php echo getTelTopAlpha4();?>', <?php echo getTelTopCount4();?>],
        ['<?php echo getTelTopAlpha5();?>', <?php echo getTelTopCount5();?>],
        ['<?php echo getTelTopAlpha6();?>', <?php echo getTelTopCount6();?>],
        ['<?php echo getTelTopAlpha7();?>', <?php echo getTelTopCount7();?>],
        ['<?php echo getTelTopAlpha8();?>', <?php echo getTelTopCount8();?>],
        ['<?php echo getTelTopAlpha9();?>', <?php echo getTelTopCount9();?>],
        ['<?php echo getTelTopAlpha10();?>', <?php echo getTelTopCount10();?>]
    ]);

    var options1 = {'title':'Top 10 Most Longest Length of English Words in Database', 'width':450, 'height':300};
    var options2 = {'title':'Top 10 Most Longest Length of Telugu Words in Database', 'width':450, 'height':300};
    var options3 = {'title':'Top 10 English Characters', 'width':450, 'height':300};
    var options4 = {'title':'Top 10 Telugu Characters', 'width':450, 'height':300};

    var chart = new     google.visualization.PieChart(document.getElementById('piechart1'));
    chart.draw(data, options1);

    var chart2 = new     google.visualization.PieChart(document.getElementById('piechart2'));
    chart2.draw(data2, options2);

    var chart3 = new     google.visualization.PieChart(document.getElementById('piechart3'));
    chart3.draw(data3, options3);

    var chart4 = new     google.visualization.PieChart(document.getElementById('piechart4'));
    chart4.draw(data4, options4);
}
</script>
</head>
<div id="container">
    <div id="body">
        <div id="indexDiv">
        	<h3>Web Crawl Statistics</h3>
        	English words: <?php echo $engWordsInBank;?>
                </br>Telugu words: <?php echo $telWordsInBank;?>
                </br><Strong style="color: orange">Total Words in bank:</Strong> <?php echo $wordsInBank;?>
                </br><Strong style="color: orange">Total URLs: </Strong> <?php echo $URLsInBank;?>
        </div>
        <div id="chart-zone">
        	<div id="piechart1"></div>
        	<div id="piechart2"></div>
        	<div id="piechart3"></div>
        	<div id="piechart4"></div>
        </div>
    </div>
    <div>
	<?php
	require "footer.php";
	?>
    </div>
</div>
</html>
