$(function () {

	window.drawNetValueChart = function(numMonths,_series,color) {
	  /*  console.log('CHART:: numMonths = ' , numMonths)
	    console.log('CHART:: series = ' , _series)
	    console.log('CHART:: color = ' , color) */
        $('#chart').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'Net Value over Time'
            },
            subtitle: {
                //text: 'at ' + interestRate + '% interest';
            },
            xAxis: {
                title: {
                    text: 'Years'
                },
                labels: {
                    formatter: function() {
                        return (this.value / 12).toFixed(1);
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Net Value (k)'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                pointFormat: '{series.name} , {point.y:,.0f}</b><br/>{point.x}'
            },
            plotOptions: {
                area: {
                    pointStart: 0,
					animation: false,
					color: color,
					pointEnd: numMonths / 12,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                },
			
            },
            series: _series
        });
	}
    });
	