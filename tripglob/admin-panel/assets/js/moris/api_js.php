<script>
$(function () {

    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
    var day_data = [
        {"period": "2012-10-01", "licensed": 807, "sorned": 660},
        {"period": "2012-09-30", "licensed": 1251, "sorned": 729},
        {"period": "2012-09-29", "licensed": 1769, "sorned": 1018},
        {"period": "2012-09-20", "licensed": 2246, "sorned": 1461},
        {"period": "2012-09-19", "licensed": 2657, "sorned": 1967},
        {"period": "2012-09-18", "licensed": 3148, "sorned": 2627},
        {"period": "2012-09-17", "licensed": 3471, "sorned": 3740},
        {"period": "2012-09-16", "licensed": 2871, "sorned": 2216},
        {"period": "2012-09-15", "licensed": 2401, "sorned": 1656},
        {"period": "2012-09-10", "licensed": 2115, "sorned": 1022}
    ];
  
<?php 
$first  = strtotime('first day this month');
$months = array();

for ($i = 6; $i >= 1; $i--) {
  array_push($months, date('M', strtotime("-$i month", $first)));
}
?>
    Morris.Bar({
        element: 'graph_bar',
        data: [
            {x: '<?php echo $months[0]; ?>', Hits: <?php echo $api_hits->sixth; ?>},
            {x: '<?php echo $months[1]; ?>', Hits: <?php echo $api_hits->fifth; ?>},
            {x: '<?php echo $months[2]; ?>', Hits: <?php echo $api_hits->fourth; ?>},
            {x: '<?php echo $months[3]; ?>', Hits: <?php echo $api_hits->third; ?>},
            {x: '<?php echo $months[4]; ?>', Hits: <?php echo $api_hits->second; ?>},
            {x: '<?php echo $months[5]; ?>', Hits: <?php echo $api_hits->first; ?>}
            
        ],
        xkey: 'x',
        ykeys: ['Hits'],
        labels: ['Hits'],
        barRatio: 0.4,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 35,
        hideHover: 'auto'
    });

   
    Morris.Donut({
        element: 'graph_donut',
        data: [
            {label: 'Success', value: <?php echo round(($pie_chart->SUCCESS/$pie_chart->TOTAL)*100,0); ?>},
            {label: 'Failure', value: <?php echo round(($pie_chart->FAILURE/$pie_chart->TOTAL)*100,0); ?>}
           
        ],
        colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        formatter: function (y) {
            return y + "%"
        }
    });

    new Morris.Line({
        element: 'graph_line',
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Value'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: [
            {year: '2008', value: 20},
            {year: '2009', value: 10},
            {year: '2010', value: 5},
            {year: '2011', value: 5},
            {year: '2012', value: 20}
        ]
    });

});
</script>