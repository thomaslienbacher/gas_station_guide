function set(star) {
    var rs = document.getElementById("ratingstar" + star);
    rs.className = "fa fa-star rating-star-small-good";
}

function unset(star) {
    var rs = document.getElementById("ratingstar" + star);
    rs.className = "fa fa-star rating-star-small";
}

function rate(amount) {
    var inputSave = document.getElementById("commentstars");
    inputSave.value = amount;

    for(var i = 1; i <= 5; i++) {
        if(amount >= i) {
            set(i);
        }
        else {
            unset(i);
        }
    }
}