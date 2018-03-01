	var params = window
    .location
    .search
    .replace('?','')
    .split('&')
    .reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );
var page = params['page'];
var limit = 10;

function update(page,lim) {
		var html;
		html = '';
		$.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  dataType: 'json',
		  data: 'update=1&page='+page+'&lim='+lim,
		  success: function(data){
		  	data.forEach(function(item, i, arr) {
		  		if (item.status == 1) {html += '<div id="'+item.id+'" class="row blue">';}
		  		else {html += '<div id="'+item.id+'" class="row gray">';}
		  		if (item.date == '0000-00-00') {item.date = '<b>-</b>';}
		  		html += '<div class="w-1-4 col"><p class="fio" onclick="edit_row('+item.id+')">'+item.fio+'</p></div>';
		  		html += '<div class="w-1-4 col"><p>'+item.position+'</p></div>';
		  		html += '<div class="w-1-4 col"><p>'+item.date+'</p></div>';
		  		html += '<div class="w-1-8 col">';
		  		if (item.status == 1) {html += '<input type="checkbox" onclick="set_status('+item.id+',0);" checked>';}
		  		else {html += '<input type="checkbox" onclick="set_status('+item.id+',1);">';}
		  		html+='</div>';
		  		html += '<div class="w-1-8 col"><a class="edit" onclick="edit_row('+item.id+')"></a><a class="delete" onclick="delete_row('+item.id+')"></a></div></div>';

			});
			$('#table').html(html);


  		},
  			error: function(data){
  				alert(data);
  			}
		});
	}

	function delete_row(id) {
		$.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  data: 'deletable='+id,
		  success: function(data){
		  update(page,limit);	
  		  },
  		  error: function(data){
  		  alert(data);
  		  }
});

		return false;
	}

	function edit_row(id) {
		$.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  dataType: 'json',
		  data: 'find=1&id='+id,
		  success: function(data){
		  	data.forEach(function(item, i, arr) {
		  		$('#edit_window input[name="id"]').val(id);
		  		$('#edit_window input[name="fio"]').val(item.fio);
		  		$('#edit_window select[name="position"]').val(item.position);
		  		if (item.status ==1) {
		  		$('#edit_window input[name="date"]').val(item.date);
		  		}
		  		else {$('#edit_window input[name="date"]').attr('disabled','');}
			});
			modal_on('edit_window');




  		},
  			error: function(data){
  				alert(1123);
  			}
		});
	}

	function add(form){

		$.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  data: 'add=1&'+$(form).serialize(),
		  success: function(data){

		  		update(page,limit);

  		},
  			error: function(data){
  				alert(data);
  			}
		});

	}

	function save(form) {
		$.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  data: 'save=1&'+$(form).serialize(),
		  success: function(data){

		  		update(page,limit);

  		},
  			error: function(data){
  				alert(123);
  			}
		});
	}

	function set_status(id,status){
		$.ajax({
		  type: 'POST',
		  url: 'ajax.php',
		  data: 'change_status=1&id='+id+'&status='+status,
		  success: function(data){

		  		update(page,limit);

  		},
  			error: function(data){
  				alert(data);
  			}
		});
	}

	function modal_on(id){

		$('body').addClass('blocked');
		$('#'+id).fadeIn();
	}
	function modal_off() {

		$('body').removeClass('blocked');
		$('.modal').fadeOut();
	}