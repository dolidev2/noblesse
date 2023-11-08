<?php

include_once'../../model/Eleve.class.php';
include_once'../../model/Paiement.class.php';
$eleve = Eleve::afficherOne($_GET['id']);
$paiement = Paiement::afficher($_GET['id']);
$total = Paiement::afficherTotalOne($_GET['id']);
$som = $total[0]->total;
if ($som == NULL)
{
    $som = 0;
}
else
{
    $som = floatval($som);
}


require '../../dompdf/vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->set_option('isHtml5ParserEnabled', true);
ob_start();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <style>
            table, tr, th, td{
                border: 1px solid black;
            }
            #text-centre{
                /*text-align: center;*/
                margin-left: 120px;
            }
            .container{
                width: 1748px;
                height: 2480px;
            }
            #carre {
                margin-left: 22px;
                height: 100px;
                width: 90px;
                /*background: red;*/
                border: 1px solid black;
                -ms-transform: rotate(45deg); /* Internet Explorer */
                -moz-transform: rotate(45deg); /* Firefox */
                -webkit-transform: rotate(90deg); /* Safari et Chrome */
                -o-transform: rotate(45deg); /* Opera */
            }

            #petit-carre {
            //                 background-color:black;
                margin-left: 22px;
                /*margin-top: 100px;*/
                height: 40px;
                width: 30px;
                /*background: red;*/
                border: 1px solid black;
                -ms-transform: rotate(45deg); /* Internet Explorer */
                -moz-transform: rotate(45deg); /* Firefox */
                -webkit-transform: rotate(90deg); /* Safari et Chrome */
                -o-transform: rotate(45deg); /* Opera */
            }
            #petit2-carre {
                margin-left: 150px;
                margin-bottom: -200%;
                height: 40px;
                width: 30px;
                /*background: red;*/
                border: 1px solid black;
                -ms-transform: rotate(45deg); /* Internet Explorer */
                -moz-transform: rotate(45deg); /* Firefox */
                -webkit-transform: rotate(90deg); /* Safari et Chrome */
                -o-transform: rotate(45deg); /* Opera */
            }
            #img-success{
                transform: rotate(-90deg);
                text-align:center;
                padding-top: 5px;
                padding-right: 150px;
            }
            #photo{
                margin-bottom: -80px;
            }
        </style>
        <!-- Bootstrap Core CSS -->

        <link rel="stylesheet" href=../css/bootstrap.min.css">

    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="head.png" alt="" width="500">
            </div>
        </div>
        <div class="row" id="photo">
            <div class="col-3" id="carre"></div>
            <div class="col-3" id="text-centre">
                <p>CARTE DE CONDUITE</p>
                <p>MATRICULE: <?= $eleve[0]->matricule ?></p>
            </div>
        </div>
        <div class="row" >
            <div class="col-12">
                <br>
                <p>Nom: <?= $eleve[0]->nom ?></p>
                <p>Prénom: <?= $eleve[0]->prenom ?></p>
                <p>Date de naissance: <?= date('d/m/Y', strtotime( $eleve[0]->dob)) ?></p>
                <p>Lieu de naissance: <?= $eleve[0]->pob ?></p>
                <p>Profession: <?= $eleve[0]->profession ?></p>
                <p>Permis demandé: <?= $eleve[0]->categorie ?></p>
                <p>Etat de versement: <?php if (isset($paiement[0]->type)) echo $paiement[0]->type; else  echo "Aucun versement"; ?></p>
                <p>Laisser passer pour:</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Créneau &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Circulation</p>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div id="petit-carre">
                    <img id="img-success" src="check2.jpg" width="20" height="20" />
                </div>
            </div>
            <div class="col-3">
                <?php
                if ($som == $eleve[0]->solde) {
                    ?>
                    <div id="petit2-carre">
                        <img id="img-success" src="check2.jpg" width="20" height="20" />
                    </div>
                    <?php
                }else{
                    ?>
                    <div id="petit2-carre"></div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Observations</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </body>
    </html>
    <!---->
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A5', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Carte.pdf",array('Attachment'=>0));
