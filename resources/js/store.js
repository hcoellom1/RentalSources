let cart = localStorage.getItem('MaquinariaLocal');
let cartCount = localStorage.getItem('MaquinariaCount');
let itemLocalidad = localStorage.getItem('itemLocalidad');
let itemTipoMaquinaria = localStorage.getItem('itemTipoMaquinaria');
let Moneda = 'L.';
let IdFactura = 0;

let store ={
    state: {
        cart:cart ? JSON.parse(cart):[],
        cartCount:cartCount ? parseInt(cartCount):0,
        itemLocalidad:itemLocalidad ? JSON.parse(itemLocalidad):[],
        itemTipoMaquinaria:itemTipoMaquinaria ? JSON.parse(itemTipoMaquinaria):[],
        Moneda:Moneda ? Moneda: 'L.',
        IdFactura:IdFactura ? parseInt(IdFactura):0,
    },
    mutations:{
        addToCart(state,Maquinaria){
            let found = state.cart.indexOf(Maquinaria);            
            if (found>=0){
                return false;
            }else
            {
                state.cart.push(Maquinaria);            
                state.cartCount++;
                this.commit('saveCartLocal');
                return true;   
            }

        }, // Fin añadir al carrito
        
        DeleteLocalStorage(state){
            state.cartCount=0;
            localStorage.removeItem("MaquinariaCount");
            localStorage.removeItem("MaquinariaLocal");
        },

        saveCartLocal(state,Maquinaria){            // notificación de Agregado       
            state.cart.push(Maquinaria);            
            state.cartCount++;
            const parsedMaquinaria =JSON.stringify(state.cart);
            localStorage.setItem("MaquinariaLocal",parsedMaquinaria);
            localStorage.setItem("MaquinariaCount",state.cartCount);  
        },

        removeFromCart(state,MaquinariaDelete){
            let index = state.cart.indexOf(MaquinariaDelete);
           
            if (index>-1){
                let product = state.cart[index];
                state.cartCount=state.cartCount-1;
                
                state.cart.splice(index,1);               
                localStorage.setItem("MaquinariaLocal",JSON.stringify(state.cart));
                localStorage.setItem("MaquinariaCount",state.cartCount);            
            }
        },
        SaveItemlocalidad(state,itemLocalidad){        
            localStorage.setItem("itemLocalidad",itemLocalidad);
        },
        SaveitemTipoMaquinaria(state,itemTipoMaquinaria){
            localStorage.setItem("itemTipoMaquinaria",itemTipoMaquinaria);
        }

    },
    
    actions:{
      

    },
    getters:{
        
    }
}

export default store;