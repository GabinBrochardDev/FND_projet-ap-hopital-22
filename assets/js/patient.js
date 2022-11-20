/* Fonction pour récupérer l'ID d'un champ avec un clic */
document.onclick = InfosUtilisateur;
function InfosUtilisateur(aEvent)
{
    // Evénement qui récupère les infos au moment du clic
    let e = aEvent ? aEvent : window.event;
    // Initialisation de l'ID sélectionné à l'écran
    let id_element = e.target.id;

    // On vérifie si 'id_element' contient la chaine "utilisateur_"
    if ( (id_element.includes("nom_")) || (id_element.includes("prenom_")) || (id_element.includes("sexe_")) || (id_element.includes("datenaissance_"))
        || (id_element.includes("numsecu_")) || (id_element.includes("adresse_")) || (id_element.includes("codepostal_")) || (id_element.includes("ville_")) || (id_element.includes("pays_")) )
    {
        // Boucle pour récupérer le numéro ID de la personne et on sort quand le booléen 'id_OK' devient 'Vrai'
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

        // Ajout du nom du patient dans les champ 'input' pour l'ID "nom" et l'ID "nom_hidden"
        document.getElementById("nom").value = document.getElementById("nom_" + id_element).innerHTML;
        document.getElementById("nom_hidden").value = document.getElementById("nom_" + id_element).innerHTML;
        // Ajout du prénom du patient dans les champ 'input' pour l'ID "prenom" et l'ID "prenom_hidden"
        document.getElementById("prenom").value = document.getElementById("prenom_" + id_element).innerHTML;
        document.getElementById("prenom_hidden").value = document.getElementById("prenom_" + id_element).innerHTML;
        // Ajout du sexe du patient dans les champ 'input' pour l'ID "sexe" et l'ID "sexe_hidden"
        document.getElementById("sexe").value = document.getElementById("sexe_" + id_element).innerHTML;
        document.getElementById("sexe_hidden").value = document.getElementById("sexe_" + id_element).innerHTML;
        // Ajout de la date de naissance du patient dans les champ 'input' pour l'ID "datenaissance" et l'ID "datenaissance_hidden"
        document.getElementById("datenaissance").value = document.getElementById("datenaissance_" + id_element).innerHTML;
        document.getElementById("datenaissance_hidden").value = document.getElementById("datenaissance_" + id_element).innerHTML;
        // Ajout du N° de Sécurité Sociale du patient dans les champ 'input' pour l'ID "numsecu" et l'ID "numsecu_hidden"
        document.getElementById("numsecu").value = document.getElementById("numsecu_" + id_element).innerHTML;
        document.getElementById("numsecu_hidden").value = document.getElementById("numsecu_" + id_element).innerHTML;
        // Ajout de l'adresse du patient dans les champ 'input' pour l'ID "adresse" et l'ID "adresse_hidden"
        document.getElementById("adresse").value = document.getElementById("adresse_" + id_element).innerHTML;
        document.getElementById("adresse_hidden").value = document.getElementById("adresse_" + id_element).innerHTML;
        // Ajout du Code Postal du patient dans les champ 'input' pour l'ID "codepostal" et l'ID "codepostal_hidden"
        document.getElementById("codepostal").value = document.getElementById("codepostal_" + id_element).innerHTML;
        document.getElementById("codepostal_hidden").value = document.getElementById("codepostal_" + id_element).innerHTML;
        // Ajout de la vile du patient dans les champ 'input' pour l'ID "ville" et l'ID "ville_hidden"
        document.getElementById("ville").value = document.getElementById("ville_" + id_element).innerHTML;
        document.getElementById("ville_hidden").value = document.getElementById("ville_" + id_element).innerHTML;
        // Ajout du pays du patient dans les champ 'input' pour l'ID "pays" et l'ID "pays_hidden"
        document.getElementById("pays").value = document.getElementById("pays_" + id_element).innerHTML;
        document.getElementById("pays_hidden").value = document.getElementById("pays_" + id_element).innerHTML;
    }
}
/* =========================================== */