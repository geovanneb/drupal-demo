jQuery(document).ready(function($){
	$('.page-error form input[type=search]').after('<i class="icon_search size-14"></i>');
	$('.search-popup.pop-up-box form input[type=search]').after('<i class="icon ion-android-arrow-forward size-24 black-arrow"></i>')
	$('.epros-search-interior form input[type=search]').after('<i class="icon ion-android-search size-24"></i>')
	$('.epros-search-electrnic form input[type=submit]').val('search');
	$('.epros-menu-additional-page li a').before('<span class="icon ion-ios-arrow-right"></span>')
    jQuery('.epros-slider').css('display','block');
    ///

    if($('#countdown-1').length){


	    var mth = $('#countdown-1').attr('data-month');
	    var day = $('#countdown-1').attr('data-day');
	    var year = $('#countdown-1').attr('data-year');
	    var _time = $('#countdown-1').attr('data-time');

	   
	    $('#countdown-1.countdown').downCount({
	        date: mth+'/'+day+'/'+year+' '+_time,
	        offset: +10
	    }, function () {
	        alert('WOOT WOOT, done!');
	    });
    }
});
jQuery(document).ready(function($) {
	$('.epros-bg-get-src').each(function() {
		//alert('dasdas');
		var img_src = $(this).attr('data-bg-src');
		//alert(img_src);
        $(this).css({"background-image": "url("+ img_src +")", "background-position": "center center" , "background-repeat": "no-repeat"});

	});
	
});

jQuery(document).ready(function($) {


	$('input[type="checkbox"]#cb-hidden-nl').click(function(){
        if($(this).is(":checked")){
        	document.cookie = 'c_popup=checked';
            
        }
        else if($(this).is(":not(:checked)")){
            document.cookie = 'c_popup=disable';
        }
    });

	//

	
	function getCookieC_popup(){
		var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)c_popup\s*\=\s*([^;]*).*$)|^.*$/, "$1");
		return cookieValue;
	}

	
	
	if(getCookieC_popup() != null && getCookieC_popup() != '' && getCookieC_popup() == 'checked'){
		$('section.subscribe-me').remove();
	}
	//alert(cookieValue);

	
	
});