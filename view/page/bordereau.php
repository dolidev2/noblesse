<?php 
include_once "../model/Bordereau.class.php";
include_once'../model/Eleve.class.php';

$depot = Bordereau::afficherOne($_GET['bordereau']);
  
 ?>
<div class="col col-lg-12">
	<div class="panel-body" style="overflow: scroll;height: 700px;"> 
		<table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
			<div class="panel-header">
				<h4>Liste des dossiers des élèves pour ce dépôt</h4>
          <div class="row">
            <div class="col-lg-3">
                <button data-toggle="modal" data-target="#ajouter" class="btn btn-primary" style="margin:5px;">
                    <span class="fa fa-pencil"></span>
                    Ajouter
                </button>
            </div>
            <div class="col-lg-3">
              <a href="../public/pdf/bordereaudom.php?bordereau=<?=$_GET['bordereau'] ?>" target="_blank" class="btn btn-warning"><span class="fa fa-print"></span>
                Imprimer
              </a>              
            </div>
          </div>
			</div>
		    <thead>
		        <tr>
		            <th>N°</th>
		            <th>Nom</th>
		            <th>Prénom</th>
		            <th>Date de dépôt</th>
                    <th>Agence</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
                <?php
                    $depot = Bordereau::afficherBoredereauParticipant($_GET['bordereau']); $i=1;
                    foreach($depot as $dt){
                        ?>
                        <tr>
                        <td align="center" ><?= $i ?></td>
                        <td align="center" ><?= $dt->nom ?></td>
                        <td align="center" ><?= $dt->prenom ?></td>
                        <td align="center" ><?= date('d/m/Y',strtotime( $dt->date_depot ))?></td>
                        <td align="center" ><?= $dt->nom_agence ?></td>
                        <td>
                        <?php if ($_SESSION['fonction'] == 'administrateur') {  ?>
                    <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="<?='#mod'.$dt->id_eleve;?>">
                      <span class="fa fa-trash"></span>
                    </button>
                    <?php } ?>

                    <!-- Modal -->
                    <div class="modal fade" id="<?='mod'.$dt->id_eleve;?>" tabindex="-1" role="dialog"  aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" >
                              Supprimer <b><?=$dt->nom.' '.$dt->prenom; ?></b>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="post" action="../control/del_eleve_bordereau.php">
                              <div class="modal-body">                           
                                <input type="hidden" name="eleve_bordereau" value="<?=$dt->id_bordereau_eleve?>">
                                <input type="hidden" name="id_bordereau" value="<?=$dt->id_bordereau?>">

                                <button class="btn btn-danger">
                                <h3>
                                    Voulez vous vraiment supprimer cet élève ?                                              
                                </h3>
                                </button>                                      
                              </div>
                              <div class="modal-footer">                           
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                <button type="submit" name="submit" class="btn btn-primary">OUI</button>
                              </div>                                                      
                          </form>
                        </div>
                      </div>
                    </div>  	
		        </td>		        		        
		      </tr>
              <?php $i++; } ?>
		    </tbody>
		</table>
	</div>
</div>

<div id="ajouter" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Choisir les élèves à insérer</h4>
                <h5 style="color: red;"> Cochez la case de l'élève à sélectionner </h5>
            </div>
            <?php
            //Liste des élèves
            $eleves = Eleve::afficherCours();
            $elev = Eleve::afficherCoursExpire($eleves);
            $to_short = [];
            for ($n=0; $n < count( $elev); $n++) {
                $to_short += [  $elev[$n]['dob'].'*'. $elev[$n]['pob'].'*'. $elev[$n]['categorie'].'*'. $elev[$n]['id'] =>  $elev[$n]['nom'].'*'. $elev[$n]['prenom']];
            }
            //Tri et organise le tableau par ordre croissant insensible à la case
            natcasesort($to_short);
            ?>
            <form id="formExamen">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table" class="table table-striped table-bordered table-hover" >
                            <thead class="title">
                            <tr>
                                <th>N°</th>
                                <th>Nom et Prénoms</th>
                                <th>Date et Lieu de Naissance</th>
                                <th>Catégorie</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $j=1;
                            foreach ($to_short as $key => $value){
                                ?>
                                <tr>
                                    <td class="num"><?= $j ?></td>
                                    <td class="info"><?php echo explode('*', $value)[0].' '.explode('*', $value)[1] ; ?></td>
                                    <td class="info"><?php echo date("d/m/Y",strtotime(explode('*', $key)[0])).' à '.explode('*', $key)[1]; ?></td>
                                    <td class="info"><?php echo explode('*', $key)[2]; ?></td>
                                    <td><input type="checkbox" id="case" value="<?=explode('*', $key)[3] ?>">  </td>
                                </tr>
                                <?php
                                $j++;
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <input type="hidden" id="depot_eleve" value="<?= $_GET['bordereau'] ?>">
                            <button type="submit" class="btn btn-success">Valider</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var data = [];
        //Get id on focus
        $('input[id^="case"]').focusout(function () 
        {
            var eleveId = $(this).val();
            data.push({
                id:eleveId,
            });
        });

        //Submit form 
        $('#formExamen').submit(function () {

            var depot = $('#depot_eleve').val();
            $.post('../control/add_bordereau_eleve.php', {data:data,depot:depot}, function(response)
            {
                window.location.href = "index.php?page=bordereau&bordereau="+depot;
            });

            return false;
        });

    });
</script>
