      <!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="./dashboard.php?main">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Početna</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="ti-pencil-alt menu-icon"></i>
                <span class="menu-title">Moje provjere</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="./dashboard.php?controlsView">Kontrolni</a></li>
                    <li class="nav-item"> <a class="nav-link" href="./dashboard.php?writeningView">Pismeni</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./dashboard.php?classesView">
                <i class="ti-pencil-alt menu-icon"></i>
                <span class="menu-title">Moje odjeljenje</span>
            </a>
        </li>
    </ul>
</nav>