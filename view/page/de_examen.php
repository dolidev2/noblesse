<?php 
    include_once'../model/Examen.class.php';
    include_once'../model/Eleve.class.php'; 

    $exam = Examen::afficherOne($_GET['id_examen']);  
 ?>
<div class="col col-lg-12">
	<div class="panel-body" style="overflow: scroll;height: 700px;"> 
		<table width="100%" class="table table-striped table-bordered table-hover" id="table_id">
			<div class="panel-header">
				<h4>Liste de Tous les Elèves qui ont participé à cet Examen</h4>
				<a href="../public/pdf/examendom.php?id_examen=<?=$_GET['id_examen']?>" target="_blank" class="btn btn-warning">Imprimer</a>
			</div>
		    <thead>
		        <tr>
		            <th>N°</th>
		            <th>Nom</th>
		            <th>Prénom</th>
		            <th>Type Examen</th>
		            <th>Date d'Examen</th>
		            <th>Examinateur</th>
		            <th>Résultat</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>

		    	<?php $eleves = Examen::afficherParticipantExamenOne($_GET['id_examen']); $j=1; ?>
                <?php foreach ($eleves as $eleve) : ?>

		      <tr>
		        <td align="center"><b><?=$j?></b></td>
		        <td align="center"><b><?=$eleve->nom ; ?></b></td>
		        <td align="center"><b><?=$eleve->prenom ; ?></b></td>
		        <td align="center"><b><?=$eleve->type ; ?></b></td>
		        <td align="center"><b><?=date("d/m/Y",strtotime($eleve->date_examen)) ?></b></td>
		        <td align="center"><b><?=$eleve->examinateur ; ?></b></td>
		        <td align="center"><b><?=$eleve->resultat ; ?></b></td>
		        <td>		        	
		        	<a title="Détail" class="btn btn-primary" 
		        	   href="index.php?page=eleve_examen&id_eleve=<?=$eleve->id_eleve ; ?>">
		        		<i class="fa fa-pencil"></i>
		        	</a> 	
		        </td>		        		        
		      </tr>
		      <?php $j++; endforeach; ?>

		    </tbody>
		</table>
	</div>
</div>

