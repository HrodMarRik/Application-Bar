<?php
class afficheur
{
    function __construct() {

        // haut du tableau
        $this->html =<<<'HTML'
            <div class="custom-block bg-white">
                <h5 class="mb-4">Mes Articles</h5>
                <div class="table-responsive">
                    <table class="account-table table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Déscription</th>
                            <th scope="col">Recette</th>
                            <th scope="col">Prix</th>
                            <th scope='col'>Stock(Bientôt)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
        HTML;

        // corps du tableau
        $this->html .= $this->get_content();

        // fin du tableau
        $this->html .=<<<'HTML'
                </tbody>
                </table>
            </div>
            </div>
        HTML;
    }


    public function get_articles() {
        if (isset($_COOKIE['articles'])) {
            return json_decode($_COOKIE['articles'], true);
        }
        return [];      
    }

    public function get_content(){
        $articles = $this->get_articles();
        $html = "";
        
        if (!empty($articles)) {
            foreach ($articles as $article) {
                $id = $article['id'] ?? '';
                $nom = $article['nom'] ?? '';
                $description = $article['description'] ?? '';
                $recette = $article['recette'] ?? '';
                $prix = $article['prix'] ?? '';
                $html .=<<<HTML
                    <tr>
                        <td scope="row">$id</td>
                        <td scope="row">$nom</td>
                        <td scope="row">$description</td>
                        <td scope="row">$recette</td>
                        <td scope="row">$prix €</td>
                        <td scope="row"></td>
                        <td scope="row">
                            <form method="POST" action="/php_microlead/php/articles.php" style="margin-top: 8px";>
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="numero" value="$numero">
                            <button type="submit" class="custom-btn danger">SUPPRIMER</button>
                            </form>
                        </td>   
                    </tr>
                HTML;
            }
            return $html;
        } else {
            $html =<<<'HTML'
                <tr>
                    <td scope="row">Pas d'article</td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                </tr>
            HTML;
            return $html;
        }
    }
}

$afficheur = new afficheur();
echo $afficheur->html;


?>