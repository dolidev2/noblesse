<?php

include_once "../model/Caisse.class.php";
$id = $_GET['recette'];
$data = Caisse::afficherRecetteOne($id);
?>

<form role="form" id="caisse_up">

    <div class="form-group col-lg-4">
        <label>Somme :  <span style="color: red">*</span></label>
        <input class="form-control" type="number" name="somme" id="somme" value="<?= $data[0]->somme_recette ?>" required />
    </div>
    <div class="form-group col-lg-4">
        <label>Date :  <span style="color: red">*</span></label>
        <input class="form-control" type="date" name="date" id="date" value="<?= $data[0]->date_recette ?>" required />
        <input type="hidden"  id="recette" value="<?= $id ?>" />
    </div>

    <div class="form-group">
        <button type="submit" class="btn-lg btn-primary">Modifier</button>
    </div>

</form>

<div id="comment"></div>

<script type="text/javascript">
    // Save User
    $('#caisse_up').submit( function()
    {
        var somme = $('#somme').val();
        var date = $('#date').val();
        var recette = $('#recette').val();

        $.post('../control/up_recette.php', {somme:somme,date:date,recette:recette}, function(response)
        {
            $('#comment').html(response);
        });

        return false;

    });

</script>

