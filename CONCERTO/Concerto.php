<?php
class Concerto
{
    private $id;
    private $codice;
    private $titolo;
    private $descrizione;
    private $data;

    public static function Create($cod, $titolo, $desc, $data)
    {
        $obj = new Concerto(); //creiamo l'object di tipo concerto
        $obj->codice = $cod;
        $obj->titolo = $titolo;
        $obj->descrizione = $desc;
        $obj->data = $data;
        return $obj; //lo ritorniamo
    }
    public function get_Id()
    {
        return $this->id;
    }
    public function get_Codice()
    {
        return $this->codice;
    }
    public function Set_Codice($cod)
    {
        $this->codice = $cod;
    }
    public function get_Titolo()
    {
        return $this->titolo;
    }
    public function Set_Titolo($titolo)
    {
        $this->titolo = $titolo;
    }
    public function get_Descrizione()
    {
        return $this->descrizione;
    }
    public function set_Descrizione($desc)
    {
        $this->descrizione = $desc;
    }
    public function get_Data()
    {
        return $this->data;
    }
    public function set_Data($data)
    {
        $this->data = $data;
    }

}