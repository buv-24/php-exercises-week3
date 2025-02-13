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

<?php


//Läsa fil är lagd i funktioner
//Strimlaren => strimlar alla filer

//4 funktioner
//2 för indexerad array
//2 för assoc array med JSON

function ReadFromFile($filename){
    if(file_exists($filename)) {
        $data = file_get_contents($filename);
    }
    if (!empty($data)) {
        $data = explode("\n", trim($data));
    } else {
        $data = [];
    }
    return $data;
}

function SaveToFile($filename, $data) {
    file_put_contents($filename, implode("\n", $data));
}

function ReadFromFileJSON($filename) {
    if (file_exists($filename)) {
        $content = trim(file_get_contents($filename));
        if (!empty($content)) {
            $data = json_decode($content, true);
            if (!is_array($data)) {
                $data = [];
            }
            return $data;
        }
    }
}

function SaveToFileJSON($filename, $data) {
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $jsonData);
}

?>

<div class="grid-container">
<div class="grid-item">

Övning 1: <h2>Here you go!</h2>

<?php
//Skriv ett PHP-script som öppnar en fil, läser innehållet och skriver ut det på webbsidan.

$filename = "files/exercise1.txt";
$data = ReadFromFile($filename);


foreach ($data as $item) {
    echo $item . "<br>";
}


?>
</div>

<div class="grid-item">
Övning 1.2: <h2>Saver</h2>  
<?php
//Skriv ett PHP-script sparar en variabel i en textfil.
//Skriv sedan kod som läser samma variabel och echo:ar variabeln.

$filename = "files/exercise1_2.txt";
$data = ReadFromFile($filename);
$data[] = "Hello, World!";
SaveToFile($filename, $data);

foreach ($data as $item) {
    echo $item . "<br>";
}
?>
</div>

<div class="grid-item">
Övning 1.3: <h2>Strimlaren</h2>
<?php
//Skapa en PHP kod som läggs i en funktion som raderar allt innehåll i en fil.

$filename = "files/exercise1_3.txt";
$data = ReadFromFile($filename);
$data = [];

