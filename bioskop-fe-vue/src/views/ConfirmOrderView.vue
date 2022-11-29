<template>
    <div>
        <NavbarComponent />
        
        <main class="content py-4">
            <div class="container">

                <h3 class="my-4">Konfirmasi Pemesanan</h3>

                <div class="alert alert-danger" role="alert" v-if="cashIsLess == true">
                    Uang pembayaran yang anda masukan kurang
                </div>
 
                
        <form>
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6">Film</div>
                <div class="col text-start">{{ film_name }}</div>
            </div>
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6">Waktu</div>
                <div class="col text-start">{{ time }}</div>
            </div>
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6">Tempat Duduk</div>
                <div class="col text-start" v-for="seat in seats" v-bind:key="seat">{{ seat }}</div>
            </div>
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6">Studio</div>
                <div class="col text-start">{{ studio }}</div>
            </div>
            <hr style="max-width: 400px" />
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6 text-start">Harga Tiket</div>
                <div class="col text-start">Rp 50.000 x {{ total_ticket }}</div>
            </div>
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6 text-start">Biaya Layanan</div>
                <div class="col text-start">Rp 2.000 x {{ total_ticket }}</div>
            </div>
            <hr style="max-width: 400px" />
            <div class="row py-1" style="max-width: 400px">
                <div class="col-6 text-start"><b>Total Bayar</b></div>
                <div class="col text-start"><b>Rp {{ total_payment }}</b></div>
            </div>
            <hr style="max-width: 400px" />
            <div class="row py-1 d-flex align-items-center" style="max-width: 400px">
                <div class="col-6 text-start"><b>Jumlah Uang</b></div>
                <div class="col text-start">
                    <input type="number" v-model="cash" class="form-control" autofocus />
                </div>
            </div>

            <button type="submit" @click="order()" class="btn btn-warning my-5">Buat Pesanan</button>
        </form>
    </div>
</main>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-bottom">
        <div class="container d-flex justify-content-center">
            <span class="text-white">lks kabupaten subang 2022, build with <a href="https://www.tiktok.com/@arifinhabibi_">arifinhabibi</a></span>
        </div>
    </nav>
 
    </div>
</template>

<script>


    import NavbarComponent from '@/components/NavbarComponent.vue';
    import axios from 'axios';
    import Swal from 'sweetalert2'

    export default {
    name: "ConfirmOrderView",
    components: { NavbarComponent },
    data() {
        return {
            total_ticket: null,
            total_payment: null,
            film_name: null,
            time: null,
            seats: [],
            studio: null,
            cash: null,
            id_user: localStorage.getItem('id'),
            token: localStorage.getItem('token'),
            cashIsLess: false
        }
    },
    methods: {
        order(){
            if (this.cash < this.total_payment) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayan kurang',

                })
            } else {

                axios.post(`http://127.0.0.1:8000/api/seat-selection/order-confirmation?token=${this.token}&movie_id=${this.$route.query.id}`, {
                    total: this.total_payment,
                    cash: this.cash,
                    created_by: this.id_user,
                    time: this.time,
                    orders: this.seats.toString()
                }).then(
                    response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.data.message
                        })
                        this.$router.push({
                            name: 'detailTransaction',
                            query: {
                                id_purchase: response.data.id 
                            }
                        })
                    }
                )
            }
        }
    },
    mounted() {

        const order = this.$route.query.order 
        const time = this.$route.query.time
        const id_movie = this.$route.query.id
        const token = localStorage.getItem('token')

        this.total_ticket = order.length
        const servicespayment = 2000 * order.length
        this.total_payment = 50000 * order.length + servicespayment


        axios.get(`http://127.0.0.1:8000/api/seat-selection?token=${token}&time=${time}&id=${id_movie}`).then(
            response => {
                this.time = response.data.time_choose
                this.film_name = response.data.movie_name
                this.studio = response.data.studio_name
            }
        )

        this.seats = order


        if (token == null) {
            this.$router.push('/login')
        }
    }
}
</script>