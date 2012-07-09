//script d'utilisation du backoffice.

jQuery(document).ready(function() {

var formfield_img = "";
var formfield_title = "";
var formfield_sub = "";
var formfield_legend = "";
var formfield_code = "";

// Refresh orders of DB slides
jQuery("div#code").each(function () {
	var code = jQuery(this).attr("code_pays");
	refresh_order(code);
	jQuery(".table-"+code).each( function (index) {	
		delete_button (index, code);
		down_button (index, code);
		up_button (index, code);
		upload_button (index, code);
	});
});

function refresh_order(code) {
	var tables  = jQuery(".table-"+code);
	var titles  = jQuery(".title-"+code);
	var subs    = jQuery(".sub-"+code);
	var legends = jQuery(".legend-"+code);
	var urls    = jQuery(".url-"+code);
	var images  = jQuery(".image-"+code);
	var imgurl  = jQuery(".add_media-"+code);
	var uplink  = jQuery(".up-"+code);
	var dwlink  = jQuery(".down-"+code);
	var buttons = jQuery(".remove_table-"+code);
	for (var i = 0; i < tables.length; i++) {
		jQuery(tables[i] ).attr("id"  , "form-table-"+code+"-"+i);
		jQuery(titles[i] ).attr("id"  , "title-"+code+"-"+i);
		jQuery(titles[i] ).attr("name", "title-"+code+"-"+i);
		jQuery(subs[i]   ).attr("id"  , "sub-"+code+"-"+i);
		jQuery(subs[i]   ).attr("name", "sub-"+code+"-"+i);
		jQuery(images[i] ).attr("id"  , "image-"+code+"-"+i);
		jQuery(images[i] ).attr("name", "image-"+code+"-"+i);
		jQuery(imgurl[i] ).attr("id"  , "content-add_media-"+code+"-"+i);
		jQuery(legends[i]).attr("id"  , "legend-"+code+"-"+i);
		jQuery(legends[i]).attr("name", "legend-"+code+"-"+i);
		jQuery(urls[i]   ).attr("id"  , "url-"+code+"-"+i);
		jQuery(urls[i]   ).attr("name", "url-"+code+"-"+i);
		jQuery(uplink[i] ).attr("id"  , "up-"+code+"-"+i);
		jQuery(uplink[i] ).attr("count", i);
		jQuery(dwlink[i] ).attr("id"  , "down-"+code+"-"+i);
		jQuery(dwlink[i] ).attr("count", i);
		jQuery(buttons[i]).attr("id"  , "remove_table-"+code+"-"+i);
		jQuery(buttons[i]).attr("name", "form-table-"+code+"-"+i);
	}
}

function delete_button (activeCount, code) {
	jQuery("#remove_table-"+code+"-"+activeCount).click(function() {
		jQuery("#"+jQuery(this).attr('name')).delay('1000').fadeOut('slow').remove();
		jQuery(this).remove();
		refresh_order(code);
	});
}

function down_button (activeCount, code) {
	jQuery("#down-"+code+"-"+activeCount).click(function() {
		if (jQuery(this).attr("count") != jQuery(".table-"+code).length-1) {
			var current = jQuery("#form-table-"+code+"-"+jQuery(this).attr("count"));
			current.next().after(current);
			refresh_order(code);
		}
	});
}

function up_button (activeCount, code) {
	jQuery("#up-"+code+"-"+activeCount).click(function() {
		if (jQuery(this).attr("count") != 0) {
			var current = jQuery("#form-table-"+code+"-"+(jQuery(this).attr("count")-1));
			current.next().after(current);
			refresh_order(code);
		}
	});
}

function upload_button (activeCount, code) {
	jQuery("#content-add_media-"+code+"-"+activeCount).click(function() {
		formfield_img    = jQuery(this).next();
		formfield_title  = jQuery(jQuery(this).parents('tr').siblings().get(0)).find('td>input');
		formfield_sub    = jQuery(jQuery(this).parents('tr').siblings().get(1)).find('td>input');
		formfield_legend = jQuery(jQuery(this).parents('tr').siblings().get(2)).find('td>input');
	});
}

if(jQuery('form.content_home').length > 0) {
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html);
		if(formfield_img !== ""){
			formfield_img.siblings("p").remove();
			formfield_img.val(imgurl.attr('src'));
			var p = jQuery(formfield_img.after(jQuery('<p>',{class:"img_home"}))).next();
			p.append(imgurl);  
		}
		if(formfield_title !== "" && formfield_title.attr("value") == ""){
			formfield_title.val(imgurl.attr('title'));
		}
		if(formfield_sub !== "" && formfield_sub.attr("value") == ""){
			formfield_sub.val(imgurl.attr('alt'));
		}
		if(formfield_legend !== "" && formfield_legend.attr("value") == ""){
			var str = html.match(/<\/a>(.+)\[\/caption\]/);
			if (str !== null)
				formfield_legend.val(str[1]);
		}
		tb_remove();
	}
}

