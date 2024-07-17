<?php

include_once "../model/Caisse.class.php";
$id = $_GET['id_caisse'];
$data = Caisse::afficherOne($id);
var_dump($data);
?>

<div class="btn btn-primary btn-lg"><?= $data[0]->desc_caisse ?></div>
<br>
<br><br>
<form role="form" id="caisse_up">
    <div class="row">
        <div class="form-group col-lg-4">
            <label>Type de Transaction:  <span style="color: red">*</span></label>
            <select class="form-control" name="type" id="type"  required >
                <option value="entre" selected>Entrée d'argent</option>
                <option value="sortie" >Sortie d'argent</option>
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label>La Somme :  <span style="color: red">*</span></label>
            <input class="form-control" type="number" name="somme" id="somme" value="<?= $data[0]->somme ?>" required />
        </div>
        <div class="form-group col-lg-4">
            <label>Description :  <span style="color: red">*</span></label>
            <input class="form-control" type="text" name="desc" id="desc" value="<?= $data[0]->desc_caisse ?>" placeholder="Description" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-4">
            <label>Mode Transaction :  <span style="color: red">*</span></label>
            <div>
                <select class="form-control" name="mode" id="mode" required >
                    <option value="ESPECE" selected>ESPECE</option>
                    <option value="CHEQUE" >CHEQUE</option>
                    <option value="ORANGE MONEY">ORANGE MONEY</option>
                    <option value="MOBICASH" >MOBICASH</option>
                    <option value="WESTERN UNION" >WESTERN UNION</option>
                    <option value="AUTRE" >AUTRE</option>
                </select>
        </div>
        </div>
        <div class="form-group col-lg-4">
            <label>Destination :  <span style="color: red">*</span></label>
            <div>
                <select class="form-control" name="compte" id="compte" required >
                    <option value="COMPTE" selected>COMPTE</option>
                    <option value="SOFI" >SOFI</option>
                    <option value="AUTRE" >AUTRE</option>
                </select>
            </div>
        </div>
        <div class="form-group col-lg-4">
            <label>Date de Transaction :  <span style="color: red">*</span></label>
            <input type="date"  class="form-control" id="date" value="<?=date('d/m/Y',strtotime($data[0]->date)) ?>" >
        </div>
    </div>
        <div class="form-group">
            <input id="id_caisse" type="hidden" class="form-control" value="<?= $data[0]->id_caisse ?>" readonly>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn-lg btn-primary">Modifier</button>
        </div>

</form>

<div id="comment"></div>

<script type="text/javascript">
    // Save User
    $('#caisse_up').submit( function()
    {
        var type = $('#type').val();
        var somme = $('#somme').val();
        var desc = $('#desc').val();
        var mode = $('#mode').val();
        var compte = $('#compte').val();
        var date = $('#date').val();
        var caisse = $('#id_caisse').val();


        $.post('../control/up_caisse.php', {type:type,somme:somme,desc:desc,mode:mode,compte:compte,caisse:caisse,date:date}, function(response)
        {
            $('#comment').html(response);
        });

        return false;

    });

</script>

