<?php
namespace models;
use PDO, PDOException;

/**
 * The User class represents a user in the system.
 */
class User {
    private $conn;
    private $table_name = "User";

    // Object properties
    public $id;
    public $name;
    public $email;
    public $emailVerified;
    public $username;
    public $passwordHash;
    public $image;

    /**
     * Constructor for the User class.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Creates a new user in the database.
     * 
     * @return bool Returns true if the user was created successfully, false otherwise.
     */
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, username=:username, passwordHash=:passwordHash, image=:image";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->passwordHash=htmlspecialchars(strip_tags($this->passwordHash));
        $this->image=htmlspecialchars(strip_tags($this->image));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $passwordHash = password_hash($this->passwordHash, PASSWORD_BCRYPT);
        $stmt->bindParam(":passwordHash", $passwordHash);
        $stmt->bindParam(":image", $this->image);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Retrieves all users from the database.
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
     * Updates an existing user in the database.
     * 
     * @return bool Returns true if the user was updated successfully, false otherwise.
     */
    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET name=:name, email=:email, username=:username, passwordHash=:passwordHash, image=:image WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->passwordHash=htmlspecialchars(strip_tags($this->passwordHash));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $passwordHash = password_hash($this->passwordHash, PASSWORD_BCRYPT);
        $stmt->bindParam(":passwordHash", $passwordHash);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Deletes a user from the database.
     * 
     * @return bool Returns true if the user was deleted successfully, false otherwise.
     */
    public function delete() {
        // Query to delete a record
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // Bind the id of the record to delete
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Verifies the user's password.
     * 
     * @param string $password The password to verify.
     * @return bool Returns true if the password is correct, false otherwise.
     */
    public function verifyPassword($password) {
        return password_verify($password, $this->passwordHash);
    }
}