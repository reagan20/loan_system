$(function () {
    getJqueryKnob();
    getFlotCharts();
    drawSparklines();
    drawMouseSpeedDemo();
    new Chart(document.getElementById("doughnut-chart").getContext("2d"), getChartJs('doughnut'));
    new Chart(document.getElementById("bar-chart2").getContext("2d"), getChartJs('bar'));
    new Chart(document.getElementById("radar-chart").getContext("2d"), getChartJs('radar'));
    new Chart(document.getElementById("polar-chart").getContext("2d"), getChartJs('polar'));
});

function getJqueryKnob() {
    /* jQueryKnob */
    $(".knob").knob({
        /*change : function (value) {
         //console.log("change : " + value);
         },
         release : function (value) {
         console.log("release : " + value);
         },
         cancel : function () {
         console.log("cancel : " + this.value);
         },*/
        draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv) // Angle
                        ,
                        sa = this.startAngle // Previous start angle
                        ,
                        sat = this.startAngle // Start angle
                        ,
                        ea // Previous end angle
                        , eat = sat + a // End angle
                        ,
                        r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor &&
                        (sat = eat - 0.3) &&
                        (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor &&
                            (sa = ea - 0.3) &&
                            (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
    /* END JQUERY KNOB */
}

function getFlotCharts() {
    /* Flot Interactive Chart*/
    var data = [],
            totalPoints = 100;
    function getRandomData() {

        if (data.length > 0)
            data = data.slice(1);

        // Do a random walk
        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
        }

        return res;
    }

    var interactive_plot = $.plot("#interactive", [getRandomData()], {
        grid: {
            borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3"
        },
        series: {
            shadowSize: 0, // Drawing is faster without shadows
            color: "#3c8dbc"
        },
        lines: {
            fill: true, //Converts the line chart to area chart
            color: "#3c8dbc"
        },
        yaxis: {
            min: 0,
            max: 100,
            show: true
        },
        xaxis: {
            show: true
        }
    });

    var updateInterval = 500; //Fetch data ever x milliseconds
    var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
    function update() {
        interactive_plot.setData([getRandomData()]);
        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw();
        if (realtime === "on")
            setTimeout(update, updateInterval);
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === "on") {
        update();
    }
    //REALTIME TOGGLE
    $("#realtime .btn").click(function () {
        if ($(this).data("toggle") === "on") {
            realtime = "on";
        } else {
            realtime = "off";
        }
        update();
    });

    /*
     * LINE CHART
     * ----------
     */

    var sin = [],
            cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }
    var line_data1 = {
        data: sin,
        color: "#3c8dbc"
    };
    var line_data2 = {
        data: cos,
        color: "#00c0ef"
    };
    $.plot("#line-chart", [line_data1, line_data2], {
        grid: {
            hoverable: true,
            borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3"
        },
        series: {
            shadowSize: 0,
            lines: {
                show: true
            },
            points: {
                show: true
            }
        },
        lines: {
            fill: false,
            color: ["#3c8dbc", "#f56954"]
        },
        yaxis: {
            show: true,
        },
        xaxis: {
            show: true
        }
    });
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: "absolute",
        display: "none",
        opacity: 0.8
    }).appendTo("body");
    $("#line-chart").bind("plothover", function (event, pos, item) {

        if (item) {
            var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);

            $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                    .css({
                        top: item.pageY + 5,
                        left: item.pageX + 5
                    })
                    .fadeIn(200);
        } else {
            $("#line-chart-tooltip").hide();
        }

    });
    /* END LINE CHART */

    /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    var areaData = [
        [2, 70.0],
        [3, 70.3],
        [4, 90.0],
        [5, 40.5],
        [6, 60.7],
        [7, 50.6],
        [8, 50.6],
        [9, 60.3],
        [10, 60.3],
        [11, 60.4],
        [12, 70.5],
        [13, 90.7],
        [14, 110.9],
        [15, 120.4],
        [16, 120.8],
        [17, 120.7],
        [18, 133.5],
        [19, 145.0]
    ];
    $.plot("#area-chart", [areaData], {
        grid: {
            borderWidth: 0
        },
        series: {
            shadowSize: 0, // Drawing is faster without shadows
            color: "#00c0ef"
        },
        lines: {
            fill: true //Converts the line chart to area chart
        },
        yaxis: {
            show: false
        },
        xaxis: {
            show: false
        }
    });
    /* END AREA CHART */

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
        data: [
            ["January", 10],
            ["February", 8],
            ["March", 4],
            ["April", 13],
            ["May", 17],
            ["June", 9]
        ],
        color: "#3c8dbc"
    };
    $.plot("#bar-chart", [bar_data], {
        grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: "center"
            }
        },
        xaxis: {
            mode: "categories",
            tickLength: 0
        }
    });
    /* END BAR CHART */

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [{
            label: "Element1",
            data: 45,
            color: "#3c8dbc"
        },
        {
            label: "Element2",
            data: 30,
            color: "#0073b7"
        },
        {
            label: "Element3",
            data: 25,
            color: "#00c0ef"
        }
    ];
    $.plot("#donut-chart", donutData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                innerRadius: 0.5,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }

            }
        },
        legend: {
            show: false
        }
    });
    /*
     * END DONUT CHART
     */
}

