<?php
include_once '../model/Audit.class.php' ;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Historique des transactiosn de modifications et de suppressions
    </div>
    <div class="panel-body">
        <!--Insert the table here-->

        <table width="100%" class="table table-striped table-bordered table-hover" id="table-audit">
            <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <th>Description</th>
                <th>Auteur</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $audit = Audit::read($_SESSION['agence']); $k=1; ?>

            <?php foreach ($audit as $vs) : ?>
                <tr class="odd gradeX">
                    <td><?=$k; ?></td>
                    <td><?=date('d/m/Y',strtotime($vs->date)); ?></td>
                    <td><?=$vs->desc_audit ?></td>
                    <td><?= $vs->username ?></td>
                    <td class="center">
                        <?php
                        if($vs->action == 'Modification'){
                            ?>
                            <button class="btn btn-primary">Modification</button>
                            <?php
                        }elseif($vs->action == 'Suppression')
                        {
                            ?>
                            <button class="btn btn-danger">Suppression</button>
                            <?php
                        }elseif ($vs->action == 'Ajout')
                        {
                            ?>
                            <button class="btn btn-success">Ajout</button>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php $k++; ?>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {

        var table= $('#table-audit').DataTable({
            "responsive":true,
            "paging":true,
        });

    });


</script>