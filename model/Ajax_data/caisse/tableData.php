<?php
include_once '../../Caisse.class.php';
session_start(); 
$query = '';
$output = array();
$query .= "SELECT * FROM caisse  WHERE ";
if(isset($_POST["search"]["value"]))
{
	$query .= ' date LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR type LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR desc_caisse LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR somme LIKE "%'.$_POST["search"]["value"].'%" ';

}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY date DESC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = Caisse::getPDO()->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$sub_array = array();

	$sub_array[] = date('d/m/Y',strtotime($row["date"]));
	$sub_array[] = $row["desc_caisse"];
    if ($row['type'] == 'sortie') { 
        $sub_array[] = '<button class="btn btn-danger">Dépense</button>';
    }
    else
    {
        $sub_array[] = '<button class="btn btn-success">Recette</button>';
    }
	$sub_array[] = $row["somme"];

    if ($_SESSION['fonction'] == 'administrateur') {  
            $sub_array[] = '
                    <a title="Modifier" class="btn btn-primary" href="index.php?page=up_caisse&id_caisse='.$row["id_caisse"].'">
                        <span class="fa fa-pencil"></span>
                     </a>
        
                    <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="#mod'.$row["id_caisse"].'">
                        <span class="fa fa-trash"></span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="#mod'.$row["id_caisse"].'" tabindex="-1" role="dialog" aria-labelledby="#mod'.$row["id_caisse"].'" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="#mod'.$row["id_caisse"].'">
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="../control/del_caisse.php">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_caisse" value="'.$row["id_caisse"].'">
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
            ';
    }
	
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	Caisse::get_total_all_records_caisse(),
	"data"				=>	$data
);
echo json_encode($output);
?>