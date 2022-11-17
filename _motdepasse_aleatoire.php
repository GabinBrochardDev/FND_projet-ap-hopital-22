<?php
    /* Initialisation des chaines contenant les alphabets minuscules et majuscules, les caractères spéciaux et les chiffres */
    $alphabet_min = 'abcdefghijklmnopqrstuvwxyz';
    $alphabet_maj = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sp_caracteres = '+-&$![]{}=()@#';
    $chiffres = '0123456789';
    /* Boucle pour créer un mot de passe automatique */
    for ($cpt_password = 0; $cpt_password < 3; $cpt_password++)
    {
        /* Ajout d'une lettre minuscule */
        $pos_alphabet_min = rand(0,strlen($alphabet_min)-1); /* Nombre alétoire de la chaine */
        $password_personne = $password_personne . $alphabet_min[$pos_alphabet_min]; /* Ajout du caractère au mot de passe */

        /* Ajout d'une lettre majuscule */
        $pos_alphabet_maj = rand(0,strlen($alphabet_maj)-1); /* Nombre alétoire de la chaine */
        $password_personne = $password_personne . $alphabet_maj[$pos_alphabet_maj]; /* Ajout du caractère au mot de passe */

        /* Ajout d'un caractère spécial */
        $pos_sp_caracteres = rand(0,strlen($sp_caracteres)-1); /* Nombre alétoire de la chaine */
        $password_personne = $password_personne . $sp_caracteres[$pos_sp_caracteres]; /* Ajout du caractère au mot de passe */

        /* Ajout d'un chiffre */
        $pos_chiffres = rand(0,strlen($chiffres)-1); /* Nombre alétoire de la chaine */
        $password_personne = $password_personne . $chiffres[$pos_chiffres]; /* Ajout du caractère au mot de passe */
    } 

    /* On mélange le mot de passe */
    $password_personne = str_shuffle($password_personne);
?>