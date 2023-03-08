<template>
    <modal
            name="bedroom_type"
            :width="700"
            height="auto"
            :adaptive="true"
            :clickToClose="false"
        >
        <div class="modal-dialog modal-lg div_g" role="document">
                <div class="modal-content" ref="">
                    <div class="modal-header">
                        <h5 class="modal-title title">Acomodacion de habitaciones</h5>
                        <button
                            type="button"
                            slot="top-right"
                            class="close button_close"
                            @click.prevent="$modal.hide('bedroom_type'), close()"
                            aria-label="Close"
                        >
                            <span class="close_x" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto; padding: 25px;">
                        <div class="row">
                            <div class="form-group col-md-12">
                                    <div>
                                        <div v-if="open == 0" class="btn btn-success btn-sm plus_e" @click.prevent="openInput()" >
                                            +
                                        </div>
                                        </br>
                                        <div v-for="(sta,index) in bedroom" :key="index">
                                            <div class="terms">
                                                <input type="text" name="amount" class="input_save" :value="sta.num_bedrooms" readonly>
                                                <input type="text" name="type_room" class="input_save" :value="sta.type_room" readonly>
                                                <input type="text" name="accommodation" class="input_save" :value="sta.accomodation" readonly>
                                                <div class="btn btn-danger btn-sm minus_e" @click.prevent="deleteBedroom(sta.id)">
                                                    -
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="open != 0">
                                            <div class="terms">
                                                <input type="number" name="amount" class="vs_l" id="reason" v-model="amount" placeholder="Cantidad de Habitaciones">
                                                <v-select v-model.trim="type_room" :options="type_bedroom" label="type_room" class="vs_l" placeholder="Tipo de Habitacion"></v-select>
                                                <v-select v-model.trim="accommodation" :options="acomoding" label="acomoding" class="vs_l" placeholder="Acomodacion"></v-select>
                                                <button  class="btn btn-success btn-sm plus_e" @click.prevent="insertBedroom()">
                                                    <span>+</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer f">
                        <button
                            class="btn btn-danger button_c"
                            @click.prevent="$modal.hide('bedroom_type'), close()"
                        >
                            Cerrar
                        </button>
                        <button class="btn btn-primary button_create" @click="acomodingBedroom()">
                            Asignar
                        </button>
                    </div>
                </div>
            </div>
    </modal>
</template>
<script>
export default {
    props: ['type_bedroom', 'acomoding', 'bedroom', 'id_hotel', 'num_r'],
    data(){
        return {
            amount: null,
            type_room: null,
            accommodation: null,
            open: 0,
            count: 0,
            id_index_delete: null,
            sum: 0,
            error: 0
        }

    },
    mounted(){ 
    },

    methods: {
        openInput(){
            this.open = this.open + 1
        },
        insertBedroom(){
            console.log(this.id_hotel)
            var i = 0;
            for (i = 0; i < this.bedroom.length; i++) {
                this.sum = this.bedroom[i].num_bedrooms + this.sum;
                if(this.bedroom[i].type_room == this.type_room && this.bedroom[i].accomodation == this.accommodation){
                    this.error = this.error + 1;
                }
            }
            console.log(this.sum)
            this.count = this.count + 1
            if (this.num_r < this.sum){
                this.$swal({
                        title:  `La suma de la cantidad de habitaciones excede el numero de habitaciones del hotel debe ser menor a `+this.num_r,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }else if (this.error > 0) {
                this.$swal({
                        title:  `No se permite repetir tipo de habitacion y acomodacion`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }else if (this.amount == null || this.amount == "") {
                this.$swal({
                        title:  `Tiene que agregar una cantidad`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            } else if (this.type_room == null || this.type_room == "null") {
                this.$swal({
                        title:  `Tiene que agregar tipo de habitacion`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            } else if (this.accommodation == null || this.accommodation == "") {
                this.$swal({
                        title:  `Tiene que agregar un tipo de acomodacion`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            } else if (this.type_room == 'ESTANDAR' && this.accommodation == 'Triple') {
                this.$swal({
                        title:  `La Habitacion Estandar no cuenta con acomodacion triple`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }else if (this.type_room == 'ESTANDAR' && this.accommodation == 'Quadruple') {
                this.$swal({
                        title:  `La Habitacion Estandar no cuenta con acomodacion Quadruple`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }else if (this.type_room == 'JUNIOR' && this.accommodation == 'Sencilla') {
                this.$swal({
                        title:  `La Habitacion Junior no cuenta con acomodacion triple`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }else if (this.type_room == 'JUNIOR' && this.accommodation == 'Doble') {
                this.$swal({
                        title:  `La Habitacion Junior no cuenta con acomodacion Quadruple`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }else if (this.type_room == 'SUITE' && this.accommodation == 'Sencilla') {
                this.$swal({
                        title:  `La Habitacion Suite no cuenta con acomodacion Quadruple`,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }
            else{
                this.bedroom.push({id: this.count, num_bedrooms: this.amount, type_room: this.type_room, accomodation: this.accommodation })
                this.amount = null
                this.type_room = null
                this.accommodation = null
                this.$swal({
                        title:  `Se agrego tipo y acomodacion de habitacion`,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if(result.isConfirmed){
                            this.error = 0;
                            this.sum = 0;
                        }
                    })
            }
        },
        deleteBedroom(id){
            this.id_index_delete = this.bedroom.findIndex(index => index.id === id)
            this.bedroom.splice(this.id_index_delete,1)
        },
        close(){
            this.amount = null
            this.type_room = null
            this.accommodation = null
            this.open = 0
            this.$emit('closeModal')
        },
        acomodingBedroom(){
            if(this.bedroom.length == 0){
                    this.$swal({
                        icon: "error",
                        text: "No existen datos para guardar",                    
                    })
            }else {
                const data = {
                    id_room: this.id_hotel,
                    bedroom: this.bedroom,
                };
                axios
                    .post("/api/hotel/acomodingBedroom", data).then(resp => {
                        if (resp.data.status) {
                            this.$modal.hide("bedroom_type");
                            this.$emit("closeModal")
                            this.open = 0
                            this.$swal({
                                icon: `${resp.data.response.type}`,
                                text: `${resp.data.response.content}`,
                            })
                        }
                    }).catch((error) => {
                        this.$swal({
                            icon: "error",
                            text: `${resp.data.message.content}`,
                            });
                        });
            }
            this.Modal()
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
    .vs_l{
        width: 220px;
    }
    .terms {
        display: flex;
    }
    .plus_e{
        width: 30px;
        height: 30px;
        transform: translateZ(10px);
        background-color: #0dc70d;
        border-color: white;
    }
    .minus_e{
        width: 30px;
        height: 30px;
        transform: translateZ(10px);
        background-color: red;
        border-color: white;
    }
    .input_save{
        text-align: center;
        border-radius: 7px;
        background-color: #f3f0f0;
    }
    .button_c{
        background-color: red;
        width: 110px;
    }
    .button_create{
        width: 110px;
    }
    .f{
        height: 80px
    }
</style>
