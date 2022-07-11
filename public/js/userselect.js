function readURL(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#media').children('img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function selectedUsers()
{
	var selectUsers = [];

	$("#paymentrequest_reciever").children().each(function()
	{
		selectUsers.push($(this).children('span').text());
	});

	selectUsers.sort();
	$("input[name='to_users_id']").val("");
	
	selectUsers.forEach(function (arrayItem)
	{
		if($("input[name='to_users_id']").val().length != 0)
		{
			$("input[name='to_users_id']").val($("input[name='to_users_id']").val() + "," + arrayItem);	
		}
		else
		{
			$("input[name='to_users_id']").val(arrayItem);	
		}
		
	});
}

function removeSelected(element)
{
	if(element.hasClass('selected_user'))
	{
		element.removeClass('selected_user');
	}
}

$( document ).ready(function() 
{
	$(".user").on('click',function()
	{
		if($(this).hasClass('selected_user'))
		{
			$(this).removeClass('selected_user');
		}
		else
		{
			$(this).addClass('selected_user');
		}
	});
	
	$("input[name='allin']").on('click', function()
	{
		$("#all_users").children().each(function()
		{
			removeSelected($(this));

			var move = $(this);
			$("#paymentrequest_reciever").prepend(move);
		});

		selectedUsers();
	});

	$("input[name='in']").on('click', function()
	{
		$("#all_users").children('.selected_user').each(function()
		{
			removeSelected($(this));

			var move = $(this);
			$("#paymentrequest_reciever").prepend(move);
		});

		selectedUsers();
	});

	$("input[name='allout']").on('click', function()
	{
		$("#paymentrequest_reciever").children().each(function()
		{
			removeSelected($(this));

			var move = $(this);
			$("#all_users").prepend(move);
		});

		selectedUsers();
	});
	
	$("input[name='out']").on('click', function()
	{
		$("#paymentrequest_reciever").children('.selected_user').each(function()
		{
			removeSelected($(this));

			var move = $(this);
			$("#all_users").prepend(move);
		});

		selectedUsers();
	});

	$("input[name='media']").on('change', function()
	{
    	readURL(this);
	});
});



