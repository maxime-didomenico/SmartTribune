<?php

// src/Controller/ApiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
 /**
 * @Route("/api/results", name="api_results", methods={"GET"})
 */
 public function getResults()
 {
 // Connexion à la base de données MySQL
 $dsn = 'mysql:host=localhost;dbname=SmartTribune';
 $username = 'root';
 $password = '1';

 try {
 // Crée une nouvelle instance de la classe PDO
 $pdo = new \PDO($dsn, $username, $password);

 // Exécute une requête SQL pour récupérer les données de la table puppeteer_results
 $query = 'SELECT * FROM puppeteer_results';
 $statement = $pdo->prepare($query);
 $statement->execute();
 $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

 // Ferme la connexion à la base de données
 $pdo = null;

 // Retourne les résultats sous forme de tableau JSON
 return new JsonResponse($results);
 } catch (\PDOException $e) {
 // Gère les erreurs de connexion à la base de données
 // Vous pouvez personnaliser la gestion des erreurs selon vos besoins
 return new JsonResponse(['error' => $e->getMessage()], 500);
 }
 }
}


?>