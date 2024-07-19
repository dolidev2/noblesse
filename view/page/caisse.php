<?php include_once '../model/Caisse.class.php' ;
 include_once '../model/Versement.class.php' ;
 include_once '../model/Audit.class.php' ;

 $caisses = Caisse::afficherFromAgence($_SESSION['agence']);
 ?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#liste" data-toggle="tab"><h4>Entrées & Sorties</h4></a>
                </li>
                <li><a href="#recette" data-toggle="tab"><h4>Clôturer</h4></a>
                </li>
                <li><a href="#compte" data-toggle="tab"><h4>Versement</h4></a>
                </li>
                <li><a href="#fond" data-toggle="tab"><h4>Fond de caisse</h4></a>
                </li>
            </ul>

    </div>
</div>


<div id="ajouter" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enregistrement d'une Entrée ou Sortie d'argent</h4>
                <h5 style="color: red;"> Les informations suivies d'un astérix (*) sont obligatoires </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" action="../control/reg_caisse.php" method="POST">

                    <div class="form-group col-lg-4">
                        <label>Date de Transaction : </label>
                        <input class="form-control" type="date" name="date"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Libelle :  <span style="color: red">*</span></label>
                        <input class="form-control" type="text" name="desc" placeholder="Description" required />
                    </div>
                         <div class="form-group col-lg-4">
                           <label>Type de Transaction: <span style="color: red">*</span></label>
                           <div>
                                <select class="form-control" name="type"  required >
                                      <option value="entre" selected>Entrée d'argent</option>
                                      <option value="sortie" >Sortie d'argent</option>

                               </select>
                           </div>
                         </div>

                         <div class="form-group col-lg-4">
                             <label>Montant :  <span style="color: red">*</span></label>
                             <input class="form-control" type="number" name="somme" required />
                             <input  type="hidden" name="agence"  value="<?= $_SESSION['agence'] ?>" />
                        </div>
                       <div class="modal-footer">
                            <input type="submit" class="btn btn-success"  name="submit" value="Valider"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="ajouter_btn" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enregistrement de la recette du jour</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" action="../control/reg_recette.php" method="POST">
                    <div class="form-group col-lg-4">
                        <label>Date  : </label>
                        <input class="form-control" type="date" name="date"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Montant :  <span style="color: red">*</span></label>
                        <input class="form-control" type="number" name="somme" required />
                    </div>
                       <div class="modal-footer">
                            <input type="submit" class="btn btn-success"  name="submit" value="Valider"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="versement" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enregistrement d'un versement</h4>
                <h5 style="color: red;"> Les informations suivies d'un astérix (*) sont obligatoires </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" action="../control/reg_versement.php" method="POST">
                        <div class="form-group col-lg-4">
                            <label>La Somme :  <span style="color: red">*</span></label>
                            <input class="form-control" type="number" name="somme" required />
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Description :  <span style="color: red">*</span></label>
                            <input class="form-control" type="text" name="desc" placeholder="Description" required />
                        </div>

                        <div class="form-group col-lg-4">
                            <label>Mode Transaction :  <span style="color: red">*</span></label>
                            <div>
                                <select class="form-control" name="mode" required >
                                    <option value="ESPECE" selected>ESPECE</option>
                                    <option value="CHEQUE" >CHEQUE</option>
                                    <option value="MOBILE MONEY" >MOBILE MONEY</option>
                                    <option value="AUTRE" >AUTRE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Date de Transaction : </label>
                            <input class="form-control" type="date" name="date"/>
                            <input  type="hidden" name="agence_versement" value="<?= $_SESSION['agence'] ?>"/>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Banque :  <span style="color: red">*</span></label>
                            <div>
                                <select class="form-control" name="compte" required >
                                    <option value="BSIC" selected>SGB</option>
                                    <option value="CORIS">CORIS BANK</option>
                                    <option value="BOA">BOA</option>
                                    <option value="MOBILE MONEY" >MOBILE MONEY</option>
                                    <option value="UBA">UBA</option>
                                    <option value="ACEP">ECOBANK</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success"  name="submit" value="Valider"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="date" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Voir les Entrée ou Sortie d'argent suivant la date </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="form_date_cloture" action="../control/caisse_cloture.php" method="GET">
                         <div class="form-group col-lg-4">
                           <label>Choisir une date : <span style="color: red">*</span></label>
                           <input class="form-control" type="date" name="date" required />
                         </div>

                       <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Valider"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                       </div>
                    </form>
                    <div class="comment"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="mensuelle" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Choisir une date contenant le mois souhaité  </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="form_date_cloture" action="../public/pdf/versement.php" method="GET">
                        <div class="form-group col-lg-4">
                            <label>Choisir une date : <span style="color: red">*</span></label>
                            <input class="form-control" type="date" name="date" required />
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Valider"/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<div id="comment"></div>
<script type="text/javascript">
    $(document).ready(function () {

        var table_caisse = $('#table_caisse').DataTable({
            "responsive":true,
            "paging":true,
        });

        var table_versement = $('#table_versement').DataTable({
            "responsive":true,
            "paging":true,
        });

    });

</script>