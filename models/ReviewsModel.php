<?php
require_once 'PdoModel.php';
class ReviewsModel extends PdoModel
{
    private $table;
    private  $idColumn;

    public function __construct($table, $idColumn)
    {
        $tables = ['article_reviews', 'project_reviews'];
        $idColumns = ['article_id', 'project_id'];

        if (!in_array($table, $tables) || !in_array($idColumn, $idColumns)) {
            throw new Exception("Table ou colonne non autorisée.");
        }

        $this->table = $table;
        $this->idColumn = $idColumn;
    }
    public function getReviews()
    {

        $db = $this->setdb();
        $req = $db->prepare("SELECT * from $this->table ORDER BY creation_date DESC");
        $req->execute([]);
        $reviews = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $reviews;
    }
    public function addReviewDb($id, $name, $firstName, $content)
    {

        $db = $this->setdb();
        $req = $db->prepare("INSERT INTO $this->table ($this->idColumn, name, first_name, content) VALUES (?,?,?,?)");
        $result = $req->execute([$id, $name, $firstName, $content]);
        return $result;
    }

    public function deleteReviewDb($id)
    {
        $db = $this->setdb();
        $req = $db->prepare(query: "DELETE FROM $this->table where id = ?");
        $result = $req->execute([$id]);
        return $result;
    }
}
