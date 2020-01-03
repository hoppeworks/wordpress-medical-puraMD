<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<script>
	function rw_icons_change(a,inputName,iconName){
		var childList = a.parentElement.children;
		for(var i=0;i<childList.length;i++){
			childList[i].classList.remove('selected');
		}
		a.classList.add('selected');
		document.querySelector('#'+inputName).value=iconName;
	}
	function rw_icons_change_selected(){
		var allInputs = document.querySelectorAll(".rw_sel_ic_input");
		for(var i=0; i<allInputs.length; i++){
			var childrens = allInputs[i].previousElementSibling.children;
			for(var c=0; c<childrens.length; c++){
				childrens[c].classList.remove('selected');
				if(childrens[c].dataset.value == allInputs[i].value){
					childrens[c].classList.add('selected');
				}
			}
		}
	}
	function Rich_Web_VSlider_Add_Option()
	{
		alert("This is free version. For more adventures click to buy Pro version.");
	}
	function stugel_rw_vs(str)
	{
		if(jQuery("#Rich_Web_"+str+"_L_T").val() == "Type 1"){ jQuery(".Loder_1_Option").show(); }else{ jQuery(".Loder_1_Option").hide(); }
	}	
	function stugel_rw_vs_lt(str)
	{
		if(jQuery("#Rich_Web_"+str+"_LT_T").val() == "Type 1"){ jQuery(".rw_text_color").hide(); jQuery(".rw_text_color1").show(); }
		else if(jQuery("#Rich_Web_"+str+"_LT_T").val() == "Type 2") { jQuery(".rw_text_color").hide(); jQuery(".rw_text_color2").show(); }
		else if(jQuery("#Rich_Web_"+str+"_LT_T").val() == "Type 3") { jQuery(".rw_text_color").hide(); jQuery(".rw_text_color3").show(); }
		else { jQuery(".rw_text_color").hide(); }
	}
	function change_rw_vs_tr(str) { stugel_rw_vs(str); }
	function change_rw_vs_ltt(str) { stugel_rw_vs_lt(str); }
  	function Rich_Web_VSlider_Can_Option() { location.reload(); }
	function Rich_Web_VSlider_Edit_Option(rich_web_Slider_ID)
	{
		jQuery(".rw_loading_c_vs").show();
		jQuery('#Rich_Web_VSlider_Option_Type').hide();
		jQuery('.Rich_Web_VSlider_Save_Table_2').hide();
		var ajaxurl = object.ajaxurl;
		var data = {
		action: 'rich_web_VS_Edit_Option', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: rich_web_Slider_ID, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) {
			var data = JSON.parse(response);
			jQuery("input[name='Rich_Web_VSlider_Upd_ID']").val(data[0][0]['RW_VS_ID']);
			for(i=0;i<data.length;i++)
			{
				for(var key in data[i][0])
				{
					if( data[i][0][key] == 'true' || data[i][0][key] == 'on' ) { jQuery("#"+key).attr('checked',true); }
					else if( data[i][0][key] == 'false' || data[i][0][key] == '' || data[i][0][key] == 'none' ) { jQuery("#"+key).attr('checked',false); }
					else { jQuery("#"+key).val(data[i][0][key]); }
				}
			}
			var answer = data[0][0]['Rich_Web_VSlider_Option_Type'];
			change_tables(answer);
			rangeSlider();
			jQuery('.Rich_Web_VS_Color').alphaColorPicker();
			jQuery('.wp-color-result').attr('title','Select');
			jQuery('.wp-color-result').attr('data-current','Selected');
			jQuery(".rw_loading_c_vs").hide();
			rw_icons_change_selected();
		})
		jQuery('.Rich_Web_VSlider_Opt_Table_Data').css('display','none');
		jQuery('.Rich_Web_VSlider_Add_Opt').addClass('Rich_Web_VSlider_Add_OptAnim');
		jQuery('.Rich_Web_VSlider_Opt_Table_Data_2').css('display','block');
		jQuery('.Rich_Web_VSlider_Upd_Opt').addClass('Rich_Web_VSlider_Sav_OptAnim');
		jQuery('.Rich_Web_VSlider_Can_Opt').addClass('Rich_Web_VSlider_Can_OptAnim');
	}
	function Rich_Web_VSlider_Del_Option(rich_web_Slider_ID)
	{
		var RWSVRSO = rich_web_Slider_ID;
		jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeIn();	
		jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeIn();
		jQuery('.Rich_Web_SliderVd_Relative_No').click(function(){
			jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeOut();	
			jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeOut();
			RWSVRSO = null;
		})
		jQuery('.Rich_Web_SliderVd_Relative_Yes').click(function(){
			if(RWSVRSO != null)
			{
				Rich_Web_VSlider_Add_Option();
				jQuery('.Rich_Web_SliderVd_Fixed_Div').fadeOut();
				jQuery('.Rich_Web_SliderVd_Absolute_Div').fadeOut();
			}
			RWSVRSO = null;			
		})				
	}
	function Rich_Web_VSlider_Copy_Option(rich_web_Slider_ID)
	{
		var ajaxurl = object.ajaxurl;
		var data = {
			action: 'rich_web_VS_Copy_Option', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: rich_web_Slider_ID, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) { location.reload(); })
	}
	var rangeSlider = function()
	{  
		var slider = jQuery('.range-slider'), range = jQuery('.range-slider__range'), value = jQuery('.range-slider__value');     
		slider.each(function()
		{   
			value.each(function()
			{   
				var value = jQuery(this).prev().attr('value');
			    jQuery(this).html(value);
			});    
			range.on('input', function()
			{      
				jQuery(this).next(value).html(this.value);
			});  
		});
	};
	rangeSlider();
	function change_tables(type)
	{
		if(type=='Content Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_1').show(); stugel_rw_vs('VS_ContSl'); stugel_rw_vs_lt('VS_ContSl'); }
		else if(type=='Slick Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_2').show(); stugel_rw_vs('SlickSl'); stugel_rw_vs_lt('SlickSl'); }
		else if(type=='Thumbnails Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_3').show(); stugel_rw_vs('ThumbSl'); stugel_rw_vs_lt('ThumbSl'); }
		else if(type=='Video Carousel/Content Popup'){ jQuery('#Rich_Web_VSlider_Save_Table_2_4').show(); stugel_rw_vs('VCCP'); stugel_rw_vs_lt('VCCP'); }
		else if(type=='Simple Video Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_5').show(); stugel_rw_vs('SimpleVS'); stugel_rw_vs_lt('SimpleVS'); }
		else if(type=='Video Slider/Vertical Thumbnails'){ jQuery('#Rich_Web_VSlider_Save_Table_2_6').show(); stugel_rw_vs('VSVT'); stugel_rw_vs_lt('VSVT'); }
		else if(type=='Horizontal Posts Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_7').show(); stugel_rw_vs('HSL'); stugel_rw_vs_lt('HSL'); }
		else if(type=='Rich Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_8').show(); stugel_rw_vs('RichSl'); stugel_rw_vs_lt('RichSl'); }
		else if(type=='TimeLine Slider'){ jQuery('#Rich_Web_VSlider_Save_Table_2_9').show(); stugel_rw_vs('TSL'); stugel_rw_vs_lt('TSL'); }
		else if(type=='Amazing Simple Slider')
		{ 
			jQuery('#Rich_Web_VSlider_Save_Table_2_10').show();
			if(jQuery('#Rich_Web_IO_NS1_Arrow_Type').val() == 'icon') 
			{
				jQuery('.Rich_Web_IO_NS1_Icon_Col_Block_DIV').fadeIn();
				jQuery('.Rich_Web_IO_NS1_IMG_Type').hide();
				jQuery('.Rich_Web_IO_NS1_Icon_Type_Block').show();
				jQuery('.Rich_Web_IO_NS1_FSize_Block').show();
				jQuery('.Rich_Web_IO_NS1_Icon_Col_Block').show();
			}
			else if(jQuery('#Rich_Web_IO_NS1_Arrow_Type').val() == 'image') 
			{
				jQuery('.Rich_Web_IO_NS1_Icon_Col_Block_DIV').fadeOut();
				jQuery('.Rich_Web_IO_NS1_IMG_Type').show();
				jQuery('.Rich_Web_IO_NS1_Icon_Type_Block').hide();
				jQuery('.Rich_Web_IO_NS1_FSize_Block').hide();
				jQuery('.Rich_Web_IO_NS1_Icon_Col_Block').hide();
			}
			stugel_rw_vs('ASSl'); stugel_rw_vs_lt('ASSl');
		}
	}
	function Rich_Web_VSlider_Option_Changed()
	{
		var Rich_Web_VSlider_Type=jQuery('#Rich_Web_VSlider_Option_Type').val();
		jQuery('.Rich_Web_VSlider_Save_Table_2').hide();
		change_tables(Rich_Web_VSlider_Type);
	}
	jQuery('.Rich_Web_IO_NS1_IMG_Type').hide();
	function Rich_Web_IO_NS1_Arrow_Type_Changed() 
	{
		var Rich_Web_Arrow_Type=jQuery('#Rich_Web_IO_NS1_Arrow_Type').val();
		if(Rich_Web_Arrow_Type == 'icon') 
		{
			jQuery('.Rich_Web_IO_NS1_Icon_Col_Block_DIV').fadeIn();
			jQuery('.Rich_Web_IO_NS1_IMG_Type').fadeOut();
			jQuery('.Rich_Web_IO_NS1_Icon_Type_Block').fadeIn();
			jQuery('.Rich_Web_IO_NS1_FSize_Block').fadeIn();
			jQuery('.Rich_Web_IO_NS1_Icon_Col_Block').fadeIn();
		}
		else if(Rich_Web_Arrow_Type == 'image')
		{
			jQuery('.Rich_Web_IO_NS1_Icon_Col_Block_DIV').fadeOut();
			jQuery('.Rich_Web_IO_NS1_IMG_Type').fadeIn();
			jQuery('.Rich_Web_IO_NS1_Icon_Type_Block').fadeOut();
			jQuery('.Rich_Web_IO_NS1_FSize_Block').fadeOut();
			jQuery('.Rich_Web_IO_NS1_Icon_Col_Block').fadeOut();
		}
	}	
</script>