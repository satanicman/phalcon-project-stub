<?php

namespace Modules\Frontend\Controllers;
use Modules\Models\Comments;
use Modules\Models\Links;
use Modules\Models\Tools;

class CommentsController extends ControllerBase
{
    protected $types = array('page', 'rubric');
    public function addAction($type, $id) {
        if(!$id && !$type) {
            $this->response->redirect(["for" => "404"]);
            return false;
        }

        if($this->request->isPost()) {
            $comment = new Comments();
            $comment->name = $this->request->getPost('name');
            $comment->description = $this->request->getPost('description');
            if ($type == 'page') {
                $comment->id_rubric = 0;
                $comment->id_page = $id;
            } elseif($type == 'rubric') {
                $comment->id_rubric = $id;
                $comment->id_page = 0;
            } else {
                $this->response->redirect(["for" => "404"]);
                return false;
            }
            $date = new \DateTime('now');
            $comment->date_add = $date->format('Y-m-d H:i:s');
            $comment->active = 0;
            $comment->ip = $_SERVER['REMOTE_ADDR'];
            $comment->save();
        }

        $links = new Links();
        if ($type == 'page')
            $this->response->redirect($links->getPageLink($id));
        elseif($type == 'rubric')
            $this->response->redirect($links->getPageLink($id));
        else {
            $this->response->redirect(["for" => "404"]);
            return false;
        }
    }

    public function ajaxAction() {
        if($this->request->isPost()) {

            $count = (int)$this->request->getPost('count');
            $id = (int)$this->request->getPost('id');
            $type = $this->request->getPost('type');
            if(empty($type) || !in_array($type, $this->types))
                $this->errors[] = 'Не верно указанный тип!';
            if(!$id)
                $this->errors[] = 'Не верный формат идетификатора!';
            if(!$count)
                $this->errors[] = 'Не верный формат кол-ва!';

            if($this->errors)
                die(json_encode(array('hesError' => 1, 'errors' => $this->errors)));

            $conditions = ($type == 'page' ? 'id_page' : 'id_rubric'). ' = ' .$id. ' and active in ('.$this->commentsModeration.')';
            $commentsCount = count(Comments::find([
                "conditions" => $conditions
            ]));

            if($count >= $commentsCount)
                $this->errors[] = 'Нет такого комментария!';

            if($this->errors)
                die(json_encode(array('hesError' => 1, 'errors' => $this->errors, 'last' => true)));

            $comments = Comments::find([
                "conditions" => $conditions,
                "offset" => $count,
                "limit" => $this->countComments
            ])->toArray();
            foreach ($comments as &$comment) {
                $comment['date_add'] = Tools::getDate($comment['date_add']);
            }

            die(json_encode(array("comments" => $comments, "count" => ($count + $this->countComments), "last" => ($count + $this->countComments >= $commentsCount))));
        }
    }
}

