<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Codice Fiscale</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/FormBase.CSS">
    </head>
    <body>
        <header>
            <h1>Elaborazione Codice Fiscale</h1>
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
                $sesso = $_POST['sesso'];
                $nascita = $_POST['nascita'];
                $luogo = $_POST['luogo'];
                $cap = $_POST['CAP'];
                $parti = explode(' ', $nominativo);

                // Calcolo del codice fiscale
                $code = new Code();
                $codice = $code->codiceFiscale($parti[0], $parti[1], $nascita, $sesso, $luogo);
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