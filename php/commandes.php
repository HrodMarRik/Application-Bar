<?php

class Commandes {
    function create_commande() {
        $commandes = $this->get_commandes();
        $numero = $this->getNextCommandeNumero();
        $commandes[$numero] = [
            'numero' => $numero, 
            'contenu' => [], 
            'date' => date('d/m/Y'),
            'statut' => false
        ];
        $this->set_commandes($commandes);
    }

    function del_commande($numero) {
        $commandes = $this->get_commandes();
        unset($commandes[$numero]);
        $this->set_commandes($commandes);
    }

    function update_commande($numero, $statut = null, $id_article = null, $nom_article = null) {
        $commandes = $this->get_commandes();
        $articles = $this->get_articles();
        if (!isset($commandes[$numero])) {
            return "Commande numéro $numero introuvable pour mise à jour.";
        }

        if ($statut == "true") {
            $commandes[$numero]['statut'] = "true";
        } else {
            $commandes[$numero]['statut'] = "false";
        }
        if ($nom_article !== null) {
            // Recherche de l'ID de l'article en fonction de son nom
            $id_article_trouve = null;
            foreach ($articles as $id => $article) {
                if ($article['nom'] === $nom_article) {
                    $id_article_trouve = $id;
                    break;
                }
            }

            // Si l'article est trouvé, on l'enregistre dans $id_article
            if ($id_article_trouve !== null) {
                $id_article = $id_article_trouve;
            }
        }
        if ($id_article !== null) {
            $submit_action = $_POST['submit_action'] ?? '';
            if (isset($articles[$id_article])) {

                switch ($submit_action) {
                    case 'add_article':
                        $commandes[$numero]['contenu'][] = $id_article;
                        break;

                    case 'delete_article':
                        $key = array_search($id_article, $commandes[$numero]['contenu']);
                        if ($key !== false) {
                            array_splice($commandes[$numero]['contenu'], $key, 1);
                        }
                        break;

                    default:
                        return "Action sur l'article non spécifiée ou invalide.";
                }
            } else {
                return "Article introuvable.";
            }
        } 

        $this->set_commandes($commandes);
        return "Commande numéro $numero mise à jour.";
    }

    private function get_commandes() {
        return isset($_COOKIE['commandes']) ? json_decode($_COOKIE['commandes'], true) : [];
    }

    private function set_commandes($commandes) {
        setcookie('commandes', json_encode($commandes), time() + 365*24*60*60, '/');
    }

    public function getNextCommandeNumero() {
        $commandes = $this->get_commandes();
        return $commandes ? max(array_keys($commandes)) + 1 : 1;
    }

    private function get_articles() {
        return isset($_COOKIE['articles']) ? json_decode($_COOKIE['articles'], true) : [];
    }
}

$commandes = new Commandes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $statut = $_POST['statut'] ?? '';
    $id_article = $_POST['id_article'] ?? '';
    $nom_article = $_POST['nom_article'] ?? '';
    try {
        switch ($action) {
            case 'create':
                $commandes->create_commande();
                break;
            case 'delete':
                $response = $commandes->del_commande($numero);
                break;
            case 'update':
                $response = $commandes->update_commande($numero, $statut, $id_article, $nom_article);
                break;
            default:
                throw new Exception("Action invalide.");
        }
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'defaultPage.php'));
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "Cette page ne doit être accédée que par POST.";
    exit;
}
?>
