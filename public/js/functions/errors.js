function userValidationErrors(err) {
    $('.alert').remove();
    $('.has-error').removeClass('has-error');
    if(err.responseJSON.errors.firstname) {
        $('.firstname-form').addClass('has-error');
        $('.firstname-form').prepend(alertMessage(err.responseJSON.errors.firstname));
    }
    if(err.responseJSON.errors.lastname) {
        $('.lastname-form').addClass('has-error');
        $('.lastname-form').prepend(alertMessage(err.responseJSON.errors.lastname));
    }
    if(err.responseJSON.errors.email) {
        $('.email-form').addClass('has-error');
        $('.email-form').prepend(alertMessage(err.responseJSON.errors.email));
    }
    if(err.responseJSON.errors.contact) {
        $('.contact-form').addClass('has-error');
        $('.contact-form').prepend(alertMessage(err.responseJSON.errors.contact));
    }
    if(err.responseJSON.errors.address) {
        $('.address-form').addClass('has-error');
        $('.address-form').prepend(alertMessage(err.responseJSON.errors.address));
    }
}

function storeValidationErrors(err) {
    $('.alert').remove();
    if(err.responseJSON.already_have_store) {
        $('.name-form').prepend(alertMessage(err.responseJSON.already_have_store));
        return 0;
    }
    $('.has-error').removeClass('has-error');
    if(err.responseJSON.errors.name) {
        $('.name-form').addClass('has-error');
        $('.name-form').prepend(alertMessage(err.responseJSON.errors.name));
    }
    if(err.responseJSON.errors.email) {
        $('.email-form').addClass('has-error');
        $('.email-form').prepend(alertMessage(err.responseJSON.errors.email));
    }
    if(err.responseJSON.errors.description) {
        $('.description-form').addClass('has-error');
        $('.description-form').prepend(alertMessage(err.responseJSON.errors.description));
    }
    if(err.responseJSON.errors.contact) {
        $('.contact-form').addClass('has-error');
        $('.contact-form').prepend(alertMessage(err.responseJSON.errors.contact));
    }
    if(err.responseJSON.errors.address) {
        $('.address-form').addClass('has-error');
        $('.address-form').prepend(alertMessage(err.responseJSON.errors.address));
    }
}

function storeUpdateErrors(err) {
    if(err.responseJSON.errors.name) {
        $('.name-form').addClass('has-error');
        $('.name-form').prepend(alertMessage(err.responseJSON.errors.name));
    }
    if(err.responseJSON.errors.email) {
        $('.email-form').addClass('has-error');
        $('.email-form').prepend(alertMessage(err.responseJSON.errors.email));
    }
    if(err.responseJSON.errors.contact) {
        $('.contact-form').addClass('has-error');
        $('.contact-form').prepend(alertMessage(err.responseJSON.errors.contact));
    }
    if(err.responseJSON.errors.address) {
        $('.address-form').addClass('has-error');
        $('.address-form').prepend(alertMessage(err.responseJSON.errors.address));
    }
    if(err.responseJSON.errors.description) {
        $('.description-form').addClass('has-error');
        $('.description-form').prepend(alertMessage(err.responseJSON.errors.description));
    }
}

function productValidationErrors(err) {
    if(err.responseJSON.errors.name) {
        $('.form-name').addClass('has-error');
        $('.form-name label').append(alertText(err.responseJSON.errors.name));
    }
    if(err.responseJSON.errors.price) {
        $('.form-price').addClass('has-error');
        $('.form-price label').append(alertText(err.responseJSON.errors.price));
    }
    if(err.responseJSON.errors.discount) {
        $('.form-discount').addClass('has-error');
        $('.form-discount label').append(alertText(err.responseJSON.errors.discount));
    }
    if(err.responseJSON.errors.srp) {
        $('.form-srp').addClass('has-error');
        $('.form-srp label').append(alertText(err.responseJSON.errors.srp));
    }
    if(err.responseJSON.errors.warranty) {
        $('.form-warranty').addClass('has-error');
        $('.form-warranty label').append(alertText(err.responseJSON.errors.warranty));
    }
    if(err.responseJSON.errors.quantity) {
        $('.form-quantity').addClass('has-error');
        $('.form-quantity label').append(alertText(err.responseJSON.errors.quantity));
    }
    if(err.responseJSON.errors.delivery_fee) {
        $('.form-delivery-fee').addClass('has-error');
        $('.form-delivery-fee label').append(alertText(err.responseJSON.errors.delivery_fee));
    }
    if(err.responseJSON.errors.image) {
        $('.form-image').addClass('has-error');
        $('.form-image label').append(alertText(err.responseJSON.errors.image));
    }
    if(err.responseJSON.errors.description) {
        $('.form-description').addClass('has-error');
        $('.form-description label').append(alertText(err.responseJSON.errors.description));
    }
}

function alertMessage(msg) {
    return `
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            ${msg}
        </div>
    `;
}

function alertText(msg) {
    return `
        <span class="text-danger product_error_message">${msg}</span>
    `;
}