<?php
class afficheur
{
    function __construct() {

        // haut du tableau
        $this->html =<<<'HTML'
            <div class="custom-block bg-white">
                <h5 class="mb-4">Mes Commandes</h5>
                <div class="table-responsive">
                    <table class="account-table table">
                    <thead>
                        <tr>
                            <th scope="col">Numéro</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Prix Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Statut de paiement</th>
                            <th scope='col'>Action</th>
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

    public function get_commandes() {
        if (isset($_COOKIE['commandes'])) {
            return json_decode($_COOKIE['commandes'], true);
        }
        return [];
    }
    public function get_articles() {
        if (isset($_COOKIE['articles'])) {
            return json_decode($_COOKIE['articles'], true);
        }
        return [];      
    }

    public function get_contenu($commande) {
        $articles = $this->get_articles();
        $html = ""; 
        
        if (!empty($commande)) {
            foreach ($commande as $key) {
                if (isset($articles[$key])) {
                    $nom_article = $articles[$key]['nom'];
                    $prix_article = $articles[$key]['prix'];
                    
                    $html .= $nom_article . " : " . $prix_article . "€<br>";
                } else {
                    $html .= $key . " introuvable<br>";
                }
            }
            return $html;
        } else {
            return "commande vide";
        }
    }


    public function get_total($commande) {
        $articles = $this->get_articles();
        $total = 0;
        
        if (!empty($commande)) {
            foreach ($commande as $key) {
                if (isset($articles[$key]['prix'])) {
                    $total += $articles[$key]['prix'];
                }
            }
            return $total . "€";
        } else {
            return "0€";
        }
    }


    public function get_content(){
        $commandes = $this->get_commandes();
        $html = "";
        
        if (!empty($commandes)) {
            foreach ($commandes as $commande) {
                
                $numero = $commande['numero'];
                $date = $commande['date'];
                $badgeClass = ($table['statut'] == true) ? "text-bg-success" : "text-bg-danger";
                $statut = ($commande['statut'] == true) ? "Payer" : "à payée";

                $contenu = $this->get_contenu($commande['contenu']);
                $total = $this->get_total($commande['contenu']);

                $html .=<<<HTML
                    <tr>
                        <td scope="row">$numero</td>
                        <td scope="row">$contenu</td>
                        <td scope="row">$total</td>
                        <td scope="row">$date</td>
                        <td scope="row"><span class="badge $badgeClass">$statut</span></td>
                        <td scope="row">
                            <form method="POST" action="../php/commandes.php" style="margin-top: 8px";>
                            <input type="hidden" name="statut" value="pay">
                            <input type="hidden" name="numero" value="$numero">
                            <button type="submit" class="custom-btn danger">PAYÉE</button>
                            </form>

                            <form method="POST" action="../php/commandes.php" style="margin-top: 8px";>
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
                    <td scope="row">Pas de commande</td>
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