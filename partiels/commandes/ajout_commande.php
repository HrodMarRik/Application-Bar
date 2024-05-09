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



        <li class="nav-item" role="presentation">
            <button class="nav-link" id="deplacer-tab" data-bs-toggle="tab" data-bs-target="#deplacer-tab-pane" type="button" role="tab" aria-controls="deplacer-tab-pane" aria-selected="false">Deplacer</button>
        </li>        

    </ul>





    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h6 class="mb-4">Créer Commande</h6>
<!-- Créer commande -->
            <form class="custom-form profile-form" action="../php/commandes.php" method="post" role="form">

                <input type="hidden" name="action" value="create">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2">
                        Créer
                    </button>
                </div>
            </form>
        </div>




        <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
            <h6 class="mb-4">Supprimer Commande</h6>
<!-- supprimer commande -->

            <form class="custom-form password-form" action="../php/commandes.php" method="post" role="form">
                <input type="hidden" name="action" value="delete">
                <input class="form-control" type="text" name="numero" id="numero" placeholder="Numéro de commande">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2">
                        Supprimer la commande
                    </button>
                </div>
            </form>
        </div>



        <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel" aria-labelledby="notification-tab" tabindex="0">
            <h6 class="mb-4">Modifier Commande</h6>
<!-- modifier commande -->

            <form class="custom-form notification-form" action="../php/commandes.php" method="post" role="form">
                <input type="hidden" name="action" value="update">
                <input class="form-control" type="text" name="numero" id="numero" placeholder="numero de commande">
                <input class="form-control" type="text" name="id_article" id="id_article" placeholder="ID d'article">
                <input class="form-control" type="text" name="nom_article" id="nom_article" placeholder="nom d'article">
                <div class="d-flex">
                    <button type="submit" class="form-control ms-2" name="submit_action" value="delete_article">
                        Supprimer de la commande
                    </button>
                    <button type="submit" class="form-control ms-2" name="submit_action" value="add_article">
                        Ajouter à la commande
                    </button>                    
                </div>
            </form>
        </div>



        <div class="tab-pane fade show" id="deplacer-tab-pane" role="tabpanel" aria-labelledby="deplacer-tab" tabindex="0">
            <h6 class="mb-4">Deplacer Commande</h6>
<!-- deplacer commande -->
            <form class="custom-form deplacer-form" action="../php/commandes.php" method="post" role="form">

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