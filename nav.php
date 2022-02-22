<nav class="navbar nav-tabs navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img class="img-fluid" style="max-width: 50px" src="img/logo2.png" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                            
                    <a class="nav-link active" href="index.php">
                        <img src="https://img.icons8.com/ios/25/000000/ingredients-list.png"/>
                        Pasar lista
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="alta_alumno.php">
                        <img src="https://img.icons8.com/dotty/25/000000/employee-card.png"/>   
                        Dar de alta
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://img.icons8.com/dotty/25/000000/combo-chart.png"/>    
                        Informes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="informes.php">Por fechas</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Por curso</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Por DNI</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Link</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
