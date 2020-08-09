<template>
<div id="wrapper">
<ul class="navbar-nav headerRental sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> {{ $auth.user().name }}   </div>
      </a>

      <!-- Divider {{ $auth.user().name }} -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" >
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Maquinaria
      </div>

      <!-- Nav Item - Pages Collapse Menu <i class="fas fa-fw fa-cog"></i> -->
      <li class="nav-item">
      
          <router-link class="nav-link js-scroll-trigger"
               to="Mantenimiento">
                Agregar Maquinaria
               </router-link>
        
      </li>
      <li class="nav-item">
                 <router-link class="nav-link js-scroll-trigger"
               :to="{name:'MyMaquinaria'}">
                Maquinaria Registradas
               </router-link>      
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Solicitudes
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Solicitudes Recibidas</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <li class="nav-item">
        <!-- <a class="nav-link" href="#" @click.prevent="$auth.logout()"> !-->
        <a class="nav-link" href="#" @click="$auth.logout()">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Cerrar Sesión</span></a>
      </li>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
          
      <div id="content">
           <transition>
                <router-view :key="$route.fullPath" class="view two" name="b">
                </router-view>
            </transition>
      
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Rental 2020</span>
          </div>
        </div>
      </footer>
      
       </div>
    </div>
</div>
</template>


<script>

/*
  export default {
    name:'Dashboard',
    methods:{
       logout() {        
          var app = this;
          this.$auth.login();
      }
    }
}

*/

</script>