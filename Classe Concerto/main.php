<?php
include 'concerto.php';//andiamo a richiamare la nostra classe concerto
include 'db_manager.php';//andiamo a richiamare la nostra connessione 
//FUNZIONI
function ControlloFind()
{
    $c = Concerto::Find(readline());
    if($c == false)
    {
        return $c = null;//lo mettiamo a nullo perchè non è stato trovato
    }
    return $c;
}
function Insert()
{
    echo "Inserisci codice concerto: ";
    $cod = readline();
    echo "Inserisci titolo concerto: ";
    $titolo = readline();
    echo "Inserisci descrizione concerto: ";
    $desc = readline();
    echo "Inserisci data concerto: ";
    $data = readline();
    echo "\n";
    $params = array($cod, $titolo, $desc, $data);//creazione array associativo 
    $c = Concerto::Create($params);
}
function Search()
{
    echo "Inserisci l'id del concerto da cercare: ";
    $c = ControlloFind();
    if($c == null)
    {
        echo "Id non presente nel database \n";
    }
    else
    {
        echo "\n";
        $c->Show();
        echo "\n";
    }    
}
function Change(){
    echo "Inserisci l'id del concerto da modificare: ";
    $c = ControlloFind();
    if($c == null)
    {
        echo "Id non presente nel database \n";
    }
    else
    {
        echo "\n";
        echo "Inserisci i dati da modificare, premere INVIO per lasciare un dato invariato ";
        echo "\n";
        echo "Inserisci codice concerto: ";
        $cod = readline();
        echo "Inserisci titolo concerto: ";
        $titolo = readline();
        echo "Inserisci descrizione concerto: ";
        $desc = readline();
        echo "Inserisci data concerto: ";
        $data = readline();
        echo "\n";
        $params = array($cod, $titolo, $desc, $data);
        $c->Update($params);
        echo "\n";
    }   
}
function Remove(){
    echo "Inserisci l'id del concerto da eliminare: ";
    $c = ControlloFind();
    if($c == null)
    {
        echo "Id non presente nel database \n";
    }
    else
    {
        echo "\n";
        $c->Delete();
        echo "Concerto eliminato \n";
    }
}
//andiamo a verificare se la connessione è avvenuta con successo e gestire l'eccezione 
try {
    $connessione = Db_manager::GenConnection();
} catch (Exception $e) {
    echo 'Impossibile connettersi al database: ';
    echo '' . $e->getMessage() . '';//getMessage mi restituisce il messaggio del eccezione
    exit();
};
for (;;) {
    echo "==================================================================\n";
    echo ("Premere 1 per creare un record\n");
    echo ("Premere 2 per mostrare un record\n");
    echo ("Premere 3 per modificare un record\n");
    echo ("Premere 4 per eliminare un record\n");
    echo ("Premere 5 per mostrare tutti i records presenti nella tabella\n");
    echo ("Premere 0 per terminare il programma\n");
    echo "==================================================================\n";
    $scelta = readline();
    switch ($scelta) {
        case 0:
            break 2;
        //Break ci permette di interrompere l'esecuzione dello switch case.
        //Break ha una sintassi del tipo "break n_Livello;" Dove n_Livello indica il ciclo o switch da cui vogliamo uscire
        //In questo caso "break 2;" interrompe il ciclo for infinito, invece "break;" interrompe solo lo switch case poichè è il primo
        case 1:
            Insert();
            break;
        case 2:
            Search();
            break;
        case 3:
            Change();
            break;
        case 4:
            Remove();
            break;
        case 5:
            Concerto::FindAll();
            break;
    }

}