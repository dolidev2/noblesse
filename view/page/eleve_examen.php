<?php 
    include_once '../model/Eleve.class.php' ;
    include_once '../model/Examen.class.php' ;
    include_once '../model/Dossier.class.php' ;    
	$dateDepot = Eleve::dateDepotEleve($_GET['id_eleve']);
 ?>
 <div class="col-lg-12">
 	<div class="row">
	 	<div id="form_payer" class="panel-body" style="overflow: scroll;height: 250px;">
				<div class="panel-header">
					<h4>Reporter les Résultats d'un Examen</h4>
				</div>			  
				<form role="form" id="Form" method="post" action="../control/reg_examen_eleve.php">
	                <div class="form-group">
	                    <label>Examen à Choisir</label>
	                    <select id="examen" class="form-control" name="id_examen" required>                       
	                       <?php 
	                       		$exams = Examen::afficherExamen();
	                       	?>
	                       	<?php foreach ($exams as $exam) : ?>
	                       		<option></option>
	                       		<option  value="<?=$exam->id_examen?>">
	                       			<?=$exam->type.' <=> '.$exam->date_examen.' <=> '.$exam->examinateur?>
	                       		</option>
	                       	<?php endforeach; ?>	

	                    </select>
	                </div>
			        <div class="form-group">
	                    <label>Résultat obténu</label>
	                    <select id="resultat" class="form-control" name="resultat" required>
	                       <option></option>
	                       <option  value="admis">Admis</option>
	                       <option  value="ajourne">Ajourné</option>   
						   <option  value="absent">Absent</option>                                              
	                    </select>
	                </div>                
	                <input type="hidden" name="id_eleve" value="<?=$_GET['id_eleve']?>">

			        <div class="form-group">		            
			            <input type="submit" name="submit" class="btn btn-success" value="Enregistrer">
			        </div>		        
				</form>   
		</div>
	</div>

	<div class="row">
		<div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs"> 
            	<li><a href="#date_depo" data-toggle="tab"><h4>Date de Dépos</h4></a>
                </li>               
                <li class="active"><a href="#code" data-toggle="tab"><h4>Code</h4></a>
                </li>
                <li><a href="#crenau" data-toggle="tab"><h4>Crénau</h4></a>
                </li>
                <li ><a href="#conduite" data-toggle="tab"><h4>Conduite</h4></a>
                </li>                                                
            </ul>
            <div class="tab-content">

            	<!-- Tab Date Dépos -->
                <div class="tab-pane fade" id="date_depo">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Date de dépos des Dossiers                            
                        </div>
                        <div class="panel-body"> 
               
							<?php
								if(!empty($dateDepot))
								{
							?>                    	
								<input type="text" value="<?= date("d/m/Y",strtotime($dateDepot[0]->date_depot)) ?>" readonly class="form-control">
							<?php }else{
								?>
								<input type="text" value="Dépôt de dossier non effectué" readonly class="form-control">
								<?php
							} ?>
							                                                       
                        </div>
                    </div>                    
                </div>


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
							        </tr>
							    </thead>
							    <tbody>
					    	<?php $codes = Examen::affichertExamenEleve('code',$_GET['id_eleve']); $j=1; ?>
                            <?php foreach ($codes as $code) : ?>
							      <tr>
							        <td align="center"><?=$j?></td>
							        <td align="center"><?=date("d/m/Y", strtotime($code->date_examen))?></td>
							        <td align="center"><?=$code->examinateur?></td>
							        <td class="badge badge-primary" align="center"><?=$code->resultat?></td>		        
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
                            Historique des examens du Crénau                            
                        </div>
                        <div class="panel-body">
                        	<table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
							    <thead>
							        <tr>
							            <th><b>N°</b></th>
							            <th><b>Date Examen</b></th>
							            <th><b>Examinateur</b></th>
							            <th><b>Résultat</b></th>
							        </tr>
							    </thead>
							    <tbody>
					    	<?php $crenaus = Examen::affichertExamenEleve('crenau',$_GET['id_eleve']); $j=1; ?>
                            <?php foreach ($crenaus as $crenau) : ?>
							      <tr>
							        <td align="center"><?=$j?></td>
							        <td align="center"><?=date("d/m/Y", strtotime($crenau->date_examen))?></td>
							        <td align="center"><?=$crenau->examinateur?></td>
							        <td class="badge badge-primary" align="center"><?=$crenau->resultat?></td>		        
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
							        </tr>
							    </thead>
							    <tbody>
					    	<?php $conduites = Examen::affichertExamenEleve('circulation',$_GET['id_eleve']); $j=1; ?>
                            <?php foreach ($conduites as $conduite) : ?>
							      <tr>
							        <td align="center"><?=$j?></td>
							        <td align="center"><?=date("d/m/Y", strtotime($conduite->date_examen))?></td>
							        <td align="center"><?=$conduite->examinateur?></td>
							        <td class="badge badge-primary" align="center"><?=$conduite->resultat?></td>		        
							      </tr>	

						      <?php $j++; ?> 
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
 </div>

 