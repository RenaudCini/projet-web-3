$(document).ready(function () {
    let buttonSearch = $("#buttonSearch");
    buttonSearch.click(function () {
        let valeur = $("#recherche").val();
        console.log(valeur);
    });
});