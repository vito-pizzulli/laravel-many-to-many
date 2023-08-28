<p align="center">
    <a href="https://getbootstrap.com" target="_blank"><img src="https://miro.medium.com/v2/resize:fit:400/1*onZhQJU7A3ab6V1sHfMRkQ.jpeg" height="150"></a>
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" height="150"></a>
    <a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Sass_Logo_Color.svg/1200px-Sass_Logo_Color.svg.png" height="150"></a>
</p>

# Laravel Boolfolio - Project Typology

<p>Continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo (come dal breve video aggiunto nelle registrazioni) e aggiungiamo una nuova entità Type.</p>
<p>Questa entità rappresenta la tipologia di progetto ed è in relazione one-to-many con i progetti.</p>
<p>I task da svolgere sono diversi, ma alcuni di essi sono un ripasso di ciò che abbiamo fatto nelle lezioni dei giorni scorsi:</p>

- creare la migration per la tabella types;
- creare il model Type;
- creare la migration di modifica per la tabella projects per aggiungere la chiave esterna;
- aggiungere ai model Type e Project i metodi per definire la relazione one to many;
- visualizzare nella pagina di dettaglio di un progetto la tipologia associata, se presente;
- permettere all’utente di associare una tipologia nella pagina di creazione e modifica di un progetto;
- gestire il salvataggio dell’associazione progetto-tipologia con opportune regole di validazione.

## Bonus

<p>Creare il seeder per il model Type.</p>