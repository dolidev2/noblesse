<?php include_once '../model/Caisse.class.php' ; ?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">        
                <li class="active"><a href="#recette" data-toggle="tab"><h4>Recettes</h4></a>
                </li>                                                                                             
            </ul>
            <div class="tab-content">         

                <!-- Tab Liste Users -->
                <div class="tab-pane fade in active" id="recette">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Toutes les Recettes
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Période</th>
                                        <th>Les Entrées</th>
                                        <th>Les Sorties</th>
                                        <th>Bénéfices</th>                                      
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <tr class="odd gradeX">
                                        <td>
                                            <span class="badge badge-danger">Cet Mois</span>
                                        </td>
                                        <td>                                   
                                            <a class="btn btn-success btn-lg" href="#">
                                              <?php 

                                              $entre_moi = Caisse::entreMoi($_POST['date']);
                                              echo $entre_moi[0]->total;

                                               ?>                                              
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-lg" href="#">
                                              <?php 

                                              $sortie_moi = Caisse::sortieMoi($_POST['date']);
                                              echo $sortie_moi[0]->total;

                                               ?>                                              
                                            </a>
                                        </td>
                                        <td>
                                            <a  class="btn btn-primary btn-lg" href="#">
                                              <?php
                                              echo ($entre_moi[0]->total - $sortie_moi[0]->total);                                              
                                               ?>                                              
                                            </a>
                                        </td>                                        
                                                                                                                    
                                    </tr> 
                                    <tr class="odd gradeX">
                                        <td>
                                            <span class="badge badge-danger">Cette Année</span>
                                        </td>
                                        <td>                                           
                                            <a class="btn btn-success btn-lg" href="#">
                                              <?php 

                                              $entre_annee = Caisse::entreAnnee($_POST['date']);
                                              echo $entre_annee[0]->total;

                                               ?>                                              
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-lg" href="#">
                                              <?php 

                                              $sortie_annee = Caisse::sortieAnnee($_POST['date']);
                                              echo $sortie_annee[0]->total;

                                               ?>                                              
                                            </a>
                                        </td>
                                        <td>
                                            <a  class="btn btn-primary btn-lg" href="#">
                                              <?php 
                                              echo ($entre_annee[0]->total - $sortie_annee[0]->total);                                             

                                               ?>                                              
                                            </a>
                                        </td>                                        
                                                                                                                     
                                    </tr>                                                                                                            
                                </tbody>
                            </table>                            
                        </div>
                    </div>                    
                </div>                          
                

            </div>            
        </div>        
    </div>    
</div> 