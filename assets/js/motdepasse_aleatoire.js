/* Fonction pour générer un mot de passe aléatoire */
let click_rand_password = document.getElementById("rand_password");
click_rand_password.addEventListener("click",PasswordAleatoire);

function PasswordAleatoire()
{
    // Initialisation des chaines contenant les alphabets minuscules et majuscules, les caractères spéciaux et les chiffres
    let alphabet_min = "abcdefghijklmnopqrstuvwxyz";
    let alphabet_maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let sp_caracteres = "+-&$![]{}=()@#";
    let chiffres = "0123456789";
    // Initialisation des variables pour construire le mot de passe
    let password_aleatoire = "";
    let pos_alphabet_min = 0;
    let pos_alphabet_maj = 0;
    let pos_sp_caracteres = 0;
    let pos_chiffres = 0;
    let password_personne = "";
    // Boucle pour créer un mot de passe automatique
    for (let cpt_password = 0; cpt_password < 3; cpt_password++)
    {
        // Ajout d'une lettre minuscule
        pos_alphabet_min = Math.floor(Math.random() * alphabet_min.length); /* Nombre alétoire de la chaine */
        password_aleatoire = password_aleatoire + alphabet_min[pos_alphabet_min]; /* Ajout du caractère au mot de passe */

        // Ajout d'une lettre majuscule
        pos_alphabet_maj = Math.floor(Math.random() * alphabet_maj.length) /* Nombre alétoire de la chaine */
        password_aleatoire = password_aleatoire + alphabet_maj[pos_alphabet_maj]; /* Ajout du caractère au mot de passe */

        // Ajout d'un caractère spécial
        pos_sp_caracteres = Math.floor(Math.random() * sp_caracteres.length) /* Nombre alétoire de la chaine */
        password_aleatoire = password_aleatoire + sp_caracteres[pos_sp_caracteres]; /* Ajout du caractère au mot de passe */

        // Ajout d'un chiffre
        pos_chiffres = Math.floor(Math.random() * chiffres.length) /* Nombre alétoire de la chaine */
        password_aleatoire = password_aleatoire + chiffres[pos_chiffres]; /* Ajout du caractère au mot de passe */
    }
    // On mélange le mot de passe. On boucle tant qu'un caractère est présent dans la chaine.
    let nb_melanges = password_aleatoire.length;
    while(nb_melanges > 0)
    {
        // On récupère un caractère du mot de passe de façon aléatoire
        let pos_lettre = Math.floor(Math.random() * (password_aleatoire.length));
        let caractere = password_aleatoire[pos_lettre];
        // On remplace le caractère actuel par une chaine vide, comme une suppression
        password_aleatoire = password_aleatoire.replace(password_aleatoire[pos_lettre],"");
        // On ajoute le caractère à la fin du mot de passe 'password_personne'
        password_personne = password_personne + caractere;
        // On décrémente le compteur
        nb_melanges--;
    }
    // On affiche le mot de passe
    document.getElementById("password").value = password_personne;
    document.getElementById("password_hidden").value = password_personne;
}
/* =========================================== */