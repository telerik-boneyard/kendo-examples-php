<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>SVG Export with Inkscape</title>
    <link href="http://cdn.kendostatic.com/2013.2.716/styles/kendo.dataviz.min.css" rel="stylesheet" />
    <link href="http://cdn.kendostatic.com/2013.2.716/styles/kendo.dataviz.default.min.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://cdn.kendostatic.com/2013.2.716/js/kendo.all.min.js"></script>
</head>
<body>
    <div>
        <button class="export" data-format="png">
            Export to PNG
        </button>
        <button class="export" data-format="pdf">
            Export to PDF
        </button>
    </div>
    <div id="chart" style="width: 800px; height: 600px">
    </div>
    <div style="display: none;">
        <form id="exportForm" action="export.php" method="POST">
            <input type="hidden" id="exportString" name="svg" />
            <input type="hidden" id="exportFormat" name="format" />
        </form>
    </div>
    <script>
        $("#chart").kendoChart({
            title: {
                text: "Internet Users"
            },
            legend: {
                position: "bottom"
            },
            chartArea: {
                background: ""
            },
            seriesDefaults: {
                type: "bar"
            },
            series: [{
                name: "World",
                data: [15.7, 16.7, 20, 23.5, 26.6]
            }, {
                name: "United States",
                data: [67.96, 68.93, 75, 74, 78]
            }],
            valueAxis: {
                labels: {
                    format: "{0}%"
                }
            },
            categoryAxis: {
                categories: [2005, 2006, 2007, 2008, 2009]
            },
            tooltip: {
                visible: true,
                format: "{0}%"
            }
        });

        $(".export").click(function () {
            var chart = $("#chart").data("kendoChart");
            var svgString = escape(chart.svg());
            var exportFormat = $(this).data("format");

            $("#exportString").val(svgString);
            $("#exportFormat").val(exportFormat);
            $("#exportForm").submit();
        });
    </script>
</body>
</html>
