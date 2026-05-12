<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>ZDOBYWCY GÓR</title>
</head>
<body>
    <header>
        <h1>Klub zdobywców gór polskich</h1>
    </header>

    <nav>
        <a href="kwerenda1.png">kwerenda1</a>
        <a href="kwerenda2.png">kwerenda2</a>
        <a href="kwerenda3.png">kwerenda3</a>
        <a href="kwerenda4.png">kwerenda4</a> 
    </nav>

    <aside class="lewy">
        <img src="logo.png" alt="logo zdobywcy">
        <h3>razem z nami:</h3>
        <ul>
            <li>wyjazdy</li>
            <li>szkolenia</li>
            <li>rekreacja</li>
            <li>wypoczynek</li>
            <li>wyzwania</li>
        </ul>
    </aside>

    <aside class="prawy">
        <h2>Dołącz do naszego zespołu!</h2>

        <p>Wpisz swoje dane do formularza:</p>

        <form method="POST" action="zdobywcy.php">
            <label for="nazwisko">Nazwisko: </label> 
            <input type="text" name="nazwisko" id="nazwisko"><br>
            
            <label for="imie">Imię: </label> 
            <input type="text" name="imie" id="imie"><br>

            <label for="funkcja">Funkcja: </label>
            <select name="funkcja" id="funkcja">
                <option value="1">uczestnik</option>
                <option value="2">przewodnik</option>
                <option value="3">zaopatrzeniowiec</option>
                <option value="4">organizator</option>
                <option value="5">ratownik</option> 
            </select><br>

            <label for="email">Email: </label> 
            <input type="email" name="email" id="email"><br>

            <button type="submit">Dodaj</button> 
        </form>

        <hr>

        <?php 
$conn = mysqli_connect("localhost", "root", "", "gory");

if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

if (!empty($_POST['nazwisko']) && !empty($_POST['imie'])) {
    $nazwisko = $_POST['nazwisko'];
    $imie = $_POST['imie'];
    $email = $_POST['email'];
    
    $funkcje = [
        "1" => "uczestnik",
        "2" => "przewodnik",
        "3" => "zaopatrzeniowiec",
        "4" => "organizator",
        "5" => "ratownik"
    ];
    $funkcja_tekst = $funkcje[$_POST['funkcja']];

    $insert_sql = "INSERT INTO osoby (nazwisko, imie, funkcja, email) 
                   VALUES ('$nazwisko', '$imie', '$funkcja_tekst', '$email')";
    
    mysqli_query($conn, $insert_sql);
}

$sql = "SELECT nazwisko, imie, funkcja, email FROM osoby"; 
$result = mysqli_query($conn, $sql); 

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Nazwisko</th>
            <th>Imię</th>
            <th>Funkcja</th>
            <th>Email</th>
          </tr>"; 

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['nazwisko'] . "</td>";
        echo "<td>" . $row['imie'] . "</td>";
        echo "<td>" . $row['funkcja'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>"; 
}

mysqli_close($conn);
?>
    </aside>

    <footer>
        <p>Stronę wykonał: Jakub Szeliga 12.05.2026</p>
    </footer>  
</body>
</html>