<?php include_once '../model/Paiement.class.php' ; ?>
<?php include_once '../model/Eleve.class.php' ; ?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">                
                <li ><a href="#liste_imp" data-toggle="tab"><h4>Impayés</h4></a>
                </li>
                <li><a href="#liste_red" data-toggle="tab"><h4>Toujours Redevables</h4></a>
                </li>
                <li class="active"><a href="#liste_solde" data-toggle="tab"><h4>Tous Payés</h4></a>
                </li>                                                
            </ul>
            <div class="tab-content">
            	<!-- Tab Liste Users -->
                <div class="tab-pane fade" id="liste_imp">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tous les Impayés en cours
                            <a href="../public/pdf/paiement.php?ind=impaye" target="_blank" class="btn btn-warning">Imprimer</a>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Contact</th>
                                        <th>Forfait</th>
                                        <th>Solde</th>
                                        <th>Catégorie</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $eleves = Eleve::afficherImpaye(); $i=1; 
                                    ?>
                                    <?php foreach ($eleves as $eleve) : ?>
                                    <tr class="odd gradeX">
                                        <td><?=$i; ?></td>
                                        <td><?=$eleve->nom; ?></td>
                                        <td><?=$eleve->prenom; ?></td>
                                        <td><?=$eleve->contact; ?></td>
                                        <td><?=$eleve->forfait; ?></td>
                                        <td><?=$eleve->solde; ?></td>
                                        <td><?=$eleve->categorie; ?></td>
                                        <td class="center">
                                            <a class="btn btn-primary" href="index.php?page=de_eleve&id_eleve=<?=$eleve->id_eleve;?>">
                                            	<span class="fa fa-pencil"></span>                            	
                                            </a>                                    
                                        </td>                                        
                                    </tr>
                                    <?php $i++; ?> 
                                    <?php endforeach; ?>                                      
                                </tbody>
                            </table>                            
                        </div>
                    </div>                    
                </div> 

                <!-- Tab Liste Users -->
                <div class="tab-pane fade" id="liste_red">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tous Encore Redevables en  Cours
                            <a href="../public/pdf/paiement.php?ind=redevable" target="_blank" class="btn btn-warning">Imprimer</a>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Contact</th>
                                        <th>Forfait</th>
                                        <th>Catégorie</th>
                                        <th>Solde</th>
                                        <th>Payé</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                          $reds = Eleve::afficherPaiement(); $j=1;
                                          foreach ($reds as $red) :
                                          if ($red->solde > $red->some) 
                                          {                                             
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?=$j; ?></td>
                                        <td><?=$red->nom; ?></td>
                                        <td><?=$red->prenom; ?></td>
                                        <td><?=$red->contact; ?></td>
                                        <td><?=$red->forfait; ?></td>
                                        <td><?=$red->categorie; ?></td>
                                        <td><?=$red->solde; ?></td>
                                        <td><?=$red->some?></td>
                                        <td class="center">                                    
                                            <a title="Détail" class="btn btn-primary" href="index.php?page=de_eleve&id_eleve=<?=$red->id_eleve;?>">
                                              <span class="fa fa-pencil"></span>
                                            </a>
                                        </td>                                        
                                    </tr>
                                    <?php  $j++; } ?> 
                                    <?php endforeach; ?>                                      
                                </tbody>
                            </table>                            
                        </div>
                    </div>                    
                </div>
                <!-- Tab Liste Permis Provisoir -->
                <div class="tab-pane fade  in active" id="liste_solde">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Les Elèves à Jour en cours
                            <a href="../public/pdf/paiement.php?ind=solde" target="_blank" class="btn btn-warning">Imprimer</a>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Contact</th>
                                        <th>Forfait</th>
                                        <th>Catégorie</th>
                                        <th>Solde</th>
                                        <th>Payé</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
                                 $pupil = Eleve::afficherPaiement(); $k=1; 
                                 foreach ($pupil as $pup) :
                                 if ($pup->solde == $pup->some) 
                                 {                                   
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?=$k; ?></td>
                                        <td><?=$pup->nom; ?></td>
                                        <td><?=$pup->prenom; ?></td>
                                        <td><?=$pup->contact; ?></td>
                                        <td><?=$pup->forfait; ?></td>
                                        <td><?=$pup->categorie; ?></td>
                                        <td><?=$pup->solde; ?></td>
                                        <td><?=$pup->some?></td>
                                        <td class="center">                                    
                                            <a title="Détail" class="btn btn-primary" href="index.php?page=de_eleve&id_eleve=<?=$pup->id_eleve;?>">
                                              <span class="fa fa-pencil"></span>
                                            </a>
                                        </td>                                        
                                    </tr>
                                    <?php $k++;} ?> 
                                    <?php endforeach; ?>                                      
                                </tbody>
                            </table>                            
                        </div>
                    </div>                    
                </div>

            </div>            
        </div>        
    </div>    
</div>

