(function (namespace, $) {
	"use strict";

	var DemoDashboard = function () {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function () {
			o.initialize();
		});

	};
	var p = DemoDashboard.prototype;

	// =========================================================================
	// MEMBERS
	// =========================================================================

	p.rickshawSeries = [[], []];
	p.rickshawGraph = null;
	p.rickshawRandomData = null;
	p.rickshawTimer = null;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function () {
		this._initSparklines();
		this._initFlotVisitors();
		this._initRickshaw();
		this._initKnob();
		this._initFlotRegistration();
	};

	// =========================================================================
	// Sparklines
	// =========================================================================

	p._initSparklines = function () {
		// Generate random sparkline data
		

	
	};
	
	// =========================================================================
	// FLOT
	// =========================================================================

	p._initFlotVisitors = function () {
		
		};

	// =========================================================================
	// Rickshaw
	// =========================================================================

	p._initRickshaw = function () {
		// Don't init a rickshaw graph twice
		if (this.rickshawGraph !== null) {
			return;
		}

		var o = this;

		// Create random data
		this.rickshawRandomData = new Rickshaw.Fixtures.RandomData(50);
		for (var i = 0; i < 75; i++) {
			this.rickshawRandomData.addData(this.rickshawSeries);
		}
		
		// Update knob charts
		this._updateKnob();

		// Init Richshaw graph
		this.rickshawGraph = new Rickshaw.Graph({
			element: $('#rickshawGraph').get(0),
			width: $('#rickshawGraph').closest('.card-body').width(),
			height: $('#rickshawGraph').height(),
			interpolation: 'linear',
			renderer: 'area',
			series: [
				{
					data: this.rickshawSeries[0],
					color: $('#rickshawGraph').data('color1'),
					name: ''
				}, {
					data: this.rickshawSeries[1],
					color: $('#rickshawGraph').data('color2'),
					name: ''
				}
			]
		});

		// Add hover info
		var hoverDetail = new Rickshaw.Graph.HoverDetail({
			graph: this.rickshawGraph
		});

		// Render graph
		this.rickshawGraph.render();

		// Add animated data
		clearInterval(this.rickshawTimer);
		this.rickshawTimer = setInterval(function () {
			o._refreshRickshaw();
		}, 2000);

		materialadmin.App.callOnResize(function () {
			o.rickshawGraph.configure({
				height: $('#rickshawGraph').height(),
				width: $('#rickshawGraph').closest('.card-body').outerWidth()
			});
			o.rickshawGraph.render();
		});
	};

	p._refreshRickshaw = function () {
		this.rickshawRandomData.removeData(this.rickshawSeries);
		this.rickshawRandomData.addData(this.rickshawSeries);
		this.rickshawGraph.update();
		this._updateKnob();
	};

	// =========================================================================
	// KNOB
	// =========================================================================

	p._initKnob = function () {
		if (!$.isFunction($.fn.knob)) {
			return;
		}

		$('.dial').each(function () {
			var options = materialadmin.App.getKnobStyle($(this));
			$(this).knob(options);
		});
	};

	p._updateKnob = function () {
		var val1 = this.rickshawSeries[0][this.rickshawSeries[0].length - 2];
		var val2 = this.rickshawSeries[0][this.rickshawSeries[0].length - 1];

		$({animatedVal: val1.y}).animate({animatedVal: val2.y}, {
			duration: 1200,
			easing: "swing",
			step: function () {
				$('#serverStatusKnob input').val(Math.ceil(this.animatedVal)).trigger("change");
			}
		});
	};
	
	// =========================================================================
	// FLOT
	// =========================================================================

	p._initFlotRegistration = function () {};

	// =========================================================================
	namespace.DemoDashboard = new DemoDashboard;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
