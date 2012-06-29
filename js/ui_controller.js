//script d'utilisation du backoffice.

jQuery(document).ready(function() {

var formfield_img = "";
var formfield_title = "";
var formfield_legend = "";

jQuery(".add_media").click(function() {
	formfield_img = jQuery(this).siblings();
	formfield_title = jQuery(jQuery(this).parents('tr').siblings().get(0)).find('td>textarea')
	formfield_legend = jQuery(jQuery(this).parents('tr').siblings().get(1)).find('td>textarea')
	//tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
});

if(jQuery('form#content_home').length > 0) {
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html);
		if(formfield_img !== ""){
			formfield_img.val(imgurl.attr('src'));
			var p = jQuery(formfield_img.before(jQuery('<p>',{class:"img_home"}))).prev();
			p.append(imgurl);  
		}
		if(formfield_title !== ""){
			formfield_title.val(imgurl.attr('title'));
		}
		if(formfield_legend !== ""){
			var str = html.match(/<\/a>(.+)\[\/caption\]/)[1];
			formfield_legend.val(str);
		}
		tb_remove();
	}
}

function refresh_order(code) {
	var tables  = jQuery(".table-"+code);
	var titles  = jQuery(".title-"+code);
	var images  = jQuery(".image-"+code);
	var imgurl  = jQuery(".thickbox");
	var legends = jQuery(".legend-"+code);
	var urls    = jQuery(".url-"+code);
	var buttons = jQuery(".removeTable_home");
	for (var i = 0; i < tables.length; i++) {
		jQuery(tables[i] ).attr("id"  , "form-table-"+code+"-"+i);
		jQuery(titles[i] ).attr("id"  , "title-"+code+"-"+i);
		jQuery(titles[i] ).attr("name", "title-"+code+"-"+i);
		jQuery(images[i] ).attr("id"  , "image-"+code+"-"+i);
		jQuery(images[i] ).attr("name", "image-"+code+"-"+i);
		jQuery(imgurl[i] ).attr("id"  , "content-add_media-"+i);
		jQuery(legends[i]).attr("id"  , "legend-"+code+"-"+i);
		jQuery(legends[i]).attr("name", "legend-"+code+"-"+i);
		jQuery(urls[i]   ).attr("id"  , "url-"+code+"-"+i);
		jQuery(urls[i]   ).attr("name", "url-"+code+"-"+i);
		jQuery(buttons[i]).attr("id"  , "remove_table-"+i);
		jQuery(buttons[i]).attr("name", "form-table-"+code+"-"+i);
	}
}

jQuery(function() {
	jQuery("#slide_list").sortable({
		update: function(event, ui) {
			refresh_order(jQuery("#add_slide").attr('code_pays'))
		}
	});
});

