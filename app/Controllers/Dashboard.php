<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Dashboard_model;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }
    public function get_grafico1()
    {
        $fecha_ini = $this->request->getPost('fecha_ini');
        $fecha_fin = $this->request->getPost('fecha_fin');
        $dashboard_model = new Dashboard_model();
        $data = [];
        $data = $dashboard_model->select('nombreIndicador,fechaIndicador,valorIndicador')
                                ->where('fechaIndicador >=',$fecha_ini)
                                ->where('fechaIndicador <=',$fecha_fin)
                                ->orderBy('fechaIndicador,nombreIndicador','ASC')
                                ->findAll();
        $data_final = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $data_final;
    }
}
