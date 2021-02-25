<?php
//Import des classes PHPMailer 
//Doivent être en haut de votre script, pas à l'intérieur d'une fonction
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

//Composer autoload 
    require_once "vendor/autoload.php";

//
    include_once "config.php";
    include_once "head.php";
//

    if (isset($_POST["insert"])) {
        try {
            // Connexion mysql
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }   catch (PDOException $e) {
            echo "Try again" . $e->getMessage();
        exit();
    }

// Récupérer les valeurs 
    //$prenom     = $_POST['prenom'];
    //$nom        = $_POST['nom'];
    //$mail       = $_POST['mail'];
    $prenom       = htmlspecialchars($_POST['prenom']);           // Variable - données sécurisées htmlspecial
    $nom          = htmlspecialchars($_POST['nom']);             // Variable - données sécurisées htmlspecial
    $mail         = htmlspecialchars($_POST['mail']);           // Variable - données sécurisées htmlspecial

    

// Requête mysql pour insérer des données
    $sql        = "INSERT INTO `client`(`prenom`, `nom`, `mail`) VALUES (:prenom, :nom, :mail)";
    $res        = $pdo->prepare($sql);
    $exec       = $res->execute(array(":prenom" => $prenom, ":nom" => $nom, ":mail" => $mail));


// Vérifier si la requête d'insertion a fonctionnée
    // if ($exec) {
    //     echo "Yes";
    // } else {
    //     echo "Try again";
    // }

// Création objets
    $email      = new PHPMailer(true);
    $mailid     = $mail;
    $subject    = "Bienvenue";
    $message    = "Votre e-mail a bien été enregistré";

        try
        {
//Paramètres du serveur
    $email->SMTPDebug = SMTP::DEBUG_SERVER;                              // Activer la sortie de débogage détaillée
    $email->isSMTP();                                                   //  L'envoi utilise SMTP : Simple Mail Transfer Protocol
    $email->Host = "smtp.gmail.com";                                   //   Configuration du serveur SMTP selon boite mail
    $email->SMTPAuth = true;                                          //    Autoriser l'authentification SMTP 
    $email->isHTML(true);                                            //     Envoyer un mail au format HTML
    $email->SMTPDebug = 0;                                          //      Permet de "cacher" les paramètres à l'envoi
    $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           //       Activer le cryptage TLS ; `PHPMailer::ENCRYPTION_SMTPS` conseillé
    $email->Port = 587;                                           //        Port GMAIL 
    $email->addAddress($mailid);                                 //         Destinataire en fonction de l'adresse mail notée
    $email->Username ="veille.php.mail@gmail.com";              //          Expéditeur
    $email->Password =$motdepasse;                             //           Mot de passe
    $email->setFrom("veille.php.mail@gmail.com",'Nom');       //            Nom n'est pas obligatoire
    $email->Subject = $subject;                              //             Objet   
    $email->Body = $message;                                //              Message

        if($email->send())
            {
                echo '<h1>' . 'Bonjour ' . $prenom . ' ' . $nom . ' !' . '</br>' . 'Vous allez recevoir un mail de confirmation' . '</h1>';
            }
        } 

        catch(Exception $ex)
            {
            $msg = "
            ".$ex->errorMessage()."
            ";
            }
};
?>