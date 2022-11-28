<template>
    <div>
        <NavbarComponent />

        
<main class="content py-4">
    <div class="container">
        <h3 class="my-4">Riwayat Transaksi</h3>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Film</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Tempat Duduk</th>
                <th>Dibuat Oleh</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="purchase in data_purchases" v-bind:key="purchase.id">
                <td>{{ purchase.movie.name }}</td>
                <td>{{ purchase.date }}</td>
                <td>{{ purchase.time }}</td>
                <td>
                    <div v-for="seats in purchase.seat" v-bind:key="seats.id" class="">
                        {{ seats.seat }}
                    </div>
                </td>
                <td>{{ purchase.created_by.username }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm me-2"
                    >Cetak Tiket</a
                    >
                    <router-link to="/detail-transaction" @click="detail(purchase.id)" class="btn btn-light btn-sm me-2">Detail</router-link>
                    <router-link to="/transaction-history" @click="deleteTransaction(purchase.id)" class="btn btn-light text-danger btn-sm">Hapus</router-link>
                </td>
            </tr>
             
                
            </tbody>
        </table>
    </div>
</main>
    </div>
</template>

<script>
import NavbarComponent from '@/components/NavbarComponent.vue';
import axios from 'axios';

    export default {
    name: "TransactionHistoryView",
    components: { NavbarComponent },
    data(){
        return {
            token: localStorage.getItem('token'),
            data_purchases: []
        }
    },
    methods: {
        getPurchase(){
            axios.get(`http://127.0.0.1:8000/api/transaction-history?token=${this.token}`).then(
            response => {
                console.log(response.data)
                this.data_purchases = response.data.purchase
            }
        )
        },
        detail(id_purchase){
            this.$router.push({
                name: 'detailTransaction',
                query: {
                    id_purchase: id_purchase
                }
            })
        },
        deleteTransaction(id_purchase){
            if (confirm('do you want deleted this data?')) {
                axios.get(`http://127.0.0.1:8000/api/transaction-history/delete?token=${this.token}&id=${id_purchase}`).then(
                    response => {
                        alert(response.data.message)
                        this.getPurchase()
                    }
                )
            }
        }
    },
    mounted(){
        this.getPurchase()


        const token = localStorage.getItem('token')
            
        if (token == null) {
            this.$router.push('/login')
        }
    }
}
</script>