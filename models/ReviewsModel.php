<?php

class ReviewsModel extends PdoModel
{
    public function getArticleReviews()
    {
        $db = $this->setdb();
        $req = $db->prepare("SELECT * from reviews");
        $req->execute([]);
        $reviews = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $reviews;
    }
    public function addReviewDb($articleId, $name, $firstName, $content)
    {
        $db = $this->setdb();
        $req = $db->prepare('INSERT INTO reviews(article_id, name, first_name, content) VALUES (?,?,?,?)');
        $result = $req->execute([$articleId, $name, $firstName, $content]);
        return $result;
    }

    public function deleteReviewDb($id)
    {
        $db = $this->setdb();
        $req = $db->prepare('DELETE FROM reviews where id = ?');
        $result = $req->execute([$id]);
    }
}
