<?php
include_once '../../Eleve.class.php';

$query = '';
$output = array();
$query .= "SELECT * FROM eleve e INNER JOIN agence a ON e.agence = a.id_agence WHERE  DATEDIFF(CURRENT_DATE, dor) <= 250 ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'AND nom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prenom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR nom_agence LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY nom ASC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = Eleve::getPDO()->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["nom"];
	$sub_array[] = $row["prenom"];
    $sub_array[] = date('d/m/Y',strtotime($row["dob"]));
	$sub_array[] = $row["pob"];
	$sub_array[] = $row["categorie"];
	$sub_array[] = $row["nom_agence"];
	$sub_array[] =  '<input type="checkbox" class="form-group check"	id="'.$row["id_eleve"].'" >';

	$sub_array[] = '
	<button title="Modifier" type="button" name="update" id="'.$row["id_eleve"].'" class="btn btn-primary btn-sm detail_eleve "><i class="glyphicon glyphicon-pencil"></i></button>
	';


	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	Eleve::get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>