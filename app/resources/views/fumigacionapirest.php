<?php
    class fumigacionapirest {
    private $conn;
    private $table_name = "fumigacion";
    private $id_response;
    public  $id;
    public  $fecha;
    public  $hora;
    public  $invernadero;
    public  $tratamiento;
    public  $encargado;

    public function __construct($db,$id) {
        $this->conn = $db;
        $this->id_response = $id;
    }

    public function selectfumigacion() {
        $query = "SELECT * FROM ". $this->table_name ." f ORDER BY f.invernadero DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function selectfumigacionactual() {
      date_default_timezone_set("America/Guayaquil");
      $Date = date('Y-m-d', time()); 
      $query = "SELECT * FROM " . $this->table_name . " f WHERE f.fecha = :fecha ORDER BY f.invernadero DESC";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':fecha', $Date);
      $stmt->execute();
      return $stmt;
    }
    public function selectfumigacioneditar() {
        $query = "SELECT * FROM " . $this->table_name . " f WHERE f.id = :id ORDER BY f.invernadero DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',$this->id_response);
        $stmt->execute();
        return $stmt;
      }
    public function agregarfumigacion() {
        $query = "INSERT INTO ".$this->table_name."
            SET
            fecha=:fecha,hora=:hora,invernadero=:invernadero,tratamiento=:tratamiento,encargado=:encargado";

        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->invernadero = htmlspecialchars(strip_tags($this->invernadero));
        $this->tratamiento = htmlspecialchars(strip_tags($this->tratamiento));
        $this->encargado = htmlspecialchars(strip_tags($this->encargado));

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":invernadero", $this->invernadero);
        $stmt->bindParam(":tratamiento", $this->tratamiento);
        $stmt->bindParam(":encargado", $this->encargado);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function editarfumigacion() {
        $query = "UPDATE " . $this->table_name . " 
        SET fecha =:fecha, hora =:hora, invernadero =:invernadero, 
        tratamiento =:tratamiento, encargado =:encargado WHERE id =:id";

        $stmt = $this->conn->prepare($query);

        $this->fecha = htmlspecialchars(strip_tags($this->fecha));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->invernadero = htmlspecialchars(strip_tags($this->invernadero));
        $this->tratamiento = htmlspecialchars(strip_tags($this->tratamiento));
        $this->encargado = htmlspecialchars(strip_tags($this->encargado));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":invernadero", $this->invernadero);
        $stmt->bindParam(":tratamiento", $this->tratamiento);
        $stmt->bindParam(":encargado", $this->encargado);
        $stmt->bindParam(":id", $this->id_response);
        

        if ($stmt->execute()) {
            return true;
        }
        return false;

    }
    public function eliminarfumigacion() {
        $query = "DELETE FROM " . $this->table_name . "
        WHERE id =:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',$this->id_response);
        $stmt->execute();
        return $stmt;
      }
}