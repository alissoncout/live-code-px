<?php

namespace App\Services;

use App\Repositories\AvaliacaoRepository;

class AvaliacaoService
{
    protected $repository;
    protected $detalheAnalise = array();

    public function __construct(AvaliacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function analise($payload)
    {
        $this->regraTipoCarga($payload);
        $this->regraClima($payload);
        $this->regraHistoricoTransportadora($payload);
        $this->regraCargaSeguro($payload);

        return array("data" => [], "status" => true);
    }

    public function regraTipoCarga($payload){
        switch ($payload['cargo_type']) {
            case 'Produtos Químicos Perigosos':
                $this->detalheAnalise['tipo_carga'] = array(
                    "risco" => 'Alto',
                );
            break;
            case 'Alimentos Perecíveis':
                if($payload['total_distancy_km'] > 300){

                }
                $this->detalheAnalise['tipo_carga'] = array(
                    "risco" => 'Alto',
                );
            break;
            case 'Eletrônicos Sensíveis':

            break;
        }
    }

    public function regraClima($payload){
        
    }

    public function regraHistoricoTransportadora($payload){
        
    }

    public function regraCargaSeguro($payload){
        
    }
}