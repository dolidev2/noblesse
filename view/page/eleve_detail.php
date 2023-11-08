<?php 

    include_once '../model/Eleve.class.php'; 
    include_once '../model/Examen.class.php';
    include_once '../model/Dossier.class.php';

    include_once '../model/Paiement.class.php';
    include_once '../config/config.php';    
    $eleve = Eleve::afficherOne($_GET['id_eleve']);
    $dossier = Dossier::afficher($_GET['id_eleve']);
    $dates_depot = Eleve::dateDepotEleve($_GET['id_eleve']);

    if(isset($dates_depot) && !empty( $dates_depot))
        $date_depot = $dates_depot[0]->date_depot;
    
    $paiement = Paiement::afficher($eleve[0]->id_eleve);
    $total = Paiement::afficherTotalOne($eleve[0]->id_eleve);
    $som = $total[0]->total;
    if ($som == NULL) 
        $som = 0;		
    else
        $som = floatval($som);
    
 ?>
<div class=" col-lg-12 btn btn-primary btn-lg"><?=$eleve[0]->nom.' '.$eleve[0]->prenom;?></div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nom</label>
            <input id="nom_save" readonly type="text" class="form-control" value="<?=$eleve[0]->nom; ?>" required>
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input id="prenom_save" readonly type="text" class="form-control" value="<?=$eleve[0]->prenom; ?>" required>
        </div>
        <div class="form-group">
            <label>Date de Naissance</label>
            <input id="dob_save" readonly type="date" class="form-control" value="<?=$eleve[0]->dob; ?>" required>                                        
        </div>
        <div class="form-group">
            <label>Lieu de Naissance</label>
            <input id="pob_save" readonly type="text" class="form-control" value="<?=$eleve[0]->pob; ?>" required>
        </div>  
        <div class="form-group">
            <label>Sexe</label>
            <input id="pob_save" readonly type="text" class="form-control" value="<?=$eleve[0]->sexe; ?>" required>
        </div>
        <div class="form-group">
            <label>Profession</label>
            <input id="profession_save" readonly type="text" class="form-control" value="<?=$eleve[0]->profession; ?>" required>
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <input id="adresse_save" readonly type="text" class="form-control" value="<?=$eleve[0]->adresse; ?>" required>
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input id="contact_save" readonly type="text" class="form-control" value="<?=$eleve[0]->contact; ?>" required>
        </div>
        <div class="form-group">
            <label>Date d'inscription</label>
            <input id="contact_save" readonly type="text" class="form-control" value="<?= date('d/m/Y',strtotime($eleve[0]->dor )); ?>" required>
        </div>
        <?php $permis = Eleve::afficherPermis($_GET['id_eleve']);
            if(!empty($permis)){?>
                <div class="form-group">
                    <label>Numéro permis provisoire</label>
                    <input readonly type="text" class="form-control" value="<?=$permis[0]->permis; ?>" required>
                </div>      
                <div class="form-group">
                    <label>Date de retrait permis provisoire</label>
                    <input readonly type="text" class="form-control" value="<?= date('d/m/Y',strtotime( $permis[0]->date_retrait )) ?>" required>
                </div>
        <?php }
         if(!empty( $dates_depot)){
        ?>
       
        <div class="form-group">
            <label>Date de dépôt</label>
            <input id="contact_save" readonly type="text" class="form-control" value="<?= date('d/m/Y',strtotime( $date_depot )); ?>" required>
        </div>
        <?php } ?>
    </div>       
    <div class="col-lg-6">
  
        <div class="panel-body" style="overflow: scroll;height: 300px;"> 
		<table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
			<div class="panel-header">
				<h4>Historique Paiement</h4>Reste à Payer
				<button class="btn btn-primary">
					<?php 
				 		$rel = ($eleve[0]->solde - $som);
				 		echo $rel;
				 	?>
				 </button><br>
			</div>
		    <thead>
		        <tr>
		            <th>N°</th>
		            <th>Somme</th>
		            <th>Date</th>
		            <th>Type</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		    <?php $i=1; foreach ($paiement as $paie): ?>	
		      <tr>
		        <td align="center"><u><b><?=$paie->numero?></b></u></td>
		        <td align="center"><u><b><?=$paie->somme?></b></u></td>
		        <td align="center"><u><b><?=$paie->date_paiement?></b></u></td>
		        <td align="center"><u><b><?=$paie->type?></b></u></td>
		        <td>
                    <?php
                        if($_SESSION['fonction'] == 'administrateur'){
                    ?>
		        	<span data-toggle="modal" data-target="<?='#mod'.$i;?>" title="Modifier" class="btn btn-primary">
		        		<i class="fa fa-pencil"></i>
		        	</span>
                    <?php  } ?>
		        	<!-- Modal -->
                    <div class="modal fade" id="<?='mod'.$i;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#mod'.$i;?>" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="<?='#mod'.$i;?>">
                              Modifier Paiment</b>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
	                          <form method="post" action="../control/up_paiement.php">
	                          	<div class="form-group">
						            <label>Numéro Reçu</label>
						            <input readonly id="numero_pai" type="text" name="numero_pai" class="form-control" value="<?=$paie->numero ?>">
						        </div>
	                          	<div class="form-group">
						            <label>Date Paiement</label>
						            <input id="date_pai" type="date" name="date_paiement" class="form-control" value="<?=$paie->date_paiement?>">
						        </div>
						        <div class="form-group">
						            <label>Somme</label>
						            <input id="somme_pai" type="number" name="somme" class="form-control" value="<?=$paie->somme?>">
						        </div>
						        <div class="form-group">
						            <label>Type de Paiement</label>
						            <input id="type_pai" type="text" name="type" class="form-control" value="<?=$paie->type?>">
						        </div>	
						        <input type="hidden" name="id" value="<?=$eleve[0]->id_eleve?>">
						        <input type="hidden" name="id_paiement" value="<?=$paie->id_paiement?>">	        
						        <div class="form-group">		            
						            <input type="submit" class="form-control btn btn-primary" value="Modifier" required>
						        </div>
	                          </form>
	                        </div>  
                        </div>
                      </div>
                    </div>

                    <!-- Modal must dynam and script --> 
                    <?php if ($_SESSION['fonction'] == 'administrateur') {  ?>                   
                    <button data-toggle="modal" data-target="<?='#sup'.$i;?>" class="btn btn-danger" title="Supprimer">
                    	<i class="fa fa-trash"></i>                    	
                    </button>
                    <?php } ?>

                    <!-- Modal -->
                    <div class="modal fade" id="<?='sup'.$i;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#sup'.$i;?>" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="<?='#sup'.$i;?>">
                              Supprimer
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>                          
                              <div class="modal-body">                        
                                <button class="btn btn-danger">
                                <h3>
                                    Voulez vous vraiment supprimer ce réçu ?                                                 
                                </h3>
                                </button>                                      
                              </div>
                              <div class="modal-footer">                           
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                <a class="btn btn-primary" href="../control/del_paiement.php?id_paiement=<?=$paie->id_paiement;?>&id_eleve=<?=$eleve[0]->id_eleve?>">
			                        OUI
			                    </a>
                              </div>                  
                        </div>
                      </div>
                    </div>
		        	
		        	<a href="../public/pdf/recudom.php?r=<?=$rel?>&id_paiement=<?=$paie->id_paiement?>&id_eleve=<?=$eleve[0]->id_eleve?>" target="_blank" title="Imprimer" class="btn btn-warning">
		        		<i class="fa fa-print"></i>
		        	</a>		        			        	
		        </td>		        		        
		      </tr>
		    <?php $i++; endforeach; ?>  
		    </tbody>
		</table>
	</div>
    </div>    
    <div class="col-lg-6">
		<div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs"> 
                    <li class="active"><a href="#code" data-toggle="tab"><h4>Code</h4></a>
                    </li>
                    <li><a href="#crenau" data-toggle="tab"><h4>Crénau</h4></a>
                    </li>
                    <li ><a href="#conduite" data-toggle="tab"><h4>Conduite</h4></a>
                    </li>     
                    <li ><a href="#permis" data-toggle="tab"><h4>Permis</h4></a>
                    </li>                                                
                </ul>
                <div class="tab-content">
                    <!-- Tab Liste Users -->
                    <div class="tab-pane fade in active" id="code">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Historique des examens du Code                            
                            </div>
                            <div class="panel-body">                        	
                                <table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th><b>N°</b></th>
                                            <th><b>Date Examen</b></th>
                                            <th><b>Examinateur</b></th>
                                            <th><b>Résultat</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php $codes = Examen::affichertExamenEleveCode($config['CODE'],$_GET['id_eleve']); $j=1; ?>
                                <?php foreach ($codes as $code) : ?>
                                    <tr>
                                        <td align="center"><?=$j?></td>
                                        <td align="center"><?=date("d/m/Y", strtotime($code->date_examen))?></td>
                                        <td align="center"><?=$code->examinateur?></td>
                                        <td class="badge badge-primary" align="center"><?=$code->resultat?></td>		        
                                        <td>
                                            <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="<?='#suppression'.$j;?>">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <div class="modal fade" id="<?='suppression'.$j;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#suppression'.$j;?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="<?='#suppression'.$j;?>">
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/del_examen_eleve.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="examen_eleve" value="<?=$code->id_examen_eleve; ?>">
                                                                <button class="btn btn-danger">
                                                                    <h3>
                                                                        Voulez vous vraiment supprimer cet résultat ?
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
                                            <button title="Modifier" class="btn btn-success"  data-toggle="modal" data-target="<?='#modification'.$j;?>">
                                                <span class="fa fa-pencil"></span>
                                            </button>

                                            <div class="modal fade" id="<?='modification'.$j;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#modification'.$j;?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="<?='#modification'.$j;?>">
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/up_examen_eleve.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="examen_eleve" value="<?= $code->id_examen_eleve; ?>">
                                                                <input type="hidden" name="eleve" value="<?= $code->eleve; ?>">
                                                                <select class="form-control" name="resultat">
                                                                        <option value="" selected>--------</option>
                                                                        <option value="admis"  >Admis</option>
                                                                        <option value="ajourné">Ajourné</option>
                                                                        <option value="absent">Absent</option>
                                                                        <option value="FNT">FNT</option>
                                                                </select>
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

                                <?php $j++; ?>
                                <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Liste Users -->
                    <div class="tab-pane fade" id="crenau">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Historique des examens du Créneau
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th><b>N°</b></th>
                                            <th><b>Date Examen</b></th>
                                            <th><b>Examinateur</b></th>
                                            <th><b>Résultat</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php $crenaus = Examen::affichertExamenEleve($config['CRENEAU'],$_GET['id_eleve']); $j=1; ?>
                                <?php foreach ($crenaus as $crenau) : ?>
                                    <tr>
                                        <td align="center"><?=$j?></td>
                                        <td align="center"><?=date("d/m/Y", strtotime($crenau->date_examen))?></td>
                                        <td align="center"><?=$crenau->examinateur?></td>
                                        <td class="badge badge-primary" align="center"><?=$crenau->resultat?></td>
                                        <td>
                                            <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="<?='#suppressions'.$j;?>">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <div class="modal fade" id="<?='suppressions'.$j;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#suppressions'.$j;?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="<?='#suppressions'.$j;?>">
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/del_examen_eleve.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="examen_eleve" value="<?=$code->id_examen_eleve; ?>">
                                                                <button class="btn btn-danger">
                                                                    <h3>
                                                                        Voulez vous vraiment supprimer cet résultat ?
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
                                            <button title="Modifier" class="btn btn-success"  data-toggle="modal" data-target="<?='#modifications'.$j;?>">
                                                <span class="fa fa-pencil"></span>
                                            </button>

                                            <div class="modal fade" id="<?='modifications'.$j;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#modifications'.$j;?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="<?='#modifications'.$j;?>">
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/up_examen_eleve.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="examen_eleve" value="<?= $code->id_examen_eleve; ?>">
                                                                <input type="hidden" name="eleve" value="<?= $code->eleve; ?>">
                                                                <select class="form-control" name="resultat">
                                                                        <option value="" selected>--------</option>
                                                                        <option value="admis"  >Admis</option>
                                                                        <option value="ajourné">Ajourné</option>
                                                                        <option value="absent">Absent</option>
                                                                        <option value="FNT">FNT</option>
                                                                </select>
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
                                <?php $j++; ?>
                                <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Liste Permis Provisoir -->
                    <div class="tab-pane fade" id="conduite">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Historique des examens de Conduite
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th><b>N°</b></th>
                                            <th><b>Date Examen</b></th>
                                            <th><b>Examinateur</b></th>
                                            <th><b>Résultat</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php $conduites = Examen::affichertExamenEleve($config['CIRCULATION'],$_GET['id_eleve']); $j=1; ?>
                                <?php foreach ($conduites as $conduite) : ?>
                                    <tr>
                                        <td align="center"><?=$j?></td>
                                        <td align="center"><?=date("d/m/Y", strtotime($conduite->date_examen))?></td>
                                        <td align="center"><?=$conduite->examinateur?></td>
                                        <td class="badge badge-primary" align="center"><?=$conduite->resultat?></td>
                                        <td>
                                            <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="<?='#suppress'.$j;?>">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <div class="modal fade" id="<?='suppress'.$j;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#suppress'.$j;?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="<?='#suppress'.$j;?>">
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/del_examen_eleve.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="examen_eleve" value="<?=$code->id_examen_eleve; ?>">
                                                                <button class="btn btn-danger">
                                                                    <h3>
                                                                        Voulez vous vraiment supprimer cet résultat ?
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
                                            <button title="Modifier" class="btn btn-success"  data-toggle="modal" data-target="<?='#modificat'.$j;?>">
                                                <span class="fa fa-pencil"></span>
                                            </button>

                                            <div class="modal fade" id="<?='modificat'.$j;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#modificat'.$j;?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="<?='#modificat'.$j;?>">
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/up_examen_eleve.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="examen_eleve" value="<?= $code->id_examen_eleve; ?>">
                                                                <input type="hidden" name="eleve" value="<?= $code->eleve; ?>">
                                                                <select class="form-control" name="resultat">
                                                                        <option value="" selected>--------</option>
                                                                        <option value="admis"  >Admis</option>
                                                                        <option value="ajourné">Ajourné</option>
                                                                        <option value="absent">Absent</option>
                                                                        <option value="FNT">FNT</option>
                                                                </select>
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
                                <?php $j++; ?>
                                <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="permis">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Retrait du Permis Provisoire
                               <button title="Ajouter" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouter_permis">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th><b>Permis</b></th>
                                            <th><b>Date de retrait</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php $permis = Eleve::afficherPermis($_GET['id_eleve']);
                                if(!empty($permis)){
                                ?>
                                <?php foreach ($permis as $pm) : ?>
                                    <tr>
                                        <td align="center"><?= $pm->permis;?></td>
                                        <td align="center"><?=date("d/m/Y",strtotime($pm->date_retrait)) ;?></td>
                                        <td>
                                            <?php if ($_SESSION['fonction'] == 'administrateur') {  ?>
                                                <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppressPermis">
                                                    <span class="fa fa-trash"></span>
                                                </button>
                                            <?php } ?>
                                            <div class="modal fade" id="suppressPermis" tabindex="-1" role="dialog" aria-labelledby="suppressPermis" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/del_permis.php">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="retrait" value="<?= $pm->id_retrait; ?>">
                                                                <input type="hidden" name="eleve" value="<?= $_GET['eleve']; ?>">
                                                                <button class="btn btn-danger">
                                                                    <h3>
                                                                        Voulez vous vraiment supprimer ?
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

                                            <button title="Modifier" class="btn btn-success"  data-toggle="modal" data-target="#modifierPermis">
                                                <span class="fa fa-pencil"></span>
                                            </button>

                                            <div class="modal fade" id="modifierPermis" tabindex="-1" role="dialog" aria-labelledby="modifierPermis" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="#modifierPermis">
                                                                Retrait du permis provisoire
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="../control/up_permis.php">
                                                            <div class="modal-body">
                                                                <div>
                                                                        <label for="Nom">Numéro permis provisoire</label>
                                                                        <input type="text" name="permis" class="form-control" value="<?=$pm->permis ?>" required>

                                                                        <input type="hidden" name="retrait" value="<?= $pm->id_retrait ?>" class="form-control">
                                                                        <input type="hidden" name="eleve" value="<?= $_GET['id_eleve'] ?>" class="form-control">
                                                                    </div>
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
                                <?php $j++; ?>
                                <?php endforeach; }?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal permis provisoire-->
                            <div class="modal fade" id="ajouter_permis" tabindex="-1" role="dialog" aria-labelledby="#ajouter_permis" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="#ajouter_permis">
                                                Retrait de permis provisoire
                                            </h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="../control/reg_permis.php">
                                            <div class="modal-body">
                                                <div>
                                                    <label for="Nom">Numéro permis provisoire</label>
                                                    <input type="text" name="permis" class="form-control" required>
                                                    <input type="date" name="date_permis" class="form-control" required>
            
                                                    <input type="hidden" name="eleve" value="<?= $_GET['id_eleve'] ?>" class="form-control">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>