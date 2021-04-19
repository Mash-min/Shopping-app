$('#create_store_form').on('submit', function(e) {
    e.preventDefault();
    let storeData = new FormData(this);
    $.ajax({
        type:'post',
        url:`${url}/store/api/create`,
        data: storeData,
        cache:false,
        processData:false,
        contentType:false
    }).done(res => {
        window.location.assign('/user/my_store');
        console.log(res);
    }).fail(err => {
        console.log(err);
        storeValidationErrors(err);
    });
});