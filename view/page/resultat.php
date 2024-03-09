<?php
include_once'../model/Examen.class.php';
include_once'../model/Eleve.class.php';
include_once'../config/config.php';

$exam = Examen::afficherOneExamen($_GET['id_examen']);
?>
<div class="col col-lg-12">
    <div class="panel-body" style="overflow: scroll;height: 700px;">
        <table width="100%" class="table table-striped table-bordered table-hover" >
            <div class="panel-header">
                <h4>Liste de Tous les Elèves Programmés à cet Examen</h4>
                <h2 style="text-align: center;">Examen de <b><?= $exam[0]->type ?></b> effectué <?= date("d/m/Y", strtotime($exam[0]->date_examen)) ?> </h2>
                <button style="margin-left:45%; " class="btn btn-primary" id="btn_save">Enrégistrer</button>
                <button  class="btn btn-success" id="btn_print">Imprimer</button>
                <input type="hidden" id="idexam" value="<?=  $exam[0]->id_examen ?>">
                <br>
                <br>
            </div>
            <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Lieu de naissance</th>
                <th>Agence</th>
                <th>Statut</th>
                <th>Examen</th>
            </tr>
            </thead>
            <tbody>
            <?php $eleves = Examen::afficherParticipantProgram($_GET['id_examen']); $j=1; ?>

            <?php foreach ($eleves as $eleve) : ?>
                <?php
                        $resultat = Examen::afficherResultat($eleve->id_eleve,$_GET['id_examen']);
                    ?>
                <tr>
                    <td align="center"><b><?=$j?></b></td>
                    <td align="center"><b><?=$eleve->nom ; ?></b></td>
                    <td align="center"><b><?=$eleve->prenom ; ?></b></td>
                    <td align="center"><b><?= date("d-m-Y", strtotime($eleve->dob)) ; ?></b></td>
                    <td align="center"><b><?=$eleve->pob ; ?></b></td>
                    <td align="center"><?=$eleve->nom_agence ; ?></td>
              
                    <td align="center">
                        <input type="hidden" id="idres" value="<?= $eleve->id_eleve ?>">
                        <select class="form-control" id="resultat">
                        <?php
                            if(isset($resultat)  && $resultat[0]->resultat == "admis"){
                        ?>
                            <option value="">--------</option>
                            <option value="admis" selected >Admis</option>
                            <option value="ajourné">Ajourné</option>
                            <option value="absent">Absent</option>
                            <option value="FNT">FNT</option>
                        <?php
                            }

                        elseif(isset($resultat)  && $resultat[0]->resultat == "ajourné"){
                            ?>

                                <option value="">--------</option>
                                <option value="admis"  >Admis</option>
                                <option value="ajourné" selected>Ajourné</option>
                                <option value="absent">Absent</option>
                                <option value="FNT">FNT</option>
                            <?php
                        }

                       elseif(isset($resultat) && $resultat[0]->resultat == "absent"){
                            ?>

                                <option value="">--------</option>
                                <option value="admis"  >Admis</option>
                                <option value="ajourné">Ajourné</option>
                                <option value="absent" selected>Absent</option>
                                <option value="FNT">FNT</option>
                            <?php
                        }

                       elseif(isset($resultat)  && $resultat[0]->resultat == "FNT"){
                            ?>

                                <option value="">--------</option>
                                <option value="admis"  >Admis</option>
                                <option value="ajourné">Ajourné</option>
                                <option value="absent">Absent</option>
                                <option value="FNT"selected>FNT</option>
                            <?php
                        }
                        else{
                            ?>

                            <option value="" selected>--------</option>
                            <option value="admis"  >Admis</option>
                            <option value="ajourné">Ajourné</option>
                            <option value="absent">Absent</option>
                            <option value="FNT">FNT</option>
                            <?php
                        }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select id="exam" class="form-control">
                            <?php
                                if(isset($resultat) && $resultat[0]->type_examen == $config['CRENEAU']){
                            ?>
                                <option value="creneau" >Créneau</option>
                                <option value="conduite">Conduite</option>
                                <option value="">----------</option>
                                <option value="<?= $resultat[0]->type_examen?>" selected><?= $resultat[0]->type_examen?></option>
                            <?php
                            }elseif(isset($resultat) && $resultat[0]->type_examen == $config['CIRCULATION']){
                            ?>
                                <option value="creneau" >Créneau</option>
                                <option value="conduite" >Conduite</option>
                                <option value="">----------</option>
                                <option value="<?= $resultat[0]->type_examen?>" selected><?= $resultat[0]->type_examen?></option>
                            <?php
                            }else{
                                ?>
                                    <option value="creneau" >Créneau</option>
                                    <option value="conduite" >Conduite</option>
                                    <option value="" selected>----------</option>
                                <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php $j++; endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
<div id="comment"></div>
<script>
    $(document).ready(function () {
        var data = [];

        $('#btn_save').click(function () {
            var resultat = $('select[id^="resultat"]').map(function () {
                return this.value;
            });

            var idres = $('input[id^="idres"]').map(function () {
                return this.value;
            });
            var exam = $('select[id^="exam"]').map(function () {
                return this.value;
            });
            for (var i =0; i < resultat.length ; i++){

                data.push({
                    'id': idres[i],
                    'resultat':resultat[i],
                    'exam':exam[i],
                })
            }

            var idexam = $('#idexam').val();

            $.post('../control/reg_resultat.php', {data:data,idexam:idexam}, function(response)
           {
               $('#comment').html(response);
               window.location.href = "index.php?page=resultat&id_examen=<?= $_GET['id_examen'] ?>";
           });

        });

        $('#btn_print').click(function () {
            window.open("../public/pdf/resultat.php?id_examen=<?= $_GET['id_examen'] ?>",'_blank');
        })
    });
</script>