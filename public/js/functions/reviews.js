$('#create_review_form').on('submit', function(e) {
    e.preventDefault();
    loader();
    let reviewData = new FormData(this);
    $.ajax({
        type: 'post',
        url: `${url}/review/api/create`,
        data: reviewData,
        cache: false,
        contentType: false,
        processData: false
    }).done(res => {
        swal.close();
        $('input[name=message]').val("");
        let review1 = new Review(
            res.review.id,
            res.user.firstname,
            res.user.lastname,
            res.review.message,
            res.user.image,
            res.review.user_id,
            res.review.user_id,
        )
        $('#reviews_container').prepend(review1.reviewItem());
    }).fail(err => {
        console.log(err);
    })
});

function getReviews(code) {
    $.ajax({
        type: 'get',
        url: `${url}/product/api/find/${code}/reviews/json`
    }).done(res => {
        console.log(res);
        for(var x in res.reviews.data) {
            let review1 = new Review(
                res.reviews.data[x].id, 
                res.reviews.data[x].user.firstname, 
                res.reviews.data[x].user.lastname, 
                res.reviews.data[x].message, 
                res.reviews.data[x].user.image,
                res.reviews.data[x].user_id,
                res.user_id
            );
            $('#reviews_container').prepend(review1.reviewItem());
        }
    }).fail(err => {
        console.log(err);
    })
}

let review = {};
function editReview(id) {
    $('#editReviewModal').modal('toggle');
    $('#message_inp').val("");
    $.ajax({
        type: 'get',
        url: `${url}/review/api/find/id=${id}`
    }).done(res => {
        review = res.review;
        $('#message_inp').val(review.message);
        console.log(res);
    }).fail(err => {
        console.log(err);
    })
}

$('#edit_review_form').on('submit', function(e) {
    e.preventDefault();
    let updateReview = new FormData(this);
    $.ajax({
        type: 'post',
        url: `${url}/review/api/update/id=${review.id}`,
        data: updateReview,
        cache: false,
        contentType: false,
        processData: false
    }).done(res => {
        console.log(res);
        $('#editReviewModal').modal('hide');
        let message = document.getElementById(`review-message-${res.review.id}`);
        message.textContent = res.review.message;
    }).fail(err => {
        console.log(err);
    })
});

function deleteReview(id) {
    swal({
        title: 'Are you sure?',
        text: 'The selected reiew will be deleted.',
        dangerMode: true,
        buttons: true,
    }).then((willDelete) => {
        if(willDelete) {
            $.ajax({
                type: 'delete',
                url: `${url}/review/api/delete/id=${id}`,
                data: {
                    _token: $('input[name=_token]').val()
                }
            }).done(() => {
                success("Successfuly removed");
                $(`#review-${id}`).remove();
            }).fail(err => {
                console.log(err);
            })
        }
    })
    
}