
        <div class="custom-block bg-white">

        <!-- choix ajouter supprimer modifier -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Ajouter</button>
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
                    <h6 class="mb-4">Ajouter Article</h6>
        <!-- ajouter article -->
                    <form class="custom-form profile-form" action="../php/articles.php" method="post" role="form">

                        <input type="hidden" name="action" value="add">
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom">

                        <input class="form-control" type="text" name="description" id="description" placeholder="Description(facultatif)">

                        <input class="form-control" type="number" name="prix" id="prix" placeholder="Prix" step="0.50">

                        <textarea class="form-control" name="recette" id="recette" placeholder="Recette (facultatif)" rows="4"></textarea>

                        <div class="d-flex">
                            <button type="submit" class="form-control ms-2">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                    <h6 class="mb-4">Supprimer Article</h6>
        <!-- supprimer article -->

                    <form class="custom-form password-form" action="../php/articles.php" method="post" role="form">
                        <input type="hidden" name="action" value="delete">
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom">
                        <input class="form-control" type="text" name="id" id="id" placeholder="ID">
                        <div class="d-flex">
                            <button type="submit" class="form-control ms-2">
                                Supprimer
                            </button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel" aria-labelledby="notification-tab" tabindex="0">
                    <h6 class="mb-4">Modifier Article</h6>
        <!-- modifier article -->

                    <form class="custom-form notification-form" action="../php/articles.php" method="post" role="form">
                    <input type="hidden" name="action" value="update">

                        <input class="form-control" type="text" name="id" id="id" placeholder="ID"><input class="form-control" type="text" name="nom" id="nom" placeholder="Nom">

                        <input class="form-control" type="text" name="description" id="description" placeholder="Description">

                        <input class="form-control" type="number" name="prix" id="prix" placeholder="Prix" step="0.50">

                        <textarea class="form-control" name="recette" id="recette" placeholder="Recette" rows="4"></textarea>
                

                        <div class="d-flex mt-4">
                            <button type="submit" class="form-control ms-2">
                                Modifier Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>