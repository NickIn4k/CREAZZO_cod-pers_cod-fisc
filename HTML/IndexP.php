<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Codice Personale</title>
        <link rel="stylesheet" type="text/css" href="../CSS/FormBase.CSS">
    </head>
    <body>
        <header>
            <h1>Calcolo Codice Personale</h1>
            <nav>
                <ul class="navbar">
                    <li class="navbar-el"><a href="https://www.itisrossi.edu.it/">ITIS "A.Rossi"</a></li> 
                    <li class="navbar-el"><a href="IndexF.php">Form Codice Fiscale</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <form id="form" method="post" onsubmit="invio(event)" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- nome + cognome [max 50 char] -->
                <label for="nominativo">Cognome e Nome</label><br>
                <input type="text" name="nominativo" id="nominativo" oninput="controlloNome(this)" maxlength="50" required><br>

                <!-- sesso -->
                <label for="sesso">Sesso</label>
                <input type="radio" name="sesso" value="uomo" id="uomo" required>
                <label for="uomo" class="inline">Uomo</label><br>
                <input type="radio" name="sesso" value="donna" id="donna">
                <label for="donna"class="inline">Donna</label><br>

                <!-- nascita + Codice da file -->
                <button type="button" onclick="caricaFile1()">Seleziona File</button>
                <label for="luogo">Luogo di nascita</label>
                <select name="luogo" id="luogo" disabled></select><br>

                <!-- data di nascita -->
                <label for="nascita">Data di nascita</label><br>
                <input type="date" name="nascita" id="nascita" required>

                <!-- ateneo -->
                <label for="ateneo">Ateneo</label><br>
                <select name="ateneo">
                    <option name="verona" value="verona">Università degli Studi di Verona</option>
                    <option name="venezia" value="venezia">Università “Ca' Foscari” di Venezia</option>
                    <option name="padova" value="padova">Università degli Studi di Padova</option>
                </select>

                <!-- CAP -->
                <label for="nascita">CAP</label><br>
                <input type="text" name="CAP" id="CAP" oninput="controlloCAP(this)" required maxlength="5">
                
                <!-- studente lavoratore -->
                <label for="stud-lav">Studente Lavoratore?</label>
                <input type="checkbox" name="stud-lav" id="stud-lav" value="true" onchange="attivaTextArea()"><br>

                <!-- textarea di descrizione -->
                <textarea maxlength="80" placeholder="Descrizione del lavoro svolto" id="desc" disabled></textarea><br>

                <!-- Invio e reset -->
                <input type="submit">
                <input type="reset">
            </form>

            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    require_once '../Script/php/codeClass.php';
                    
                    // Input dei dati
                    $nominativo = trim($_POST['nominativo']);
                    $nascita = $_POST['nascita'];
                    $parti = explode(' ', $nominativo);
                    
                    if(isset($_POST['stud-lav']))
                        $stud_lav = $_POST['stud-lav'];     //stud-lav si salva a true se esiste
                    else
                        $stud_lav = 'false';

                    // Calcolo del codice fiscale
                    $code = new Code();
                    $codice = $code->codicePersonale($parti[0], $parti[1], $nascita, $stud_lav);
                    echo "<h1>Il tuo Codice Fiscale</h1>";
                    echo "<p style='text-align: center;'>$codice</p>";
                }               
            ?>  
        </main>
        <footer>
            <h2>Credits</h2>
            <p>Nicola Creazzo</p>
            <a href="mailto:10934103@itisrossi.iv.it">Scrivi una mail!</a>
        </footer> 

        <!-- script in fondo per far caricare il body prima -->
        <script src="../Script/js/library.js"></script>
    </body>
</html>