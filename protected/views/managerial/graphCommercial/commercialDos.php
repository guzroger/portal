<div class="col-lg-12">
	<div id="chartManagerial" style="height: 300px;"></div>
</div>
<script type="text/javascript">
!function($) {
    "use strict";

	var MorrisCharts = function() {};

    MorrisCharts.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true, //defaulted to true
            colors: colors
        });
    },

    MorrisCharts.prototype.init = function() {
	    var $data = [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
        ];
        this.createDonutChart('chartManagerial', $data, ["#3bafda", "#ededed", "#80deea"]);
	},
    
    $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.MorrisCharts.init();
}(window.jQuery);
</script>