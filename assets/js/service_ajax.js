/* Fonction pour afficher les métiers et les membres du personnel selon le service sélectionné */
let selection_service = document.getElementById("service");
selection_service.addEventListener("click",ChangementService);

function ChangementService()
{
    // Exécution de la requête AJAX pour afficher les métiers
    const xhttp_service = new XMLHttpRequest();
    xhttp_service.open("GET", "personnel_ajax_service_metier.php?service_selectionne=" + document.getElementById("service").value);
    xhttp_service.send();

    xhttp_service.onload = function()
    {
        document.getElementById("metier").innerHTML = this.responseText;
    }

    // Exécution de la requête AJAX pour afficher les membres du personnel
    const xhttp_metier = new XMLHttpRequest();
    xhttp_metier.open("GET", "personnel_ajax_service_metier_personnel.php?service_selectionne=" +
    document.getElementById("service").value + "&metier_selectionne="+ document.getElementById("metier").value);
    xhttp_metier.send();

    xhttp_metier.onload = function()
    {
        document.getElementById("personnel").innerHTML = this.responseText;
    }
}
/* =========================================== */

