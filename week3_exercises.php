<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Övningar</title>
    <style>
        h2 {
            margin:0px;
            font-size: 1.1rem;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 1px;
            text-align: left;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .grid-item {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<h1>PHP Övningar vecka 3</h1>

<div class="grid-container">
<div class="grid-item">

Övning 1: <h2>Here you go!</h2>
<?php
//Skriv ett PHP-script som öppnar en fil, läser innehållet och skriver ut det på webbsidan.


?>
</div>

<div class="grid-item">
Övning 1.2: <h2>Saver</h2>  
<?php
//Skriv ett PHP-script sparar en variabel i en textfil.
//Skriv sedan kod som läser samma variabel och echo:ar variabeln.

?>

</div>

<div class="grid-item">
Övning 1.3: <h2>Strimlaren</h2>
<?php
//Skapa en PHP kod som läggs i en funktion som raderar allt innehåll i en fil.

?>

</div>
<div class="grid-item">
Övning 2: <h2>Loggfil med tidsstämpel</h2>
<?php
//Skapa ett PHP-script som loggar användarens besök genom att skriva en tidsstämpel och IP-adress till en fil.
//Tips: använd date() och $_SERVER['REMOTE_ADDR'];

?>

</div>

<div class="grid-item">
Övning 3:<h2>Info om filen</h2>
<?php
//Skriv ett PHP-script som räknar antalet ord i en textfil  
//och visar filens storlek och och sedan echo det på webbsidan.
?>
</div>

<div class="grid-item">
Övning 4: <h2>Listan</h2>
<?php
//Skriv ett PHP-script som hämtar innehållet i en textfil och visar det i en HTML-lista (ul, li).
?>

</div>

<div class="grid-item">
Övning 5:<h2>Gästboken</h2>
<?php 
//Skapa ett formulär där användare kan skriva sitt namn och meddelande. 
//Alla meddelanden sparas i en textfil och visas på en gästbokssida.
?>

</div>

<div class="grid-item">
Övning 6:<h2>Array vs. File</h2>
<?php
//Skapa ett PHP-script skriver ut följande associativa array till en textfil, 
//Samt sedan läser tillbaka det till en array, med samma data och struktur.
/*

$person = [
    "first_name" => "John",
    "last_name" => "Doe",
    "age" => 30,
    "email" => "john.doe@example.com"
];

*/


?>
    
</div>
<div class="grid-item">
Övning 7:<h2>Magic 8th Ball Wisdom</h2>
<?php
//Skapa ett PHP-script som genererar ett slumpmässigt citat från en fil med citat. 
//Citaten sparas i en textfil, och varje gång scriptet körs, returneras ett nytt smart citat.
//Spara i en "counter" längst ner i textfilen hur många gånger programmet har körts
//Lagra en till fil med dåliga citat. 
//Börja använda dessa citat mer och mer när kulan börjar bli trött efter för många körningar.

?>

</div>

<div class="grid-item">
Övning 8:<h2>Kalkylator</h2>
<?php
//Skapa en miniräknare som lagrar alla beräkningar i en fil.
//Miniräknaren ska byggas med GET som method i formuläret
//Plus. minus, gånger och delat med ska finnas.

//Varje gång man trycker på submit så ska historiken visas under miniräknaren

?>

</div>

<div class="grid-item">
Övning 9:<h2>Tamagotchi</h2>
<?php
//Skapa ett PHP-script som simulerar ett virtuellt djur som växer 
//genom att uppdatera en textfil med information om djurets storlek, 
//vikt och ålder varje gång scriptet körs.
//Djuret har en viss ålder och dör sedan. Visa gravsten som bild när djuret har dött.
?>
</div>

<div class="grid-item">
Övning 10: <h2>Team List</h2>
<?php
//Skapa ett PHP-script som läser in användarnamn från en fil (en rad per användare) 
//och lagrar dem i en array. Sedan ska du lägga till en ny användare till denna 
//lista och skriva tillbaka den uppdaterade listan till filen

?>

</div>

<div class="grid-item">
Övning 11: <h2>Leaderboard</h2>
<?php
//Skapa ett PHP-script som lagrar poäng för flera spelare i en textfil,
// där varje spelares poäng lagras på en separat rad. Sedan ska scriptet 
//läsa dessa poäng och sortera dem i ordning efter högsta poäng.

</div>

<div class="grid-item">
Övning 12: <h2>Blogg</h2>
<?php
//Skapa en blogg där du som användare kan:
// Skriva inlägg via ett formulär.
// Se alla inlägg på en sida.
// Varje inlägg sparas som en separat fil till exempel: "posts/2025-02-06-title.txt)".

?>

</div>

<div class="grid-item">
Övning 13: <h2>Retro Game Warehouse</h2>
<?php

// Bygg ett enkelt lagerhanteringssystem där:
// Produkter lagras i en CSV-fil (inventory.csv).
// Varje produkt har ett namn, antal i lager och pris.
//Konvertera CSV-rader till en associativ array och tillbaka.
//Formulär behövs inte men följande funktionalitet krävs:
//Ändringar i arrayen ska kunna sparas i CSV-fil, 
//och ändringar i CSV-fil ska ändra arrayen (vid refresh).


?>


</div>

<div class="grid-item">
Övning 14: <h2>Pub quiz</h2>
<?php
//Skapa ett quiz där frågorna och svaren lagras i en JSON-fil (quiz.json).
// Varje fråga har ett eller flera alternativ och ett rätt svar.
// Användaren får poäng för rätt svar och ser sitt resultat i slutet.
// Skapa ett formulär med radioknappar som val av 1, X eller 2 (3-valsfrågor).


?>

</div>

</body>
</html>
