// importacion de componente 
const Hotel = ()=> import('./components/hotel/View.vue');


//rutas a nivel general con su respectiva ruta
export const routes = [
    {
        name: 'hotel',
        path: '/hotel',
        component: Hotel
    }
]