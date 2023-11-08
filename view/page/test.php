<tbody>
<?php $versement = Versement::read(); $i=1; ?>
<?php foreach ($versement as $vs) : ?>
    <tr class="odd gradeX">
        <td><?=$i; ?></td>
        <td><?=$vs->somme; ?></td>
        <td><?=$vs->desc_ver; ?></td>
        <td><?=$vs->banque; ?></td>
        <td><?=$vs->mode; ?></td>
        <td><?=date('d/m/Y',strtotime($vs->date)); ?></td>
        <td class="center">
            <a title="Modifier" class="btn btn-primary" href="index.php?page=up_versement&id_versement=<?= $vs->id_ver ?>">
                <span class="fa fa-pencil"></span>
            </a>
            <?php if ($_SESSION['fonction'] == 'administrateur') {  ?>
                <button title="Supprimer" type="button" class="btn btn-danger" data-toggle="modal" data-target="<?='#modmodal_ver'.$i?>">
                    <span class="fa fa-trash"></span>
                </button>
            <?php } ?>
            <!-- Modal -->
            <div class="modal fade" id="<?='modal_ver'.$i;?>" tabindex="-1" role="dialog" aria-labelledby="<?='#modal_ver'.$i;?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="<?='#modal_ver'.$i;?>">
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="../control/del_versement.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_caisse" value="<?=$vs->id_ver?>">
                                <button class="btn btn-danger">
                                    <h3>
                                        Voulez vous vraiment supprimer cette Transaction ?
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
        </td>
    </tr>
    <?php $i++; ?>
<?php endforeach; ?>
</tbody>