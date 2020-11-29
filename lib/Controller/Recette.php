<?php

namespace Controller;



class Recette extends Controller
{
    protected $modelName = 'Recette';

    /**
     * index
     */
    public function index()
    {
        $recettes = $this->model->findArticles();

        $this->render('recette/list', [
            'recettes' => $recettes
        ]);
    }

    /**
     * affiche les commentaires
     */
    public function show()
    {
        $commentModel = new \Model\Comment;

        // filter_input() permet de filtrer les informations d'entrée
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            \Http::createErrorResponse('Il faut préciser un identifiant numérique.');
        }

        $article = $this->model->find($id);

        if (!$article) {
            \Http:: createErrorResponse('Aucun article trouvé pour l\'identifiant demandé.', 404);
        }

        // Si POST, on veut enregistrer un commentaire
        if (\Http::isMethod('POST')) {
            // Extraction des infos du formulaire
            $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

            if (!$author || !$content) {
                \Http::createErrorResponse('Vous avez mal rempli le formulaire.');
            }

            $commentModel->insertComment($author, $content, $id);

            \Http::redirect("index.php?article&id=$id");
        }

        // Si on est en GET, c'est qu'on veut l'article


        $comments = $commentModel->findAllComments($id);

        $this->render('article/article', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    /**
     * crée un commentair
     */
    public function create()
    {
        if (\Http::isMethod('POST')) {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $short = filter_input(INPUT_POST, 'short');
            $content = filter_input(INPUT_POST, 'content');
            $image = filter_input(INPUT_POST, 'image', FILTER_VALIDATE_URL);

            if (!$title || !$short || !$content || !$image) {
                \Http::createErrorResponse("Un des champs ne correspond pas.");
            }

            $id = $this->model->insertArticle($title, $short, $content, $image);

            \Http::redirect("index.php?show&id=$id");
        }

        $this->render('article/create');
    }

    public function delete()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if(!$id)
        {
            \Http::createErrorResponse("Un des champs ne correspond pas.");
        }

        $article = $this->model->find($id);
         if(!$article)
         {
             \Http::createErrorResponse("Un des champs ne correspond pas.");
         }
        $this->model->delete($id);
        \Http::redirect("index.php?controlleur=article&action=index");
    }
}
