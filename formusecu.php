<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="phpcss.css">
    <title>Document</title>
</head>
<body>

   <?php $options = array(
        "nom" => FILTER_SANITIZE_STRING,
        "prenom" => FILTER_SANITIZE_STRING,
        "mail" => FILTER_VALIDATE_EMAIL,
        "message" => FILTER_SANITIZE_STRING,
        "genre" => FILTER_SANITIZE_NUMBER_INT,
        "sujet" => FILTER_SANITIZE_NUMBER_INT,
        "pays" => FILTER_SANITIZE_NUMBER_INT,
    );


    $result = filter_input_array(INPUT_POST, $options);

    if ($result != null AND $result != FALSE) {

        echo "Nous avons bien reçu vos coordonnées! : <br>";
    
    } else {
    
        echo "Un champ est vide ou n'est pas correct!";
    
    }
    //condition pour les pays
            if ($result["pays"] == 1) {
                $result["pays"] = "Allemagne";
            }
            else if ($result["pays"] == 2) {
                $result["pays"] = "Belgique";
            }
            else if ($result["pays"] == 3) {
                $result["pays"] = "France";
            }
            else if ($result["pays"] == 4) {
                $result["pays"] = "Suisse";
            }
            else {
                $result["pays"] = "Error";
            }
//condition pour les genres
                        if ($result["genre"] == 1) {
                            $result["genre"] = "Homme";
                        }
                        else if ($result["genre"] == 2) {
                            $result["genre"] = "Femme";
                        }
                        else {
                            $result["genre"] = "Error";
                        }
//checkbox


    
    foreach($options as $key => $value) 
    {
       $result[$key]=trim($result[$key]);
    }

    echo 'Votre nom est '.$result['nom'] . "<br>";
    echo 'Votre prénom est '.$result['prenom'] . "<br>";
    echo 'Votre E-mail est '.$result['mail'] . "<br>";
    echo 'Vous habitez en '.$result['pays'] . "<br>";
    echo 'Votre message: '.$result['message'] . "<br>";
    echo 'Vous êtes un/une '.$result['genre'] . "<br>";
    
    if(!empty($_POST['sujet'])) {
        // Counting number of checked checkboxes.
        $checked_count = count($_POST['sujet']);
        echo "Vous avez selectionné".$checked_count." sujet(s): <br/>";
        // Loop to store and display values of individual checked checkbox.
        foreach($_POST['sujet'] as $selected) {
            if ($selected== 1) {
                $selected = 'commande';
                echo '<p>commande';
            }
            else if ($selected == 2) {
                $selected= 'remboursement';
                echo '<p>remboursement';
            }
            else if ($selected == 3) {
                $selected= 'réparation';
                echo '<p>réparation' .'</p>';
            }
            else if ($selected == 4) {
                $selected = 'Autre';
                echo '<p>Autre' .'</p>';
            }
            
        
        }

    }
    else {
        echo "<p>autre";
    }

?>
<p>Si vous voulez renvoyer un formulaire, <a href="index.html">clique ici</a></p>

<?php
$mail = 'weaponsb@mail.fr'; // Déclaration de l'adresse de destination.
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Bonjour".$result['prenom'].'ce mail confirme votre envoi de formulaire pour le site hackers poulette :) ' ;
$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Confirmation reception formulaire";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"CarolineL\"<lippenscaroline1@gmail.com>".$passage_ligne;
$header.= "Reply-to: \"caro\" <lippenscaroline1@gmail.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========
?>


</body>
</html>