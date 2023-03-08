require('./bootstrap');

// importacion vue
import vue from 'vue'
window.Vue = vue;

//importacion componente principal
import App from './components/App.vue';

//importacion Axios
import VueAxios from 'vue-axios';
import axios from 'axios';

//importacion de vue-router y configuracion
import VueRouter from 'vue-router';
import {routes} from './route';

import Vue from 'vue';
import { ServerTable } from "vue-tables-2";

//Sweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

//vModal
import VModal from 'vue-js-modal';

//vSelect
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';


//implementacion de importaciones
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(ServerTable,{
    perPage: 15,
    texts: {
        count: "Mostrando del {from} al {to} de {count} Registros|{count} Registros|1 Registro",
        first: "First",
        last: "Last",
        filter: "",
        records:"......",
        filterPlaceholder: "Buscar registro",
        limit: "",
        page: "Page:",
        noResults: "Sin resultados",
        filterBy: "{column}",
        loading: "Cargando...",
        defaultOption: "Todos",
        columns: "Columnas"
    }

})
Vue.use(VueSweetalert2);
Vue.use(VModal);
Vue.component('v-select', vSelect);

//intancia de router
const router = new VueRouter ({
    mode:'history',
    routes: routes
});

//instanciacion app
const app = new Vue ({
    el: '#app',
    router: router,
    render: h => h(App)
});
