<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Codice Personale</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/FormBase.CSS">
    </head>
    <body>
        <header>
            <h1>Elaborazione Codice Personale</h1>
            <nav>
                <ul class="navbar">
                    <li class="navbar-el"><a href="https://www.itisrossi.edu.it/">ITIS "A.Rossi"</a></li> 
                    <li class="navbar-el"><a href="../../HTML/IndexF.HTML">Form Codice Fiscale</a></li>
                    <li class="navbar-el"><a href="../../HTML/IndexP.HTML">Form Codice Personale</a></li>
                </ul>
            </nav>
        </header>
        <main> 
            <?php
                require_once 'codeClass.php';
                
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
            ?>  
            <h1>Il tuo Codice Fiscale</h1>
            <p style="text-align: center;"><?php echo $codice; ?></p>
        </main>
        <footer>
            <h2>Credits</h2>
            <p>Nicola Creazzo</p>
            <a href="mailto:10934103@itisrossi.iv.it">Scrivi una mail!</a>
        </footer> 
    </body>
</html>