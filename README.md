# AWS
AWS - Amazon WOW Services

Tecnologie usate:
  - HTML 5: per la struttura del sito web.
  - CSS 3: per gli abbellimenti grafici (sfondo e bottoni).
  - PHP 8.0 per la gestione server-side.
  - Docker 3: per la virtualizzazione dei servizi (mysql, phpmyadmin, apache, php 8).

Struttura della repository:
  - Nella root folder di "aws" troviamo il file "index.html" che ti farà scegliere tra il login e la registrazione, il "docker-compose.yml" utilizzato per avviare e gestire l'intera applicazione e il "Dockerfile" che contiene la dipendenza per l'installazione di php 8.
  - Nella cartella "style" troviamo il file "style.css" che defisce lo sfondo comune a tutte le pagine del sito e la grafica dei bottoni.
  - Nella cartella "public" troviamo le pagine client-side per la visualizzazione. 
     - Il file "register.html" contiene un form (con controlli client-side) dove si devono inserire le informazioni per registrari (nome, cognome, nome utente, email e password), il form è collegato alla pagina php "./func/register.php". 
     - Troviamo il file "login.html" che contiene un form (con controlli client-side) per l'accesso al sito web dove si dovranno inserire le informazioni necessarie (nome utente e password), il form è collegato alla pagina php "./func/login.php". 
     - Il file "home.php" è accessibile solo dopo aver fatto il login grazie alla funzione "seiloggato()" all'interno del file "./func/islogged.php" e permette di visualizzare il nome utente.
  - Nella cartella "func" troviamo le pagine server-side per la gestione del login e della registrazione. 
     - Il file "register.php" richiede i file "./config/connetion.php" (connessione al database) e "./config/utility.php" (funzioni extra). Per prendere i valori inseriti nel form utilizziamo il metodo HTML "POST" e utilizziamo la funzione nativa di php "mysqli_real_escape_string()" che converte i caratteri speciali in backslash e la funzione "sanitizeString()" per pulire l'input ricevuto. All'inizio controlliamo che siano stati accettati i termini e le condizioni e subito dopo controlliamo che il nome utente o l'email non siano già state utilizzate per qualche altro account. Se non sono state usate allora si protegge la password facendo l'hash tra se stessa e un carattere "salt" con l'algoritmo "sha256" e, si va ad eseguire l'inserimento all'interno del deatabase dei dati dell'utente. 
     - Il file "login.php" inizializza la sessione e richiede gli stessi file e pulisce i valori in input come "register.php". Contorlla che il nome utente sia presente all'interno del database e se è presente fa' l'hash della password come in precedenza e controlla che sia un utente con le credenziali inserite, nel caso lo trovasse andrebbe a impostare come variabile "user" all'interno di "$_SESSION[]"_ reindirizzandolo alla pagina home.
     - Il file "islogged.php" ha al suo interno la funzione "seiloggato()" che controlla se è impostata la variabile "$_SESSION['user']_".
  - Nella cartella "database" troviamo il dump del database che contiene una sola tabella chiamata "account" con i campi "nome, cognome, username, email e password". Tutti hanno un massimo di caratteri inseribili e username e email hanno l'attributo "Unique".
  - Nella cartella "config" troviamo il file per la connessione al database "connection.php" e il file "utility.php" che ha la funzione "sanitizeString()" e la funzione per il carattere "salt" chiamata "saltChars()".
