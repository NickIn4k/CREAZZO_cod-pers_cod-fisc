<?php
    class Code{
        // regex consonanti
        function estraiConsonanti($str) {
            return preg_replace('/[^BCDFGHJKLMNPQRSTVWXYZ]/i', '', $str);
        }

        // regex vocali
        function estraiVocali($str) {
            return preg_replace('/[^AEIOU]/i', '', $str);
        }

        // estrazione cognome
        function estraiCognome($cognome) {
            // 3 consonanti
            // in caso vocali
            // in caso X
            $cod = $this->estraiConsonanti($cognome) . $this->estraiVocali($cognome) . 'XXX';
            // return 3 char
            return strtoupper(substr($cod, 0, 3));
        }

        // estrazione nome
        function estraiNome($nome) {
            $cons = $this->estraiConsonanti($nome);
            if (strlen($cons) >= 4) {
                // 4 consonanti -> 1,3,4
                $cod = $cons[0] . $cons[2] . $cons[3];
            } else {
                // 3 consonanti
                // in caso vocali
                // in caso X
                $cod = $cons . $this->estraiVocali($nome) . 'XXX';
                // return 3 char
                $cod = substr($cod, 0, 3);
            }
            return strtoupper($cod);
        }

        // estrazione anno (ultime 2 cifre)
        function codiceAnno($data){
            // substr("stringa", inizio, lunghezza)
            return substr($data, 2, 2);
        }

        // estrazione mese
        function codiceMese($data){
            $mesi = array(
                '01' => 'A',
                '02' => 'B',
                '03' => 'C',
                '04' => 'D',
                '05' => 'E',
                '06' => 'H',
                '07' => 'L',
                '08' => 'M',
                '09' => 'P',
                '10' => 'R',
                '11' => 'S',
                '12' => 'T'
            );
            $mese = substr($data, 5, 2); // estrae il mese dalla data
            return $mesi[$mese];
        }

        // estrazione giorno
        function codiceGiorno($data, $sesso){
            $cod = intval(substr($data, 8, 2)); // estrae il giorno dalla data
            if($sesso == 'donna'){
                $cod += 40; // aggiunge 40 se il sesso è donna
            }
            // str_pad(stringa, lunghezzaVoluta, carattere, tipo)
            return str_pad($cod, 2, '0', STR_PAD_LEFT); // ritorna il giorno con due cifre
        }

        function codiceLuogo($luogo){
            $parti = explode(' - ', $luogo);
            return $parti[1]; // ritorna il codice
        }
        
        function ultimaLettera($codice){
            $pari = array(
                '0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4,
                '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
                'A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4,
                'F' => 5, 'G' => 6, 'H' => 7, 'I' => 8, 'J' => 9,
                'K' => 10,'L' => 11,'M' => 12,'N' => 13,'O' => 14,
                'P' => 15,'Q' => 16,'R' => 17,'S' => 18,'T' => 19,
                'U' => 20,'V' => 21,'W' => 22,'X' => 23,'Y' => 24,
                'Z' => 25
            );
            $dispari = array(
                '0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9,
                '5' => 13,'6' => 15,'7' => 17,'8' => 19,'9' => 21,
                'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9,
                'F' => 13,'G' => 15,'H' => 17,'I' => 19,'J' => 21,
                'K' => 2, 'L' => 4, 'M' => 18,'N' => 20,'O' => 11,
                'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12,'T' => 14,
                'U' => 16,'V' => 10,'W' => 22,'X' => 25,'Y' => 24,
                'Z' => 23
            );
            $somma = 0;
            for($i = 0; $i < strlen($codice); $i++){
                if($i % 2 == 0){ // posizione dispari (perchè [0] è la prima posizione)
                    $somma += $dispari[$codice[$i]];
                } else { // posizione pari
                    $somma += $pari[$codice[$i]];
                }
            }
            $resto = $somma % 26;
            // chr: ASCII to char (n+65)
            return chr($resto + 65);
        }

        public function codiceFiscale($cognome, $nome, $data, $sesso, $luogo){
            $codice = '';
            $codice .= $this->estraiCognome($cognome);
            $codice .= $this->estraiNome($nome);
            $codice .= $this->codiceAnno($data);
            $codice .= $this->codiceMese($data);
            $codice .= $this->codiceGiorno($data, $sesso);
            $codice .= $this->codiceLuogo($luogo);
            $codice .= $this->ultimaLettera($codice);
            return $codice;
        }

        public function codicePersonale($cognome, $nome, $data, $stud_lav){
            $codice = '';
            $codice .= $this->estraiCognome($cognome);
            $codice .= $this->estraiNome($nome);
            $codice .= $this->codiceAnno($data);

            if($stud_lav == 'true')
                $codice .= 'L';
            else 
                $codice .= 'S';

            return $codice;
        }
    }
?>