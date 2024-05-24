<?php
class Torneo{
    private $colPartidos;
    private $importePremio;

    public function __construct($colPartidos,$importePremio){
        $this->colPartidos=$colPartidos;
        $this->importePremio=$importePremio;
    }

    public function getColPartidos(){
        return $this->colPartidos;
    }

    public function setColPartidos($colPartidos){
        $this->colPartidos=$colPartidos;
    }

    public function getImportePremio(){
        return $this->importePremio;
    }

    public function setImportePremio($importePremio){
        $this->importePremio=$importePremio;
    }

    public function __toString(){
        $partidos=$this->getColPartidos();
        $cadena="";

        $cadena.="\n////////coleccion de partidos/////////////\n".$this->ColDeObjetos($partidos);
        $cadena.="\n/////////////////////////////\n"."Premio: $".$this->getImportePremio();
        return $cadena;
    }

    public function ColDeObjetos($coleccion){
        $cadena="";
        for($i=0;$i<count($coleccion);$i++){
            $cadena.="partido ".($i+1)."\n".$coleccion[$i]."\n\n";
        }
        return $cadena;
    }

    /**
     * Registra los nuevos partidos, si la cantidad de jugadores y la categoria son la misma
     * @param Equipo
     * @param Equipo
     * @param string
     * @param string
     * FUNCIONA
     */
    public function ingresarPartido($objEquipo1,$objEquipo2,$fecha,$tipoPartido){
        $nuevoPartido=null;

        if($objEquipo1->mismasCondiciones($objEquipo2)){
            $idPartido=random_int(1,999);
            if(strcmp($tipoPartido,"fotbool")==0){
                $nuevoPartido=new Fotbool($idPartido,$fecha,$objEquipo1,0,$objEquipo2,0);
            }else{
                $cantInfracciones=random_int(1,5);
                $nuevoPartido= new Basket($idPartido,$fecha,$objEquipo1,0,$objEquipo2,0,$cantInfracciones);
            }

            $auxPartidos=$this->getColPartidos();
            array_push($auxPartidos,$nuevoPartido);
            $this->setColPartidos($auxPartidos);
        }
        return $nuevoPartido;
    }

    /**
     * recibe por parámetro si se trata de un partido de fútbol o de básquetbol y en base al parámetro 
     * busca entre esos partidos los equipos ganadores ( equipo con mayor cantidad de goles),.
     * Retorna una coleccion con todos los ganadores de ese deporte
     * @return array
     */
    public function darGanadores($deporte){
        $colGanadores=[];

        foreach($this->getColPartidos() as $auxPartidos){
            if(is_a($auxPartidos,$deporte)){
                //esto es para el caso que haya un empate
                $auxGanador=$auxPartidos->darEquipoGanador();
                if(count($auxGanador)==2){
                    array_push($colGanadores,$auxGanador[0]);
                    array_push($colGanadores,$auxGanador[1]);
                }else{
                    //esto es para el caso de que solo haya un ganador
                    array_push($colGanadores,$auxGanador);
                }
            }       
        }
        return $colGanadores;
    }


}
?>