<?php

include 'Concerto.php'; //includiamo la nostra classe 
//apriamo file di testo contenente la password e la scriviamo nella variabile 
$filePs = fopen("Pssw.txt", "r");
$password = fread($filePs, filesize("Pssw.txt"));
fclose($filePs);
//apriamo file di testo contenente l'username e la scriviamo nella variabile 
$fileUs = fopen("Username.txt", "r");
$username = fread($fileUs, filesize("Username.txt"));
fclose($fileUs);

//utilizziamo la classe PDO per stabilire connessione con il database di dbeaver
$host = 'mysql:host=localhost;dbname=e5_concerto';
$connessione = new PDO($host, $username, $password);

for (; ; ) //facciamo un ciclo infinito finche l'utente non decide di interrompere l'inserimento
{
    echo "Inserisci codice \n";
    $codice = readline();
    echo "Inserisci titolo \n";
    $titolo = readline();
    echo "Inserisci descrizione \n";
    $descrizione = readline();
    echo "Inserisci data \n";
    $data = readline();

    $concerto = Concerto::Create($codice, $titolo, $descrizione, $data);

    $connessione->query("insert into e5_concerto.concerti (codice_concerto, titolo_concerto, descrizione_concerto, data_concerto)
    VALUES ('$codice', '$titolo', '$descrizione', '$data')"); //andiamo a scrivere la nostra query per inserire il record 
    echo "inserire altri oggetti?  S/N \n";
    $risposta = readline();
    if (strtolower($risposta) == 'n') {
        break;
    }
}