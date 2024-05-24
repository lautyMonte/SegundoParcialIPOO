<?php
class Fotbool extends Partido{
    private $coefCategoriaMenores;
    private $coefCategoriaJuveniles;
    private $coefCategoriaMayores;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coefCategoriaMenores=0.13;
        $this->coefCategoriaJuveniles=0.19;
        $this->coefCategoriaMayores=0.27;
    }

    public function __toString(){
        $cadena=parent::__toString();

        return $cadena;
    }

    public function darEquipoGanador()
    {
        $ganador=parent::darEquipoGanador();
        return $ganador;
    }

    /**
     * Devuelve el coeficiente del partido, pero 
     * @return float
     */
    public function coeficientePartido(){
        $coefPartido=parent::coeficientePartido();
        
        switch($this->getObjEquipo1()->getDescripcion()){
            case "Menores":
                $coefPartido=$coefPartido*$this->coefCategoriaMenores;break;
            case "juveniles":
                $coefPartido=$coefPartido*$this->coefCategoriaJuveniles;break;
            case "Mayores":
                $coefPartido=$coefPartido*$this->coefCategoriaMayores;break;
        }
        return $coefPartido;   
    }
}
?>