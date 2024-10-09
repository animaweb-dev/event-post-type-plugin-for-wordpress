$(document).ready(function(){

	jQuery('.start-date-pick').persianDatepicker({
		observer: true,
		format: 'YYYY/MM/DD',
		autoClose: true,
		altField: '.start-date-pick-stamp',
		initialValue: false,
		calendar:{
			gregorian: {
				showHint: true
			}
		},

	
	});
	jQuery('.end-date-pick').persianDatepicker({
		observer: true,
		format: 'YYYY/MM/DD',
		autoClose: true,
		altField: '.end-date-pick-stamp',
		initialValue: false,
		showHint: true,
		calendar:{
			gregorian: {
				showHint: true
			}
		},
	});
	

	$('.filter-item').click(function(){
		$('.filter-item').removeClass('active-filter')
		$(this).addClass('active-filter')
		var _postype = $(this).children('input#postype').val()
		var taxonomy_id = $(this).children('input#taxonomy_id').val()
		var taxonomy_name = $(this).children('input#taxonomy_name').val()
		var _ppp = 20
		var _offset = 0

		LodeMore(_postype,taxonomy_id,taxonomy_name,_ppp,_offset); 

		 
	})

    function LodeMore(_postype,taxonomy_id,taxonomy_name,_ppp,_offset){
		
		$.ajax({
			type : 'POST',  
			url:ajax.ajax_url, 
			data:{
				action : 'lode_more_cat_post',
				_postype: _postype,
				taxonomy_id: taxonomy_id,
				taxonomy_name: taxonomy_name,
				_ppp: _ppp,
				_offset: _offset,
			},
			beforeSend:function(){  
				$('.preloading').css('display','flex');

			},
			success:function(res){
				res = JSON.parse(res);  
				$('.post-archive-wrapper').html(res.data); 
				$('.pagenavi-wrapper').html(res.paged); 
				$('.preloading').css('display','none');



			},
            error:function(){
				console.log('eror')
            }
		})
		
	}
//**************************************************************************** */


$(document).on('click', '.filter-item-more', function(){
		var _postype = $(this).children('input#postype').val()
		var taxonomy_id = $(this).children('input#taxonomy_id').val()
		var taxonomy_name = $(this).children('input#taxonomy_name').val()
		var _ppp = 20
		var _offset = $('.post-box-slider-item').length

		console.log(_offset);
		LodeMorecat(_postype,taxonomy_id,taxonomy_name,_ppp,_offset); 

		 
	})

    function LodeMorecat(_postype,taxonomy_id,taxonomy_name,_ppp,_offset){
		
		$.ajax({
			type : 'POST',  
			url:ajax.ajax_url, 
			data:{
				action : 'lode_more_cat_post',
				_postype: _postype,
				taxonomy_id: taxonomy_id,
				taxonomy_name: taxonomy_name,
				_ppp: _ppp,
				_offset: _offset,
			},
			beforeSend:function(){  
				$('.preloading').css('display','flex');

			},
			success:function(res){
				res = JSON.parse(res);  
				$('.post-archive-wrapper').append(res.data); 
				$('.preloading').css('display','none');

				if(res.status == 'end'){
					$('.filter-item-more').remove();  
				}
			},
            error:function(){
				console.log('eror')
            }
		})
		
	}
//**************************************************************************** */

// option select ==============================================

$('.select-filter-title, .bi-chevron-down').on('click', function(){
    $(this).siblings('.select-filter').slideToggle(400);
    $(this).toggleClass("open-option-list");
    $(this).siblings('.bi-chevron-down').toggleClass("open-option-list");
});
var _term_ids_first = [];
var _term_taxs_name_first='';
var _term_ids_second = [];
var _term_taxs_name_second='';
var danesh_bonyan = '';

$('.slect-filter-danesh').on('click', function(){
    $(this).find('.bi-check-lg').fadeToggle();
		if(danesh_bonyan == ''){
			danesh_bonyan = $(this).find('#daneshbonyan_id').val()
		}else{
			danesh_bonyan = ''
		}

});

$('.filter-item-type1').on('click', function(){
    $(this).find('.bi-check-lg').fadeToggle();
		_term_taxs_name_first = $(this).find('#taxonomy_name').val()
		if(_term_ids_first.indexOf($(this).find('#taxonomy_id').val()) == -1){
			_term_ids_first.push($(this).find('#taxonomy_id').val())
		  }else{
			_term_ids_first = _term_ids_first.filter(item => item !== $(this).find('#taxonomy_id').val())
		  }

});
$('.filter-item-type2').on('click', function(){
    $(this).find('.bi-check-lg').fadeToggle();

	_term_taxs_name_second = $(this).find('#taxonomy_name').val()

		if(_term_ids_second.indexOf($(this).find('#taxonomy_id').val()) == -1){
			_term_ids_second.push($(this).find('#taxonomy_id').val())
		  }else{
			_term_ids_second = _term_ids_second.filter(item => item !== $(this).find('#taxonomy_id').val())
		  }

});
$('.filter-item-event').on('click', function(){
	$('.filter-item-event').find('.bi-check-lg').fadeOut();
	$(this).find('.bi-check-lg').fadeToggle();

	_term_ids_second = []
	_term_ids_second[0] = $(this).find('#taxonomy_id').val()
	console.log(_term_ids_second);
});


$('.select-filter-button').click(function(){
	$('.select-filter').slideUp(400);
    $('.select-filter-title, .bi-chevron-down').removeClass("open-option-list");
    $('.bi-chevron-down').removeClass("open-option-list");
	var _postype = $(this).children('input#postype').val()
	var _ppp = 30
	var _offset = 0

	lode_more_archive_post(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,_term_taxs_name_second,_term_ids_second,danesh_bonyan); 
})

function lode_more_archive_post(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,_term_taxs_name_second,_term_ids_second,danesh_bonyan){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_taxs_name_second: _term_taxs_name_second,
			_term_ids_first: _term_ids_first,
			_term_ids_second: _term_ids_second,
			danesh_bonyan: danesh_bonyan,
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').html(res.data); 
			$('.pagenavi-wrapper').html(res.paged); 
			$('.preloading').css('display','none');



		},
		error:function(){
			console.log('eror')
		}
	})
	
}



