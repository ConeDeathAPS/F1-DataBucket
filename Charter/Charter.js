
var Charter = (function() {
	var data;
	var bar_height_multiplier;
	var bar_width;
	var bcolor;
	var ccolor;
	var lcolor;
	var hcolor;
	var label_color
	var name;
	var x_text;
	var y_text;
	var bar_label_color;
	var border_color;
	var easing;
	return {
		get_styling: function(properties) {
			bcolor = properties.bar_color;
			ccolor = properties.chart_background;
			lcolor = properties.label_background;
			hcolor = properties.header_color;
			label_color = properties.label_color;
			name = properties.chart_name;
			x_text = properties.x_axis_labels;
			y_text = properties.y_axis_labels;
			bar_label_color = properties.bar_label_color;
			border_color = properties.border_color;
			bar_easing = properties.easing;
		},
		auto_scaling: function(user_data, user_height, user_width) {
			var max = 0;
			data = [];
			// console.log(length);
			for (i = 0; i < user_data.length; i++) {
				data.push(Number(user_data[i]));
				if (data[i] > max) {
					max = data[i];
				}
			}
			//get the bar height multiplier. We will multiply each data value by this multiplier in order to get the height of each bar in pixels
			// console.log(max);
			bar_height_multiplier = ((user_height - 30) / max);
			//this will calculate how wide each bar should be
			bar_width = ((user_width - (data.length * 10))/data.length);
			var scaling = [bar_height_multiplier, bar_width];
			return scaling;
		},
		draw_chart: function(chartID, data, height, width) {
			//declare some local variables
			var chart = document.getElementById(chartID);
			var scaling = this.auto_scaling(data, height, width);
			//add a container for holding the bars and separating them from the outside of the container
			chart.innerHTML = "<h2 style='text-align:center;margin:5px;font-family:arial;color:"+hcolor+";'>" + name + "</h2><div id='chart_container' height='" + (height) +"' width='" + (width) + "' style='margin:5px auto;vertical-align:middle;background:" + ccolor + ";border-bottom:2px solid " + border_color + ";border-left:2px solid " + border_color + ";display:inline-block;'></div>";
			//format the styling of the chart main container
			chart.setAttribute("style", "width:" + (width + 5) + "px;background-color:" + lcolor + ";display:inline-block;height:"+height+";");
			//set the chart_data container we just made to a local variable
			var chart_data = document.getElementById("chart_container");
			//populate the bars
			for (i = 0; i < data.length; i++) {
				if (bar_easing != "") {
					var div = document.createElement('div');
					div.setAttribute("id", "bar" + i);
					div.setAttribute("style", "height:0px; width:" + scaling[1] + "px; background-color:" + bcolor + ";display:inline-block;vertical-align:bottom;margin:0px 5px;overflow:hidden;");
					div.innerHTML = "<p class='bar_label' style='text-align:center;color:" + bar_label_color + ";font-family:arial;font-weight:bold;margin-bottom:5px;'>" + data[i] + "</p>";
					chart_data.appendChild(div);	
				} else {
					var div = document.createElement('div');
					div.setAttribute("id", i);
					div.setAttribute("style", "height:" + (data[i] * scaling[0]) +"px; width:" + scaling[1] + "px; background-color:" + bcolor + ";display:inline-block;vertical-align:bottom;margin:0px 5px;overflow:hidden;");
					div.innerHTML = "<p class='bar_label' style='text-align:center;color:" + bar_label_color + ";font-family:arial;font-weight:bold;margin-bottom:5px;'>" + data[i] + "</p>";
					chart_data.appendChild(div);	
				}
			}
			//begin populating labels if the user specified values for them
			if (x_text) {
				var x_labels_container = document.createElement("ul");
				x_labels_container.setAttribute("style", "vertical-align:bottom;height:20px;list-style-type:none;margin:0px;padding-left:3px;");
				chart.appendChild(x_labels_container);
				for (i = 0; i < x_text.length; i++) {
					var label = document.createElement("li");
					// console.log(label);
					label.setAttribute("id", "label" + i);
					label.setAttribute("style", "list-style-type:none;display:inline-block;width:" + scaling[1] + "px;margin:0px 5px;text-align:center;color:" + label_color + ";");
					label.innerHTML = x_text[i];
					x_labels_container.appendChild(label);
				}
			}
			if (bar_easing != "") {
				for (i = 0; i < data.length; i++) {
					if (data[i] != 0) {
						$("#bar" + i).animate({height: data[i]*scaling[0]}, 250, bar_easing, function(){});			
					}		
				}

			}
		}
	}
})();