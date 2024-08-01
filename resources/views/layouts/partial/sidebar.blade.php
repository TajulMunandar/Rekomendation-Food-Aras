 <!-- Sidebar -->
 <nav class="navbar-vertical navbar">
     <div class="nav-scroller">
         <!-- Brand logo -->
         <a class="navbar-brand d-flex text-decoration-none text-dark" href="{{ route('dashboard') }}">
             <dotlottie-player src="https://lottie.host/918b23bb-1723-4f9d-8b7c-c06cfbdc8598/OzhEfjKMFa.json"
                 background="transparent" speed="1" style="width: 25px; height: 25px;" loop autoplay
                 class="me-2"></dotlottie-player> Colesterol SPK
         </a>
         <!-- Navbar nav -->
         <ul class="navbar-nav flex-column" id="sideNavbar">
             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                     <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
                 </a>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard/aras') ? 'active' : '' }}" href="/dashboard/aras">
                     <i data-feather="tag" class="nav-icon icon-xs me-2">
                     </i>
                     Aras
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard/alternatif') ? 'active' : '' }}"
                     href="/dashboard/alternatif">
                     <i data-feather="tag" class="nav-icon icon-xs me-2">
                     </i>
                     Alternatif
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard/pasien') ? 'active' : '' }}" href="/dashboard/pasien">
                     <i data-feather="users" class="nav-icon icon-xs me-2">
                     </i>
                     Pasien
                 </a>
             </li>

             <!-- Nav item -->
             <li class="nav-item">
                 <div class="navbar-heading">Data Master</div>
             </li>




             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard/kriteria') ? 'active' : '' }}"
                     href="/dashboard/kriteria">
                     <i data-feather="bookmark" class="nav-icon icon-xs me-2">
                     </i>
                     Kriteria
                 </a>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard/aktivitas') ? 'active' : '' }}"
                     href="/dashboard/aktivitas">
                     <i data-feather="activity" class="nav-icon icon-xs me-2">
                     </i>
                     Aktivitas
                 </a>
             </li>

             <!-- Nav item -->
             <li class="nav-item">
                 <a class="nav-link {{ request()->is('dashboard/users') ? 'active' : '' }}" href="/dashboard/users">
                     <i data-feather="user" class="nav-icon icon-xs me-2">
                     </i>
                     Users
                 </a>
             </li>


         </ul>

     </div>
 </nav>
