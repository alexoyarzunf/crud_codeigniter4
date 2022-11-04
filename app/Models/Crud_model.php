<?php 
namespace App\Models;

use CodeIgniter\Model;

class Crud_model extends Model{

    protected $db;
    protected $table            = 'data';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombreIndicador','codigoIndicador','unidadMedidaIndicador','valorIndicador','fechaIndicador','origenIndicador'];
    
    public function get_opciones()
    {
        return $this->select('nombreIndicador,codigoIndicador')
                    ->groupBy('nombreIndicador,codigoIndicador','ASC')
                    ->findAll();
    }

    public function validar_repetido($codigoIndicador,$fecha)
    {
        $filas = $this->select('id')
                      ->where('codigoIndicador =',$codigoIndicador)
                      ->where('fechaIndicador =',$fecha)
                      ->countAllResults();

        return $filas;
    }

    public function crear_indicador($codigoIndicador,$fecha,$valor)
    {
        $db = \Config\Database::connect();                        
                     
        $sql = "INSERT INTO data (nombreIndicador, codigoIndicador, unidadMedidaIndicador, valorIndicador, fechaIndicador, origenIndicador)
                     SELECT nombreIndicador, '$codigoIndicador', unidadMedidaIndicador, $valor, '$fecha', 'CRUD'
                       FROM data
                      WHERE codigoIndicador = '$codigoIndicador'
                      LIMIT 1";
        
        $this->db->query($sql);
    }

    public function get_data()
    {
        return $this->select('*')->orderBy('fechaIndicador','nombreIndicador', 'DESC')->findAll();
    }

    public function get_valor_actual($codigoIndicador,$fecha)
    {
        return $this->select('valorIndicador')
                    ->where('codigoIndicador=',$codigoIndicador)
                    ->where('fechaIndicador=',$fecha)
                    ->findAll();
    }

    public function update_data($codigoIndicador,$fecha,$valor_nuevo)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE data SET valorIndicador = $valor_nuevo 
                          WHERE codigoIndicador = '$codigoIndicador' AND
                                fechaIndicador = '$fecha'";
        
        $this->db->query($sql);
    }

    public function delete_data($id)
    {
        $db = \Config\Database::connect();

        $sql = "DELETE FROM data WHERE id = $id";
        
        $this->db->query($sql);
    }

}