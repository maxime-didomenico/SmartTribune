<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PuppeteerApiController extends AbstractController
{
    /**
     * @Route("/api/puppeteer", name="api_puppeteer", methods={"POST"})
     */
    public function runPuppeteer(Request $request)
    {
        $url = $request->getContent(); // Récupère l'URL depuis la requête POST

        // Exécute le script Puppeteer avec l'URL spécifiée
        $output = shell_exec('node ../puppeteer/index.js ' . escapeshellarg($url));
        
        // Supprime les espaces et les caractères de nouvelle ligne en début et en fin de chaîne
        $output = trim($output);

        // Sépare la chaîne en un tableau en utilisant l'espace comme séparateur
        $outputArray = explode(' ', $output);

        // Connexion à la base de données MySQL
        $dsn = 'mysql:host=localhost;dbname=SmartTribune';
        $username = 'root';
        $password = '1';

        try {
            // Crée une nouvelle instance de la classe PDO
            $pdo = new \PDO($dsn, $username, $password);

            // Exécute une requête SQL pour insérer les résultats dans la base de données
            $query = 'INSERT INTO puppeteer_results (link, result1, result2, result3) VALUES (:link, :result1, :result2, :result3)';
            $statement = $pdo->prepare($query);
            $statement->bindParam(':link', $url);
            $statement->bindParam(':result1', $outputArray[0]);
            $statement->bindParam(':result2', $outputArray[1]);
            $statement->bindParam(':result3', $outputArray[2]);
            $statement->execute();

            // Ferme la connexion à la base de données
            $pdo = null;

            // Retourne le résultat sous forme de tableau JSON
            return new JsonResponse($outputArray);
        } catch (\PDOException $e) {
            // Gère les erreurs de connexion à la base de données
            // Vous pouvez personnaliser la gestion des erreurs selon vos besoins
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}

?>