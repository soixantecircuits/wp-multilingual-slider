//script d'utilisation du backoffice.


jQuery(document).ready(function(){

var formfield_img = "";
var formfield_title = "";
var formfield_legend = "";

jQuery(".add_media").click(function(){
		formfield_img = jQuery(this).siblings();
    formfield_title = jQuery(jQuery(this).parents('tr').siblings().get(0)).find('td>textarea')
    formfield_legend = jQuery(jQuery(this).parents('tr').siblings().get(1)).find('td>textarea')

		//tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
});

if(jQuery('form#content_home').length > 0){
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


	
/***ADD SLIDE***/
jQuery(".add").click('bind',function(){
	
	var code = jQuery(this).attr('code_pays');
	//alert (code);
        var activeCount = jQuery(".table_"+code).length;
	//alert ("#form-table-"+code+"-"+parseInt(activeCount-1));
	jQuery("#form-table-"+code+"-"+parseInt(activeCount-1)).after(
	    '<table class="table_'+code+'" id="form-table-'+code+'-'+activeCount+'">'+
		    '<tr valign="top">'+
          '<th scope="row">Titre '+activeCount+' :</th>'+
          '<td><textarea name="'+code+'_Titre-'+activeCount+'" id="'+code+'_Titre-'+activeCount+'"></textarea></td>'+
        '</tr>'+
        '<tr valign="top">'+
          '<th scope="row">Image '+activeCount+' :</th>'+
          '<td><textarea style="display:none;"name="'+code+'_Image-'+activeCount+'" id="'+code+'_Image-'+activeCount+'"></textarea> <a href="/wp-admin/media-upload.php?post_id=1&amp;TB_iframe=1" class="thickbox add_media" id="content-add_media-'+activeCount+'" title="Add Media" onclick="return false;"><?php _e("Upload/Insert");?> <img src="http://sandbox-wp.dev/wp-admin/images/media-button.png?ver=20111005" width="15" height="15"></a></td>'+
        '</tr>'+
        '<tr valign="top">'+
          '<th scope="row">Légende '+activeCount+' :</th>' +
          '<td><textarea name="'+code+'_Legend-'+activeCount+'" id="'+code+'_Legend-'+activeCount+'"></textarea></td>'+
        '<tr valign="top">'+
          '<th scope="row">Url '+activeCount+' :</th>'+
          '<td><textarea name="'+code+'_Url-'+activeCount+'" id="'+code+'_Url-'+activeCount+'"></textarea></td>'+
        '</tr><tr><th></th><td><span style="background-color:#FF4D1A;float:right;"class="removeTable_home button-primary" name="form-table-'+code+'-'+activeCount+'">Supprimer</span></td></tr>'+
		'</table>'
	);
	
	jQuery(".removeTable_home").click('bind', function(){
		alert("#"+jQuery(this).attr('name'));
		jQuery("#"+jQuery(this).attr('name')).delay('1000').fadeOut('slow').remove();
		jQuery(this).remove();
	});
	
	jQuery(".add_media").click(function(){
    formfield_img = jQuery(this).siblings();
    formfield_title = jQuery(jQuery(this).parents('tr').siblings().get(0)).find('td>textarea')
    formfield_legend = jQuery(jQuery(this).parents('tr').siblings().get(1)).find('td>textarea')
  });


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
  });


/***SAVE FUNTION*****/
jQuery("#save_home").click('bind',function(){
	var tab_pays = new Array();
	var cpt = new Array();
	var separator = new Array();
	jQuery("div#code").each(function (index) {
		//alert (jQuery(this).attr("code_pays"));
		tab_pays[index] = jQuery(this).attr("code_pays")
	});
	content = jQuery("#content_home").serializeArray();
	jQuery.each(tab_pays,function (index_pays, value_pays)
	{
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
	
	jQuery.each(tab_pays,function (index_pays, value_pays)
	{
		jQuery("#home_content_"+value_pays).val(jQuery("#home_content_"+value_pays).val() +']');
	});
	jQuery("#home_handler").append("<div class='message'>Sauvegarde en cours...</div>");
	jQuery.ajax({
   		type: "POST",
   		url: "options.php",
	    data: jQuery("#home_handler").serialize(),
	    success: function(msg){
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