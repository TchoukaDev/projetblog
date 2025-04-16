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
    public function addArticleDb($title, $name, $firstName, $content)
    {
        $db = $this->setdb();
        $req = $db->prepare('INSERT INTO articles (title, name, first_name, content) VALUES (?, ?,?,?)');
        $result = $req->execute([$title, $name, $firstName, $content]);
        return $result;
    }
    public function updateArticleDb($title, $content, $id)
    {
        $db = $this->setdb();
        $req = $db->prepare('UPDATE articles SET title = ?, content = ? WHERE id = ?');
        $result = $req->execute([$title, $content, $id]);
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
