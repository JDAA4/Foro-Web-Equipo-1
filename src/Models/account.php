<?php
namespace models;
use PDO, PDOException;

/**
 * The Account class represents a user account.
 */
class Account {
    private $conn;
    private $table_name = "Account";

    // Object properties
    public $id;
    public $userId;
    public $type;
    public $provider;
    public $providerAccountId;
    public $refresh_token;
    public $access_token;
    public $expires_at;
    public $token_type;
    public $scope;
    public $id_token;
    public $session_state;

    /**
     * Constructor for the Account class.
     *
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Creates a new account.
     *
     * @return bool Returns true if the account was created successfully, false otherwise.
     */
    public function create() {
        // Consulta para insertar un registro
        $query = "INSERT INTO " . $this->table_name . " SET userId=:userId, type=:type, provider=:provider, providerAccountId=:providerAccountId, refresh_token=:refresh_token, access_token=:access_token, expires_at=:expires_at, token_type=:token_type, scope=:scope, id_token=:id_token, session_state=:session_state";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->provider = htmlspecialchars(strip_tags($this->provider));
        $this->providerAccountId = htmlspecialchars(strip_tags($this->providerAccountId));
        $this->refresh_token = htmlspecialchars(strip_tags($this->refresh_token));
        $this->access_token = htmlspecialchars(strip_tags($this->access_token));
        $this->expires_at = htmlspecialchars(strip_tags($this->expires_at));
        $this->token_type = htmlspecialchars(strip_tags($this->token_type));
        $this->scope = htmlspecialchars(strip_tags($this->scope));
        $this->id_token = htmlspecialchars(strip_tags($this->id_token));
        $this->session_state = htmlspecialchars(strip_tags($this->session_state));

        // Enlazar valores
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":provider", $this->provider);
        $stmt->bindParam(":providerAccountId", $this->providerAccountId);
        $stmt->bindParam(":refresh_token", $this->refresh_token);
        $stmt->bindParam(":access_token", $this->access_token);
        $stmt->bindParam(":expires_at", $this->expires_at);
        $stmt->bindParam(":token_type", $this->token_type);
        $stmt->bindParam(":scope", $this->scope);
        $stmt->bindParam(":id_token", $this->id_token);
        $stmt->bindParam(":session_state", $this->session_state);

        // Ejecutar la consulta
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Retrieves all accounts.
     *
     * @return PDOStatement Returns a PDOStatement object containing the result set.
     */
    public function read() {
        // Consulta para seleccionar todos los registros
        $query = "SELECT * FROM " . $this->table_name;

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }

    /**
     * Updates an existing account.
     *
     * @return bool Returns true if the account was updated successfully, false otherwise.
     */
    public function update() {
        // Consulta para actualizar un registro
        $query = "UPDATE " . $this->table_name . " SET userId=:userId, type=:type, provider=:provider, providerAccountId=:providerAccountId, refresh_token=:refresh_token, access_token=:access_token, expires_at=:expires_at, token_type=:token_type, scope=:scope, id_token=:id_token, session_state=:session_state WHERE id=:id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->provider = htmlspecialchars(strip_tags($this->provider));
        $this->providerAccountId = htmlspecialchars(strip_tags($this->providerAccountId));
        $this->refresh_token = htmlspecialchars(strip_tags($this->refresh_token));
        $this->access_token = htmlspecialchars(strip_tags($this->access_token));
        $this->expires_at = htmlspecialchars(strip_tags($this->expires_at));
        $this->token_type = htmlspecialchars(strip_tags($this->token_type));
        $this->scope = htmlspecialchars(strip_tags($this->scope));
        $this->id_token = htmlspecialchars(strip_tags($this->id_token));
        $this->session_state = htmlspecialchars(strip_tags($this->session_state));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar valores
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":provider", $this->provider);
        $stmt->bindParam(":providerAccountId", $this->providerAccountId);
        $stmt->bindParam(":refresh_token", $this->refresh_token);
        $stmt->bindParam(":access_token", $this->access_token);
        $stmt->bindParam(":expires_at", $this->expires_at);
        $stmt->bindParam(":token_type", $this->token_type);
        $stmt->bindParam(":scope", $this->scope);
        $stmt->bindParam(":id_token", $this->id_token);
        $stmt->bindParam(":session_state", $this->session_state);
        $stmt->bindParam(":id", $this->id);

        // Ejecutar la consulta
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Deletes an account.
     *
     * @return bool Returns true if the account was deleted successfully, false otherwise.
     */
    public function delete() {
        // Consulta para eliminar un registro
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar el id del registro a eliminar
        $stmt->bindParam(":id", $this->id);

        // Ejecutar la consulta
        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
