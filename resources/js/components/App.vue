<template>
    <div class="kt-portlet__body div_g">
        <div>
            <div>
                <h3 class="title" style="margin-bottom: 10px;">Hoteles It Business</h3>
            </div>
            <div class="div_new">
                <button class="btn btn-primary button_new" @click="$modal.show('create_hotel')"> Nuevo Hotel </button>
            </div>
        </div>
        <v-server-table class="" ref="hotel" url="/api/hotel/getHotel" :columns="columns" @loaded="loaded" :options="{headings,sortable:[], requestFunction}">
            <template slot="id" slot-scope="props">
                <span>{{props.row.id}}</span>
            </template>
            <template slot="name" slot-scope="props">
                <div>{{props.row.name}}</div>
            </template>
            <template slot="city" slot-scope="props">
                <div style="width: 150px">{{props.row.city}}</div>
            </template>
            <template slot="address" slot-scope="props">
                <span>{{props.row.address}}</span>
            </template>
            <template slot="nit" slot-scope="props">
                <span>{{props.row.nit}}</span>
            </template>
            <template slot="num_room" slot-scope="props">
                <span>{{props.row.num_room}}</span>
            </template>
            <template slot="options" slot-scope="props">
                <button class="btn btn-danger" @click.prevent="deleteHotel(props.row.id)">Eliminar</button>
                <button v-if="open == 0" class="btn btn-primary" @click="date(props.row)"> Acomodacion </button>
                <button v-if="open != 0" class="btn btn-primary" @click="test(props.row), $modal.show('bedroom_type')"> Acomodacion </button>
            </template>
        </v-server-table>
        <create-hotel
        @create="handlerCreate"
        :n_hotel="n_hotel">
        </create-hotel>
        <acomoding-hotel
        @closeModal="closeModal"
        :type_bedroom="type_bedroom"
        :acomoding="acomoding"
        :id_hotel="id_hotel"
        :bedroom="bedroom"
        :num_r="num_r"
        >
        </acomoding-hotel>

    </div>
</template>

<script> 
import CreateHotel from "./hotel/Create.vue";
import AcomodingHotel from "./hotel/Bedrooms.vue";
export default {
    props:{
        //
    },
    components: {
        CreateHotel,
        AcomodingHotel,
    },

    data(){
        return {
            columns: [
                "id",
                "name",
                "city",
                "address",
                "nit",
                "num_room",
                "options"
            ],
            headings: {
                'id': "id",
                'name': "Nombre de Hotel",
                'city': "Ciudad",
                'address': "Direccion",
                'nit': "NIT",
                'num_room': "Numero de habitaciones",
                'options': "Opciones"
            },
            type_bedroom: null,
            acomoding: null,
            id_hotel: null,
            bedroom: null,
            open: 0,
            id_button: null,
            num_r: 0,
            n_hotel: null
        }
    },
    mounted(){
        this.getComplements()
    },
    methods: {
        getComplements(){
            axios.get('/api/hotel/getComplements').then(resp => {
                this.type_bedroom = resp.data[0]
                this.acomoding = resp.data[1]
                this.n_hotel = resp.data[2]
            })
            .catch(error => {
                // loader.hide()
                this.$swal({
                    icon: 'error',
                    text: 'Ha ocurrido un fallo, intenta nuevamente.',
                });
            })
        },
        date(data){
            this.id_hotel = data.id;
            this.bedroom = data.bedroom;
            this.num_r = data.num_room;
            this.$swal({
                title:  `Preparando`,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
            }).then((result) => {
                if(result.isConfirmed){
                    this.open = this.open + 1
                    this.id_button = data.id
                }
            })
        },
        test(data){
            if(data.id != this.id_button){
                this.$swal({
                title:  `No es el mismo hotel que preparaste, prepara de nuevo para asignar la acomodacion`,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.reload()
                }
            })
            }
            this.open = 0;
        },
        loaded(data) {
            if (this.loader != null) {
                this.loader.hide()
            }
        },

        requestFunction(data) {
            
            data = {
                ...data,
                search: data.query,
            };
            return axios.post('/api/hotel/getHotel', data).catch((e) => {
                loader.hide()
            });
        },

        handlerCreate(){
            this.closeModal()    
        },

        refreshPageTable() {
            if (this.$refs.hotel) {
                   this.$refs.hotel.refresh()  
            }
        },
        closeModal() {
            this.refreshPageTable();
            this.data = {};
        },
        deleteHotel(id_hotel){
            this.$swal({
                title:  `¿ Realmente deseas Eliminar este hotel ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI',
                cancelButtonText: 'NO',
            }).then((result) => {
                if(result.isConfirmed){
                    let data = {
                        id: id_hotel
                    }
                    axios.post('/api/hotel/deleteHotel', data).then(resp => {
                        if (resp.data.status) {
                            this.$swal({
                                icon: 'success',
                                text: 'Se elimino el hotel.',
                            });
                            this.refreshPageTable();
                        }
                        })
                        .catch((e) => {
                            loader.hide()
                            this.$swal({
                            icon: "error",
                            text: "Ha ocurrido un error, vuelve a intentarlo."
                        });
                        });
                }else{
                    this.$refs.hotel.refresh()
                }
            })
        }

    }
}
</script>
<style scoped>
    .title{
        padding: 20px 20px 20px 0px;
        font-size: 40px;
        color: #E5D104;
    }
    .button_new{
        padding: 10px 10px 10px 10px;
        background-color: #0dc70d;
        font-size: 16px;
        border-radius: 10px;
        text-align: center;
        width: 150px;
        border-color: white;
        
    }
    .div_new{
        text-align: right;
    }
    .div_g{
        padding: 25px 25px 25px 25px;
    }
</style>