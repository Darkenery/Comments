<?php
/**
 * Created by PhpStorm.
 * User: darke_000
 * Date: 01.07.2016
 * Time: 18:06
 */

namespace Comments\Repository;

use Doctrine\DBAL\Connection;


class CommentRepository
{
    protected $db;
    public $level = -1;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function inputComment($pid, $text, $user)
    {
        $id = $this->getnewId();
        $date = date('d-m-Y H:i');
        $this->db->executeQuery('INSERT INTO comments VALUES (?, ?, ?, ?, ?);', array($id, $pid, $text, $user, $date));
    }

    public function getAllComments()
    {
        $stmt = $this->db->executeQuery('SELECT * FROM comments ORDER BY id ASC;');
        $rows = $stmt->fetchAll();

        if (!$rows)
            return null; else
        return $this->getCommentsTree($rows);
    }

    public function getNewId()
    {
        $stmt= $this->db->executeQuery('SELECT MAX(id) AS id FROM comments;');
        return $stmt->fetchColumn()+1;
    }

    public function getCommentsTree(array $comments)
    {
        $tree = array();

        foreach($comments as $comment) {
            $tree[(int)$comment['pid']][] = $comment;
        }

        return $this->buildTree($tree, 0);
    }

    public function buildTree($tree, $pid)
    {
        $this->level++;
        $result = array();

        if (is_array($tree) && isset($tree[$pid])){
            foreach ($tree[$pid] as $br){
                $br['level'] = $this->level;
                $result[] = $br;
                $result = array_merge($result, $this->buildTree($tree, $br['id']));
                $this->level--;
            }
        } else {
            return array();
        }
        return $result;
    }

    public function deleteComment($id)
    {
        $this->db->executeQuery('DELETE FROM comments WHERE id=?;', array($id));
        $stmt = $this->db->executeQuery('SELECT * FROM comments WHERE pid=?;', array($id));
        $rows = $stmt->fetchAll();
        foreach ($rows as $row){
            $this->db->executeQuery('DELETE FROM comments WHERE id=?', array($row['id']));
            $this->deleteComment($row['id']);}
    }
}