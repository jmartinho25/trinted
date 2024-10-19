function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function addFavorite(id) {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/addFavorite.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id}))
    location.reload()
}

function removeFavorite(id) {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/removeFavorite.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id}))
    location.reload()
}

function addCart(id) {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/addCart.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id}))
    location.reload()
}

function removeCart(id) {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/removeCart.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id}))
    location.reload()
}

function addPurchase() {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/purchase.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send()
    location.reload()
}

function addAdmin(id) {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/addAdmin.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id}))
    location.reload()
}

function removeAdmin(id) {

    const request = new XMLHttpRequest()
    request.open("post", "../actions/removeAdmin.action.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id}))
    location.reload()
}

function addCategory() {

    let name = window.prompt("Insira o nome da categoria:");


    if (name !== null && name.trim() !== "") {
        let sanitizedName = encodeURIComponent(name);
        const request = new XMLHttpRequest();
        request.open("post", "../actions/newCategory.action.php", true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        let data = encodeForAjax({ name: sanitizedName });

        request.send(data);

        location.reload();
    }
}

function addCondition() {

    let name = window.prompt("Insira a categoria a adicionar:");


    if (name !== null && name.trim() !== "") {

        let sanitizedName = encodeURIComponent(name);

        const request = new XMLHttpRequest();
        request.open("post", "../actions/newCondition.action.php", true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        let data = encodeForAjax({ name: sanitizedName });

        request.send(data);

        location.reload();
    }
}

function addRating(id) {

    let ratingString = window.prompt("Insira a classificação:");

    if (ratingString !== null && ratingString.trim() !== "") {

        let rating = encodeURIComponent(ratingString);

        const request = new XMLHttpRequest();
        request.open("post", "../actions/addRating.action.php", true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        let data = encodeForAjax({rating: rating, id:id });

        request.send(data);

        location.reload();
    }
}
