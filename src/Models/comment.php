<?php
namespace models;
use PDO, PDOException;

/**
 * The Comment class represents a comment in the system.
 */
class Comment {
    private $conn;
    private $table_name = "Comment";

    // Object properties
    public $id;
    public $content;
    public $image;
    public $createdAt;
    public $updatedAt;
    public $creatorId;
    public $postId;
    public $replyToId;

    /**
     * Constructor for the Comment class.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Creates a new comment.
     * 
     * @return bool Returns true if the comment was created successfully, false otherwise.
     */
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, postId=:postId, replyToId=:replyToId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));
        $this->postId = htmlspecialchars(strip_tags($this->postId));
        $this->replyToId = htmlspecialchars(strip_tags($this->replyToId));

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":replyToId", $this->replyToId);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Reads all comments.
     * 
     * @return PDOStatement Returns the result set of all comments.
     */
    public function read() {
        // Query to select all records
        $query = "SELECT * FROM " . $this->table_name;

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();

        return $stmt;
    }

    /**
     * Updates an existing comment.
     * 
     * @return bool Returns true if the comment was updated successfully, false otherwise.
     */
    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, postId=:postId, replyToId=:replyToId WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));
        $this->postId = htmlspecialchars(strip_tags($this->postId));
        $this->replyToId = htmlspecialchars(strip_tags($this->replyToId));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":replyToId", $this->replyToId);
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Deletes a comment.
     * 
     * @return bool Returns true if the comment was deleted successfully, false otherwise.
     */
    public function delete() {
        // Query to delete a record
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind the id of the record to delete
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
