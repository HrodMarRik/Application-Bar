<div class="custom-block bg-white">




<!-- choix ajouter supprimer modifier -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">



        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Créer</button>
        </li>



        <li class="nav-item" role="presentation">
            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false">Supprimer</button>
        </li>



        <li class="nav-item" role="presentation">
            <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification-tab-pane" type="button" role="tab" aria-controls="notification-tab-pane" aria-selected="false">Modifier</button>
        </li>

    </ul>





    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h6 class="mb-4">Créer Table</h6>
<!-- Créer Table -->
            <form class="custom-form profile-form" action="../php/tables.php" method="post" role="form">

                <input type="hidden" name="action" value="create">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2">
                        Créer
                    </button>
                </div>
            </form>
        </div>




        <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
            <h6 class="mb-4">Supprimer Table</h6>
<!-- supprimer Table -->

            <form class="custom-form password-form" action="../php/tables.php" method="post" role="form">
                <input type="hidden" name="action" value="delete">
                <input class="form-control" type="text" name="numero" id="numero" placeholder="Numéro de Table">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2">
                        Supprimer la Table
                    </button>
                </div>
            </form>
        </div>



        <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel" aria-labelledby="notification-tab" tabindex="0">
            <h6 class="mb-4">Modifier Table</h6>
<!-- modifier Table -->

            <form class="custom-form notification-form" action="../php/tables.php" method="post" role="form">
                <input type="hidden" name="action" value="update">
                <input class="form-control" type="text" name="numero" id="numero" placeholder="numero de Table">
                <input class="form-control" type="text" name="num_commande" id="num_commande" placeholder="numero de commande">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2" name="submit_action" value="delete_commande">
                        Supprimer de la Table
                    </button>
                    <button type="submit" class="form-control ms-2" name="submit_action" value="add_commande">
                        Ajouter à la Table
                    </button>                    
                </div>
            </form>
        </div>



        <div class="tab-pane fade show" id="deplacer-tab-pane" role="tabpanel" aria-labelledby="deplacer-tab" tabindex="0">
            <h6 class="mb-4">Deplacer Table</h6>
<!-- deplacer Table -->
            <form class="custom-form deplacer-form" action="../php/tables.php" method="post" role="form">

                <input type="hidden" name="action" value="move">
                <input class="form-control" type="text" name="table" id="table" placeholder="Numero de table">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2">
                        deplacer
                    </button>
                </div>
            </form>
        </div>
    </div>


</div>