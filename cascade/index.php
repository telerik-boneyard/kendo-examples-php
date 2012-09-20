<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.common.min.css" rel="stylesheet">
	<link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.metro.min.css" rel="stylesheet">
	<style>
		#orders {
			margin-top: 20px;
			display: none;
		}
	</style>
</head>
<body>
	
	<input id="categories" />
	<input id="products" />
	<div id="orders"></div>

		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="http://cdn.kendostatic.com/2012.2.913/js/kendo.all.min.js"></script>

		<script>

		var MYAPP = (function($, kendo) {

			$("#categories").kendoDropDownList({
				dataSource: new kendo.data.DataSource({
					transport: {
						read: "data/categories.php"
					},
					schema: {
						data: "data"
					}
				}),
				change: function() {
					// if the grid is visible
					if ($("#orders").is(":visible")) {
						// animate it out and hide it
						$("#orders").kendoAnimate({
							effects: "slide:down fade:out",
							hide: true
						});
					}
				},
			    optionLabel: "Select A Category",
				dataTextField: "CategoryName",
				dataValueField: "CategoryID"
			});

			$("#products").kendoDropDownList({
    			dataSource: new kendo.data.DataSource({
        			transport: {
            			read: "data/products.php",
            			parameterMap: function(options, operation) {
            				return {
            					CategoryID: options.filter.filters[0].value
            				}
            			}
		        	},
		        	schema: {
		            	data: "data"
		        	},
		        	serverFiltering: true
		        }),
		        optionLabel: "Select A Product",
		        dataTextField: "ProductName",
		        dataValueField: "ProductID",
		        cascadeFrom: "categories",
		        autoBind: false,
		        change: function(e) {
		        	// first zoom the grid out
		        	$("#orders").kendoAnimate({
		        		effects: "zoom:out fade:out",
		        		complete: function() {
		        			// the products DropDown is e.sender. to get it's selected value
			        		// call the view() method
			        		productId = e.sender.value();
			        		// tell the grid datasource to read
			        		$("#orders").data("kendoGrid").dataSource.read();
		        			// zoom the grid back in
		        			$("#orders").kendoAnimate({
		        				effects: "zoom:out fade:out",
		        				reverse: true,
		        				show: true
		        			});
		        		}
		        	});
    			}
		    });

			// create a product variable to hold the selected
			// product id.  set it to 0 by default
			var productId = 0;
			$("#orders").kendoGrid({
				columns: [{ field: 'OrderID', title: 'Order ID'},
						 { field: 'ShipName', title: 'Name'}, 
						 { field: 'ShipCity', title: 'City' },
						 { field: 'ShipRegion', title: 'Region'}],
				dataSource: new kendo.data.DataSource({
					transport: {
						read: "data/orders.php",
						parameterMap: function(options, operation) {
						    // return the value of the selected product
						    return {
						        ProductID: productId
						    }
						}
					},
					schema: {
						data: "data",
						total: "total"
					},
					pageSize: 5
				}),
				pageable: true,
				autoBind: false
			});

		})(jQuery, kendo);

	</script>

</body>
</html>