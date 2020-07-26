<template>
<div>
    <Header/>
    <Header_1/>
    <carousel/>
    <compra/>
    <renta/>
    <nosotros/>
    <contacto/>
    <Footer/>
</div>
    
</template>

<script>
/* Import front components home
    Include all components for home*/
import Header from "./Layout/Header.vue";
import Header_1 from "./Layout/Header_1.vue";
import Footer from "./Layout/Footer.vue";

import carousel from "./home/Carousel-section.vue";
import compra from "./home/Compra-section.vue" ;
import renta from "./home/Renta-section.vue";
import nosotros from "./home/Nosotros-section.vue";
import contacto from "./home/Contacto-section.vue";


export default {
    name:"home-app",
    components: {
        carousel,
        compra,
        renta,
        nosotros,
        contacto,
        Header,
        Header_1,
        Footer

    }
}

</script>