if (isset($_GET['strimlaren'])) {
    $files = scandir('./');
    foreach ($files as $file) {
        
        if (substr($file, -4) === '.txt') {
            file_put_contents($file, '');
        }
        if (substr($file, -5) === '.json') {
            file_put_contents($file, '');
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
echo "<a href=?strimlaren>Strimla</a>";
?>
</div>

<div class="grid-item">
Övning 2: <h2>Loggfil med tidsstämpel</h2>
<?php
//Skapa ett PHP-script som loggar användarens besök genom att skriva en tidsstämpel och IP-adress till en fil.
//Tips: använd date() och $_SERVER['REMOTE_ADDR'];

$filename = "files/exercise2.txt";
$data = ReadFromFile($filename);

$timestamp = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$data[] = $timestamp . " - " . $ip;

SaveToFile($filename, $data);

if(count($data)<4 ) {
    foreach ($data as $item) {
        echo $item . "<br>";
    }
}
?>
</div>

<div class="grid-item">
Övning 3: <h2>Info om filen</h2>
<?php
//Skriv ett PHP-script som räknar antalet ord i en textfil  
//och visar filens storlek och och sedan echo det på webbsidan.

$filename = "files/exercise3.txt";
$data = ReadFromFile($filename);
$wordCount = str_word_count(implode(" ", $data));
$fileSize = filesize($filename);

echo "Antal ord: " . $wordCount . "<br>";
echo "Filstorlek: " . $fileSize . " bytes";
?>
</div>

<div class="grid-item">
Övning 4: <h2>Listan</h2>
<?php
//Skriv ett PHP-script som hämtar innehållet i en textfil och visar det i en HTML-lista (ul, li).

$filename = "files/exercise4.txt";
$data = ReadFromFile($filename);
echo "<ul>";
foreach ($data as $line) {
    echo "<li>" . htmlspecialchars($line) . "</li>";
}
echo "</ul>";
?>
</div>

<div class="grid-item">
Övning 5: <h2>Gästboken</h2>
<?php
//Skapa ett formulär där användare kan skriva sitt namn och meddelande. 
//Alla meddelanden sparas i en textfil och visas på en gästbokssida.

$filename = "files/guestbook.txt";

$entries = ReadFromFile($filename);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = isset($_POST['name']) ? $_POST['name'] : 'Anonym';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    $timestamp = date('Y-m-d H:i:s');

    $entry = "[$timestamp] $name: $message";

    $entries[] = $entry;

    SaveToFile($filename, $entries);
}
?>

    <form method="POST">
        <label for="name">Ditt namn:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="message">Meddelande:</label><br>
        <textarea name="message" id="message" rows="4" required></textarea><br><br>

        <button type="submit">Posta inlägg</button>
    </form>

    <h3>Gästboksinlägg:</h3>
    <ul>
    <?php

    if (!empty($entries)) {
        foreach ($entries as $entry) {
            echo "<li>" . htmlspecialchars($entry) . "</li><br>";
        }
    } else {
        echo "<li>Inga inlägg än.</li>";
    }
    ?>
    </ul>
</div>

<div class="grid-item">
Övning 6: <h2>Array vs. File</h2>

<?php

$filename = "files/exercise6.json";
$data = ReadFromFileJSON($filename);
//Skapa ett PHP-script skriver ut följande associativa array till en textfil, 
//Samt sedan läser tillbaka det till en array, med samma data och struktur.

$person = [
    "first_name" => "John",
    "last_name" => "Doe",
    "age" => 30,
    "email" => "john.doe@example.com"
];

$data[] = $person;
SaveToFileJSON($filename, $data);

echo "Array har sparats i fil.";
?>
</div>

<div class="grid-item">
Övning 7: <h2>Magic 8th Ball Wisdom</h2>
<?php
//Skapa ett PHP-script som genererar ett slumpmässigt citat från en fil med citat. 
//Citaten sparas i en textfil, och varje gång scriptet körs, returneras ett nytt smart citat.
//Spara i en "counter" längst ner i textfilen hur många gånger programmet har körts
//Lagra en till fil med dåliga citat. 
//Börja använda dessa citat mer och mer när kulan börjar bli trött efter för många körningar.

$filename = "files/exercise7.txt";
$data = ReadFromFile($filename);
$counterFile = 'counter.txt';
$counter = 0;
if(file_exists($counterFile)) {
    $counter = file_get_contents($counterFile);
}

if (count($data) > 0) {
    $quote = $data[array_rand($data)];
    echo "Citat: $quote<br>";
} else {
    echo "Inga citat finns i filen.<br>";
}

$counter++;
SaveToFile($filename, $data);

if ($counter > 5) {
    $badQuotes = ["Detta är ett dåligt citat.", "För mycket visdom kan vara farligt.", "Kasta bort denna kulas visdom."];
    $quote = $badQuotes[array_rand($badQuotes)];
    echo "Dåligt citat: $quote<br>";
}
?>
</div>

<div class="grid-item">
Övning 8: <h2>Kalkylator</h2>

<?php
//Skapa en miniräknare som lagrar alla beräkningar i en fil.
//Miniräknaren ska byggas med GET som method i formuläret
//Plus. minus, gånger och delat med ska finnas.
//Varje gång man trycker på submit så ska historiken visas under miniräknaren

$filename = "files/exercise8.txt";

$calculations = ReadFromFile($filename);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    $result = '';

    switch ($operation) {
        case 'addition':
            $result = $num1 + $num2;
            break;
        case 'subtraction':
            $result = $num1 - $num2;
            break;
        case 'multiplication':
            $result = $num1 * $num2;
            break;
        case 'division':
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $result = 'Fel: Division med noll!';
            }
            break;
        default:
            $result = 'Vänligen välj en giltig operation.';
    }

    $calculations[] = "Tal 1: $num1, Tal 2: $num2, Operation: $operation, Resultat: $result";
    SaveToFile($filename, $calculations);

    echo "<h3>Resultat: $result</h3>";
}
?>

