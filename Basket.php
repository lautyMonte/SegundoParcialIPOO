<?php
class Basket extends Partido{
    private $cantInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$cantInfracciones){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones=$cantInfracciones;
        $this->coefPenalizacion=0.75;
    }

    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }

    public function setCantInfracciones($cantInfracciones){
        $this->cantInfracciones=$cantInfracciones;
    }

    public function __toString(){
        $cadena=parent::__toString();

        $cadena.="cantidad de infracciones: ".$this->getCantInfracciones();
        $cadena.="\nPenalizacion: ".$this->coefPenalizacion;
        return $cadena;
    }

    public function darEquipoGanador()
    {
        $ganador=parent::darEquipoGanador();
        return $ganador;
    }

    /**
     * Devuelve el coeficiente del partido, pero descontandolo con el coeficiente de penalizacion
     * por la cantidad de infracciones
     * @return float
     */
    public function coeficientePartido(){
        $coefPartido=parent::coeficientePartido();
        $coefPartido=$coefPartido-($this->coefPenalizacion*$this->getCantInfracciones());
        return $coefPartido;   
    }


}
?>