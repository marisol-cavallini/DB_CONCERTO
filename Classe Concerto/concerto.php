<?php
class Concerto
{   //creazione attributi
    private $id;
    private $codice_concerto;
    private $titolo_concerto;
    private $descrizione_concerto;
    private $data_concerto;

    public static function Create($params)
    {
        $connessione = Db_manager::get_Connection();
        $concerto = $connessione->prepare('insert into organizzazione_concerto.concerti (codice_concerto, titolo_concerto, descrizione_concerto, data_concerto) values (:codice, :titolo, :descrizione, :dataConcerto)');
        //prepariamo uno statement ovvero prepariamo il codice mysql per creare la nostra query
        //utilizziamo i bindParam per sanificare l'input dati, ovvero costringiamo il nostro codice a prender in input determinati tipi di valori. Esempio se abbiamo un intero il dato inserito deve essere per forza intero e non stringa
        $concerto->bindParam(':codice', $params[0], PDO::PARAM_STR);
        $concerto->bindParam(':titolo', $params[1], PDO::PARAM_STR);
        $concerto->bindParam(':descrizione', $params[2], PDO::PARAM_STR);
        $concerto->bindParam(':dataConcerto', $params[3], PDO::PARAM_STR);
        $concerto->execute();
        //execute esegue la statement con il bind dei parametri
        $id = $connessione->lastInsertId(); //restituiamo ultimo id creato
        $c = $connessione->prepare('select * from organizzazione_concerto.concerti where id = :id'); //cerchiamo l'oggeto appena xcreato per l'id
        $c->bindParam(':id', $id, PDO::PARAM_INT);
        $c->execute();
        return $c->fetchObject(__CLASS__); //lo ritorniamo e con fetch object serve per andare a recuperare l'oggetto di tipo class 
    }
    public static function Find($id)
    {
        $connessione = Db_manager::get_Connection();
        $concerto = $connessione->prepare('select * from organizzazione_concerto.concerti where id=:id');
        //viene eseguita sanificazione input
        $concerto->bindParam(':id', $id, PDO::PARAM_INT);
        $concerto->execute();
        //fetcchobject ci ritorna un'oggetto del tipo di una determinata classe. 
        //In questo caso inseriamo "__CLASS__" Per indicare che l'oggetto ritornato deve essere del tipo della classe in cui è collocato il codice quindi sarà di tipo Concerto
        $concertoTrovato = $concerto->fetchObject(__CLASS__);
        if($concertoTrovato == false)
        {
            return false;
        }
        return $concertoTrovato; //lo ritorniamo
    }
    public static function FindAll()
    {
        $connessione = Db_manager::get_Connection();
        $concerto = $connessione->query('select * from organizzazione_concerto.concerti');
        foreach ($concerto as $value) {
            echo "Codice: ".$value['codice_concerto'], " Titolo: " . $value['titolo_concerto'], " Descrizione: " . $value['descrizione_concerto'], " Data: " . $value['data_concerto'];
            echo("\n");
        }
    }
    //Metodi D'istanza
    public function Show()
    {
        //Mostriamo tutti gli attributi dell'oggetto
        echo "Codice: " . $this->codice_concerto . "\n";//. serve per unire le stringhe
        echo "Titolo: " . $this->titolo_concerto . "\n";
        echo "Descrizione: " . $this->descrizione_concerto . "\n";
        echo "Data: " . $this->data_concerto . "\n";
    }
    public function Delete()
    {
        //cancelliamo dal database un oggetto
        $connessione = Db_manager::get_Connection();
        $concerto = $connessione->prepare("delete from organizzazione_concerto.concerti where id=:id");
        //sanificazione input
        $concerto->bindParam(':id', $this->id, PDO::PARAM_INT);
        $concerto->execute();
    }
    public function Update($params)
    {
        $connessione = Db_manager::get_Connection();
        $concerto = $connessione->prepare("UPDATE organizzazione_concerto.concerti SET codice_concerto = :codice, titolo_concerto = :titolo, descrizione_concerto = :descrizione, data_concerto = :data WHERE id=:id");
        //prepariamo uno statement
        $i = 0;//si riferisce all'id
        $j = 0;
        //Dato che params contiene i valori degli attributi da modificare, alcuni a volte potrebbero essere vuoti perchè non richiedono modifiche
        //Pertanto quando $params ha valori vuoti andiamo semplicemente a sovrascriverli con i valori già presenti nel database
        foreach ($this as $value) 
        {
            //con un foreach iteriamo ogni valore di ogni attributo
            if ($i > 0) 
            {
                //controlliamo che $i sia > 0 perchè l'attributo 0 è id e pertanto non è presente in $params.
                if (strlen($params[$j]) == 0)
                {
                    $params[$j] = $value;
                }
                $j++;
            }
            $i++;
        }
        //sanificazione input
        $concerto->bindParam(':id', $this->id, PDO::PARAM_INT);
        $concerto->bindParam(':codice', $params[0], PDO::PARAM_STR);
        $concerto->bindParam(':titolo', $params[1], PDO::PARAM_STR);
        $concerto->bindParam(':descrizione', $params[2], PDO::PARAM_STR);
        $concerto->bindParam(':data', $params[3], PDO::PARAM_STR);
        $concerto->execute();
    }
    //metodi GET e SET
    public function get_Id()
    {
        return $this->id;
    }
    public function get_Codice()
    {
        return $this->codice_concerto;
    }
    public function Set_Codice($cod)
    {
        $this->codice = $cod;
    }
    public function get_Titolo()
    {
        return $this->titolo_concerto;
    }
    public function Set_Titolo($titolo)
    {
        $this->titolo = $titolo;
    }
    public function get_Descrizione()
    {
        return $this->descrizione_concerto;
    }
    public function set_Descrizione($desc)
    {
        $this->descrizione = $desc;
    }
    public function get_Data()
    {
        return $this->data_concerto;
    }
    public function set_Data($data)
    {
        $this->data = $data;
    }
}