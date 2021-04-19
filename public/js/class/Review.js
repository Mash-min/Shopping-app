class Review {
    constructor(id, firstname, lastname, message, image, user_id, auth_id) {
        this.id = id;
        this.name = firstname + " " + lastname;
        this.message = message;
        this.image = image;
        this.user_id = user_id;
        this.auth_id = auth_id;
    }

    reviewItem() {
        return `
            <div class="media" id="review-${this.id}">
                <div class="media-left">
                    <img class="media-object img-circle" src="/images/avatar.jpg" alt="...">
                </div>
                <div class="media-body">
                    ${reviewButtons(this.user_id, this.auth_id, this.id)}
                    <h4 class="media-heading">${this.name}</h4>
                    <p id="review-message-${this.id}">${this.message}</p>
                </div>
            </div>
        `;
    }
}

function deleteReview(id){
    console.log(id)
}

function reviewButtons(uid, aid, id) {
    if(uid == aid) {
        return `
            <a><i class="fa fa-times text-danger pull-right" onclick="deleteReview('${id}')"></i></a>
            <a><i class="fa fa-pencil pull-right" onclick="editReview('${id}')"></i></a>
        `;  
    }else {
        return '';
    }
}