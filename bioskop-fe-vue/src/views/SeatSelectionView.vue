<template>
    <div>
        <NavbarComponent />

        
        <main class="content py-4">
            <div class="container">
                <p class="text-center text-muted mb-2">
                    {{ movie_name }} ({{ studio_name }})
                </p>
                <h5 class="text-center text-muted mb-4">
                    {{ date }}<span class="mx-3">|</span> {{ time_choose }}
                </h5>

                        <div class="row d-flex justify-content-around mb-4" v-for="alfa in total_seat" v-bind:key="alfa">
                                <div class="col-5 d-flex justify-content-around">
                                <div class="seat" v-for="num in 6" v-bind:key="num">
                                    <input type="checkbox" v-model="seats" :id="alfabet[alfa-1]+num" :value="alfabet[alfa-1]+(num <= 9 ? '0'+num : num)" />
                                    <label :for="alfabet[alfa-1]+num" class="btn btn-dark">{{ alfabet[alfa-1] }}{{ num <= 9 ? '0'+num : num }}</label>
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-around">
                                <div class="seat" v-for="num in 6" v-bind:key="num">
                                    <input type="checkbox" v-model="seats" :id="alfabet[alfa-1]+(num+6)" :value="alfabet[alfa-1]+(num+6 <=9 ? '0'+(num+6) : num+6)" />
                                    <label :for="alfabet[alfa-1]+(num+6)" class="btn btn-dark">{{ alfabet[alfa-1] }}{{ num+6 <=9 ? '0'+(num+6) : num+6  }}</label>
                                </div>
                            </div>
                        </div>
                        
                    <div class="text-center my-5">
                        <router-link class="btn btn-warning" @click="orderSeat()" to="/confirm-order">Selesai memilih</router-link>
                    </div>
            </div>
        </main>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-bottom">
        <div class="container d-flex justify-content-center">
            <span class="text-white">kursi pesanan : {{ seats }}</span>
        </div>
    </nav>
    </div>
</template>

<script>
import NavbarComponent from '@/components/NavbarComponent.vue';
import axios from 'axios';

    export default {
    name: "SeatSelectionView",
    data() {
        return {
            alfabet: ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'],
            id: null,
            movie_name: null,
            studio_name: null,
            date: null,
            time_choose: null,
            studio_capacity: null,
            total_seat: null,
            seats: [],
        }
    },  
    components: { NavbarComponent },
    methods: {
        orderSeat(){
            this.$router.push({
                name: 'confirmOrder',
                query: {
                    order: this.seats,
                    time: this.time_choose,
                    id: this.id
                }
            })
        },
        
    },
    mounted() {
        const token = localStorage.getItem('token')
        
        axios.get(`http://127.0.0.1:8000/api/seat-selection?token=${token}&time=${this.$route.query.time}&id=${this.$route.query.id}`).then(
            response => {
                this.date = response.data.date
                this.time_choose = response.data.time_choose
                this.id = response.data.id
                this.movie_name = response.data.movie_name
                this.studio_name = response.data.studio_name
                this.studio_capacity = response.data.studio_capacity
                this.total_seat = response.data.studio_capacity / 12

                console.log(response.data)
            }
        )

        if (token == null) {
            this.$router.push('/login')
        }


    }
}
</script>