jQuery("#select_themes").change(function update_preview() {
	var translater = jQuery("#translater");
	var current = jQuery('#select_themes option:selected').val();
	var screenshot = "";
	
	var allText = "";
	var txtFile = new XMLHttpRequest();
	txtFile.open("GET", "../wp-content/plugins/wp-multilingual-slider/themes/"+current+"/README.mdown", true);
	txtFile.onreadystatechange = function() {
  		if (txtFile.readyState === 4) {
    		if (txtFile.status === 200) {
      		allText = txtFile.responseText; 
				var converter = new Showdown.converter();
				var html = converter.makeHtml(allText);
				jQuery("#current-theme").append(
					'<div style="float: right;width: 50%;height: 500px;border: solid 1px;overflow-y: scroll;overflow-x: auto;position: absolute;top: 50px;right: 0px;background: #EEE;">'+html+'</div>'
				);
    		}
  		}
	}
	txtFile.send(null);

	jQuery("#current-theme").remove();
	if (jQuery("#select_themes option:selected").attr("screenshot") == "true") {
		screenshot = '<img id="theme_preview" src="../wp-content/plugins/wp-multilingual-slider/themes/'+current+'/screenshot.png" />';
	}
	jQuery("#select_themes").after(
		'<div id="current-theme" class="has-screenshot">'+
			screenshot+
			'<h3>Selected theme</h3>'+
			'<h4>'+current+'</h4>'+
			'<button type="button" id="save_themes" class="button-primary">'+translater.attr("savbut")+'</button>'+
		'</div>'
	);
	update_save_themes_button();
});

jQuery("#select_themes").change();

jQuery(function() {
	jQuery(".add").each ( function () {
		var code = jQuery(this).attr('code_pays');
		jQuery("#slide_list-"+code).sortable({
			update: function(event, ui) {
				refresh_order(code)
			}
		});
	});
});

jQuery(function() {
	jQuery("#tabs").tabs();
});

