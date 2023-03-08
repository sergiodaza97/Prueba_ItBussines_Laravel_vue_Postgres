// importacion de componente 
const Hotel = ()=> import('./components/hotel/View.vue');
const Create = ()=> import('./components/hotel/Create.vue');

export const routes = [
    {
        name: 'hotel',
        path: '/hotel',
        component: Hotel
    },
    {
        name: 'create',
        path: '/create',
        component: Create
    }
]