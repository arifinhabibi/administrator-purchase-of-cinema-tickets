<template>
    <div>
        <NavbarComponent/>

                
        <main class="content py-4">
            <div class="container">
                <h3 class="my-4">List Film</h3>
                <div class="row">

                    <div class="col-6" v-for="movie in movies" v-bind:key="movie.id">
                        <div class="row d-flex mb-5">
                            <div class="col-3">
                                <div class="card">
                                    <img :src='movie.image' class="card-img-top" style="height: 185px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-body mb-4">
                                    <h4 class="card-title mb-3">{{ movie.name }}</h4>
                                    <div>
                                        <div class="row">
                                            <div class="col text-muted">Studio</div>
                                            <div class="col">{{ movie.studio_name }} <span class="text-muted">({{ movie.studio_capacity }})</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-muted">Genre</div>
                                            <div class="col">{{ movie.genre.name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-muted">Durasi</div>
                                            <div class="col">{{ Math.floor(movie.minutes / 60) }} Jam {{ movie.minutes % 60 }} Menit</div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-muted">Sutradara</div>
                                            <div class="col">{{ movie.director }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <router-link to="/seat-selection" @click="timeSelect('10:00', movie.id)" class="btn btn-light me-3">10:00</router-link>
                                    <router-link to="/seat-selection" @click="timeSelect('13:00', movie.id)" class="btn btn-light me-3">13:00</router-link>
                                    <router-link to="/seat-selection" @click="timeSelect('16:00', movie.id)" class="btn btn-light me-3">16:00</router-link>
                                    <router-link to="/seat-selection" @click="timeSelect('19:00', movie.id)" class="btn btn-light me-3">19:00</router-link>
                                </div>

                            </div>


                        </div>
                    </div>
                     

                </div>

            </div>
        </main>
    </div>
</template>

<script>
    import NavbarComponent from '@/components/NavbarComponent.vue';
import axios from 'axios';
    export default {
        name: "HomeView",
        components: {
            NavbarComponent
        },
        data() {
            return {
                movies: false,
                
            }
        },  
        methods: {
            listMovie(token){
                axios.get(`http://127.0.0.1:8000/api/list-movie?token=${token}`).then(
                    response => {
                        this.movies = response.data
                    }
                )
                    
            },
            timeSelect(time, id){
                this.$router.push({
                    name: 'seatSelection',
                    query:{
                        time: time,
                        id: id,
                    } 
                })
                
            }
        },
        
        mounted() {
            const token = localStorage.getItem('token')
            
            if (token == null) {
                this.$router.push('/login')
            } else {
                this.listMovie(token)
            }
        }
    }
</script>