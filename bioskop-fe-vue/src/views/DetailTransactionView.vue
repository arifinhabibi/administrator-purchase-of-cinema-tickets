<template>
    <div>
       <NavbarComponent /> 

       
<main class="content py-4">
    <div class="container">
        <!-- <div class="alert alert-success">Pesanan berhasil dibuat.</div> -->

        <h3 class="my-4">Detail Pemesanan</h3>

        <div class="row py-1" style="max-width: 400px">
            <div class="col-6">Film</div>
            <div class="col text-start">{{ film }}</div>
        </div>
        <div class="row py-1" style="max-width: 400px">
            <div class="col-6">Waktu</div>
            <div class="col text-start">{{ time }}</div>
        </div>
        <div class="row py-1" style="max-width: 400px">
            <div class="col-6">Tempat Duduk</div>
            <div class="col text-start">
                <p v-for="seat in seats" v-bind:key="seat">
                    {{ seat.seat }}
                </p>
            </div>
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
            <div class="col text-start"><b>Rp {{ cash }}</b></div>
        </div>
        <div class="row py-1 d-flex align-items-center" style="max-width: 400px">
            <div class="col-6 text-start"><b>Kembalian</b></div>
            <div class="col text-start"><b>Rp {{ change_money }}</b></div>
        </div>

        <a href="print-tickets.html" class="btn btn-warning my-5 me-3">Cetak Tiket</a>
        <router-link to="/transaction-history" class="btn btn-light my-5">Lihat Riwayat Transaksi</router-link>
    </div>
</main>


    </div>
</template>

<script>
import NavbarComponent from '@/components/NavbarComponent.vue';
import axios from 'axios';
    export default {
    name: "DetailTransactionView",
    components: { NavbarComponent },
    data() {
        return {
            token: localStorage.getItem('token'),
            film: null,
            time: null,
            seats: [],
            studio: null,
            total_ticket: null,
            total_payment: null,
            cash: null,
            change_money: null,
        }
    },
    mounted() {
        const id_purchase = this.$route.query.id_purchase

        axios.get(`http://127.0.0.1:8000/api/detail-transaction?token=${this.token}&id=${id_purchase}`).then(
            response => {
                this.film = response.data.film_name
                this.time = response.data.time
                this.seats = response.data.seat
                this.studio = response.data.studio_name
                this.total_payment = response.data.total
                this.cash = response.data.cash
                this.change_money = response.data.change_money
                this.total_ticket = response.data.seat.length

            }
        )


        const token = localStorage.getItem('token')

        if (token == null) {
            this.$router.push('/login')
        }

    }
}
</script>