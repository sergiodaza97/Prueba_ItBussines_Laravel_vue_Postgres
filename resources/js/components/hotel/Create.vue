<template>
    <modal
            name="create_hotel"
            :width="700"
            height="auto"
            :adaptive="true"
            :clickToClose="false"
        >
    <div class="modal-dialog modal-lg div_g" role="document">
                <div class="modal-content" ref="">
                    <div class="modal-header">
                        <h5 class="modal-title title">Crear Hotel</h5>
                        <button
                            type="button"
                            slot="top-right"
                            class="close button_close"
                            @click.prevent="$modal.hide('create_hotel')"
                            aria-label="Close"
                        >
                            <span class="close_x" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto; padding: 15px;">
                        <div class="row">
                            <div class="form-group col-6">
                                    <label class="label" for="name">Nombre:</label>
                                    <input type="text" class="form-control" v-model.trim="name" id="name" placeholder="Nombre de Hotel" required>
                                </div>
                                </br>
                                <div class="form-group col-6" >
                                    <label class="label" for="city">Ciudad:</label>
                                    <input type="text" class="form-control" v-model.trim="city" id="city" placeholder="Ciudad" required>
                                </div>
                                </br>
                                <div class="form-group col-12" >
                                    <label class="label" for="address">Direccion:</label>
                                    <input type="text" class="form-control" v-model.trim="address" id="address" placeholder="Direccion Hotel" name="address" required>
                                </div>
                                </br>
                                <div class="form-group col-6">
                                    <label class="label" for="nit">NIT:</label>
                                    <input type="text" class="form-control" v-model.trim="nit" id="nit" placeholder="NIT Hotel" required>
                                </div>
                                </br>
                                <div class="form-group col-6">
                                    <label class="label" for="num_room">Numero de Habitaciones:</label>
                                    <input type="number" class="form-control" v-model.trim="num_room" id="num_room" placeholder="Numero de Habitaciones" required>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-danger button_c"
                            @click.prevent="$modal.hide('create_hotel')"
                        >
                            Cerrar
                        </button>
                        <button class="btn btn-primary button_create" @click="saveHotel()">
                            Crear
                        </button>
                    </div>
                </div>
            </div>
    </modal>
</template>
<script>
export default {
    props: ['n_hotel'],
    data(){
        return {
            name: null,
            city: null,
            address: null,
            nit: null,
            num_room: null,
            sum: 0
        }

    },
    mounted(){ 
    },

    methods: {
        saveHotel(){
            var i = 0;
            for (i = 0; i < this.n_hotel.length; i++) {
                if(this.n_hotel[i].name == this.name && this.n_hotel[i].city == this.city && this.n_hotel[i].address == this.address && this.n_hotel[i].nit == this.nit){
                    this.sum = this.sum + 1;
                }
            }
            if (this.name == "" || this.name == null) {
                this.$swal({
                        title:  `No ha ingresado un nombre de hotel.`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.sum = 0
                        }
                    })
                return
            }
            else if (this.city == "" || this.city == null) {
                this.$swal({
                        title:  `No ha ingresado la ciudad.`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.sum = 0
                        }
                    })
                return
            } else if (this.address == "" || this.address == null) {
                this.$swal({
                        title:  `No ha ingresado una direccion.`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.sum = 0
                        }
                    })
                return
            }else if (this.nit == "" || this.nit == null) {
                this.$swal({
                        title:  `No ha ingresado el nit del hotel.`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.sum = 0
                        }
                    })
                return
            }else if (this.num_room == "" || this.num_room == null) {
                this.$swal({
                        title:  `No ha ingresado el numero de habitaciones.`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.sum = 0
                        }
                    })
                return
            }else if(this.sum > 0){
                this.$swal({
                        title:  `El hotel ya existe`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.sum = 0
                        }
                    })
                return
            }
            let data = {
                name: this.name,
                city: this.city,
                address: this.address,
                nit: this.nit,
                num_room: this.num_room
            }
            axios.post("/api/hotel/saveHotel", data)
            .then(res => {
                if (res.data.status) {
                    this.name = null,
                    this.city = null,
                    this.address = null,
                    this.nit = null,
                    this.num_room = null,
                    this.$modal.hide("create_hotel");
                    this.$emit("create")
                    this.$swal({
                        icon: 'success',
                        text: 'Hotel creado con éxito.',
                    });
                }
            })
            .catch(err => {
                this.$swal({
                    icon: 'error',
                    text: 'Estamos presentado problemas con la api, comunicate con IT.',
                });

                console.log(err);
            })
        },
        
        Modal(){
            this.$emit("closeModal")
            this.data = {}
        }
    }    
}
</script>
<style scoped>
    .div_g{
        padding: 20px
    }
    .title{
        font-size: 25px;
        color: #E5D104;
    }
    .button_close{
        background-color: red;
        width: 35px;
        border-color: white;
        border-radius: 6px;
    }
    .close_x{   
        color: white;
        font-size: 17px;
    }
    .label{
        font-size: 20px;
    }
    .button_c{
        background-color: red;
        width: 110px;
    }
    .button_create{
        width: 110px;
    }
</style>
