// Function to initialize a doughnut chart
function initializeDoughnutChart(chartElement, chartData, chartOptions) {
    var ctx = chartElement.getContext('2d');

    // Register plugin for displaying data percentages inside the chart segments
    Chart.pluginService.register({
        beforeDraw: function (chart) {
            var width = chart.chart.width,
                height = chart.chart.height,
                ctx = chart.chart.ctx;

            ctx.restore();
            var fontSize = (height / 114).toFixed(2);
            ctx.font = fontSize + "em sans-serif";
            ctx.textBaseline = "middle";

            var text = "75%", // Default text to display if no data provided
                dataSum = 0;

            // Calculate the sum of data values
            chart.data.datasets.forEach(function (dataset) {
                dataset.data.forEach(function (element) {
                    dataSum += element;
                });
            });

            if (dataSum > 0) {
                var percentage = Math.round((chart.data.datasets[0].data[0] / dataSum) * 100);
                text = percentage + "%";
            }

            var textX = Math.round((width - ctx.measureText(text).width) / 2),
                textY = height / 2;

            ctx.fillText(text, textX, textY);
            ctx.save();
        }
    });

    // Create the doughnut chart instance
    var myDoughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: chartData,
        options: chartOptions
    });
}

// Example usage:
var doughnutChartAvailable = document.getElementById('doughnutChartAvailable');
var data1 = {
    datasets: [{
        data: [appraovedPercentage, 100 - appraovedPercentage],
        backgroundColor: ["#32CD32", "#f3f3f3"],
    }],
};
var options1 = {
    responsive: true,
    maintainAspectRatio: false,
    cutoutPercentage: 60,
    tooltips: {
        enabled: false
    },
    layout: {
        padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
        },
    },
};

initializeDoughnutChart(doughnutChartAvailable, data1, options1);

// Repeat for additional charts
var doughnutChartRejected = document.getElementById('doughnutChartRejected');
var data2 = {
    datasets: [{
        data: [rejectPercentage, 100 - rejectPercentage],
        backgroundColor: ["#00BFFF", "#f3f3f3"],
    }],
};
var options2 = {
    responsive: true,
    maintainAspectRatio: false,
    cutoutPercentage: 60,
    tooltips: {
        enabled: false
    },
    layout: {
        padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
        },
    },
};

initializeDoughnutChart(doughnutChartRejected, data2, options2);

// Repeat for additional charts
var doughnutChartPending = document.getElementById('doughnutChartPending');
var data3 = {
    datasets: [{
        data: [pendingPercentage, 100 - pendingPercentage],
        backgroundColor: ["#FF4500", "#f3f3f3"],
    }],
};
var options3 = {
    responsive: true,
    maintainAspectRatio: false,
    cutoutPercentage: 60,
    tooltips: {
        enabled: false
    },
    layout: {
        padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
        },
    },
};

initializeDoughnutChart(doughnutChartPending, data3, options3);