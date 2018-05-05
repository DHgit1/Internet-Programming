<?php
    $ans;
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

        <script>
        function updatePoll() {
            $("#container").html("<img src='img/loading.gif' />");
            var selValue = $('input[name=contact]:checked').val();
            $.ajax({
                type: "GET",
                url: "updatePoll.php",
                dataType: "json",
                data: { "id": selValue},
                success: function(data,status) {
                    
                }
            });
            
            //on Success, call the 'updatePollChart' function passing the percentages of the three choices, for example:
            updatePollChart(25,40,35);
        }
        //You can change the choice names if different from "yes", "maybe", and "no"
        function updatePollChart(yes, maybe, no) {
            Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ''
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Choices',
                        colorByPoint: true,
                        data: [{
                            name: 'Yes',
                            y: yes
                        }, {
                            name: 'Maybe',
                            y: maybe,
                            sliced: true,
                            selected: true
                        }, {
                            name: 'No',
                            y: no
                        }]
                    }]
                });
        }//endFunction
        
        </script>
        
    </head>
    <body>
      <h1> Question: </h1>
      <div id="questions"> Does global warming exist?
            <input class="radio" type="radio" id="1"
             name="contact" value="Yes">
            <label for="1">Yes</label>
        
            <input class="radio" type="radio" id="2"
             name="contact" value="No">
            <label for="2">No</label>
        
            <input class="radio" type="radio" id="3"
             name="contact" value="Maybe">
            <label for="3">Maybe</label>
      </div>
      <button onclick="updatePoll()">Submit</button>
      <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

    </body>
</html>