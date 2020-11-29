<?php

namespace Controller;

require_once 'lib/Controller/Controller.php';
require_once 'lib/Http.php';
require_once 'lib/Model/Comment.php';

class Comment extends Controller
{
    protected $modelName = 'Comment';

    /**
     * supprime un commentaire
     */
    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            \Http::createErrorResponse("Vous devez donner l'identifiant numérique du commentaire.");
        }

        $comment = $this->model->find($id);

        if (!$comment) {
            \Http::createErrorResponse("Aucun commentaire pour l'identifiant $id.");
        }

        $this->model->delete($id);

        \Http::redirect("index.php?show&id=$id" . $comment['article_id']);
    }
}
