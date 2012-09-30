<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.common.min.css" rel="stylesheet">
	<link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.blueopal.min.css" rel="stylesheet">
</head>
<body>
	<input data-role="autocomplete" data-bind="source: states" data-text-field="StateName" placeholder="Select A State" />
	
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://cdn.kendostatic.com/2012.2.913/js/kendo.all.min.js"></script>

	<script>

		// specify strict mode. helps keep me from making stupid mistakes.
		'use strict';

		// create a self-invoking anonymous function to make sure that we
		// dont attach any variables to the global namesapce.
		(function($, kendo) {

			// create a new viewModel
			var viewModel = kendo.observable({
				// the states property is the datasource for the autocomplete
				states: new kendo.data.DataSource({
					transport: {
						read: "data/states.php",
						// the parameter map is where we translate the filter value
						// into something the server can understand
						parameterMap: function(options, operation) {
							return {
								StartsWith: options.filter.filters[0].value
							}
						}
					},
					// specify where in our dataset the repeating items are
					schema: {
						data: "data"
					},
					// push filtering to the server
					serverFiltering: true
				})
			})

			// bind the UI to the viewModel using Kendo UI
			kendo.bind(document.body, viewModel);

		})(jQuery, kendo);

	</script>

</body>
</html>