<?php 
namespace App\Models;

use CodeIgniter\Model;

class Dashboard_model extends Model{

    protected $table            = 'data';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombreIndicador','valorIndicador','fechaIndicador'];

}