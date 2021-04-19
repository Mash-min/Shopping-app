$('#update_account_form').on('submit', function(e) {
    e.preventDefault();
    let updateData = new FormData(this);
    loader();
    $.ajax({
        type:'post',
        url:`${url}/user/update`,
        data: updateData,
        cache:false,
        processData:false,
        contentType:false
    }).done(res => {
        swal("Profile updated!");
        window.location.assign('/user/profile');
    }).fail(err => {
        swal.close()
        userValidationErrors(err);
    })
});

$('#reset_password_btn').click(() => {
    swal({
        text: 'Please enter your current password',
        content: {
            element: "input",
                attributes: {
                placeholder: "Type your password",
                type: "password",
            },
        },
    }).then(checkPassword => {
        if(checkPassword) {
            $.ajax({
                type:'post',
                url:`${url}/user/check_password`,
                data: {
                    _token:$('input[name=_token]').val(),
                    password: checkPassword
                }
            }).done(res => {
                swal({
                    text: 'Please enter your new password',
                    content: {
                        element: "input",
                            attributes: {
                            placeholder: "Type your password",
                            type: "password",
                        },
                    },
                }).then(newPassword => {
                    if(newPassword) {
                        $.ajax({
                            type:'post',
                            url:`${url}/user/reset_password`,
                            data: {
                                _token:$('input[name=_token]').val(),
                                password: newPassword
                            }
                        }).done(res => {
                            swal("Password successfully reset");
                        }).fail(err => {
                            console.log(err);
                        });
                    }
                });
            }).fail(err => {
                swal({
                    text:"Invalid password",
                    icon:'warning'
                });
            });
        }
    }); // =============== ENTER CURRENT PASSWORD
});