/***ADD SLIDE***/
jQuery(".add").click('bind',function() {
	var code = jQuery(this).attr('code_pays');
	var activeCount = jQuery(".table-"+code).length;
	var last_slide = jQuery("#form-table-"+code+"-"+parseInt(activeCount-1));
	if (!last_slide.is('*')) {
		last_slide = jQuery("#sentinel");
	}
	last_slide.after(
		'<table class="table-'+code+'" id="form-table-'+code+'-'+activeCount+'">'+
			'<tr align="left">'+
				'<th scope="row">Titre :</th>'+
				'<td>'+
					'<input name="title-'+code+'-'+activeCount+'" class="title-'+code+'" id="title-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">Légende :</th>'+
				'<td>'+
					'<input name="legend-'+code+'-'+activeCount+'" class="legend-'+code+'" id="legend-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">Url :</th>'+
				'<td>'+
					'<input name="url-'+code+'-'+activeCount+'" class="url-'+code+'" id="url-'+code+'-'+activeCount+'"></input>'+
				'</td>'+
			'</tr>'+
			'<tr align="left">'+
				'<th scope="row">Image :</th>'+
				'<td>'+
					'<textarea style="display:none;"class="image-'+code+'" name="image-'+code+'-'+activeCount+'" id="image-'+code+'-'+activeCount+'"></textarea>'+
					'<a href="media-upload.php?post_id=1&amp;TB_iframe=1" class="thickbox add_media" id="content-add_media-'+activeCount+'" title="Add Media" onclick="return false;">'+
					'Upload/Insert<!-- <img src="http://sandbox-wp.dev/wp-admin/images/media-button.png?ver=20111005" width="15" height="15"> --></a>'+
				'</td>'+
			'</tr>'+
			'<tr>'+
				'<th>'+
					'<a class="up-'+code+'" id="up-'+code+'-'+activeCount+'" href="#" onclick="return false;">Monter</a> / '+
					'<a class="down-'+code+'" id="down-'+code+'-'+activeCount+'" href="#" onclick="return false;">Descendre</a>'+
				'</th>'+
				'<td>'+
					'<button type="button" style="border-color:#FF4D1A;background:#FF4D1A;'+
					'float:right;"id="remove_table-'+activeCount+'"'+
					'class="removeTable_home button-primary" name="form-table-'+code+'-'+activeCount+'">Supprimer</button>'+
				'</td>'+
			'</tr>'+
	'</table>'
	);

	jQuery("#remove_table-"+activeCount).click(function() {
		jQuery("#"+jQuery(this).attr('name')).delay('1000').fadeOut('slow').remove();
		jQuery(this).remove();
		refresh_order(code);
	});

/*
	jQuery("#down-"+code+"-"+activeCount).click(function() {
		var current = $("#form-table-"+code+"-"+(activeCount+1));
		current.next().after(current);
		refresh_order(code);
	});
*/

	jQuery(".add_media").click(function(){
		formfield_img = jQuery(this).siblings();
		formfield_title = jQuery(jQuery(this).parents('tr').siblings().get(0)).find('td>textarea')
		formfield_legend = jQuery(jQuery(this).parents('tr').siblings().get(1)).find('td>textarea')
	});

	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html);
		if (formfield_img !== "") {
			formfield_img.val(imgurl.attr('src'));
			var p = jQuery(formfield_img.before(jQuery('<p>',{class:"img_home"}))).prev();
			p.append(imgurl);  
		}
		if (formfield_title !== "") {
			formfield_title.val(imgurl.attr('title'));
		}
		if (formfield_legend !== "") {
			var str = html.match(/<\/a>(.+)\[\/caption\]/)[1];
			formfield_legend.val(str);
		}
		tb_remove();
	}
});

/***SAVE FUNTION***/
jQuery("#save_home").click('bind',function() {
	var tab_pays = new Array();
	var cpt = new Array();
	var separator = new Array();

	jQuery("div#code").each(function (index) {
		//alert (jQuery(this).attr("code_pays"));
		tab_pays[index] = jQuery(this).attr("code_pays")
	});
	content = jQuery("#content_home").serializeArray();
	jQuery.each(tab_pays,function (index_pays, value_pays) {
		jQuery("#home_content_"+value_pays).val('[');
		cpt[index_pays] = 0;
		separator[index_pays] = value_pays +'_';
	});

	jQuery(content).each(function(ind, el){
		jQuery.each(tab_pays,function (index_pays, value_pays)
		{
			//alert("index="+ind + "; el="+JSON.stringify(el));
			if(el.name.match(separator[index_pays])){
				//alert("index="+ind + "; el="+JSON.stringify(el));
				if(cpt[index_pays] == 0){
					jQuery("#home_content_"+value_pays).val(jQuery("#home_content_"+value_pays).val()+JSON.stringify(el));
					cpt[index_pays]++;
				}
				else{
					jQuery("#home_content_"+value_pays).val(jQuery("#home_content_"+value_pays).val() +","+JSON.stringify(el));
					cpt[index_pays]++;
				}
			}
		});
	});

	jQuery.each(tab_pays,function (index_pays, value_pays) {
		jQuery("#home_content_"+value_pays).val(jQuery("#home_content_"+value_pays).val() +']');
	});
	jQuery("#home_handler").append("<div class='message'>Sauvegarde en cours...</div>");
	jQuery.ajax({
		type: "POST",
		url: "options.php",
		data: jQuery("#home_handler").serialize(),
		success: function(msg) {
			jQuery(".message").html("Sauvegardé");
			jQuery(".message").delay('1000').fadeOut('slow');
		},
		error: function(msg){
			jQuery(".message").html("Oups, une erreur s'est produite :( ...");
			jQuery(".message").delay('1000').fadeOut('slow');
		}
	});

});

});
