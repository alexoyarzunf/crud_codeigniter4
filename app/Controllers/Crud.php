<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Crud_model;

class Crud extends Controller{
    
    public function index_create()
    {
        $crud_model     = new Crud_model();
        $data           = [];
        $data["data"]   = $crud_model->get_opciones();
        return view('crud/create',$data);
    }

    public function create()
    {
        $crud_model         = new Crud_model();
        $codigoIndicador    = $this->request->getPost('codigoIndicador');
        $fecha              = $this->request->getPost('fecha');
        $valor              = $this->request->getPost('valor');

        $filas              = $crud_model->validar_repetido($codigoIndicador,$fecha);
        
        if($filas == 0){
            $crud_model->crear_indicador($codigoIndicador,$fecha,$valor);
            return 'ok';
        }else{
            return 'error';
        }
        
    }

    public function index_read()
    {
        return view('crud/read');
    }

    public function read()
    {
        $crud_model         = new Crud_model();
        $data               = json_encode($crud_model->get_data(), JSON_UNESCAPED_UNICODE);
        return $data;
    }

    public function index_update()
    {
        $crud_model         = new Crud_model();
        $data               = [];
        $data["data"]       = $crud_model->get_opciones();
        return view('crud/update',$data);
    }

    public function get_valor_actual(){

        $codigoIndicador    = $this->request->getPost('codigoIndicador');
        $fecha              = $this->request->getPost('fecha');

        $crud_model         = new Crud_model();
        $valor_actual       = json_encode($crud_model->get_valor_actual($codigoIndicador,$fecha), JSON_UNESCAPED_UNICODE);
        return $valor_actual;

    }

    public function update()
    {
        
        $crud_model         = new Crud_model();
        $codigoIndicador    = $this->request->getPost('codigoIndicador');
        $fecha              = $this->request->getPost('fecha');
        $valor_nuevo        = $this->request->getPost('valor_nuevo');
        $crud_model->update_data($codigoIndicador,$fecha,$valor_nuevo);
    }

    public function index_delete()
    {
        return view('crud/delete');
    }

    public function delete()
    {
        
        $crud_model         = new Crud_model();
        $id                 = $this->request->getPost('id');
        $crud_model->delete_data($id);
    }

}