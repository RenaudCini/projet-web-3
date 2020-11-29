<?php

class Http
{

    /**
     * Permet de vérifier si la méthode d'obtention est celle spécifiée en paramètre.
     *
     * @param string $method La méthode voulue (GET ou POST)
     * @return boolean
     */
     public static function isMethod(string $method): bool
     {
        return $_SERVER['REQUEST_METHOD'] === $method;
    }

    /**
     * Permet d'effectuer une redirection sur la page spécifiée en paramètre.
     *
     * @param string $url L'URL de la page vers laquelle on redirige.
     */
    public static function redirect($url) {
        header("Location: $url", true, 302);
        die;
    }

    /**
     * Permet de créer une réponse d'erreur pour le navigateur.
     *
     * @param string $message Le message d'erreur à afficher.
     * @param integer $code Le code HTTP à renvoyer.
     */
    public static function createErrorResponse(string $message = 'Une erreur est survenue.', int $code = 400) {
        http_response_code($code);
        die($message);
    }
}
