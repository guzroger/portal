<div class="col-lg-12">
	<div id="chartManagerial" style="height: 300px;"></div>
</div>

<script type="text/javascript">
!function($) {
    "use strict";

	var MorrisCharts = function() {};

    MorrisCharts.prototype.createAreaChartDotted = function(element, pointSize, lineWidth, data, xkey, ykeys, labels, Pfillcolor, Pstockcolor, lineColors) {
            Morris.Area({
                element: element,
                pointSize: 3,
                lineWidth: 1,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                labels: labels,
                hideHover: 'auto',
                pointFillColors: Pfillcolor,
                pointStrokeColors: Pstockcolor,
                resize: true,
                gridLineColor: '#eef0f2',
                lineColors: lineColors
            });
        },


    MorrisCharts.prototype.init = function() {

	    var $areaDotData = [
            { y: '2009', a: 10, b: 20 },
            { y: '2010', a: 75,  b: 65 },
            { y: '2011', a: 50,  b: 40 },
            { y: '2012', a: 75,  b: 65 },
            { y: '2013', a: 50,  b: 40 },
            { y: '2014', a: 75,  b: 65 },
            { y: '2015', a: 90, b: 60 }
        ];
        this.createAreaChartDotted('chartManagerial', 0, 0, $areaDotData, 'y', ['a', 'b'], ['Series A', 'Series B'],['#ffffff'],['#999999'], ["#26c6da", "#80deea"]);

	},
    
    $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.MorrisCharts.init();
}(window.jQuery);
</script>