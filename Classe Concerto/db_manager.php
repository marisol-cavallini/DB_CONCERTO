<?php
//php una volta terminata la esecuzione del programma chiude in maniera automatica la connessione con il database 
class Db_manager
{
    static private $connection;
    static private $dsn = "mysql:host=localhost;dbname=organizzazione_concerto";//dsn->data source name che contiene i dati necessari per la connessione con il database

    public static function GenConnection()
    {
        $loginData = file_get_contents('config.txt'); //file_get_contents mette tutti i contenuti di un file in una stringa, come parametro viene passato il nome del file
        $loginDataSplit = explode(":", $loginData); //explode separa la nostra stringa prendendo in input il carettere separatore e la stringa
        $connection = new PDO(self::$dsn, $loginDataSplit[0], $loginDataSplit[1]); //creiamo una connessione con il database
        self::$connection = $connection; //self ci permette di assegnare il valore alla variabile statica connection
        return $connection;
    }
    public static function get_Connection()
    {
        return self::$connection;//ci ritorna la connessione creata precedentemente
    }
}