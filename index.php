<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/icon.png">
    <title>WILLIHAUS</title>
    <script src="/scripts/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kamil Giec - Zuucker">
</head>

<body>
    <div class="navbar">
        <div class="logo"  onClick="scrollToSection('about')">
            <img src="house_icon.svg">
            <span>WILLIHAUS</span>
        </div>
        <div class="menu-item">
            <span onClick="scrollToSection('moreRealizations')">Realizacje</span>
         </div>
        <div class="menu-item">
            <span  onClick="scrollToSection('contact')">Kontakt</span>
        </div>
    </div>

    <div class="container-1" id="about">
        <div class="box">
            <div class="gallery">
                <div class="slider">
                    <img src="example_images\image11.png" alt="Image 1" class="preview">
                    <img src="example_images\image12.png" alt="Image 2" class="preview">
                    <img src="example_images\image13.png" alt="Image 3" class="preview">
                </div>
            </div>
            
            <script src="scripts/scrollGallery.js"></script>
        </div>

        <div class="box box-2">
            <span>Firma budowlana WILLIHAUS oferuje kompleksowe wsparcie w tworzeniu wymarzonych domów.</span><br><br>
            <span>Dzięki doświadczeniu i profesjonalizmowi zapewniamy solidną i estetyczną realizację projektów.</span><br><br>
            <span>Nasze indywidualne podejście oraz otwarta komunikacja gwarantują satysfakcję klientów.</span><br><br>
            <span>Zespół specjalistów dba o każdy detal, tworząc domy idealnie dopasowane do potrzeb i stylu życia klientów.</span><br>
            <br><br>
            <span>Z nami wyremontujesz swój wymarzony dom!</span>
         </div>

        <div class="box box-3"> 
            <span class="text-important">Oferowane usługi</span><br><br>
            <span>Wznoszenie Budynków mieszkalnych i niemieszkalnych</span><br><br>
            <span>Rozbiórka i burzenie obiektów budowlanych</span><br><br>
            <span>Wykonywanie instalacji elektrycznych, wodno-kanalizacyjnych, cieplnych, gazowych i klimatyzacyjnych</span><br><br>
            <span>Zakładanie stolarki budowlanej</span><br><br>
            <span>Tynkowanie, malowanie i szklenie oraz inne roboty wykończeniowe.</span><br><br>
            <span>Wykonywanie konstrukcji i pokryć dachowych</span><br><br>
            <span>Oraz innne roboty budowlane dostosowane do potrzeb klienta</span>
        </div>

        <div class="box box-4">
            <img src="/example_images/image12.png">
        </div>
    </div>
    
    <div>
        <span class="text-important" id="moreRealizations">Przykładowe realizacje firmy</span>
    </div>

    <div class="container-2" id="realizations">
        <?php
        require './scripts/utils.php';

        $realizations = readFiles('zapisane/');

        for ($i = 2; $i < 5; $i++) {
            echo realizationComponent($realizations[$i]);
        }
        ?>
    </div>

    <div class="more-realizations">
        <button class="button" onClick="redirectTo('realizacje.php')">Więcej realizacji</button>
    </div>

    <div class="container-3" id="contact">
        <div class="small-box">
            <span class="text-important">Kontakt</span>
            <span>WILLIHAUS spółka z ograniczoną odpowiedzialnością</span>
            <span>ul. Towarowa 1 nr lokalu 308</span>
            <span>42-600 Tarnowskie Góry</span>
            <span>Telefon DODAJ_NUMER</span>
            <span>Zaufaj nam, a wspólnie stworzymy budynki, które spełnią Twoje najwyższe oczekiwania.</span>
        </div>
        <div class="small-box">
            <span class="text-important">O nas</span>
            <span>Firma WILLIHAUS powstała w 2019 z połączenia ambicji, zrozumienia potrzeb rynkowych oraz odpowiedzi na indywidualne zapotrzebowania.</span>
            <span>Złożona jest z dynamicznego zespółu doświadczonych fachowców, którzy dostarczają wysokiej jakości usługi budowlane dla naszych klientów.</span>
            <span>Z pasją i zaangażowaniem realizujemy różnorodne projekty, od nowych budów po modernizacje istniejących obiektów.</span>
            <span>Nasze indywidualne podejście oraz skoncentrowana uwaga na potrzebach klienta sprawiają, że każdy projekt jest dla nas wyjątkowy.</span>
        </div>
    </div>
</body>

</html>