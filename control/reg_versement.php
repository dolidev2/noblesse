<?php
session_start();
include_once '../model/Versement.class.php';
include_once '../model/Audit.class.php';

if ( isset($_POST['somme']) AND isset($_POST['desc']) AND isset($_POST['mode']) AND isset($_POST['date']) AND isset($_POST['compte']))
{

    $somme = strip_tags(htmlspecialchars(trim($_POST['somme'])));
    $desc = strip_tags(htmlspecialchars(trim($_POST['desc'])));
    $mode = strip_tags(htmlspecialchars(trim($_POST['mode'])));
    $date = strip_tags(htmlspecialchars(trim($_POST['date'])));
    $compte = strip_tags(htmlspecialchars(trim($_POST['compte'])));


    $data = array(
        'somme' => $somme,
        'desc' => $desc,
        'compte' => $compte,
        'mode' => $mode,
        'date' => $date,
        );
    $desc_audit = 'Versement de '.$somme.' effectué dont le motif est '.$desc.' dans la banque '.$compte;

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Ajout',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);
    Versement::register($data);

    header('location:../view/index.php?page=caisse');
}
else
{?>
    <script type="text/javascript">
        alert("Impossible champs vides")
    </script>

    <?php
    header('location:../view/index.php?page=caisse');
}
?>