function getStores(){
    loader();
    $.ajax({
        type: 'get',
        url: `${url}/store/api/stores/json`
    }).done(res => {
        swal.close();
        for(var x in res.stores.data) {
            let store1 = new Store(
                res.stores.data[x].id,
                res.stores.data[x].name,
                res.stores.data[x].email,
                res.stores.data[x].contact,
                res.stores.data[x].address,
                res.stores.data[x].status,
                res.stores.data[x].description,
                res.stores.data[x].image,
            );
            $('#stores_container').append(store1.stores());
        }
    }).fail(err => {
        console.log(err);
    })
}