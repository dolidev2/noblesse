<?php include_once '../model/Caisse.class.php' ; ?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active" ><a href="#recette" data-toggle="tab"><h4>Clôturer</h4></a>
                </li>
            </ul>
            <div class="tab-content">

                <!-- Tab Liste Recettes -->
                <div class="tab-pane fade in active" id="recette">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Clôture de la caisse
                            <button title="Date" data-toggle="modal" data-target="#date" class="btn btn-warning">Choisir une date</button>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <h4>Cloture Journalière</h4>
                                    <a href="../public/pdf/caisse_journalier.php?agence=<?= $_SESSION['agence']; ?>&date=<?=$_GET['date'] ?>" target="_blank">
                                        <button title="Détail" class="btn btn-primary">Détail</button>
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <h4>Cloture Mensuelle</h4>
                                    <a href="../public/pdf/caisse_mensuelle.php?agence=<?= $_SESSION['agence']; ?>&date=<?=$_GET['date'] ?>" target="_blank">
                                        <button title="Détail" class="btn btn-primary">Détail</button>
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                  <h4>Cloture Mensuelle Fond de caisse</h4>
                                  <a href="../public/pdf/fond_caisse.php?agence=<?= $_SESSION['agence']; ?>&date=<?= $_GET['date']?>" target="_blank">
                                      <button title="Détail" class="btn btn-primary">Détail</button>
                                  </a>
                              </div>
                                <div class="col-lg-3">
                                    <h4>Cloture Annuelle</h4>
                                    <a href="../public/pdf/caisse_annuelle.php?agence=<?= $_SESSION['agence']; ?>&date=<?=$_GET['date'] ?>>" target="_blank">
                                        <button title="Détail" class="btn btn-primary">Détail</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
