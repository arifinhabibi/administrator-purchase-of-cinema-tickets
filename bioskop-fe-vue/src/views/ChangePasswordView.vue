<template>
    <div>
        <NavbarComponent />
                
        <main class="content py-4">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4">
                        <div class="card my-4">
                            <div class="card-body">
                                <h5 class="mb-3">Ubah Password</h5>
                                <form @submit.prevent="changePassword">
                                    <div class="form-group mb-3">
                                        <label for="new-password" class="mb-2">New Password</label>
                                        <input
                                            type="password"
                                            v-model="new_password"
                                            class="form-control"
                                            autofocus
                                        />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="new-password-confirmation" class="mb-2"
                                        >New Password Confirmation</label
                                        >
                                        <input
                                            type="password"
                                            v-model="new_password_confirmation"
                                            class="form-control"
                                        />
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        Update Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
    export default {
        name: "ChangePasswordView",
        components: { NavbarComponent },
        data(){
            return {
                new_password: '',
                new_password_confirmation: ''
            }
        },
        methods: {
            changePassword(){
                this.token = localStorage.getItem('token')
                axios.post(`http://127.0.0.1:8000/api/auth/change-password?token=${this.token}`, {
                    new_password: this.new_password,
                    new_password_confirmation: this.new_password_confirmation

                }).then(
                    response => { 
                        alert(response.data.message)
                        this.$router.push('/')
                    }
                ).catch(function (error){
                    alert(error.response.data.message)
                    location.reload()
                })

            }


        },
        mounted(){
            const token = localStorage.getItem('token')

            if (token == null) {
                this.$router.push('/login')
            }
        }
    }
</script>