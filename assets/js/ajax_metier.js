/* Fonction pour afficher les membres du personnel selon le métier sélectionné */
let selection_metier = document.getElementById("metier");
selection_metier.addEventListener("click",ChangementMetier);

function ChangementMetier()
{
    // Exécution de la requête AJAX pour afficher les membres du personnel
    const xhttp_metier = new XMLHttpRequest();
    xhttp_metier.open("GET", "ajax_service_metier_personnel.php?service_selectionne=" +
    document.getElementById("service").value + "&metier_selectionne="+ document.getElementById("metier").value);
    xhttp_metier.send();

    xhttp_metier.onload = function()
    {
        document.getElementById("personnel").innerHTML = this.responseText;
    }
}
/* =========================================== */

