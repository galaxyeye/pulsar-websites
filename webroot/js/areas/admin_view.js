$(document).ready(function(){
	var add = function(element){
		var r = [];
		$('.editableContainer > .add span').each(function(){
			r.push(this.innerHTML);
		});
		var root = $('#root').val();

		$.post('../save',
				{id : r[0], order : r[1], name : r[2], layer :  r[3],
					children : r[4], is_open : (r[5] == '是' ? 1 : 0), root : root},
				function(data){
					$('.message span').text('记录[' + r[2] + ']' + '已保存');
					$('.error').html(data);
		});
	}

	var upd = function(element){
		var r = [];
		$(element).parent().parent().find('span').each(function(){
			r.push(this.innerHTML);
		});
		var name = $(element).parent().parent().find('a').html();

		if (r[0] != '0'){
			$('.message span').text('保存中...');
			// update
			$.post('../save',
					{id : r[0], order : r[1], name : name, layer : r[2], children : r[3], is_open : (r[4] == '是' ? 1 : 0)},
					function(data){
						$('.error').html(data);
						$('.message span').text('记录[' + name + ']' + '已保存');
					});
		}
	}

	var del = function(element){
		var id   = $(element).parent().parent().find('td:nth-child(1)').children().html();
		var name = $(element).parent().parent().find('td:nth-child(3)').children().html();

		$.post('../del', {id : id}, function(data){
			$('.message span').text('记录[' + name + ']' + '已删除');
			$('.error').text(data);// no message if no error
		});
		$(element).parent().parent().remove();
	}

	// open edit mode and bind upd event
	$('.open').click(function(){
		// .e is a hint which indicates the element should be editable when edit mode is open.
		$('.editableContainer .e').removeClass('e').addClass('editable');
		$('.open').hide();
		$('.close').add('.add').add('.op').show();
		$('.message span').text('编辑模式已打开');

		// edit and save
		$('.editable').editable(function(element){
			upd(element);
		});
	});

	// add
	$('.editableContainer .op .doAdd').click(function(){
		// new record
		$confirmed = confirm('确定要加入这条纪录？');
		if ($confirmed){
			add(this);
		}// end if confirmed
	});

	// delete
	$('.editableContainer .op .rm').click(function(){
		$confirmed = confirm('确定要删除？');
		if ($confirmed){
			del(this);
		}// end if confirmed
	});

	// close edit mode
	$('.close').click(function(){
		$('.close').add('.op').add('.add').hide();
		$('.open').show();
		$('.message span').text('');

		$('.editable').removeAttr('contenteditable').removeClass('editable').addClass('e');
	});
});
