<h2>Ajouter un nouvel élève pour le réinscrire</h2>
<form role="form" id="formulaire_save">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nom</label>
            <input id="nom_save" type="text" class="form-control" placeholder="Nom" required>

        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input id="prenom_save" type="text" class="form-control" placeholder="Prénom" required>
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input id="contact_save" type="text" class="form-control" placeholder="Numéro" required>
        </div>
        <div class="form-group">
            <label>Profession</label>
            <input id="profession_save" type="text" class="form-control" placeholder="Profession" >
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <input id="adresse_save" type="text" class="form-control" placeholder="Adresse" required>
        </div>
        <div class="form-group">
            <label>Date de Naissance</label>
            <input id="dob_save" type="date" class="form-control" >
        </div>
        <div class="form-group">
            <label>Lieu de Naissance</label>
            <input id="pob_save" type="text" class="form-control" >
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Date d'inscription</label>
            <input id="dor" type="date" class="form-control" >
        </div>
        <div class="form-group">
            <label>Catégorie Permis</label>
            <select id="categorie_save" class="form-control" required>
                <option  value="A">A</option>
                <option  value="B">B</option>
                <option  value="C">C</option>
                <option selected value="D">D</option>
                <option  value="E">E</option>

            </select>
        </div>
        <div class="form-group">
            <label>Forfait</label>
            <select id="forfait_save" class="form-control" required>
                <option selected  value="normal">Tarif Normal</option>
                <option  value="special">Tarif Spécial</option>
                <option  value="accelere">Tarif accéléré</option>
                <option  value="promo">Tarif Promo</option>
            </select>

        </div>
        <div class="form-group">
            <label>Solde Forfait</label>
            <input id="solde_save" type="number" class="form-control" placeholder="Solde du forfait" required>
        </div>
        <div class="form-group">
            <label>Sexe</label>
            <select id="sexe_save" class="form-control" required>
                <option selected value="masculin">masculin</option>
                <option value="feminin">feminin</option>
            </select>
        </div>
        <div class="form-group">
            <label>Recommandation</label>
            <input id="recommandation" type="text" class="form-control" placeholder="Recommandation pour l'inscription">
        </div>
        <div class="form-group">
            <label>Agence</label>
            <input id="agence" type="text" class="form-control" placeholder="Agence de l'élève" required>
        </div>
        <div class="form-group">
            <label>Frais de dossier</label>
            <input id="dossier" type="checkbox" >
        </div>
        <div class="form-group">
            <label>Montant des frais de dossier</label>
            <input id="montant" type="number" class="form-control"  >
        </div>
        <div class="form-group">
            <button type="submit" class="btn-lg btn-primary">Ajouter</button>
        </div>
    </div>
</form>
<div id="comment"></div>

<script>
    $(document).ready(function () {

        $('#montant').hide();
        $('#dossier').change(function () {
            if( $('#dossier').is(':checked'))
            {
                $('#montant').show();
            }
            else{
                $('#montant').hide();
            }
        });
        // Save User
        $('#formulaire_save').submit( function()
        {
            var nom = $('#nom_save').val();
            var prenom = $('#prenom_save').val();
            var contact = $('#contact_save').val();
            var profession = $('#profession_save').val();
            var adresse = $('#adresse_save').val();
            var dor = $('#dor').val();
            var dob = $('#dob_save').val();
            var pob = $('#pob_save').val();
            var categorie = $('#categorie_save').val();
            var forfait = $('#forfait_save').val();
            var solde = $('#solde_save').val();
            var sexe = $('#sexe_save').val();
            var recommandation = $('#recommandation').val();
            var agence = $('#agence').val();
            var montant = '';
            if( $('#dossier').is(':checked'))
            {
                montant = $('#montant').val();
            }

            $.post('../control/reg_eleve.php', {nom:nom,prenom:prenom,contact:contact,profession:profession,adresse:adresse,dob:dob,pob:pob,categorie:categorie,
                forfait:forfait,solde:solde,sexe:sexe,recommandation:recommandation,agence:agence,montant:montant,dor:dor}, function(response)
            {
                window.location.href = "index.php?page=eleve";
            });

            return false;

        });
    });
</script>