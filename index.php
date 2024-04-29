<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <title>Builder Project</title>
    <script src="scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        window.addEventListener('wheel', function(e) {
             var scrollPosition = window.scrollY;

             var deltaY = e.deltaY;

             window.scrollTo({
                top: scrollPosition + window.innerHeight* (deltaY > 0 ? 1 : -1),
                behavior: 'smooth' 
            });

             e.preventDefault();
        },{passive:false});
    </script>
</head>

<body>
    <div class="navbar">
        <div class="logo"  onClick="scrollToSection('about')">
            <img src="house_icon.svg">
            <span>WILLIHAUS</span>
        </div>
        <div class="menu-item">
            <span onClick="scrollToSection('realizations')">Realizacje</span>
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
        <div class="box">Coś o firmie jaka jest fajna etc</div>
        <div class="box">Opis co robimy etc</div>
        <div class="box">jakiś obrazek </div>
    </div>
    <div class="container-2" id="realizations">
        <div>3 przykładowe realizacje w wierszu i guzik więcej</div>
    </div>
    <div class="container-3" id="contact">
        <div class="small-box">
            <p>"WILLIHAUS" SPÓŁKA Z OGRANICZONĄ ODPOWIEDZIALNOŚCIĄ</p>
            <p>Tarnowskie Góry</p>
            <p>ul. Towarowa 1 nr lokalu 308</p>
            <p>42-600 Tarnowskie Góry</p>
        </div>
        <div class="small-box">
            <p>
                <span>Firma budowlana WILLIHAUS powstała w 2019 z połączenia ambicji, zrozumienia potrzeb rynkowych oraz odpowiedzi na indywidualne zapotrzebowania.</span><br>
                <span>Złożona jest z dynamicznego zespółu doświadczonych fachowców, którzy dostarczają wysokiej jakości usługi budowlane dla naszych klientów.</span><br>
                <span>Z pasją i zaangażowaniem realizujemy różnorodne projekty, od nowych budów po modernizacje istniejących obiektów.</span><br>
                <span>Nasze indywidualne podejście oraz skoncentrowana uwaga na potrzebach klienta sprawiają, że każdy projekt jest dla nas wyjątkowy.</span><br>
                <span>Zaufaj nam, a wspólnie stworzymy budynki, które spełnią Twoje najwyższe oczekiwania.</span><br>
            </p>
        </div>
    </div>
</body>

</html>