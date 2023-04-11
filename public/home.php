<?php
    session_start();
    require "../func/utility.php";
    if(!seiloggato()){
        echo "<script> window.location = '../public/login.html';</script>";
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>AWS</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">SCHERZONEEEE</h2>

                                <h2 class="text text-center mb-5">Ciao, <?php echo $_SESSION['user'] ?> in realtà non c'è niente...</h2>
                                
                                <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-success btn-block btn-lg text-body lol" data-toggle="modal" data-target="#modal">Informazioni</button>
                                </div>

                                <form method="POST" action="../func/logout.php">
                                    <button type="submit" class="btn btn-success btn-block btn-lg text-body lol" data-toggle="modal" data-target="#modal">Esci</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Spiegazione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            AWS - Amazon WOW Services <br><br>

Tecnologie usate:<br><br>

HTML 5: per la struttura del sito web.<br>
CSS 3: per gli abbellimenti grafici (sfondo e bottoni).<br>
Bootstrap 5: per la visualizzazione grafica fresca e responsive.<br>
JQuery 3: per la gestione degli script.<br>
PHP 8.0: per la gestione server-side.<br>
MYSQL: per la gestione del database.<br>
Docker 3: per la virtualizzazione dei servizi (mysql, phpmyadmin, php8-apache, docker-ssl-proxy).<br><br>



Struttura della repository:<br><br>

Nella root folder di "aws" troviamo il file "index.html" che ti farà scegliere tra il login e la registrazione, il "docker-compose.yml" utilizzato per avviare e gestire l'intera applicazione (mysql, phpmyadmin, php8-apache dal "Dockerfile", docker-ssl-proxy) e il "Dockerfile" che contiene la dipendenza per l'installazione di php 8.<br><br>
Nella cartella "style" troviamo il file "style.css" che defisce lo sfondo comune a tutte le pagine del sito e la grafica dei bottoni.<br><br>
Nella cartella "public" troviamo le pagine client-side per la visualizzazione del sito web:<br>
Il file "register.html" contiene un form (con controlli client-side) dove si devono inserire le informazioni per registrari (nome, cognome, nome utente, email e password), il form è collegato alla pagina php "./func/register.php".<br>
Troviamo il file "login.html" che contiene un form (con controlli client-side) per l'accesso al sito web dove si dovranno inserire le informazioni necessarie (nome utente e password), il form è collegato alla pagina php "./func/login.php".<br>
Il file "home.php" è accessibile solo dopo aver fatto il login grazie alla funzione "seiloggato()" all'interno del file "./func/utility.php" che reindirizza l'utente alla pagina di login se non è già loggato.<br><br>
Nella cartella "func" troviamo le pagine server-side per la gestione del login e della registrazione:<br>
Il file "register.php" richiede i file "./config/connetion.php" (connessione al database) e "./func/utility.php" (funzioni extra). Per prendere i valori inseriti nel form utilizziamo il metodo HTML "POST" e utilizziamo la funzione nativa di php "mysqli_real_escape_string()" che converte i caratteri speciali in backslash e la funzione "sanitizeString()" da "./func/utility.php" per pulire l'input ricevuto. All'inizio controlliamo che siano stati accettati i termini e le condizioni e subito dopo controlliamo che il nome utente o l'email non siano già state utilizzate per qualche altro account. Se non sono state usate allora si protegge la password facendo l'hash tra se stessa e un carattere "salt" con l'algoritmo "ripemd160" e, si va ad eseguire l'inserimento all'interno del deatabase dei dati dell'utente.<br>
Il file "login.php" inizializza la sessione e richiede gli stessi file e pulisce i valori in input come "register.php". Contorlla che il nome utente sia presente all'interno del database e se è presente fa' l'hash della password come in precedenza e controlla che sia un utente con le credenziali inserite, nel caso lo trovasse andrebbe a impostare come variabile "user" all'interno di "$_SESSION[]"_ il nome utente e lo reindirizzerebbe alla pagina home.<br>
Il file "utility.php" ha la funzione "sanitizeString()" per pulire una stringa, la funzione per aggiungere il carattere "salt" chiamata "saltChars()" e la funzione "seiloggato()" che controlla che sia settata la variabile "user" all'interno di "$_SESSION[]"_.<br>
Il file "logout.php" elimina la sessione, toglie la variabile "user" all'interno di "$_SESSION[]"_ e ti reindirizza al login.<br><br>
Nella cartella "database" troviamo il dump del database che contiene una sola tabella chiamata "account" con i campi "id, nome, cognome, username, email e password". Tutti hanno un massimo di caratteri inseribili e "username" e "email" hanno l'attributo "Unique" invece "id" è la chiave primaria ed è si auto incrementa.<br>
Nella cartella "config" troviamo il file per la connessione al database "connection.php".<br><br>

Sul server EC2 di Amazon è stata creata un'istanza con Ubuntu per far hostare il sito web e sono state aperte le porte necessarie per il funzionamento di tutti i servizi correlati.
            </div>
            </div>
        </div>
    </div>
</body>
</html>