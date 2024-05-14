<?php
class afficheur {
    function __construct() {

        // haut du tableau
        $this->html =<<<'HTML'
            <div class="custom-block bg-white">
                <h5 class="mb-4">Mes Tables</h5>
                <div class="table-responsive">
                    <table class="account-table table">
                    <thead>
                        <tr>
                            <th scope="col">Numéro de table</th>
                            <th scope="col">Disponibilité</th>
                            <th scope="col">Commande</th>
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
    public function get_tables() {
        if (isset($_COOKIE['tables'])) {
            return json_decode($_COOKIE['tables'], true);
        }
        return [];        
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
        $commandes = $this->get_commandes();
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
            
        } else {
            $html .= "commande vide";
        }
        return $html;
    }
    public function get_total($commande) {
        $commandes = $this->get_commandes();
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
    public function get_commande($num_commande) {
        $commandes = $this->get_commandes();
        $html = "";
        $contenu = $this->get_contenu($commandes[$num_commande]['contenu']);
        $total = $this->get_total($commandes[$num_commande]['contenu']);
        $badgeClass = ($table['statut'] == true) ? "text-bg-success" : "text-bg-danger";
        $statut = ($commande['statut'] == true) ? "Payer" : "à payée";


        $html .=<<<HTML
            <b>commande : $num_commande</b><br>
            <em>$contenu</em><br>
            <b>$total</b><br>
            <span class="badge $badgeClass">$statut</span>
        HTML;
        return $html;
    }
    public function get_content(){
        $tables = $this->get_tables();
        $html = "";

        
        if (!empty($tables)) {
            foreach ($tables as $table) {
                
                $numero = $table['numero'];
                $dispo = (isset($table['num_commande'])) ? "Occupé" : "Libre";
                $commande = $this->get_commande($table['num_commande']);
                $num_commande = $table['num_commande'];
                $html .=<<<HTML
                    <tr>
                        <td scope="row">$numero</td>
                        <td scope="row">$dispo</td>
                        <td scope="row">$commande</td>
                        <td scope="row">
                            <form method="POST" action="../php/commandes.php" style="margin-top: 8px";>
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="numero" value="$num_commande">
                            <input type="hidden" name="statut" value="true">
                            <button type="submit" class="custom-btn danger">PAYÉE</button>
                            </form>

                            <form method="POST" action="../php/tables.php" style="margin-top: 8px";>
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
                    <td scope="row">Pas de table</td>
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