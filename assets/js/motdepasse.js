/* Fonction pour afficher le mot de passe */
let click_password = document.getElementById("eye");
click_password.addEventListener("click",AffichagePassword);

function AffichagePassword()
{
    if (document.getElementById("password").getAttribute("type") == "password")
    {
        document.getElementById("password").setAttribute("type","text");
    }
    else
    {
        document.getElementById("password").setAttribute("type","password");
    }
}
/* =========================================== */