function getChartJs(type) {
    var config = null;
    if (type === 'doughnut') {
        config = {
            type: 'doughnut',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [
                    {
                        label: "Doughnut chart",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: [2478, 5267, 734, 784, 433]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                }
            }
        }
    } else if (type === 'bar') {
        config = {
            type: 'bar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [
                    {
                        label: "Bar Chart",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: [2478, 2267, 1734, 1784, 1433]
                    }
                ]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                }
            }
        }
    } else if (type === 'radar') {
        config = {
            type: 'radar',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [
                    {
                        label: "1950",
                        fill: true,
                        backgroundColor: "rgba(179,181,198,0.2)",
                        borderColor: "rgba(179,181,198,1)",
                        pointBorderColor: "#fff",
                        pointBackgroundColor: "rgba(179,181,198,1)",
                        data: [10, 30, 25, 16, 12]
                    }, {
                        label: "2050",
                        fill: true,
                        backgroundColor: "rgba(255,99,132,0.2)",
                        borderColor: "rgba(255,99,132,1)",
                        pointBorderColor: "#fff",
                        pointBackgroundColor: "rgba(255,99,132,1)",
                        pointBorderColor: "#fff",
                        data: [20, 18, 25, 14.06, 41.45]
                    }
                ]
            }
            ,
            options: {
                title: {
                    display: true,
                }
            }
        }
    } else if (type === 'polar') {
        config = {
            type: 'polarArea',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [
                    {
                        label: "Polar Area",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: [2478, 3267, 1734, 1784, 1433]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                }
            }
        }
    }
    return config;
}

/* Custom Label formatter */
function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
            label +
            "<br>" +
            Math.round(series.percent) + "%</div>";
}

function drawSparklines() {
    // Bar + line composite charts
    $('#compositebar').sparkline('html', {
        type: 'bar',
        barColor: '#aaf'
    });
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7], {
        composite: true,
        fillColor: false,
        lineColor: 'red'
    });


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html', {
        type: 'line',
        height: '2.5em',
        width: '4em'
    });

    // Customized line chart
    $('#linecustom').sparkline('html', {
        height: '1.5em',
        width: '8em',
        lineColor: '#f00',
        fillColor: '#ffa',
        minSpotColor: false,
        maxSpotColor: false,
        spotColor: '#77f',
        spotRadius: 3
    });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {
        type: 'bar'
    });

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
        type: 'bar',
        tooltipFormat: '{{value:levels}} - {{value}}',
        tooltipValueLookups: {
            levels: $.range_map({
                ':2': 'Low',
                '3:6': 'Medium',
                '7:': 'High'
            })
        }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {
        type: 'tristate'
    });
    $('.sparktristatecols').sparkline('html', {
        type: 'tristate',
        colorMap: {
            '-2': '#fa7',
            '2': '#44f'
        }
    });

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {
        fillColor: false,
        changeRangeMin: 0,
        chartRangeMax: 10
    });
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7], {
        composite: true,
        fillColor: false,
        lineColor: 'red',
        changeRangeMin: 0,
        chartRangeMax: 10
    });

    // Line charts with normal range marker
    $('#normalline').sparkline('html', {
        fillColor: false,
        normalRangeMin: -1,
        normalRangeMax: 8
    });
    $('#normalExample').sparkline('html', {
        fillColor: false,
        normalRangeMin: 80,
        normalRangeMax: 95,
        normalRangeColor: '#4f4'
    });

    // Discrete charts
    $('.discrete1').sparkline('html', {
        type: 'discrete',
        lineColor: 'blue',
        xwidth: 18
    });
    $('#discrete2').sparkline('html', {
        type: 'discrete',
        lineColor: 'blue',
        thresholdColor: 'red',
        thresholdValue: 4
    });

    // Bullet charts
    $('.sparkbullet').sparkline('html', {
        type: 'bullet'
    });

    // Pie charts
    $('.sparkpie').sparkline('html', {
        type: 'pie',
        height: '1.0em'
    });

    // Box plots
    $('.sparkboxplot').sparkline('html', {
        type: 'box'
    });
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18], {
        type: 'box',
        raw: true,
        showOutliers: true,
        target: 6
    });

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
        type: 'box',
        tooltipFormatFieldlist: ['med', 'lq', 'uq'],
        tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
        var sparkline = ev.sparklines[0],
                region = sparkline.getCurrentRegionFields();
        value = region.y;
        alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
        var sparkline = ev.sparklines[0],
                region = sparkline.getCurrentRegionFields();
        value = region.y;
        $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
        $('.mouseoverregion').text('');
    });
}

/* Draw the little mouse speed animated graph */
function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
        var mousex = e.pageX;
        var mousey = e.pageY;
        if (lastmousex > -1) {
            mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
        }
        lastmousex = mousex;
        lastmousey = mousey;
    });
    var mdraw = function () {
        var md = new Date();
        var timenow = md.getTime();
        if (lastmousetime && lastmousetime != timenow) {
            var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
            mpoints.push(pps);
            if (mpoints.length > mpoints_max)
                mpoints.splice(0, 1);
            mousetravel = 0;
            $('#mousespeed').sparkline(mpoints, {
                width: mpoints.length * 2,
                tooltipSuffix: ' pixels per second'
            });
        }
        lastmousetime = timenow;
        setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
}