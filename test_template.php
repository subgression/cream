<!DOCTYPE html>
<html lang="en">

<!-- Init Cream PHP -->
<?php require "./src/Cream.class.php"; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RM Plastic Display</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/stylish-portfolio.css" rel="stylesheet">

    <!-- Animate on Scroll CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body id="page-top">

    <!-- Navigation -->
    <a class="menu-toggle rounded" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <!--<a class="js-scroll-trigger" href="#page-top">RM Plastic Display</a>-->
                <img class="img img-fluid" src="img/logo_white.png" />
            </li>
            <hr>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#page-top">Home</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#about">La nostra storia</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#services">Servizi</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#process">Processo</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#portfolio">Portfolio</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#machines">Macchinari</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="#message">Messaggi</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <div class="masthead">

    </div>

    <!-- Container -->
    <div class="header d-flex">
        <div class="container text-center my-auto">
            <!-- <h1 class="mb-5 text-white title" data-aos="fade-in">RM Plastic Display</h1> -->
            <img class="img img-fluid rounded w-50 h-50" src="img/logo_white.png" />
            <!--
      <h3 class="mb-5 text-white subtitle">
        <em>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</em>
      </h3>
      -->

            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="mailto:info@plasticdisplay.it">
                        <i class="far fa-envelope"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" href="tel:+390373965064">
                        <i class="fas fa-phone"></i>
                    </a>
                </li>
            </ul>
            <br>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Scopri di più</a>
        </div>
        <div class="overlay"></div>
    </div>

    <!-- About -->
    <section class="content-section bg-light" id="about">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <img src="./img/extern.jpg" class="img img-fluid rounded" />
                </div>
                <div class="col-lg-4 mx-auto">
                    <!-- <h2>La nostra storia</h2> -->
                    <h2 data-cream-name="storia" data-cream-type="text"> <?php $Cream->Text("storia", "La nostra storia"); ?> </h2>
                    <p class="lead mb-5">Nel 2001, dopo un’esperienza decennale nella lavorazione del Plexiglass, Roberto Marinoni decide di mettersi in proprio, dando vita a RM Plastic Display. </p>
                    <p class="lead mb-5">L’azienda si distingue fin da subito grazie alla grande competenza del titolare, all’attenzione al progetto del cliente e alla puntualità delle consegne. </p>
                    <p class="lead mb-5">Da circa vent’anni RM Plastic Display collabora a diversi importanti progetti, soprattutto per i più rinomati brand nel mercato del lusso, del benessere e dei servizi.</p>
                    <a class="btn btn-dark btn-xl js-scroll-trigger" href="#services">Cosa offriamo</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="content-section bg-primary text-white text-center" id="services">
        <div class="container">
            <div class="content-section-heading">
                <h3 class="text-secondary mb-0">Servizi</h3>
                <h2 class="mb-5">Cosa offriamo</h2>
            </div>
            <div class="row my-auto">
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0" data-aos="fade-in" data-aos-duration="600">
                    <span class="service-icon rounded-circle mx-auto mb-3">
                        <i class="icon-screen-smartphone"></i>
                    </span>
                    <h4>
                        <strong>Taglio Laser</strong>
                    </h4>
                    <!--
          <p class="text-faded mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt error nostrum ut,
            rem qui ex eligendi maiores quaerat! Voluptates sit corporis illum, expedita aut obcaecati similique ratione
            quos libero labore.</p>
          -->
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0" data-aos="fade-in" data-aos-duration="800">
                    <span class="service-icon rounded-circle mx-auto mb-3">
                        <i class="icon-pencil"></i>
                    </span>
                    <h4>
                        <strong>Termoformatura</strong>
                    </h4>
                    <!--
          <p class="text-faded mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt error nostrum ut,
            rem qui ex eligendi maiores quaerat! Voluptates sit corporis illum, expedita aut obcaecati similique ratione
            quos libero labore.</p>
          -->
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-0" data-aos="fade-in" data-aos-duration="1000">
                    <span class="service-icon rounded-circle mx-auto mb-3">
                        <i class="icon-like"></i>
                    </span>
                    <h4>
                        <strong>Incollaggio</strong>
                    </h4>
                    <!--
          <p class="text-faded mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt error nostrum ut,
            rem qui ex eligendi maiores quaerat! Voluptates sit corporis illum, expedita aut obcaecati similique ratione
            quos libero labore.</p>
          -->
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-in" data-aos-duration="1200">
                    <span class="service-icon rounded-circle mx-auto mb-3">
                        <i class="icon-mustache"></i>
                    </span>
                    <h4>
                        <strong>Taglio/Fresatura con Macchine CNC</strong>
                    </h4>
                    <!--
          <p class="text-faded mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt error nostrum ut,
            rem qui ex eligendi maiores quaerat! Voluptates sit corporis illum, expedita aut obcaecati similique ratione
            quos libero labore.</p>
          -->
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-in" data-aos-duration="1200">
                    <span class="service-icon rounded-circle mx-auto mb-3">
                        <i class="icon-mustache"></i>
                    </span>
                    <h4>
                        <strong>Stampa Digitale</strong>
                    </h4>
                    <!--
          <p class="text-faded mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt error nostrum ut,
            rem qui ex eligendi maiores quaerat! Voluptates sit corporis illum, expedita aut obcaecati similique ratione
            quos libero labore.</p>
          -->
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-in" data-aos-duration="1200">
                    <span class="service-icon rounded-circle mx-auto mb-3">
                        <i class="icon-mustache"></i>
                    </span>
                    <h4>
                        <strong>Verniciatura</strong>
                    </h4>
                    <!--
          <p class="text-faded mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt error nostrum ut,
            rem qui ex eligendi maiores quaerat! Voluptates sit corporis illum, expedita aut obcaecati similique ratione
            quos libero labore.</p>
          -->
                </div>
                <div class="container text-center my-2">
                    <a class="btn btn-dark btn-xl js-scroll-trigger mt-5" href="#process">Il nostro processo</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Process -->
    <section class="content-section bg-light" id="process">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="my-2">Processo</h2>
                    <div class="container mx-auto my-2 process-container" data-aos="fade-in" data-aos-duration="1000">
                        <h5> Progettazione </h5>
                        <span class="service-icon-big rounded-circle mx-auto">
                            <i class="far fa-hourglass"></i>
                        </span>
                        <div class="process-text">
                            <p class="my-2">La prima fase di progettazione è estremamente importante. </p>
                            <p class="my-2">Consiste nell’esposizione e nella valutazione del progetto.</p>
                            <p class="my-2"> RM Plastic Display guida il cliente nella scelta dei materiali, dei colori e della struttura con lo scopo di rendere unica l’idea, andando sempre incontro alle sue richieste.</p>
                        </div>
                    </div>
                    <span class="mx-auto" data-aos="fade-in" data-aos-duration="2000">
                        <i class="fas fa-arrow-down arrow-icon"></i>
                    </span>
                    <div class="container mx-auto my-2 process-container" data-aos="fade-in" data-aos-duration="1000">
                        <h5> Prototipo </h5>
                        <span class="service-icon-big rounded-circle mx-auto">
                            <i class="fas fa-hammer"></i>
                        </span>
                        <div class="process-text">
                            <p class="my-2">Dopo un’attenta analisi, viene creato il prototipo corrispondente al progetto. </p>
                            <p class="my-2">Assieme al cliente si decide se rivalutarlo ed attuare eventuali modifiche o se portarlo alla fase ultima del processo, ovvero la produzione. </p>
                        </div>
                    </div>
                    <span class="mx-auto" data-aos="fade-in" data-aos-duration="2000">
                        <i class="fas fa-arrow-down arrow-icon"></i>
                    </span>
                    <div class="container mx-auto my-2 process-container" data-aos="fade-in" data-aos-duration="1000">
                        <h5> Produzione </h5>
                        <span class="service-icon-big rounded-circle mx-auto">
                            <i class="fas fa-bread-slice"></i>
                        </span>
                        <div class="process-text">
                            <p class="my-2">Quest’ultima fase è quella decisiva.</p>
                            <p class="my-2">Se il prototipo risulta soddisfacente e in linea con l’idea del cliente, viene prodotto nelle modalità e nelle quantità accordate.</p>
                        </div>
                    </div>
                    <span class="mx-auto" data-aos="fade-in" data-aos-duration="2000">
                        <i class="fas fa-arrow-down arrow-icon"></i>
                    </span>
                    <div class="container mx-auto my-2 process-container" data-aos="fade-in" data-aos-duration="1000">
                        <h5> Feedback </h5>
                        <span class="service-icon-big rounded-circle mx-auto">
                            <i class="fas fa-bread-slice"></i>
                        </span>
                        <div class="process-text">
                            <p class="my-2">Per RM Plastic Display il feedback del cliente è essenziale.</p>
                            <p class="my-2">Anche dopo la chiusura di un progetto, l’azienda vuole assicurarsi della piena soddisfazione del cliente e coltivare un rapporto di collaborazione continua.</p>
                        </div>
                    </div>
                    <!--
          <hr>
          <p class="lead mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, at. Fugit consectetur
            ipsam nobis dolor harum ratione facilis impedit obcaecati, temporibus, quibusdam quam aperiam, quasi
            molestiae. Molestias voluptatem eveniet fugit.</p>
          -->
                    <a class="btn btn-dark btn-xl js-scroll-trigger" href="#portfolio">Cosa abbiamo creato</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Chi Incolla senza bolle? -->
    <section class="content-section bg-primary text-white" id="glue">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0" data-aos="fade-in">Incollaggio</h3>
                <h2 class="mb-5" data-aos="fade-in">Chi Incolla senza Bolle?</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Lavorando prevalentemente con brand di lusso, per noi è necessario mantenere sempre una qualità
                        eccellente e un requisito fondamentale che permette di non far perdere valore a un materiale
                        visivamente d’impatto come il plexiglass è la precisione e la trasparenza dell’incollaggio.
                        La nostra azienda, grazie alla passione smisurata e la competenza sviluppata negli anni,
                        è specializzata in incollaggi di estrema trasparenza, <strong>senza bolle</strong>, con o senza lampade a
                        raggi UV e realizzabili su prodotti di grandi dimensioni come pedane per vetrine o scaffali
                        interamente trasparenti come su prodotti di piccole dimensioni come cubi, targhe o espositori
                        da banco
                    </p>
                </div>
                <div class="col-lg-4">
                    <img src="./img/bubbles/bubble1.jpg" class="img img-fluid rounded" data-aos="fade-in">
                </div>
                <div class="col-lg-4">
                    <img src="./img/bubbles/bubble2.jpg" class="img img-fluid rounded" data-aos="fade-in">
                </div>
                <div class="col-lg-4">
                    <img src="./img/bubbles/bubble3.jpg" class="img img-fluid rounded" data-aos="fade-in">
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio -->
    <section class="content-section bg-light" id="portfolio">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Prodotti</h3>
                <h2 class="mb-5">Cosa abbiamo creato</h2>
            </div>
            <div class="row no-gutters">
                <?php
                require_once('./src/CreamTopping.class.php');
                //$creamTopping = new CreamTopping('product.html');
                CreamTopping::GetToppingName('product.html');
                ?>
            </div>
        </div>
    </section>

    <!-- Machines -->
    <section class="content-section bg-primary text-white" id="machines">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Le nostre macchine</h3>
                <h2 class="mb-5">Con cosa li creiamo</h2>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/machines/Laser.JPG" alt="First slide">
                        <h4> <strong>Laser</strong></h4>
                        <p>Laser performante per tagli accurati e bordi lucenti</p>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/machines/Pantografo.JPG" alt="Second slide">
                        <h4> <strong>Pantografo</strong></h4>
                        <p>Pantografo a laser per incisioni perfette</p>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/machines/Diamantatrice.JPG" alt="Third slide">
                        <h4> <strong>Diamantatrice</strong></h4>
                        <p>Diamantatrice per rendere il plexiglass lucido e brillante</p>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/machines/Sezionatrice.JPG" alt="Third slide">
                        <h4> <strong>Sezionatrice</strong></h4>
                        <p>Sezionatrice potente per una qualità di taglio precisa e minuziosa</p>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <!--
  <section class="content-section bg-primary text-white">
    <div class="container text-center">
      <h2 class="mb-4">The buttons below are impossible to resist...</h2>
      <a href="#" class="btn btn-xl btn-light mr-4">Click Me!</a>
      <a href="#" class="btn btn-xl btn-dark">Look at Me!</a>
    </div>
  </section>
  -->

    <!-- Contacts -->
    <section class="bg-light content-section" id="message">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Contattaci!</h3>
                <h2 class="mb-5">Chiedici quello che vuoi</h2>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="txtName" class="form-control" placeholder="Nome e Cognome *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="txtEmail" class="form-control" placeholder="Indirizzo Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="txtPhone" class="form-control" placeholder="Numero di telefono *" value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Il tuo messaggio *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <a class="btn btn-dark btn-xl js-scroll-trigger" onclick="console.log('Vava');">Invia!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <section id="map" class="map">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2801.286147732371!2d9.472731851388799!3d45.40356904540501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4781331bb3a9f96b%3A0xc08d6905acb060f6!2sR.M.+Plastic+Display+Srl+Socio+Unico!5e0!3m2!1sen!2sit!4v1563886718190!5m2!1sen!2sit"></iframe>
        <br />
        <small>
            <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2801.286147732371!2d9.472731851388799!3d45.40356904540501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4781331bb3a9f96b%3A0xc08d6905acb060f6!2sR.M.+Plastic+Display+Srl+Socio+Unico!5e0!3m2!1sen!2sit!4v1563886718190!5m2!1sen!2sit"></a>
        </small>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="mailto:info@plasticdisplay.it">
                        <i class="far fa-envelope"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" href="tel:+390373965064">
                        <i class="fas fa-phone"></i>
                    </a>
                </li>
            </ul>
            <p class="text-muted small mb-0">2019 R.M. Plastic Display s.r.l. | P.Iva 13286570158</p>
            <p class="text-muted small mb-0"> Tel: <a href="tel:+390373965064"> +39 0373 965064 </a> | Mail: <a href="mailto:info@plasticdisplay.it"> info@plasticdisplay.it</a></p>
            <p class="text-muted small mb-0">Copyright &copy; <a href="http://www.subgression.com">www.subgression.com</a></p>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/stylish-portfolio.js"></script>

    <!-- Animate on Scroll js -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>