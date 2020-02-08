google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['number of characters', 'number of words'],
        ['2 Characters', 334],
        ['3 Characters', 20],
        ['4 Characters', 500],
        ['5 Characters', 410],
        ['6 Characters', 210],
        ['7 Characters', 89],
        ['8 Characters', 32],
        ['9 Characters', 79],
        ['10 Characters', 250],
        ['11 Characters', 250]
]);
    var data2 = google.visualization.arrayToDataTable([
        ['characters of word', 'number of words'],
        ['2 Characters', 334],
        ['3 Characters', 20],
        ['4 Characters', 500],
        ['5 Characters', 410],
        ['6 Characters', 210],
        ['7 Characters', 89],
        ['8 Characters', 32],
        ['9 Characters', 79],
        ['10 Characters', 250],
        ['11 Characters', 250]
]);

    var data3 = google.visualization.arrayToDataTable([
        ['characters of word', 'number of words'],
        ['1 Characters', 334],
        ['2 Characters', 334],
        ['3 Characters', 20],
        ['4 Characters', 500],
        ['5 Characters', 410],
        ['6 Characters', 210],
        ['7 Characters', 89],
        ['8 Characters', 32],
        ['9 Characters', 79],
        ['10 Characters', 250]
]);

    var data4 = google.visualization.arrayToDataTable([
        ['characters of word', 'number of words'],
        ['1 Characters', 334],
        ['2 Characters', 334],
        ['3 Characters', 20],
        ['4 Characters', 500],
        ['5 Characters', 410],
        ['6 Characters', 210],
        ['7 Characters', 89],
        ['8 Characters', 32],
        ['9 Characters', 79],
        ['10 Characters', 250]
]);
    var options1 = {'title':'English Words in Database', 'width':450, 'height':300};
    var options2 = {'title':'Telugu Words in Database', 'width':450, 'height':300};
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