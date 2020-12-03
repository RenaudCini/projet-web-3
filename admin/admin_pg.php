<?php
session_start();

if (isset($_SESSION['id'], $_SESSION['id_roles']) && $_SESSION['id_roles'] == 1) :

    require_once 'admin_sc.php';
    $titrePage = 'Administration';
    $js[] = 'admin.js';
    $admin = new admin_sc();

    require_once '../template/view/nav.php';
    $roles = $roles = $admin->afficherToutRole();
    $roleUser = $admin->afficherRole(8);
    $utlisateur = $admin->afficheUtilisateur(8);

?>


    <div class="container">

        <h1 class="mb-5">Administration utilisateurs</h1>

        <div id="ajaxAdminUtilisateurs">
            <!-- Message chargé en AJAX. -->
        </div>

        <table id="example" class="table table-sm" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Date inscription</th>
                    <th>Dernière connexion</th>
                    <th>ID roles</th>
                    <th>Actif</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="modalUtilisateur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- role -->
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary">Rôle</button>
                        </div>
                        <select class="custom-select" id="role" aria-label="Example select with button addon">
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>"> <?= $role['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- actif-->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary">Actif</button>
                        </div>
                        <select class="custom-select" id="actif" aria-label="Example select with button addon">
                            <option value="0">Inactif</option>
                            <option value="1">Actif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSauvegarderUtilisateur" class="btn btn-warning text-light" data-dismiss="modal">Sauvegarder les modifications</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once '../template/view/footer.php';
else :
    header('Location: /index.php');
endif;
