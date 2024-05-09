<?php

class Tables {
    public function createTable() {
        $tables = $this->getTables();
        $numero = $this->getNextTableNumero();
        $tables[$numero] = [
            'numero' => $numero, 
            'num_commande' => null
        ];
        $this->setTables($tables);
    }

    public function deleteTable($numero) {
        $tables = $this->getTables();
        unset($tables[$numero]);
        $this->setTables($tables);
    }

    public function updateTable($numero, $num_commande = null) {
        $tables = $this->getTables();
        if (!isset($tables[$numero])) {
        }

        if ($num_commande !== null) {
            $tables[$numero]['num_commande'] = $num_commande;
        }



        $this->setTables($tables);
    }

    private function getTables() {
        return isset($_COOKIE['tables']) ? json_decode($_COOKIE['tables'], true) : [];
    }

    private function setTables($tables) {
        setcookie('tables', json_encode($tables), time() + 365*24*60*60, '/');
    }

    public function getNextTableNumero() {
        $tables = $this->getTables();
        return $tables ? max(array_keys($tables)) + 1 : 1;
    }
}

$tables = new Tables();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $num_commande = $_POST['num_commande'] ?? '';

    try {
        switch ($action) {
            case 'create':
                $tables->createTable();
                break;
            case 'delete':
                $tables->deleteTable($numero);
                break;
            case 'update':
                $response = $tables->updateTable($numero, $num_commande);
                break;
            default:
                throw new Exception("Invalid action.");
        }
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'defaultPage.php'));
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "This page must be accessed via POST.";
    exit;
}
?>
