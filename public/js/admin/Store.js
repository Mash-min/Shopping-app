let Store = {
    storeList: (store) => {
        return `
            <tr id='store_${store.id}'>
                <td>${store.name}</td>
                <td>${store.email}</td>
                <td>${store.address}</td>
                <td>#${store.contact}</td>
                <td>${store.products.length} product/s</td>
                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg"">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger"">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr> 
        `;
    },
    storeRequests: (store) => {
        return `
            <tr id='store_${store.id}'>
                <td>${store.name}</td>
                <td>${store.email}</td>
                <td>${store.address}</td>
                <td>#${store.contact}</td>
                <td>${store.products.length} product/s</td>
                <td>
                    <button class="btn btn-success" onclick="acceptStore('${store.id}')">
                        <i class="fa fa-check"></i>
                    </button>
                    <button class="btn btn-danger"">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr> 
        `;
    }
}

function getStoreList() {
    loader();
    $.get(`${url}/admin/store/list`)
    .done(res => {
        swal.close();
        console.log(res);
        for(var x in res.stores.data) {
            $('#store_list_container').append(Store.storeList(res.stores.data[x]));
        }
    })
    .fail(err => {
        console.log(err);
    });
}

function getStoreRequests() {
    loader();
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: `${url}/admin/store/requests`,

        }).done(res => {
            console.log(res);
            swal.close();
            for(var x in res.stores.data) {
                $('#store_requests_container').append(Store.storeRequests(res.stores.data[x]));
            }
        }).fail(err => {
            console.log(err);
        })
    });
}

function acceptStore(id) {
    $.ajax({
        type: 'PUT',
        url: `${url}/admin/store/accept/${id}`,
        data: {
            _token: $('input[name=_token]').val()
        }
    }).done(res => {
        console.log(res);
        $(`#store_${id}`).remove();
        success("Store Accepted!");
    }).fail(err => {
        console.log(err);
    })
}