<?php

class ArticlesModel extends PdoModel
{
    public function getAllArticles()
    {
        $db = $this->setdb();
        $req = $db->prepare('SELECT * FROM articles ORDER BY creation_date DESC');
        $req->execute();
        $articles = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $articles;
    }
    public function addArticleDb($name, $firstName, $content)
    {
        $db = $this->setdb();
        $req = $db->prepare('INSERT INTO articles (name, first_name, content) VALUES (?,?,?)');
        $result = $req->execute([$name, $firstName, $content]);
        $req->closeCursor();
        return $result;
    }
    public function updateArticleDb($content, $id)
    {

        $db = $this->setdb();
        $req = $db->prepare('UPDATE articles SET content = ? WHERE id = ?');
        $result = $req->execute([$content, $id]);
        $req->closeCursor();
        return $result;
    }
    public function deleteArticleDb($id)
    {
        $db = $this->setdb();
        $req = $db->prepare('DELETE FROM articles WHERE id=?');
        $result = $req->execute([$id]);
        return $result;
    }
}
