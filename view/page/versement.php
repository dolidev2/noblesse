<?php

include_once "../model/Versement.class.php";
$id = $_GET['id_versement'];
$data = Versement::read_single($id);
?>

<div class="btn btn-primary btn-lg"><?= $data[0]->desc_ver ?></div>
<br>
<br><br>
<form role="form" id="versement">
    <div class="row">
        <div class="form-group col-lg-4">
            <label>La Somme :  <span style="color: red">*</span></label>
            <input class="form-control" type="number" name="somme" id="somme" value="<?= $data[0]->somme ?>" required />
        </div>
        <div class="form-group col-lg-4">
            <label>Description :  <span style="color: red">*</span></label>
            <input class="form-control" type="text" name="desc" id="desc" value="<?= $data[0]->desc_ver ?>" placeholder="Description" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-4">
            <label>Mode Transaction :  <span style="color: red">*</span></label>
            <div>
                <select class="form-control" name="mode" id="mode" required >
                    <option value="ESPECE" selected>ESPECE</option>
                    <option value="CHEQUE" >CHEQUE</option>
                    <option value="AUTRE" >AUTRE</option>
                </select>
            </div>
        </div>
        <div class="form-group col-lg-4">
            <label>Banque :  <span style="color: red">*</span></label>
            <div>
                <select class="form-control" name="compte" id="compte" required >
                    <option value="SGB" >SGB</option>
                    <option value="CORIS">CORIS BANK</option>
                    <option value="BOA"selected>BOA</option>
                    <option value="UBA">UBA</option>
                    <option value="ECOBANK">ECOBANK</option>
                    <option value="ATLANTIQUE">ATLANTIQUE</option>
                    <option value="WENDKUNI">WENDKUNI</option>
                    <option value="IB BANK">IB BANK</option>
                    <option value="AUTRE" >AUTRE</option>
                </select>
            </div>
        </div>
        <div class="form-group col-lg-4">
            <label>Date de Transaction :  <span style="color: red">*</span></label>
            <input type="date"  class="form-control" id="date" value="<?= date('d/m/Y',strtotime($data[0]->date))  ?>" >
        </div>
    </div>
    <div class="form-group">
        <input id="ver" type="hidden" class="form-control" value="<?= $data[0]->id_ver ?>" readonly>
    </div>
    <br>
    <div class="form-group">
        <button type="submit" class="btn-lg btn-primary">Modifier</button>
    </div>

</form>

<div id="comment"></div>

<script type="text/javascript">
    // Save User
    $('#versement').submit( function()
    {

        var somme = $('#somme').val();
        var desc = $('#desc').val();
        var mode = $('#mode').val();
        var compte = $('#compte').val();
        var date = $('#date').val();
        var ver = $('#ver').val();


        $.post('../control/up_versement.php', {somme:somme,desc:desc,mode:mode,compte:compte,ver:ver,date:date}, function(response)
        {
            $('#comment').html(response);
        });

        return false;

    });

</script>

