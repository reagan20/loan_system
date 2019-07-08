$(function () {
    new Chart(document.getElementById("doughnut-chart").getContext("2d"), getChartJs('doughnut'));
    new Chart(document.getElementById("bar-chart").getContext("2d"), getChartJs('bar'));
    new Chart(document.getElementById("radar-chart").getContext("2d"), getChartJs('radar'));
    new Chart(document.getElementById("polar-chart").getContext("2d"), getChartJs('polar'));
});

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
