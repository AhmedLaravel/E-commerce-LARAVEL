 function check_all(){
      $('input[class = "item_check"]:checkbox').each(function(){
        if($('input[class = "check_all"]:checkbox:checked').length == 0){
          $(this).prop('checked', false);
        }else{
          $(this).prop('checked', true);
        }
      });
    }

function delete_all(){
	$(document).on('click', '.delete_all', function(){
		$('#form_data').submit();
	});
	$(document).on('click', '.delBtn', function(){
		numberOfItems = $('input[class = "item_check"]:checkbox:checked').length;
		if(numberOfItems > 0){
			$('.countRecord').text(numberOfItems);
			$('.no_empty_records').removeClass('hidden');
			$('.empty_records').addClass('hidden');
		}else{
			$('.countRecord').text('');
			$('.empty_records').removeClass('hidden');
			$('.no_empty_records').addClass('hidden');

		}
		$('.multipleDelete').modal('show');
	});
}