class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
    <style>
    body {
      background-color: cornflowerblue;
    }

    #Main-NavBar{
      box-shadow: 0px 7px 25px 0px rgba(0,0,0,0.75);
      -webkit-box-shadow: 0px 7px 25px 0px rgba(0,0,0,0.75);
      -moz-box-shadow: 0px 7px 25px 0px rgba(0,0,0,0.75);
    }

    .header-buttons {
      margin-left: 28%;
    }

    .header-a {
      background-color: #D68441;
      color: #fff !important;
      border-radius: 5px;
      border-bottom-style: outset;
      border-bottom-color: rgb(180, 114, 64);
    }

    .header-navbar li {
      margin-right: 5px;
    }

    .header-a,
    .header-a2 {
      padding: 16px 14px;
      font-family: 'Open Sans', sans-serif;
      font-size: 14px;
      font-weight: bolder;
    }

    .header-a2:hover {
      background-color: #D68441;
      color: #fff !important;
      border-radius: 5px;
      border-bottom-style: outset;
      border-bottom-color: rgb(180, 114, 64);
    }

    @media (max-width: 992px) {
      .header-buttons {
        margin-left: 0;
      }
      .header-a2, .header-a{
        padding-left: 2% !important;
      }
      .header-a2:hover, .header-a {
        background-color: rgba(0,0,0,.3) !important;
        border-radius: 0;
        border-bottom-style: none;
      }
    }
  </style>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white" id="Main-NavBar">
    <div class="container-fluid" style="padding-bottom: 1%;">
      <a class="navbar-brand" href="#" style="padding-left: 5%;">
        <img src="images/logoTrackerEstatico.png" alt="" style="max-width: 70%;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse header-buttons" id="navbarNavDropdown">
        <ul class="navbar-nav header-navbar">
          <li class="nav-item">
            <a class="nav-link active header-a" aria-current="page" href="./index.html">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle header-a2" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Productos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="./MaxFuel-Monitoreo-de-combustible.html">Max Fuel</a></li>
              <li><a class="dropdown-item" href="./MaxTEMP-Control-de-temperatura.html">Max Temp</a></li>
              <li><a class="dropdown-item" href="./Satelital.html">Max Satelital</a></li>
              <li><a class="dropdown-item" href="./Max100.html">Max100</a></li>
              <li><a class="dropdown-item" href="./MaxGPSSolar.html">Max GPS Solar</a></li>
              <li><a class="dropdown-item" href="./MicroGPS.html">Micro GPS</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link header-a2" href="productos.html">Equipo y Accesorios</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle header-a2" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Productos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="./Geocercas.html">Geocercas</a></li>
              <li><a class="dropdown-item" href="./Monitoreo-de-velocidad.html">Monitoreo de Velocidad</a></li>
              <li><a class="dropdown-item" href="./Mapa-de-rutas.html">Mapa de Rutas</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link header-a2" href="https://www.maxtrackergps.com/rastreo/">LogIn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link header-a2" href="#contactoCorreo">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
      `;
  }
}

customElements.define("header-component", Header);
