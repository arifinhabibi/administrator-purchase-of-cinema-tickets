<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <router-link class="navbar-brand" to="/">Chandra Cinema</router-link>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">
                            List Film
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/transaction-history">Riwayat Transaksi</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ username }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <router-link class="dropdown-item" to="/change-password">Ubah Password</router-link>
                            <div class="dropdown-divider"></div>
                            <a href="#" @click="logout" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>


<script>
import axios from 'axios'


    export default {
        name: 'NavbarComponent',
        data(){
            return {
                username: localStorage.getItem('username'),
            }
        },
        methods: {
            logout(){
                this.token = localStorage.getItem('token')
                axios.get(`http://127.0.0.1:8000/api/auth/logout?token=${this.token}`).then(
                    response => {
                        localStorage.removeItem('token')
                        this.$router.push('/login')
                        console.log(response)
                    }
                ).catch(
                    error =>{
                        console.log(error)
                    }
                )

            }
        } 
    }
</script>