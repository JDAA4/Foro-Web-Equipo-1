<?php
namespace models;
use PDO, PDOException;

/**
 * The Session class represents a session in the application.
 */
class Session {
    private $conn;
    private $table_name = "Session";

    // Object properties
    public $id;
    public $userId;
    public $expires;
    public $sessionToken;
    public $accessToken;
    public $createdAt;
    public $updatedAt;

    /**
     * Constructor for the Session class.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Creates a new session.
     * 
     * @return bool Returns true if the session was created successfully, false otherwise.
     */
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET userId=:userId, expires=:expires, sessionToken=:sessionToken, accessToken=:accessToken, createdAt=:createdAt, updatedAt=:updatedAt";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->expires = htmlspecialchars(strip_tags($this->expires));
        $this->sessionToken = htmlspecialchars(strip_tags($this->sessionToken));
        $this->accessToken = htmlspecialchars(strip_tags($this->accessToken));
        $this->createdAt = htmlspecialchars(strip_tags($this->createdAt));
        $this->updatedAt = htmlspecialchars(strip_tags($this->updatedAt));

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":expires", $this->expires);
        $stmt->bindParam(":sessionToken", $this->sessionToken);
        $stmt->bindParam(":accessToken", $this->accessToken);
        $stmt->bindParam(":createdAt", $this->createdAt);
        $stmt->bindParam(":updatedAt", $this->updatedAt);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Reads all sessions from the database.
     * 
     * @return PDOStatement Returns a PDOStatement object containing the result set.
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
     * Updates an existing session.
     * 
     * @return bool Returns true if the session was updated successfully, false otherwise.
     */
    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET userId=:userId, expires=:expires, sessionToken=:sessionToken, accessToken=:accessToken, createdAt=:createdAt, updatedAt=:updatedAt WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->expires = htmlspecialchars(strip_tags($this->expires));
        $this->sessionToken = htmlspecialchars(strip_tags($this->sessionToken));
        $this->accessToken = htmlspecialchars(strip_tags($this->accessToken));
        $this->createdAt = htmlspecialchars(strip_tags($this->createdAt));
        $this->updatedAt = htmlspecialchars(strip_tags($this->updatedAt));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":expires", $this->expires);
        $stmt->bindParam(":sessionToken", $this->sessionToken);
        $stmt->bindParam(":accessToken", $this->accessToken);
        $stmt->bindParam(":createdAt", $this->createdAt);
        $stmt->bindParam(":updatedAt", $this->updatedAt);
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Deletes a session from the database.
     * 
     * @return bool Returns true if the session was deleted successfully, false otherwise.
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