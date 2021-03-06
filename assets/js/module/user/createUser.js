function deleteUser(user_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Delete This User?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "employee/deleteUser",
                    data: {
                        user_id: user_id
                    },
                    cache: false,
                    success: function (response) {
                        //alert(response);
                        //console.log(response); return false;
                        var data = JSON.parse(response);
                        switch (data.status) {
                            case 'success':
                                $('#response_msg').html(data.message);
                                break;
                            case 'error':
                                $('#response_msg').html(data.message);
                                break;
                            default:
                                $('#response_msg').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                                setTimeout(function () {
                                    $('.alert_message').fadeOut('fast');
                                }, 8000); // <-- time in milliseconds
                                break;
                        }
                    }
                });
            },
            cancel: function () {
            }
        }
    });
}