<form method="POST">
    <label for="num1">Tal 1:</label>
    <input type="number" name="num1" id="num1" required><br><br>
    
    <label for="num2">Tal 2:</label>
    <input type="number" name="num2" id="num2" required><br><br>

    <label for="operation">Operation:</label>
    <select name="operation" id="operation" required>
        <option value="addition">Addition</option>
        <option value="subtraction">Subtraktion</option>
        <option value="multiplication">Multiplikation</option>
        <option value="division">Division</option>
    </select><br><br>

    <button type="submit">Beräkna</button>
</form>

<h3>Tidigare beräkningar:</h3>
<ul>
<?php

if (!empty($calculations)) {
    foreach ($calculations as $calculation) {
        echo "<li>" . htmlspecialchars($calculation) . "</li>";
    }
} else {
    echo "<li>Inga tidigare beräkningar.</li>";
}
?>
</ul>
</div>


<div class="grid-item">
Övning 9: <h2>Tamagotchi</h2>
<?php
//Skapa ett PHP-script som simulerar ett virtuellt djur som växer 
//genom att uppdatera en textfil med information om djurets storlek, 
//vikt och ålder varje gång scriptet körs.
//Djuret har en viss ålder och dör sedan. Visa gravsten som bild när djuret har dött.

$filename = "files/exercise9.json";

if (file_exists($filename)) {
    $content = trim(file_get_contents($filename));
    if (!empty($content)) {
        $data = json_decode($content, true);
        if (!is_array($data)) {
            $data = [];
        }
    }
}

$data['age'] = isset($data['age']) ? $data['age'] + 1 : 1;
$data['size'] = $data['age'] > 5 ? 'big' : 'small';
$data['weight'] = $data['age'] > 5 ? 'heavy' : 'light';

if ($data['age'] > 10) {
    echo "Tamagotchi är död. <img style='height:500px;' src='https://content.mycutegraphics.com/graphics/halloween/halloween-tombstone-rip.png' alt='Gravsten'>";
    $data = [];
}

file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

if (!empty($data)) {
    echo "Tamagotchi: Ålder: " . $data['age'] . ", Storlek: " . $data['size'] . ", Vikt: " . $data['weight'];
} else {
    echo "Tamagotchi has died.";
}
?>
</div>

<div class="grid-item">
Övning 10: <h2>Team List</h2>
<?php
//Skapa ett PHP-script som läser in användarnamn från en fil (en rad per användare) 
//och lagrar dem i en array. Sedan ska du lägga till en ny användare till denna 
//lista och skriva tillbaka den uppdaterade listan till filen

$filename = "files/exercise10.txt";
$data = ReadFromFile($filename);

$newUser = "John Doe";
$data[] = $newUser;
SaveToFile($filename, $data);

echo "Uppdaterad användarlista:<br><ul>";
foreach ($data as $user) {
    echo "<li>" . htmlspecialchars($user) . "</li>";
}
echo "</ul>";
?>
</div>

<div class="grid-item">
Övning 11: <h2>Leaderboard</h2>

<?php
//Skapa ett PHP-script som lagrar poäng för flera spelare i en textfil,
// där varje spelares poäng lagras på en separat rad. Sedan ska scriptet 
//läsa dessa poäng och sortera dem i ordning efter högsta poäng.

$filename = "files/exercise11.json";
$data = ReadFromFileJSON($filename);

$player = "John Doe";
$score = rand(0, 100);

$data[] = [
    "player" => $player, 
    "score" => $score
];

SaveToFileJSON($filename, $data);

usort($data, function($a, $b) {
    return $b['score'] - $a['score'];
});

