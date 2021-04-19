const url = location.protocol +'//'+location.host;

$('#register_user_form').on('submit', function(e) {
    e.preventDefault();
    let registerData = new FormData(this);
    loader();
    $.ajax({
        type:'post',
        url: `${url}/user/register`,
        processData: false,
        cache: false,
        contentType: false,
        data: registerData
    }).done(res => {
        swal.close()
        window.location.assign('/user/profile');
    }).fail(err => {
        swal.close()
        console.log(err);
        userValidationErrors(err);
    })
});

$('#user_login_form').on('submit', function(e) {
    e.preventDefault();
    let loginData = new FormData(this);
    loader();
    $.ajax({
        type:'post',
        url:`${url}/user/login`,
        processData: false,
        cache: false,
        contentType: false,
        data: loginData
    }).done(res => {
        window.location.assign('/user/profile');
    }).fail(err => {
        console.log(err);
        swal.close();
        $('.alert').remove();
        $('.login-modal').prepend(alertMessage(err.responseJSON.message));
    })
}); 

function logoutUser() {
    swal("Are you sure to logout?", {
        icon:'warning',
        dangerMode: true,
        buttons: true,
    }).then((willLogout) => {
        if(willLogout) {
            $('#logout-form').submit();
        }
    });
}

function loader() {
    swal({
        text:'loading',
        buttons:false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    })
}

function success(msg) {
    swal({
        text: msg,
        icon: 'success'
    })
}