//event filter=============================================================
$('.select-filter-button-event').click(function(){
	$('.select-filter').slideUp(400);
    $('.select-filter-title, .bi-chevron-down').removeClass("open-option-list");
    $('.bi-chevron-down').removeClass("open-option-list");
	var _postype = $(this).children('input#postype').val()
	var _ppp = 30
	var _offset = 0

	lode_archive_post_event(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,_term_ids_second); 
})

function lode_archive_post_event(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,_term_ids_second){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post_event',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_ids_first: _term_ids_first,
			_term_ids_second: _term_ids_second[0],
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
			console.log(_term_ids_second[0]);
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').html(res.data); 
			$('.pagenavi-wrapper').html(res.paged); 
			$('.preloading').css('display','none');



		},
		error:function(){
			console.log('eror')
		}
	})
	
}
// option select more post event ==============================================

$(document).on('click', '.filter-item-more_event', function(){
	var _postype = $(this).children('input#postype').val()
	var _ppp = 30
	var _offset = $('.ajax-item').length

	lode_more_archive_post_event(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,_term_ids_second); 
	 
})
function lode_more_archive_post_event(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,_term_ids_second){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post_event',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_ids_first: _term_ids_first,
			_term_ids_second: _term_ids_second[0],
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
			console.log(_term_ids_second[0]);
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').append(res.data); 
			$('.preloading').css('display','none');

			if(res.status == 'end'){
				$('.filter-item-more_event').remove();  
			}

		},
		error:function(){
			console.log('eror')
		}
	})
	
}



//post filter=============================================================
$('.select-filter-button-post').click(function(){
	$('.select-filter').slideUp(400);
    $('.select-filter-title, .bi-chevron-down').removeClass("open-option-list");
    $('.bi-chevron-down').removeClass("open-option-list");
	var start_date = new Date(Number($('.start-date-pick-stamp').val()))
	var end_date = new Date(Number($('.end-date-pick-stamp').val()))
	var str_y = start_date.getFullYear()
	var str_m = start_date.getMonth() + 1 ;
	var str_d = start_date.getDate();
	var end_y = end_date.getFullYear()
	var end_m = end_date.getMonth() + 1 ;
	var end_d = end_date.getDate();
	var _postype = $(this).children('input#postype').val()
	var _ppp = 20
	var _offset = 0
	lode_archive_post_post(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,str_y,str_m,str_d,end_y,end_m,end_d); 

})

function lode_archive_post_post(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,str_y,str_m,str_d,end_y,end_m,end_d){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post_post',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_ids_first: _term_ids_first,
			str_y: str_y,
			str_m: str_m,
			str_d: str_d,
			end_y: end_y,
			end_d: end_d,
			end_m: end_m,
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').html(res.data); 
			$('.pagenavi-wrapper').html(res.paged); 
			$('.preloading').css('display','none');

		},
		error:function(){
			console.log('eror')
		}
	})
	
}

