/* Fonction pour afficher les métiers, membres du personnel et salles selon le service sélectionné */
let selection_service = document.getElementById("service");
selection_service.addEventListener("click",ChangementService);

function ChangementService()
{
    // Exécution de la requête AJAX pour afficher les métiers selon le service
    const xhttp_service = new XMLHttpRequest();
    xhttp_service.open("GET", "ajax_service_metier.php?service_selectionne=" + document.getElementById("service").value);
    xhttp_service.send();
    xhttp_service.onload = function()
    {
        document.getElementById("metier").innerHTML = this.responseText;
    }

    // Exécution de la requête AJAX pour afficher les membres du personnel selon le service
    const xhttp_metier = new XMLHttpRequest();
    xhttp_metier.open("GET", "ajax_service_metier_personnel.php?service_selectionne=" +
                        document.getElementById("service").value + "&metier_selectionne="+ document.getElementById("metier").value);
    xhttp_metier.send();
    xhttp_metier.onload = function()
    {
        document.getElementById("personnel").innerHTML = this.responseText;
    }

    // Exécution de la requête AJAX pour afficher les salles selon le service
    const xhttp_salle = new XMLHttpRequest();
    xhttp_salle.open("GET", "ajax_service_salle.php?service_selectionne=" + document.getElementById("service").value);
    xhttp_salle.send();
    xhttp_salle.onload = function()
    {
        document.getElementById("salle").innerHTML = this.responseText;
    }

    // Exécution de la requête AJAX pour afficher la durée du service
    const xhttp_duree = new XMLHttpRequest();
    xhttp_duree.open("GET", "ajax_service_duree.php?service_selectionne=" + document.getElementById("service").value);
    xhttp_duree.send();
    xhttp_duree.onload = function()
    {
        document.getElementById("dureerdv").value = this.responseText + " minutes";
        document.getElementById("dureerdv_hidden").value = this.responseText;
    }
}
/* =========================================== */