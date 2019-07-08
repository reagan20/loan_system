$(function () {
    drawSparklines();
    getLineChart();
    getVectorMap();
    $('.knob').knob();
});


function getVectorMap() {

// jvectormap data visitors
    var visitorsData = {
        US: 398, // USA
        SA: 400, // Saudi Arabia
        CA: 1000, // Canada
        DE: 500, // Germany
        FR: 760, // France
        CN: 300, // China
        AU: 700, // Australia
        BR: 600, // Brazil
        IN: 800, // India
        GB: 320, // Great Britain
        RU: 3000 // Russia
    };
// World map by jvectormap
    $('#world-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                fill: '#e4e4e4',
                'fill-opacity': 1,
                stroke: 'none',
                'stroke-width': 0,
                'stroke-opacity': 1
            }
        },
        series: {
            regions: [
                {
                    values: visitorsData,
                    scale: ['#92c1dc', '#ebf4f9'],
                    normalizeFunction: 'polynomial'
                }
            ]
        },
        onRegionLabelShow: function (e, el, code) {
            if (typeof visitorsData[code] != 'undefined')
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
        }
    });
}

function drawSparklines() {

    $('#sparkline-1').sparkline([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021], {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: '#ebf4f9',
        height: '50',
        width: '80'
    });

    $('#sparkline-2').sparkline([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921], {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: '#ebf4f9',
        height: '50',
        width: '80'
    });

    $('#sparkline-3').sparkline([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21], {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: '#ebf4f9',
        height: '50',
        width: '80'
    });
}

function getLineChart() {

    var options = {
        type: 'line',
        data: {
            labels: ["January", "February", "March",
                "April", "May", "June",
                "July", "August"],
            datasets: [
                {
                    label: 'Positive',
                    data: [10, 14, 3, 5, 4, 3, 12, 10],
                    borderWidth: 1,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10
                },
                {
                    label: 'Negative',
                    data: [7, 11, 5, 8, 4, 7, 4, 2],
                    borderWidth: 1,
                    lineTension: 0.1,
                    backgroundColor: "rgba(74, 117, 191, 0.4)",
                    borderColor: "rgba(74, 117, 191, 1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(74, 117, 191, 1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(74, 117, 191, 1)",
                    pointHoverBorderColor: "rgba(74, 117, 191, 1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            reverse: false
                        }
                    }]
            }
        }
    }

    var ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, options);
}
