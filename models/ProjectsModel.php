<?php

class ProjectsModel extends PdoModel
{

    public function getAllprojects()
    {
        $db = $this->setdb();
        $req = $db->prepare('SELECT * FROM projects ORDER BY creation_date DESC');
        $req->execute();
        $projects = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $projects;
    }
    public function addProjectDb($title, $name, $firstName, $content, $link)
    {
        $db = $this->setdb();
        $req = $db->prepare('INSERT INTO projects (title, name, first_name, content, link) VALUES (?, ?,?,?,?)');
        $result = $req->execute([$title, $name, $firstName, $content, $link]);
        return $result;
    }
    public function updateProjectDb($title, $content, $link, $id)
    {
        $db = $this->setdb();
        $req = $db->prepare('UPDATE projects SET title = ?, content = ?, link = ? WHERE id = ?');
        $result = $req->execute([$title, $content, $link,  $id]);
        return $result;
    }
    public function deleteProjectDb($id)
    {
        $db = $this->setdb();
        $req = $db->prepare('DELETE FROM projects WHERE id=?');
        $result = $req->execute([$id]);
        return $result;
    }
}
