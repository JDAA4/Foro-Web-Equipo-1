<?php
namespace models;
use PDO;

/**
 * The Votes class represents a vote in the system.
 */
class Votes extends connection{
    private $id;
    private $type;
    private $userId;
    private $postId;
    private $commentId;

    /**
     * Constructs a new Votes object.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Inserts a new vote into the database.
     *
     * @param string $type The type of the vote.
     * @param string $userId The ID of the user who made the vote.
     * @param string|null $postId The ID of the post the vote is for (optional).
     * @param string|null $commentId The ID of the comment the vote is for (optional).
     * @return int The ID of the inserted vote.
     */
    public function InsertVote(string $type, string $userId, string $postId=null, string $commentId=null){
        $this->type = $type;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->commentId = $commentId;
    
        $sql = "INSERT INTO Vote (type, userId, postId, commentId) VALUES (?, ?, ?, ?)";
        $insert = $this->conn->prepare($sql);
        $arrData = array($this->type, $this->userId, $this->postId, $this->commentId);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    /**
     * Retrieves the number of votes for a specific post.
     *
     * @param int $postId The ID of the post.
     * @return array An associative array containing the number of votes.
     */
    public function GetVotesByPostId($postId){
        $sql="SELECT COUNT(*) as votes FROM Vote WHERE postId = $postId";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    /**
     * Retrieves the number of votes for a specific comment.
     *
     * @param int $commentId The ID of the comment.
     * @return array An associative array containing the number of votes.
     */
    public function GetVotesByCommentId($commentId){
        $sql="SELECT COUNT(*) as votes FROM Vote WHERE commentId = $commentId";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }
}
