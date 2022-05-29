<?php
session_start();
$putanja = getcwd();
include "zaglavlje.php";
//declare (strict_types=1);
?>

<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Kreirano: 26. ožujka 2022.">
        <meta name="keywords" content="HTML, CSS, zadaća">
        <meta name="author" content="Andreas Leja">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/aleja.css">
        <title>Početna stranica</title>
    </head>
    <body id="tijelo">
        <header id="zaglavlje">

            <a href="./index.php"><img src="./materijali/foi-logo.jpg" alt="FOI logo" width="80" height="80"></a>
            <a href="#tijelo">

                <div class="naslov">
                    <h1>Početna stranica</h1>
                </div>

            </a>

            <a href="#zaglavlje">
                <img src="./materijali/menu.png" alt="Menu icon" width="60" height="60">
            </a>

        </header>

        <nav>
            <ul>
                <li>
                    <a href="./multimedija.php">
                        Multimedija
                    </a>
                </li>
                <li>
                    <a href="./popis.php">
                        Popis
                    </a>
                </li>
                <li>
                    <a href="./obrasci/obrazac.php">
                        Obrazac
                    </a>
                </li>
                <li>
                    <a href="./obrasci/prijava.php">
                        Prijava
                    </a>
                </li>
                <li>
                    <a href="./obrasci/registracija.php">
                        Registracija
                    </a>
                </li>
                <li>
                    <a href="./era.php#tijelo">
                        ERA
                    </a>
                </li>
                <li>
                    <a href="./navigacijski.php#tijelo">
                        Navigacijski
                    </a>
                </li>
            </ul>
        </nav>

        <main class="glavni">
            <!--<div class="animacija">
                <figure id="slika1">
                    <img  src="http://drive.google.com/uc?export=view&id=1aqK9G7lyHiOE8w74qFl8DuVwnYAtuYzH" alt="INFJ" width="500" height="500">
                    <figcaption>
                        Slika 1.: MBTI
                    </figcaption>
                </figure>

                <figure id="slika2">
                    <img  src="http://drive.google.com/uc?export=view&id=1gWujXmLtpGsAtDG6XFOXYIYDebLebMFS" alt="Enneagram 4w5" width="500" height="500">
                    <figcaption>
                        Slika 2.: Enneagram
                    </figcaption>
                </figure>
                
                <figure id="slika3">
                    <img src="http://drive.google.com/uc?export=view&id=1GcNExErzUv4_3-xzrfRxA4DT6eHPGUWT" alt="Ravenclaw" width="500" height="500">
                    <figcaption>
                        Slika 3.: Hogwarts house
                    </figcaption>
                </figure>
                
                <figure id="slika4">
                    <img src="http://drive.google.com/uc?export=view&id=1uty77QJob6CLxY8WZLc6lxPC5I68FEUP" alt="DISC" width="500" height="500">
                    <figcaption>
                        Slika 4.: DISC
                    </figcaption>
                </figure>
                
            </div>
            <hr>
            <div class="clanci">
                <article>
                    <h3>
                        MBTI
                    </h3>
                    <em>28.03.2022. 16:30</em>
                    <p>
                        MBTI je introspektivni upitnik koji su osmislile majka i kćer Briggs-Myers. Taj upitnik je prvenstveno bio
                        namijenjen ženama kako bi saznale koji bi "muški" posao najbolje mogle obavljati. S obzirom da se uspostavilo
                        da poslovi ipak ne mogu biti vezani za spol, a upitnik je bio relativno precizan, MBTI test je ostao kao jedan
                        od mnogih pokazatelja osobnosti. Ovaj upitnik se također koristi i prilikom zapošljavanja. Poslodavci daju svojim
                        novim potencijalnim radnicima MBTI test kako bi vidjeli kakav stil interakcije s okolinom imaju. MBTI koristi
                        skraćeni tip ispisa osobnosti u obliku četiri slova I/E, S/N, F/T, J/P. Svako od ovih slova opisuje kako se
                        snalazimo u određenim dimenzijama svoje osobnosti. I je za introverte, E je za ekstroverte, S označava senzoriku,
                        mogućnost snalaženja u stvarnom svijetu, N pokazuje mogućnost snalaženja u svijetu ideja i apstraktnog mišljenja.
                        Nadalje, F označava način odlučivanja na temelju osjećaja, T način odlučivanja na temelju razmišljanja, P znači 
                        razinu spontanosti u životu i prikupljanju ideja i informacija, a J označava red i organiziranje ideja i misli.
                    </p>
                    <a href="https://issuu.com/foi.stak/docs/stak22/s/11886498" target="_blank">Poveznica na izvorni članak</a>
                </article>

                <article>
                    <h3>
                        Enneagram
                    </h3>
                    <em>28.03.2022. 16:40</em>
                    <p>
                        Prema knjizi koju su napisali Ian Morgan Cron i Suzanne Stabile, postoji devet tipova osobnosti prema eneagramu.
                        Povijesno se ovaj sustav tipiziranja osobnosti (u nastavku "model osobnosti") koristio u religiozne svrhe pri čemu
                        bi ljudi saznali koja je njihova "svrha postojanja". Osobnosti po ovom modelu su opstale i do dana današnjeg te tako
                        i dalje razlikujemo i dalje devet vrsta osobnosti. Pogledamo li znak eneagrama vidimo da su brojevi poredani na način
                        da uvijek graniče s drugim. Na taj način dobivamo krila, tj. osobnost jednog tipa može imati neke osobine susjednog
                        tipa kojem teži. Također, tipovi osobnosti po eneagramu se mogu podijeliti u trijade (skupine po tri osobnosti).
                        Te trijede se zovu: trijada sržbe (tipovi 8, 9 i 1), trijada osjećaja (tipovi 2, 3 i 4) te tijadu glave (tipovi 5, 6 i 7).
                        Kao posljednju misao koju bismo trebali ponijeti kao pouku članka jest ta da nam je pružen model osobnosti kako bismo 
                        lakše komunicirali i kako bismo se lakše razumjeli te ga ne bismo trebali koristiti na način da validiramo svoje loše
                        ponašanje ili diskriminiramo druge ljude zbog njihovog tipa.
                    </p>
                    <a href="https://issuu.com/foi.stak/docs/stak_24/s/14955169" target="_blank">Poveznica na izvorni članak</a>
                </article>

                <article>
                    <h3>
                        Tko su Ravenclaw učenici?
                    </h3>
                    <em>29.03.2022. 09:17</em>
                    <p>
                        Ravenclaw je jedna o četiri kuće u školi magije i čarobnjaštva Hogwarts. Učenici koje sortirajuća kapa smjesti u ovu kuću
                        dijele zajedničke karakteristike. Jedna od tih karakteristika je i pametna vrsta humora. Također, Ravenclaw su jako intuitivni, 
                        odnosno duboko razumiju kako stvari funkcioniraju. To znači da njihova pamet i mudrost nije naučena ili naštrebana napamet, nego 
                        je primjenjiva u svakodnevnom životu. S ovom karakteristikom najbolje ide i ona brzog razmišljanja. Kada situacija zagusti, oni 
                        znaju što treba brzo poduzezi kako bi se izvukli iz nevolje. Na kraju krajeva, studenti u kući Ravenclaw su individualisti, 
                        neovisni o drugima i o grupi. S obzirom da znaju biti više introvertirani, u suradnji s ostalim karakteristikama koje smo naveli, 
                        mogu dobiti velilke nalete inspiracije što ih čini originalnima i kreativnima. Kao zaključak možemo izvući da su ovi učenisi vrlo 
                        mudri. Inteligencija ima određen limit do kojeg može dosegnuti, ali mudrost koju posjeduju ovi učenici više ide u dubinu i znaju 
                        kako ostati u dobrim odnosima s ostalim kućama.
                    </p>
                    <a href="https://screenrant.com/harry-potter-ravenclaw-best-worst-traits/" target="_blank">Poveznica na izvorni članak</a>
                </article>
            </div>
            <hr>
            <div class="autor">
                <ul>
                    <li>
                        <label>Ime: </label> Andreas
                    </li>
                    <li>
                        <label>Prezime: </label> Leja
                    </li>
                    <li>
                        <label>Broj iksice: </label> 0016141488
                    </li>
                    <li>
                        <label>Email adresa:</label> aleja@foi.hr
                    </li>
                    <li>
                        <label>Slika: </label><br>
                        <img width="160" height="200" src="http://drive.google.com/uc?export=view&id=1N02zeS8_yiC7QlGhna8mcNtap_VTrOz5" alt="Andraes Leja - slika lica">
                    </li>
                    <li>Životopis: <br>
                    Student željan stjecanja novih znanja i vještina u području informacijskih tehnologija. Pun entuzijazma za učenjem i razvojem web tehnologija primjenjivih u praksi.<br>
                    <li style="list-style-type: none;">
                    <ul>
                        <li>Logičko razmišljanje</li>
                        <li>Timski rad</li>
                        <li>Programiranje</li>
                        <li style="list-style-type: none;">
                            <ul>
                                <li>C++, Python, PHP</li>
                            </ul>
                        </li>
                            
                    </ul>
                    <li>
                        Oblikovanje i upravljanje bazama podataka
                    </li>
                    <li>Projekti izrade web aplikacija</li>

                </ul>
            </div> -->

            <?php
            /*
              $broj1 = 1;
              $tekst1 = "Andreas";
              echo $broj1;
              echo "<br>Varijabla ima vrijednost ".$broj1."a";
              echo "<br>".strlen($tekst1);
              $niz = array("OWT", "WebDiP", "UWT", "IWA");
              array_pop($niz);
              foreach($niz as $element){
              if(isset($niz[$i]))
              echo "<br>".$element;
              }



              $nizAsoc = array("OWT" => "Osnove web tehnologija", "WebDiP" => "Web dizajn i programiranje", "PI" => "Programsko inženjerstvo");

              foreach($nizAsoc as $kljuc=>$vrijednost){
              echo "<br>".$kljuc."=>".$vrijednost;
              }



              echo "<br><br><br><br>";
              $index = 0;
              function naziv($recenica, $rijec){
              global $tekst1;
              echo "<div>$tekst1</div>";

              // elseif()
              if(!ctype_upper($recenica[0])){
              echo "Greška!";
              }
              elseif(strpos($recenica, $rijec) < 0){
              echo "Ne postoji rijec u recenici";
              }
              else{
              $index = strpos($recenica, $rijec);
              echo "<br>". substr($recenica, $indeks, strlen($recenica));
              }

              $brojRjeci = str_word_count($recenica);
              $string = (String)$brojRjeci;
              $broj = (Int)$brojRjeci;



              }

              naziv("mala lala je mala", "lala"); */
            // get current working directory
            // superglobalne varijable
            // $GLOBALS, $_SERVER, $_GET, $_COOKIE...

            $tekst = " Skripta:" . $_SERVER['PHP_SELF'];
            $dnevnik = new Dnevnik(); 
            // ako je dnevnik.log na poslužitelju barka, obavezno chmod 777 dnevnik.log
            $putanjaDnevnik = "$putanja/izvorne_datoteke/dnevnik.log";
            $dnevnik->setNazivDatoteke($putanjaDnevnik);
            $dnevnik->spremiDnevnik($tekst);
            
            $niz = $dnevnik->citajDnevnik();
            
            foreach($niz as $k=>$v){
                echo($k." ".$v."<br>");
            }
            
            ?>

        </main>

        <footer>
            <address>
                Godina izrade: 2022<br>
                Izradio: &copy; <a class="poveznica" href="mailto:aleja@foi.hr">Andreas Leja</a><br>
                <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Findex.php">
                    <img src="materijali/HTML5.png" alt="HTM5" height="60" width="60">
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Findex.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="materijali/CSS3.png" alt="HTM5" height="60" width="60">
                </a>
            </address>
        </footer>
    </body>
</html>
