<?php
namespace models;
use PDO, PDOException;

/**
 * Class Subscription
 * 
 * Represents a subscription in the system.
 */
class Subscription {
    private $conn;
    private $table_name = "Subscription";

    // Object properties
    public $userId;
    public $subgroupId;
    public $createdAt;
    public $updatedAt;

    /**
     * Constructor with the database connection.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Create a new subscription.
     * 
     * @return bool Returns true if the subscription was created successfully, false otherwise.
     */
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET userId=:userId, subgroupId=:subgroupId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->subgroupId = htmlspecialchars(strip_tags($this->subgroupId));

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":subgroupId", $this->subgroupId);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Read all subscriptions.
     * 
     * @return PDOStatement Returns the result set of all subscriptions.
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
     * Update a subscription.
     * 
     * @return bool Returns true if the subscription was updated successfully, false otherwise.
     */
    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET userId=:userId, subgroupId=:subgroupId WHERE userId=:userId AND subgroupId=:subgroupId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->subgroupId = htmlspecialchars(strip_tags($this->subgroupId));

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":subgroupId", $this->subgroupId);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Delete a subscription.
     * 
     * @return bool Returns true if the subscription was deleted successfully, false otherwise.
     */
    public function delete() {
        // Query to delete a record
        $query = "DELETE FROM " . $this->table_name . " WHERE userId=:userId AND subgroupId=:subgroupId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->subgroupId = htmlspecialchars(strip_tags($this->subgroupId));

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":subgroupId", $this->subgroupId);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
