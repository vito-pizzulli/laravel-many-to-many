<p align="center">
    <a href="https://getbootstrap.com" target="_blank"><img src="https://miro.medium.com/v2/resize:fit:400/1*onZhQJU7A3ab6V1sHfMRkQ.jpeg" height="150"></a>
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" height="150"></a>
    <a href="https://sass-lang.com/" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Sass_Logo_Color.svg/1200px-Sass_Logo_Color.svg.png" height="150"></a>
</p>

# Laravel Boolfolio - Project Technology

<p>Continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo e aggiungiamo una nuova entità Technology.</p>
<p>Questa entità rappresenta le tecnologie utilizzate ed è in relazione many to many con i progetti.</p>
<p>I task da svolgere sono diversi, ma alcuni di essi sono un ripasso di ciò che abbiamo fatto nelle lezioni dei giorni scorsi:</p>

- creare la migration per la tabella technologies;
- creare il model Technology;
- creare la migration per la tabella pivot project_technology;
- aggiungere ai model Technology e Project i metodi per definire la relazione many to many;
- visualizzare nella pagina di dettaglio di un progetto le tecnologie utilizzate, se presenti;
- permettere all’utente di associare le tecnologie nella pagina di creazione e modifica di un progetto;
- gestire il salvataggio dell’associazione progetto-tecnologie con opportune regole di validazione.

## Bonus 1

<p>Creare il seeder per il model Technology.</p>

## Bonus 2

<p>Aggiungere le operazioni CRUD per i model Types e Technology, in modo da gestire i tipi e le tecnologie utilizzate nei progetti direttamente dal pannello di amministrazione.</p>