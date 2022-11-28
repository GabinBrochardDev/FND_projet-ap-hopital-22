/* Fonction pour afficher les patients selon la saisie */
let saisie_nom_patient = document.getElementById("recherche_patient");
saisie_nom_patient.addEventListener("input",ChargementRDV);

function ChargementRDV()
{
    // Exécution de la requête AJAX pour afficher les patients
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "rendezvous_ajax_patient.php?filtre=" + document.getElementById("recherche_patient").value);
    xhttp.send();
    
    xhttp.onload = function()
    {
        document.getElementById("tableau_patients").innerHTML = this.responseText;
    }
}
/* =========================================== */