// option select more post post ==============================================

$(document).on('click', '.filter-item-more_posts', function(){
	var _postype = $(this).children('input#postype').val()
	var start_date = new Date(Number($('.start-date-pick-stamp').val()))
	var end_date = new Date(Number($('.end-date-pick-stamp').val()))
	var str_y = start_date.getFullYear()
	var str_m = start_date.getMonth() + 1 ;
	var str_d = start_date.getDate();
	var end_y = end_date.getFullYear()
	var end_m = end_date.getMonth() + 1 ;
	var end_d = end_date.getDate();
	var _ppp = 20
	var _offset = $('.ajax-item').length
	lode_more_archive_post_posts(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,str_y,str_m,str_d,end_y,end_m,end_d); 
	 
})
function lode_more_archive_post_posts(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first,str_y,str_m,str_d,end_y,end_m,end_d){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post_post',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_ids_first: _term_ids_first,
			str_y: str_y,
			str_m: str_m,
			str_d: str_d,
			end_y: end_y,
			end_d: end_d,
			end_m: end_m,
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
			console.log(_term_ids_second[0]);
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').append(res.data); 
			$('.preloading').css('display','none');

			if(res.status == 'end'){
				$('.filter-item-more_posts').remove();  
			}

		},
		error:function(){
			console.log('eror')
		}
	})
	
}
//librery filter=============================================================
$('.select-filter-button-libreries').click(function(){
	$('.select-filter').slideUp(400);
    $('.select-filter-title, .bi-chevron-down').removeClass("open-option-list");
    $('.bi-chevron-down').removeClass("open-option-list");
	var _postype = $(this).children('input#postype').val()
	var _ppp = 20
	var _offset = 0
	lode_archive_post_libreries(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first); 
})

function lode_archive_post_libreries(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post_libreries',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_ids_first: _term_ids_first,
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
			// console.log(_term_ids_second[0]);
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').html(res.data); 
			$('.pagenavi-wrapper').html(res.paged); 
			$('.preloading').css('display','none');

		},
		error:function(){
			console.log('eror')
		}
	})
	
}

// option select more post post ==============================================

$(document).on('click', '.filter-item-more_libreries', function(){
	var _postype = $(this).children('input#postype').val()
	var _ppp = 20
	var _offset = $('.ajax-item').length

	lode_more_archive_post_libreriess(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first); 
	 
})
function lode_more_archive_post_libreriess(_postype,_term_taxs_name_first,_ppp,_offset,_term_ids_first){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post_libreries',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_ids_first: _term_ids_first,
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');
			console.log(_term_ids_second[0]);
		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').append(res.data); 
			$('.preloading').css('display','none');

			if(res.status == 'end'){
				$('.filter-item-more_libreries').remove();  
			}

		},
		error:function(){
			console.log('eror')
		}
	})
	
}


// option select more post ==============================================

$(document).on('click', '.filter-item-more_archive', function(){
	var _postype = $(this).children('input#postype').val()
	var daneshbonyan_status = $(this).children('input#daneshbonyan_status').val()
	var _ppp = 30
	var _offset = $('.ajax-item').length
	LodeMorecat(_postype,_term_ids_first,_term_ids_second,_term_taxs_name_first,_term_taxs_name_second,_ppp,_offset,daneshbonyan_status); 
})



function LodeMorecat(_postype,_term_ids_first,_term_ids_second,_term_taxs_name_first,_term_taxs_name_second,_ppp,_offset,daneshbonyan_status){
	
	$.ajax({
		type : 'POST',  
		url:ajax.ajax_url, 
		data:{
			action : 'lode_more_archive_post',
			_postype: _postype,
			_term_taxs_name_first: _term_taxs_name_first,
			_term_taxs_name_second: _term_taxs_name_second,
			_term_ids_first: _term_ids_first,
			_term_ids_second: _term_ids_second,
			danesh_bonyan: daneshbonyan_status,
			_ppp: _ppp,
			_offset: _offset,
		},
		beforeSend:function(){  
			$('.preloading').css('display','flex');

		},
		success:function(res){
			res = JSON.parse(res);  
			$('.post-archive-wrapper').append(res.data); 
			$('.preloading').css('display','none');

			if(res.status == 'end'){
				$('.filter-item-more_archive').remove();  
			}
		},
		error:function(){
			console.log('eror')
		}
	})
	
}
//**************************************************************************** */










})