/***ADD SLIDE***/
jQuery(".add").click('bind',function() {
	var code = jQuery(this).attr('code_pays');
	var activeCount = jQuery(".table-"+code).length;
	var last_slide = jQuery("#form-table-"+code+"-"+parseInt(activeCount-1));
	var translater = jQuery("#translater");
	if (!last_slide.is('*')) {
		last_slide = jQuery("#sentinel-"+code);
	}
	last_slide.after(
		'<table class="table-'+code+'" id="form-table-'+code+'-'+activeCount+'">'+
			'<tr align="left">'+
				'<th scope="row">'+translater.attr("title")+' :</th>'+
				'<td>'+
					'<input name="title-'+code+'-'+activeCount+'" class="title-'+code+'" id="title-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'<tr align="left">'+
				'<th scope="row">'+translater.attr("sub")+' :</th>'+
				'<td>'+
					'<input name="sub-'+code+'-'+activeCount+'" class="sub-'+code+'" id="sub-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+translater.attr("leg")+' :</th>'+
				'<td>'+
					'<input name="legend-'+code+'-'+activeCount+'" class="legend-'+code+'" id="legend-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+translater.attr("url")+' :</th>'+
				'<td>'+
					'<input name="url-'+code+'-'+activeCount+'" class="url-'+code+'" id="url-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+translater.attr("img")+' :</th>'+
				'<td>'+
					'<a href="media-upload.php?post_id=1&amp;TB_iframe=1" class="thickbox add_media" id="content-add_media-'+code+'-'+activeCount+'" title="Add Media" onclick="return false;">'+
					translater.attr("upld")+'</a>'+
					'<input class="image-'+code+'" name="image-'+code+'-'+activeCount+'" id="image-'+code+'-'+activeCount+'" type="hidden" ></textarea>'+
				'</td>'+
			'</tr>'+
			'<tr>'+
				'<th>'+
					'<a class="up-'+code+'" id="up-'+code+'-'+activeCount+'" count='+activeCount+' href="#" onclick="return false;">'+translater.attr("up")+'</a> / '+
					'<a class="down-'+code+'" id="down-'+code+'-'+activeCount+'" count='+activeCount+' href="#" onclick="return false;">'+translater.attr("down")+'</a>'+
				'</th>'+
				'<td>'+
					'<button type="button" style="border-color:#FF4D1A;background:#FF4D1A;'+
					'float:right;"id="remove_table-'+code+'-'+activeCount+'"'+
					'class="remove_table-'+code+' button-primary" name="form-table-'+code+'-'+activeCount+'">'+translater.attr("del")+'</button>'+
				'</td>'+
			'</tr>'+
	'</table>'
	);

	delete_button (activeCount, code);
	down_button (activeCount, code);
	up_button (activeCount, code);
	upload_button (activeCount, code);

});

/***SAVE FUNTION***/
jQuery("#save_home").click('bind',function() {
	var translater = jQuery("#translater");
	var content = "";
	var i = 0;
	jQuery("div#code").each(function (index) {
		var code = jQuery(this).attr("code_pays");
		jQuery("#home_content\\["+code+"\\]").attr("value", 
			JSON.stringify(jQuery("#content_home-"+code).serializeArray())
		);
	});
	jQuery("#home_handler input").each(function (index) {
		if (i != 0) {
			content += "&";
		}
		content += jQuery(this).attr("name");
		content += "=";
		content += jQuery(this).attr("value");
		i++;
	});
	jQuery("#home_handler").append("<div class='message'>"+translater.attr("save")+"...</div>");
	jQuery.ajax({
		type: "post",
		url: "options.php",
		data: content,
		success: function(msg) {
			jQuery(".message").html(translater.attr("saved"));
			jQuery(".message").delay('1000').fadeOut('slow');
		},
		error: function(msg){
			jQuery(".message").html(translater.attr("saverr"));
			jQuery(".message").delay('1000').fadeOut('slow');
		}
	});
});

function update_save_themes_button () {
	jQuery("#save_themes").click("bind", function() {
		var translater = jQuery("#translater");
		var content = "";
		var i = 0;
		jQuery("#home_themes input").each(function (index) {
			if (i != 0) {
				content += "&";
			}
			content += jQuery(this).attr("name");
			content += "=";
			content += jQuery(this).attr("value");
			i++;
		});
		jQuery("#home_themes select").each(function () {
			content += "&";
			content += jQuery(this).attr("name");
			content += "=";
			content += jQuery(this).attr("value");
		});
		jQuery("#home_themes").append("<div class='message'>"+translater.attr("save")+"...</div>");
		jQuery.ajax({
			type: "post",
			url: "options.php",
			data: content,
			success: function(msg) {
				jQuery(".message").html(translater.attr("saved"));
				jQuery(".message").delay('1000').fadeOut('slow');
			},
			error: function(msg){
				jQuery(".message").html(translater.attr("saverr"));
				jQuery(".message").delay('1000').fadeOut('slow');
			}
		});
	});
}

});

