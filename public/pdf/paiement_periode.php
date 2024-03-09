<?php
require '../../dompdf/vendor/autoload.php';
include_once("../../model/Eleve.class.php");
include_once("../../model/Agence.class.php");

if(isset($_GET['agence']))
{
    $eleves = Eleve::afficherInscrisAgencePeriode($_GET['agence'], $_GET['debut'], $_GET['fin']);
    $agence = Agence::afficherAgenceOne($_GET['agence']);
    $nom_agence =  $agence[0]->nom_agence;
}else{
    $eleves = Eleve::afficherInscrisPeriode($_GET['debut'], $_GET['fin']);
    $nom_agence = 'Toutes agences';
}

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->set_option('isHtml5ParserEnabled', true);
ob_start();
?>
    <div class="container">
        <img  src="head.png" width="100 %" >
        <h2 class="title1">Elèves inscris à :  <?= $nom_agence ?> sur la période du <?= date("d/m/Y",strtotime($_GET['debut']))?> au <?= date("d/m/Y",strtotime($_GET['fin']))?> </h2>
        <br>
        <table class="table">
            <thead class="title">
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Catégorie</th>
                <th>Date et lieu de naissance</th>
                <th>Date d'inscription</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $j=1;
                foreach ($eleves as $eleve)
                {?>
                    <tr>
                        <td class="num"><?= $j ?></td>
                        <td class="info"><?= $eleve->nom  ?></td>
                        <td class="info"><?= $eleve->prenom ?></td>
                        <td class="info"><?= $eleve->categorie ?></td>
                        <td class="info"><?= date("d/m/Y", strtotime($eleve->dob)).' à '. $eleve->pob ?></td>
                        <td class="info"><?= date("d/m/Y", strtotime($eleve->dor)) ?></td>
                    </tr>
                    <?php
                    $j++;
                }
            ?>
            </tbody>
        </table>
    </div>
    <style>
        .title{
            text-align: center;
            font-weight:bold;
            font-size: 16px;
        }
        .title1{
            text-align: center;
            font-weight:bold;
            text-transform: capitalize;
            text-transform: uppercase;
            font-size: 18px;
            border: 1 px solid black;
        }
        .info{
            text-transform: uppercase;
            text-align: left;
            font-size: 14px;
            padding-left: 5px;
        }
        p{
            font-weight: bold;
        }

        table{
            width: 100%;
        }
        th{
            text-align: center;
        }

        table,th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .num{
            text-align: center;
        }
    </style>

<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(  'Elèves inscris sur la période du '. date("d/m/Y",strtotime($_GET['debut'])). ' au '.date("d/m/Y",strtotime($_GET['fin']))
,array('Attachment'=>0));