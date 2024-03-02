<?php
namespace models;
use PDO, PDOException;

/**
 * Class Subgroup
 * 
 * Represents a subgroup in the application.
 */
class Subgroup {
    private $conn;
    private $table_name = "Subgroup";

    // Object properties
    public $id;
    public $name;
    public $description;
    public $image;
    public $createdAt;
    public $updatedAt;
    public $creatorId;

    /**
     * Constructor with database connection.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Create a new subgroup.
     * 
     * @return bool Returns true if the subgroup was created successfully, false otherwise.
     */
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, image=:image, creatorId=:creatorId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Read all subgroups.
     * 
     * @return PDOStatement Returns the result set of all subgroups.
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
     * Update a subgroup.
     * 
     * @return bool Returns true if the subgroup was updated successfully, false otherwise.
     */
    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, image=:image, creatorId=:creatorId WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->creatorId = htmlspecialchars(strip_tags($this->creatorId));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Delete a subgroup.
     * 
     * @return bool Returns true if the subgroup was deleted successfully, false otherwise.
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