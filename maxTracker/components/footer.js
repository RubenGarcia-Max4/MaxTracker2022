class footer extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.innerHTML = `
    <style>
    .footer {
      background: #fff;
      position: relative;
      background-repeat: no-repeat;
      /*background-image: url('images/footer-map.png');*/
      background-size: cover;
    }
    
    .footer .single-widget h2 {
      font-size: 20px;
      margin-bottom: 20px;
      padding-bottom: 15px;
      position: relative;
    }
    
    .footer .single-widget h2::before {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 2px;
      background: #4a89dc;
    }
    
    .footer .footer-top {
      padding: 90px 0;
      background-image: url("./images/map.png");
    }
    
    .footer .logo {
      margin-bottom: 20px;
    }
    
    .footer-about .logo a {
      font-size: 30px;
      color: #333;
      font-weight: 700;
    }
    
    .single-widget.lists ul li {
      width: 100%;
      float: left;
    }
    
    .single-widget ul li {
      line-height: 36px;
    }
    
    .single-widget ul li,
    .single-widget ul li a {
      color: #222538;
      font-weight: 600;
      -webkit-transition: all 0.2s ease;
      -moz-transition: all 0.2s ease;
      transition: all 0.2s ease;
    }
    
    .single-widget ul li:hover,
    .single-widget ul li a:hover {
      color: #4a89dc;
    }
    
    .single-widget ul li i {
      margin-left: 10px;
      margin-right: 10px;
    }
    
    .footer .social {
      text-align: center;
      float: left;
    }
    
    .footer .social li {
      margin-right: 5px;
      display: inline-block;
    }
    
    .footer .social li a {
      display: block;
      line-height: 28px;
      font-size: 15px;
      color: #fff;
      width: 28px;
      height: 28px;
      line-height: 30px;
      text-align: center;
      border-radius: 100%;
      font-size: 15px;
    }
    
    .footer .social li:hover a,
    .footer .social li.active a {
      background: #4a89dc;
    }
    
    .footer .arrow a {
      font-size: 30px;
      position: absolute;
      top: -12px;
      left: 50%;
      color: #fff;
      width: 45px;
      height: 45px;
      line-height: 45px;
      border-radius: 100%;
      margin-left: -21px;
      box-shadow: 0px 0px 4px #fff;
      display: block;
      padding: 0;
    }
    
    .footer .arrow a:hover {
      background: #333;
    }
    
    .footer-about a.elena-btn {
      margin-top: 15px;
      padding: 12px 30px;
    }
    
    .footer-about a.elena-btn:hover {
      color: #fff;
    }
    
    .footer-about .list {
      margin-top: 10px;
    }
    
    .footer-about ul li i {
      width: 28px;
      height: 28px;
      line-height: 28px;
      border: 1px solid #ccc;
      text-align: center;
    }
    
    /* Subscribe */
    
    .footer .subscribe form {
      position: relative;
      margin-top: 20px;
    }
    
    .footer .subscribe form input {
      height: 50px;
      padding: 0 20px;
      border: none;
      width: 100%;
      background: #f3f6fa;
      font-weight: 600;
    }
    
    .footer .subscribe h2 {
      margin-bottom: 15px;
      border: none;
    }
    
    .footer .subscribe form button {
      color: #fff;
      margin-top: 10px;
      cursor: pointer;
    }
    
    .footer .subscribe form button:hover {
      color: #fff;
      background: #2a2d2f;
    }
    
    .footer .subscribe form button i {
      margin-left: 10px;
    }
    
    .office img {
      width: 100%;
    }
    
    .office {
      position: relative;
      display: inline-block;
    }
    
    .office span {
      position: absolute;
      bottom: 0;
      width: 100%;
      background: #333333a1;
      text-align: center;
      color: #fff;
    }
    
    .footer .copyright {
      padding: 15px 0;
      background: #00486b;
    }
    
    .footer .copyright .text {
      color: #eee;
      margin: 0;
      font-size: 15px;
    }
    
    .footer .copyright .text a {
      color: #fff;
    }
    
    .footer .copyright .text a:hover {
      color: #4a89dc;
    }
    
    .footer .copyright span {
      margin: 0px 5px;
    }
    
    .poweredBy p {
      margin-top: 290px;
    }
    
    .poweredBy .fuerte {
      font-weight: bolder;
      color: black;
      opacity: 0.8;
    }
    
    /*====================================
      End Footer CSS
    ======================================*/
    
    /*Ajustes*/
    
    .top-info .phone a {
      color: white;
    }
    
    @media (min-width: 992px) {
      .col-lg-2-grande {
        flex: 0 0 30%;
        max-width: 30%;
      }
      .col-lg-10-grande {
        flex: 0 0 70%;
        max-width: 70%;
      }
    }
    
    .list i {
      color: #a22529;
    }
    
    @media (min-width: 768px) {
    }
    
    </style>
    <footer class="footer" style="bottom: -25px;">
    <!-- Footer Top -->
    <div class="footer-top" id="contacto">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <!-- Single Footer -->
                    <div class="single-widget footer-about">
                        <h2>Nuestra ubicación</h2>
                        <p>Contamos con oficinas en México</p>
                        <ul class="list">
                            <li><i class="fa fa-map-marker"></i>Brasilia 107 Aguascalientes, México. CP 20239.</li>
                            <li><i class="fa fa-headphones"></i><span>Teléfonos:</span> </li>
                            <li><a href="tel:+524499991858">+52 (449) 999.18.58</a></li>
                            <li><a href="tel:+524492574186">+52 (449) 257.41.86</a></li>
                            <li><i class="fa fa-envelope"></i><span>Email:</span> <a href="mailto:contacto@max4technologies.com">contacto@max4technologies.com</a>
                            </li>
                        </ul>
                        <p>y en Estados Unidos.</p>
                        <ul class="list">
                            <li><i class="fa fa-map-marker"></i>105 N 1ST Street Unit 429, San Jose, CA P.C. 95103
                            </li>
                            <li><i class="fa fa-headphones"></i><span>Phone:</span> +1 408 340 1990</li>
                            <li><i class="fa fa-envelope"></i><span>Email:</span> <a href="mailto:marketing@max4technologies.com">contact@konektisms.com</a></li>
                        </ul>
                        <a href="#" onclick="whatsApp()" class="btn btn-naranja click-whatsapp mt-2">Contáctanos</a>

                    </div>
                    <!--/ End Single Footer -->
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <!-- Single Footer -->
                    <div class="single-widget lists">
                        <h2>Enlaces rápidos</h2>
                        <ul class="list">
                            <li><a href="#loQueHacemos"><i class="fa fa-long-arrow-right"></i>Soluciones de Rastreo
                                    Satelital y Telemetría</a></li>
                            <li><a href="#tuFlotillaBajoControl"><i class="fa fa-long-arrow-right"></i>¡Tu flotilla
                                    bajo Control</a></li>
                            <li><a href="#experiencia"><i class="fa fa-long-arrow-right"></i>+15 Experiencia</a>
                            </li>
                            <li><a href="#queEsYComoFunciona"><i class="fa fa-long-arrow-right"></i>¿Qué es y cómo
                                    funciona MaxTracker?</a></li>
                            <li><a href="#casosEstudio"><i class="fa fa-long-arrow-right"></i>Casos de Estudio</a>
                            </li>
                            <li><a href="#colaboradores"><i class="fa fa-long-arrow-right"></i>Nuestros Clientes</a>
                            </li>

                        </ul>
                        <div class="poweredBy">
                            <p>Una empresa de <span class="fuerte">MAX4 TECHNOLOGIES</span></p>
                            <a href="https://max4technologies.com"><img src="images/MicroGPS-imgs/max4logo.png" alt=""></a>
                        </div>
                    </div>
                    <!--/ End Single Footer -->
                </div>

            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <p class="text">&copy; Copyright 2019 Theme.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <!-- Social -->
                    <ul class="social">
                        <li><a href="https://www.facebook.com/MaxTracker" target=_blank><i
                                    class="fab fa-facebook-f"></i></a></li>

                        <li><a href="https://www.linkedin.com/company/max4-technologies" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                    <!--/ End Social -->
                </div>
                <div class="col-lg-4 col-md-4 col-12 aviso">
                    <a href="AvisoPrivacidad.html">Aviso de Privacidad</a>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Copyright -->

</footer>
      `;
    }
}

customElements.define("footer-component", footer);