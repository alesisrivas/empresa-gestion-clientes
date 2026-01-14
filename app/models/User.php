<?php

class User {
    private $conn;
    private $table = "users";

    
public function __construct($db) {
    $this->conn = $db;
}

public function getAll() {
    $sql = "SELECT id, name, email, active, created_at
    FROM {$this->table}
    WHERE active = 1";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function create($name, $email, $password) {
    $sql = "INSERT INTO {$this->table} (name, email, password)
            VALUES (:name, :email, :password)";

    $stmt = $this->conn->prepare($sql);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    return $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashedPassword
        ]);
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM {$this->table}
        WHERE email = :email AND active = 1
        LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
