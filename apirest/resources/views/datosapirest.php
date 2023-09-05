<?php
 use app\models\Usuario;
   class datosapirest {
    private $conn;
    private $table_name = "fumigaciones";
    private $table_name2 = "datos_plantas";
    private $table_name3= "usuarios";
    private $id_response;
    public  $id;
    public  $fecha;
    public  $hora;
    public  $invernadero,$privilegio;
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
    public function selectsensadoplanta() {
        date_default_timezone_set("America/Guayaquil");
        $Date = date('Y-m-d', time());
        $query = "SELECT * FROM ". $this->table_name2 ." d  WHERE d.fecha = :fecha ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fecha', $Date);
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
      public function selectusuarios() {
        $query = "SELECT * FROM ".$this->table_name3." WHERE id_usuario = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',$this->id_response);
        $stmt->execute();
        return $stmt;
      }
      public function comprobar() {
        $query = "SELECT * FROM " . $this->table_name3 . " s WHERE s.username = :id";
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
    public function actualizarprivilegio() {
        $query = "UPDATE " . $this->table_name3 . "
        SET privilegio =:privilegio
        WHERE id_usuario =:id";
        /*SET username =:username, password =:password, privilegio =:privilegio,
        activo =:activo, apellido =:apellido, fecha =:fecha, apellido =:apellido
        WHERE id_usuario =:id";*/

        $stmt = $this->conn->prepare($query);

       // $this->username = htmlspecialchars(strip_tags($this->username));
       // $this->password = htmlspecialchars(strip_tags($this->password));
        $this->privilegio = htmlspecialchars(strip_tags($this->privilegio));
      //  $this->activo= htmlspecialchars(strip_tags($this->activo));
      //  $this->apellido = htmlspecialchars(strip_tags($this->apellido));
      //  $this->fecha = htmlspecialchars(strip_tags($this->fecha));
     //   $this->imagenusuario = htmlspecialchars(strip_tags($this->imagenusuario));
      //  $this->dispositivo = htmlspecialchars(strip_tags($this->dispositivo));
        $this->id = htmlspecialchars(strip_tags($this->id));

     //   $stmt->bindParam(":username", $this->username);
     //   $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":privilegio", $this->privilegio);
     // $stmt->bindParam(":activo", $this->activo);
       // $stmt->bindParam(":apellido", $this->apellido);
       // $stmt->bindParam(":fecha", $this->fecha);
       // $stmt->bindParam(":imagenusuario", $this->imagenusuario);
       // $stmt->bindParam(":dispositivo", $this->dispositivo);
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
