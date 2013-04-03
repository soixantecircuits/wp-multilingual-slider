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
		update_iframe (index, code);
	});
	jQuery(".ext-"+code).each(function() {
		jQuery(this).trigger('keyup');
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
	var extcnt  = jQuery(".ext-"+code);
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
		jQuery(extcnt[i] ).attr("id"  , "ext-"+code+"-"+i);
		jQuery(extcnt[i] ).attr("name", "ext-"+code+"-"+i);
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

function test_iframe (activeCount, code) {

}

function update_iframe (activeCount, code) {
	jQuery("#ext-"+code+"-"+activeCount).keyup(function() {
		if (jQuery(this).val() != "") {
			jQuery("#form-table-"+code+"-"+activeCount).find("p.img_home").css("background-color","#000");
			jQuery("#form-table-"+code+"-"+activeCount).find("p>img").css("opacity","0.5");
		} else {
			jQuery("#form-table-"+code+"-"+activeCount).find("p.img_home").css("background-color","#fff");
			jQuery("#form-table-"+code+"-"+activeCount).find("p>img").css("opacity","1");
		}
	});
}

if(jQuery('form.content_home').length > 0) {
	window.send_to_editor = function(html) {
		imgurl = jQuery(html, 'img');
		if( (imgurl.attr('href') !== '') && (imgurl.attr("href") !== undefined)){
			imgurl = jQuery(imgurl.html());
		}
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
	var current = jQuery('#select_themes option:selected').val();
	var screenshot = "";
	var isInThemes = false;
	if (current.indexOf("_THEMES_") != -1) {
		isInThemes = true;
		current = current.replace("_THEMES_", "");
	}
	var themes = isInThemes ? "themes/"+loc.themes_name+"/" : "";

	if (current !== 'none') {
		var allText = "";
		var txtFile = new XMLHttpRequest();
		txtFile.open("GET", "../wp-content/"+ themes +"plugins/wp-multilingual-slider/themes/"+current+"/README.mdown", true);
		txtFile.onreadystatechange = function() {
			if (txtFile.readyState === 4) {
				if (txtFile.status === 200) {
					allText = txtFile.responseText;
					var converter = new Showdown.converter();
					var html = converter.makeHtml(allText);
					jQuery(".markdown").html(html);
				}
			}
		}
		txtFile.send(null);
	}

	jQuery("#currenttheme").remove();
	if (jQuery("#select_themes option:selected").attr("screenshot") == "true") {
		screenshot = '<img id="theme_preview" src="../wp-content/'+ themes +'plugins/wp-multilingual-slider/themes/'+current+'/screenshot.png" />';
	}
	jQuery("#selector").after(
		'<div id="currenttheme" class="has-screenshot">'+
		  '<div class="container width-3">'+
				'<h3>Selected theme</h3>'+
				'<h4>'+current+'</h4>'+
				'<button type="button" id="save_themes" class="button-primary">'+loc.savbut+'</button>'+
				screenshot+
			'</div>'+	
			'<div class="markdown width-2"></div>'+
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
	if (jQuery("#select_themes option:selected").val() == 'none') {
		alert("Please choose a theme slider before");
		return;
	}
	var code = jQuery(this).attr('code_pays');
	var activeCount = jQuery(".table-"+code).length;
	var last_slide = jQuery("#form-table-"+code+"-"+parseInt(activeCount-1));
	if (!last_slide.is('*')) {
		last_slide = jQuery("#sentinel-"+code);
	}
	last_slide.after(
		'<table class="table-'+code+'" id="form-table-'+code+'-'+activeCount+'">'+
			'<tr align="left">'+
				'<th scope="row">'+loc.title+' :</th>'+
				'<td>'+
					'<input name="title-'+code+'-'+activeCount+'" class="title-'+code+'" id="title-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'<tr align="left">'+
				'<th scope="row">'+loc.sub+' :</th>'+
				'<td>'+
					'<input name="sub-'+code+'-'+activeCount+'" class="sub-'+code+'" id="sub-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+loc.leg+' :</th>'+
				'<td>'+
					'<input name="legend-'+code+'-'+activeCount+'" class="legend-'+code+'" id="legend-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+loc.url+' :</th>'+
				'<td>'+
					'<input name="url-'+code+'-'+activeCount+'" class="url-'+code+'" id="url-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+loc.img+' :</th>'+
				'<td>'+
					'<a href="media-upload.php?post_id=0&amp;TB_iframe=1" class="thickbox add_media" id="content-add_media-'+code+'-'+activeCount+'" title="Add Media" onclick="return false;">'+
					loc.upld+'</a>'+
					'<input class="image-'+code+'" name="image-'+code+'-'+activeCount+'" id="image-'+code+'-'+activeCount+'" type="hidden" ></textarea>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">'+loc.ext+' :</th>'+
				'<td>'+
					'<input name="ext-'+code+'-'+activeCount+'" class="ext-'+code+'" id="ext-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr>'+
				'<th>'+
					'<a class="up-'+code+'" id="up-'+code+'-'+activeCount+'" count='+activeCount+' href="#" onclick="return false;">'+loc.up+'</a> / '+
					'<a class="down-'+code+'" id="down-'+code+'-'+activeCount+'" count='+activeCount+' href="#" onclick="return false;">'+loc.down+'</a>'+
				'</th>'+
				'<td>'+
					'<button type="button" style="border-color:#FF4D1A;background:#FF4D1A;'+
					'float:right;"id="remove_table-'+code+'-'+activeCount+'"'+
					'class="remove_table-'+code+' button-primary" name="form-table-'+code+'-'+activeCount+'">'+loc.del+'</button>'+
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
	var content = "";
	var i = 0;
	jQuery("div#code").each(function (index) {
		var code = jQuery(this).attr("code_pays");
		jQuery(".ext-"+code).each(function() {
			var str = jQuery(this).val().replace(/\"/g, "\'");
			jQuery(this).val(str);
		});
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
	content = content.replace(/\\"/g, "'");
	jQuery("#home_handler").append("<div class='message'>"+loc.save+"...</div>");
	jQuery.ajax({
		type: "post",
		url: "options.php",
		data: content,
		success: function(msg) {
			jQuery(".message").html(loc.saved);
			jQuery(".message").delay('1000').fadeOut('slow');
		},
		error: function(msg){
			jQuery(".message").html(loc.saverr);
			jQuery(".message").delay('1000').fadeOut('slow');
		}
	});
});

function update_save_themes_button () {
	jQuery("#save_themes").click("bind", function() {
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
		jQuery("#currenttheme").append("<div class='message'>"+loc.save+"...</div>");
		jQuery.ajax({
			type: "post",
			url: "options.php",
			data: content,
			success: function(msg) {
				jQuery(".message").html(loc.saved);
				jQuery(".message").delay('1000').fadeOut('slow');
			},
			error: function(msg){
				jQuery(".message").html(loc.saverr);
				jQuery(".message").delay('1000').fadeOut('slow');
			}
		});
	});
}

jQuery("#save_json").click(function () {
	var content = new Array();
	jQuery("div#code").each(function (index) {
		var code = jQuery(this).attr("code_pays");
		jQuery(".ext-"+code).each(function() {
			var str = jQuery(this).val().replace(/"/g, "'");
			jQuery(this).val(str);
		});
		var form = jQuery("#content_home-"+code);
		if(form.replace !== undefined){
			content.push(code, (form.replace(/"/g, "'").serializeArray()));
		} else {
			content.push(code, (form.html(form.html().replace(/"/g, "'")).serializeArray()));
		}
	});
	var uriContent = "data:application/octet-stream," + encodeURIComponent(JSON.stringify(content));
	var newWindow = window.open(uriContent, 'slides_export.json');
});

jQuery("#load_json").click(function () {
	
	var content = jQuery("#data_json").val();

	if (content !== "") {
		var obj = {};
		try
		{
	  	 obj = JSON.parse(content);
	  	 jQuery("div#code").each(function (index) {
					var code = jQuery(this).attr("code_pays");
					for (var i = 0; i < obj.length; i+=2) {
						if (obj[i] == code) {
							jQuery("#json_content\\["+code+"\\]").attr("value", JSON.stringify(obj[i+1]));
						}
					}
			  });
			jQuery("#json_handler").submit();
		}
		catch(e)
		{
	  	 alert(loc.jsonformat);
		}
	} else {
		alert(loc.empty);
	}
});
});