echo "<ul>";
foreach ($data as $entry) {
    echo "<li>" . htmlspecialchars($entry['player']) . ": " . $entry['score'] . "</li>";
}
echo "</ul>";
?>
</div>

<div class="grid-item">
Övning 12: <h2>Blogg</h2>

<?php
//Skapa en blogg där du som användare kan:
// Skriva inlägg via ett formulär.
// Se alla inlägg på en sida.
// Varje inlägg sparas som en separat fil till exempel: "posts/2025-02-06-title.txt)".


$filename = "files/blog_posts.json";

$posts = ReadFromFileJSON($filename) ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['author']) && isset($_POST['content'])) {
       
        $author = $_POST['author'];
        $content = $_POST['content'];
        $timestamp = date('Y-m-d H:i:s'); 

        $posts[] = [
            'author' => $author, 
            'content' => $content, 
            'timestamp' => $timestamp
        ];

        SaveToFileJSON($filename, $posts);
    }
}

?>
<form method="POST">
    <label for="author">Ditt namn:</label>
    <input type="text" name="author" id="author" required>
    <label for="content">Inlägg:</label>
    <textarea name="content" id="content" required></textarea>
    <button type="submit">Posta inlägg</button>
</form>

<h3>Alla inlägg:</h3>
<ul>
<?php

// Visa alla bloggposter om de finns
if (!empty($posts)) {
    foreach ($posts as $post) {
        echo "<li><strong>" . htmlspecialchars($post['author']) . "</strong> - " . htmlspecialchars($post['timestamp']) . "<br>";
        echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p></li><br>";
    }
} else {
    echo "<li>Inga inlägg än.</li>";
}
?>
</ul>

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
$filename = "files/exercise13.json";

$data = ReadFromFileJSON($filename) ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $quantity = $price = "";

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    }

    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $price = $_POST['price'];
    }

    if (!empty($name) && !empty($quantity) && !empty($price)) {
        $data[] = ["name" => $name, "quantity" => $quantity, "price" => $price];
        SaveToFileJSON($filename, $data);
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Produktnamn" required>
    <input type="number" name="quantity" placeholder="Antal" required>
    <input type="number" name="price" placeholder="Pris" required>
    <button type="submit">Lägg till produkt</button>
</form>

<?php
if (!empty($data)) {
    echo "<ul>";
    foreach ($data as $product) {
        echo "<li>" . htmlspecialchars($product['name']) . " - " . $product['quantity'] . " - " . $product['price'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Inga produkter har lagts till än.";
}

?>
</div>

<div class="grid-item">
Övning 14: <h2>Pub quiz</h2>

<h2>Pub quiz</h2>

<?php
//Skapa ett quiz där frågorna och svaren lagras i en JSON-fil (quiz.json).
// Varje fråga har ett eller flera alternativ och ett rätt svar.
// Användaren får poäng för rätt svar och ser sitt resultat i slutet.
// Skapa ett formulär med radioknappar som val av 1, X eller 2 (3-valsfrågor).
$filename = "files/quiz.json";

$data = ReadFromFileJSON($filename);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;

    foreach ($data as $index => $question) {
        if (isset($_POST['question_' . $index]) && $_POST['question_' . $index] == $question['correct_answer']) {
            $score++;
        }
    }

    echo "Your score: $score/" . count($data);
    exit(); 
}
?>

<form method="POST">
    <?php
    if (!empty($data)) {
        foreach ($data as $index => $question) {
            echo "<h4>" . htmlspecialchars($question['question']) . "</h4>";

            foreach ($question['answers'] as $answer) {

                echo "<input type='radio' name='question_" . $index . "' value='" . htmlspecialchars($answer) . "'> " . htmlspecialchars($answer) . "<br>";
            }
        }
    } else {
        echo "No questions available.";
    }
    ?>
    <button type="submit">Submit</button>
</form>

</div>
</div>

</body>
</html>
