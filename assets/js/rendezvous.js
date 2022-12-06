/* Fonction pour récupérer l'ID d'un champ avec un clic */
document.onclick = RendezVous;
function RendezVous(aEvent)
{
    // Evénement qui récupère les infos au moment du clic
    let e = aEvent ? aEvent : window.event;
    // Initialisation de l'ID sélectionné à l'écran
    let id_element = e.target.id;

    // On vérifie si 'id_element' contient la chaine "rdv_"
    if ( id_element.includes("rdv_") )
    {
        // Boucle pour récupérer le numéro ID du RDV et on sort quand le booléen 'id_OK' devient 'Vrai'
        let cpt_id = 0; // Compteur de boucle
        let taille_id_element = id_element.length -1; // Taille de la chaine - 1
        let id_OK = false; // Booléen indiquant que l'ID a été récupéré
        while ( (cpt_id < taille_id_element) && (!id_OK) )
        {
            // On remplace le caractère actuel par une chaine vide, comme une suppression
            id_element = id_element.replaceAll(id_element[cpt_id],"");
            // On vérifie si le caractère en cours est '_'
            if (id_element[cpt_id] == "_")
            {
                // On remplace le caractère actuel par une chaine vide, comme une suppression
                id_element = id_element.replaceAll(id_element[cpt_id],"");
                // On modifie l'état du booléen à 'Vrai' pour sortir de la boucle
                id_OK = true;
            }
        }
        
        // Exécution de la requête pour annuler un RDV
        const xhttp_rdv_annulatiion = new XMLHttpRequest();
        xhttp_rdv_annulatiion.open("GET", "rendezvous_annulation.php?id_rdv=" + id_element);
        xhttp_rdv_annulatiion.send();
    }
}
/* =========================================== */