<?php

    header('Content-Type: text/html; charset=utf-8');

    // CONDITIONS NOM
    if ( (isset($_POST["nom"])) && (strlen(trim($_POST["nom"])) > 0) ) {
        $nom = stripslashes(strip_tags($_POST["nom"]));
    } else {
        echo "Merci d'écrire un nom <br />";
        $nom = "";
    }

    // CONDITIONS EMAIL
    if ( (isset($_POST["email"])) && (strlen(trim($_POST["email"])) > 0) && (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) ) {
        $email = stripslashes(strip_tags($_POST["email"]));
    } elseif (empty($_POST["email"])) {
        echo "Merci d'écrire une adresse email <br />";
        $email = "";
    } else {
        echo "Email invalide :(<br />";
        $email = "";
    }
    

    // CONDITIONS MESSAGE
    if ( (isset($_POST["message"])) && (strlen(trim($_POST["message"])) > 0) ) {
        $message = stripslashes(strip_tags($_POST["message"]));
    } else {
        echo "Merci d'écrire un message<br />";
        $message = "";
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé

    // PREPARATION DES DONNEES
    $ip           = "mailout.one.com";
    $hostname     = gethostbyaddr("mailout.one.com");
    $destinataire = "contact@jimmy-friedblatt.fr";
    $objet        = "objet de la demande" . $nom;
    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n".$email."\r\n";
    $contenu     .= $message . "\r\n\n";

    $headers  = "CC: " . $email . " \r\n"; // ici l'expediteur du mail
    $headers .= "From: contact@jimmy-friedblatt.fr \r\n";
    

    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($nom)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message)) ) {
        echo 'echec :( <br /><a href="index.html">Retour au formulaire</a>';
    } else {
        // ENCAPSULATION DES DONNEES
        mail($destinataire, $objet, utf8_decode($contenu), $headers);
        echo 'Formulaire envoyé';
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>
