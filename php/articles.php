<?php

class articles {
    function __construct() {
        // Initialisation, si nécessaire
    }

    function add_article($id, $nom, $description, $prix, $recette = null) {
        $articles = $this->get_articles();
        $articles[$id] = [
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'recette' => $recette
        ];
        $this->set_articles($articles);
    }

    function del_article($id) {
        $articles = $this->get_articles();
        unset($articles[$id]);
        $this->set_articles($articles);
    }

    function update_article($id, $nom, $description, $prix, $recette) {
        $articles = $this->get_articles();
        if (isset($articles[$id])) {
            
            if (!empty($nom)) {
                $articles[$id]['nom'] = $nom;
            }

            if (!empty($description)) {
                $articles[$id]['description'] = $description;
            }
            if (!empty($prix)) {
                $articles[$id]['prix'] = $prix;
            } 
            if (!empty($recette)) { // Ajout de la parenthèse fermante
                $articles[$id]['recette'] = $recette;
            }                      
            $this->set_articles($articles);
        }
    }


    private function get_articles() {
        return isset($_COOKIE['articles']) ? json_decode($_COOKIE['articles'], true) : [];
    }

    private function set_articles($articles) {
        setcookie('articles', json_encode($articles), strtotime("+1 year"), '/');
    }

    public function getNextArticleId() {
        $articles = $this->get_articles();
        $maxId = array_reduce($articles, function ($max, $item) { return $item['id'] > $max ? $item['id'] : $max; }, 0);
        return $maxId + 1;
    }
    public function getArticleIdByName($nom) {
        $articles = $this->get_articles();
        foreach ($articles as $id => $article) {
            if ($article['nom'] === $nom) {
                return $id;
            }
        }
        return null;
    }
}

$articles = new articles();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $missingFields = [];
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add':

            if (empty($_POST['nom'])) {
                $missingFields[] = 'nom';
            } else {
                $nom = $_POST['nom'];
            }

            if (empty($_POST['prix'])) {
                $missingFields[] = 'prix';
            } else {
                $prix = $_POST['prix'];
            }

            $id = $articles->getNextArticleId();
            $description = $_POST['description'] ?? null;
            $recette = $_POST['recette'] ?? null ;
            break;

        case 'delete':
            if (empty($_POST['nom']) && empty($_POST['id'])) {
                $missingFields[] = 'nom ou id';
            } elseif (empty($_POST['id']) && !empty($_POST['nom'])) {
                $id = $articles->getArticleIdByName($_POST['nom']);
            } elseif (empty($_POST['id'])) {
                $missingFields[] = 'id';
            } else {
                $id = $_POST['id'];
            }

            break;

        case 'update':
            if (empty($_POST['nom']) && empty($_POST['id'])) {
                $missingFields[] = 'nom ou id';
            } elseif (empty($_POST['id']) && !empty($_POST['nom'])) {
                $id = $articles->getArticleIdByName($_POST['nom']);
            } elseif (empty($_POST['id'])) {
                $missingFields[] = 'id';
            } elseif (!empty($_POST['id']) && !empty($_POST['nom'])) {
                $id = $_POST['id'];
                $nom = $_POST['nom'];
            } else {
                $id = $_POST['id'];
                if (empty($_POST['description']) && empty($_POST['prix']) && empty($_POST['recette'])) {
                   $missingFields[] = 'description, prix ou recette';
                }
            }

            $prix = $_POST['prix'] ?? null;
            $description = $_POST['description'] ?? null;
            $recette = $_POST['recette'] ?? null ;
            break;

        default:
            $missingFields[] = 'action invalide';
            break;
    }

    if (!empty($missingFields)) {
        echo "Données nécessaires manquantes : " . implode(', ', $missingFields);
        exit;
    }

    switch ($action) {
        case 'delete':
            $articles->del_article($id);
            break;
        case 'add':
            $articles->add_article($id, $nom, $description, $prix, $recette);
            break;
        case 'update':
            $articles->update_article($id, $nom, $description, $prix, $recette);
            break;
        default:
            echo "Action inconnue.";
            exit;
    }

    $referer = $_SERVER['HTTP_REFERER'] ?? 'defaultPage.php';
    header("Location: $referer");
    exit;
} else {
    echo "Cette page ne doit être accédée que par POST.";
    exit;
}
?>
