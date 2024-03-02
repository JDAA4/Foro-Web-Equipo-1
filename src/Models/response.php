<?php
namespace models;
use PDO, PDOException;

/**
 * Class Response
 * 
 * Represents a response in the forum.
 */
class Response {
    private $conn;
    private $table_name = "Response";

    // Object properties
    public $id;
    public $content;
    public $image;
    public $createdAt;
    public $updatedAt;
    public $creatorId;
    public $commentId;

    /**
     * Response constructor.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Create a new response.
     * 
     * @return bool True if the response was created successfully, false otherwise.
     */
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, commentId=:commentId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));
        $this->commentId = htmlspecialchars(strip_tags($this->commentId));

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":commentId", $this->commentId);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Read all responses.
     * 
     * @return PDOStatement The query result set.
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
     * Update a response.
     * 
     * @return bool True if the response was updated successfully, false otherwise.
     */
    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, commentId=:commentId WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));
        $this->commentId = htmlspecialchars(strip_tags($this->commentId));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":commentId", $this->commentId);
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Delete a response.
     * 
     * @return bool True if the response was deleted successfully, false otherwise.
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
