<?php
session_start();
if (isset($_SESSION['id'])) :

    require_once 'admin_sc.php';
    $titrePage = 'Administration';
    $js[] = 'admin.js';
    $admin = new admin_sc();

    require_once '../template/view/nav.php';
    $roles = $roles = $admin->afficherToutRole();
    $roleUser = $admin->afficherRole(8);
    $utlisateur = $admin->afficheUtilisateur(8);
    ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- role -->
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary">role</button>
                        </div>
                        <select class="custom-select" id="inputGroupSelect03"
                                aria-label="Example select with button addon">
                            <?php foreach ($roles as $key => $role) { ?>
                                <option value=" <?php echo $key ?>"> <?php echo $role['nom'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- actif-->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary">role</button>
                        </div>
                        <select class="custom-select" id="inputGroupSelect03"
                                aria-label="Example select with button addon">
                            <option value="1">0</option>
                            <option value="2">1</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">save</button>
                </div>
            </div>
        </div>
    </div>

    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>pseudo</th>
            <th>mail</th>
            <th>date_inscription</th>
            <th>derniere_connexion</th>
            <th>id_roles</th>
            <th>actif</th>
            <th>button</th>
        </tr>
        </thead>
    </table>
    <?php
    require_once '../template/view/footer.php';

else :
    header('Location: /acces_restreint.php');
endif;
?>
