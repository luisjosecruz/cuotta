<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <title>Cuotta | Ecuenta Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?=$URLSERVER?>assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=$URLSERVER?>assets/css/home.css">
</head>
<body>
    <main>
        <article class="luismartbox">
            <button id="logout">Salir</button>
            <section class="luismartbox-body">
                <div class="luismartbox-img">
                    <img src="<?=$URLSERVER?>assets/images/home.svg" alt="">
                </div>
                <div class="luismartbox-box">
                    <section class="luismartbox-header">
                        <svg id="img_ppal_frm" data-name="logo-tt-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                            <path d="M392.08,347.89a44.56,44.56,0,0,1-44.43,44.44H52.35A44.56,44.56,0,0,1,7.92,347.89V52.59A44.55,44.55,0,0,1,52.35,8.17h295.3a44.55,44.55,0,0,1,44.43,44.42Z" class="bkg-svg_img_ppal_frm"></path>
                            <path d="M100.06,226.36c0-12.65-.13-22.82.07-33,.06-3.33-1-4.31-4.27-4.19-5.82.23-11.66.13-17.5.05-10.72-.16-18-6.57-19.33-17.09a48.8,48.8,0,0,1,3.86-26.76c1.27-2.83,2.82-4,6-3.95,9,.2,18-.06,27,.14,3.31.07,4.27-1.07,4.23-4.3-.15-13.33.06-26.67-.15-40,0-3.41.81-5,4.29-5.77a102.5,102.5,0,0,1,32.27-2.07c17.61,1.61,24.83,10,25.14,28.39.11,6.5.17,13,0,19.5-.11,3.33,1.13,4.27,4.34,4.24,12.83-.14,25.66.07,38.49-.14,3.56-.06,5.34,1.11,6.75,4.36a49.38,49.38,0,0,1,3.67,26.32c-1.36,10.6-8.52,17-19.29,17.12-9.83.11-19.67.17-29.5,0-3.55-.08-4.5,1.1-4.47,4.54.16,16,.46,32,0,48-.45,14.23,7.08,18.49,18.62,19.51a62.9,62.9,0,0,0,22.26-2.15c2.47-.68,3.9-.37,5.47,1.69,12.31,16.1,5.7,39.8-13.65,45.77a93.18,93.18,0,0,1-64-2.76c-18.38-7.49-26.76-22.5-29.3-41.47C99.23,249.53,100.56,236.69,100.06,226.36Z" class="tt1-svg_img_ppal_frm"></path>
                            <path d="M212.16,189.26c10.9-13.13,10.1-27,5.65-41.21-2-6.38-2.29-6.52,4.05-6.45,3.59,0,4-1.58,4-4.54-.11-13.5-.05-27,0-40.49,0-1.94-.45-3.93,2.46-4.59,13.61-3,27.31-4.57,41-1,12.25,3.16,17.18,9.55,17.62,22.17.28,8,.29,16,.09,24-.09,3.54,1.13,4.54,4.57,4.5,13-.17,26,.06,39-.16,3.43-.06,5,1.18,6.26,4.21,3.93,9.31,5.47,18.84,3.24,28.76-2,9.11-8.84,14.69-18.16,14.83-10,.15-20,.24-30-.07-4.11-.12-5,1.29-4.92,5.1.2,15.83.08,31.66.09,47.49,0,13,5.61,18.79,18.74,19.53a68.78,68.78,0,0,0,22.73-2.36c2.41-.68,3.62-.1,5,1.73,12.56,16.69,5.68,40.38-14.31,46.23a94.48,94.48,0,0,1-62.2-2.62c-18-7.05-27.33-21.09-30-39.77-2.37-16.4-.82-32.93-1.16-49.4-.15-7.16-.22-14.34.05-21.49.14-3.63-1.19-4.68-4.58-4.38C218.53,189.45,215.7,189.26,212.16,189.26Z" class="tt2-svg_img_ppal_frm"></path>
                            <path d="M199.6,392c-48.65,0-97.31-.33-146,.16-20.42.2-41-13.37-45.33-37.36A32.09,32.09,0,0,1,8,349.35Q8,199.89,8,50.41C8,30.81,24.74,11.66,44.2,8.81a96.61,96.61,0,0,1,13.91-1q143.73.06,287.44,0c21.92,0,39.17,12.83,44.81,33.25A44,44,0,0,1,392,52.89q0,147.23,0,294.44A44.14,44.14,0,0,1,347.57,392Q273.59,392.12,199.6,392ZM337,379c20.69.07,41.76-17.37,41.83-42q.34-136.71.06-273.4a42.87,42.87,0,0,0-42.59-42.51q-136.44-.06-272.9,0A42.72,42.72,0,0,0,21,63.94c0,90.3.25,180.6-.16,270.9C20.68,359.49,41,379.5,65.13,379.12c44.81-.69,89.63-.2,134.45-.2C245.4,378.92,291.22,378.82,337,379ZM335.3,375c19.68.18,39.59-15.51,39.63-39.21q.27-135.72-.06-271.44c-.08-22.67-16.93-39.2-39.17-39.29q-135.72-.59-271.44,0c-24.42.1-39.38,19.76-39.35,39.63Q25,200.41,25,336.13a38.61,38.61,0,0,0,38.9,38.78h136C245,374.91,290.15,374.64,335.3,375ZM94.66,229.54c0-10-.15-20,.08-30,.08-3.57-1.1-4.71-4.56-4.44s-6.66.07-10,.06c-15.87-.07-25.27-8.45-26.92-24.16-1.18-11.29,1.55-21.77,6.74-31.76,1.2-2.32,2.8-2.85,5.19-2.82,8.33.11,16.67-.11,25,.12,3.45.09,4.59-.91,4.54-4.47-.2-13,0-26-.14-39,0-3.15.72-4.66,4.08-5.46,15.21-3.62,30.46-5.71,45.91-1.79,14.7,3.72,21.53,12.16,22.26,27.38.3,6.32.27,12.67.09,19-.08,3.1.58,4.36,4.05,4.35,15.15,0,30.31-1.08,45.46-.05,3.19.22,3.9-1.09,3.87-4-.13-13.17,0-26.33-.12-39.5,0-3.25.91-4.55,4.2-5.35,13.71-3.37,27.46-5,41.53-2.8,17.53,2.79,25.56,11.45,26.76,29.37a119,119,0,0,1,.1,17c-.35,4.65,1.39,5.48,5.61,5.38,11.83-.28,23.67,0,35.49-.18,3.37-.07,5.05,1.11,6.46,4.05,5.12,10.73,7.78,21.76,5.53,33.87A25.8,25.8,0,0,1,321,195.13c-7.93.18-15.87.12-23.81,0-3-.05-4.45.4-4.4,4,.21,15.33.05,30.66.11,46,0,5.82,2,8.52,7.83,9.92,9.63,2.29,19.22,1.28,28.52-1.77,3.25-1.06,4.83-.43,7,2.15,17,20,9.47,52.65-20.21,58.63-19.29,3.89-38.42,3.51-57.13-2.78-23.66-7.95-35.46-25.4-37.84-49.59-2-20.26-.63-40.62-.72-60.94,0-4.74-1.45-5.76-5.88-5.67-14.31.27-28.63.24-42.94,0-3.82-.06-4.72,1.07-4.66,4.77.22,14.33.07,28.66.09,43,0,8.87,3.16,12.37,12.12,13.07,8.35.66,16.7.3,24.61-2.71,3.89-1.47,5.54.27,7.9,3.66,17.23,24.71,7.13,50.76-22.26,57.32a101.77,101.77,0,0,1-58.2-3.64c-23.54-8.68-34.17-27-36-51-.74-9.93-.12-20-.12-30Z" class="body-svg_img_ppal_frm"></path>
                        </svg>
                        <h1>
                            Estados de cuenta <br>
                            <p>Bienvenido nuevamente</p>
                        </h1>
                    </section>
                    <section class="luismartbox-menu">
                        <ul>
                            <li><a target="_blank" href="<?=$URLSERVER?>printv3">Estados de cuenta <span>v.3.0</span></a></li>
                            <li><a target="_blank" href="<?=$URLSERVER?>printv2">Estados de cuenta <span>v.2.0</span></a></li>
                            <li><a target="_blank" href="<?=$URLSERVER?>printv1">Estados de cuenta <span>v.1.0</span></a></li>
                            <li><a target="_blank" href="<?=$URLSERVER?>barcode">Generación de código de barras</a></li>
                            <li><a target="_blank" href="<?=$URLSERVER?>mandamientos">Estados de cuenta por mandamientos</a></li>
                        </ul>   
                    </section>
                </div>
            </section>
        </article>
    </main>
    <script src="<?=$URLSERVER?>assets/scripts/jquery-3.6.0.min.js"></script>
    <script src="<?=$URLSERVER?>assets/scripts/login.js"></script>
</body>
</html>






