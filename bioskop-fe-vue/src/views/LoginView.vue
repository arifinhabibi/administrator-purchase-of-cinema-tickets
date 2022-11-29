<template>
    <div>
        <main class="content py-4">
            <div class="container">
                <h1 class="my-5 text-center">Subang Cinema</h1>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Login</h5>
                                    <form @submit.prevent="login">
                                        <input type="hidden" name="_token" value="bR9SKbIwKCemMWDGZAoOp64eTR5zVfqad1bZeuv3">                                <div class="form-group mb-3">
                                        <label for="username" class="mb-2">Username</label>
                                        <input type="text" v-model="username" class="form-control" autofocus>
                                    </div>
                                        <div class="form-group mb-4">
                                            <label for="username" class="mb-2">Password</label>
                                            <input type="password" v-model="password" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-warning">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-bottom">
        <div class="container d-flex justify-content-center">
            <span class="text-white">lks kabupaten subang, build with <a href="https://www.tiktok.com/@arifinhabibi_">arifinhabibi</a></span>
        </div>
    </nav>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "LoginView",
        data() {
            return {
                username: '',
                password: '',
            }
        },  
        methods: {
            async login(){
                try {
                  const response = await axios.post('http://127.0.0.1:8000/api/auth/login', {
                    username: this.username,
                    password: this.password
                  })
                  localStorage.setItem('token', response.data.token)
                  localStorage.setItem('id', response.data.id)
                  localStorage.setItem('username', response.data.username)
                  this.$router.push('/');
                      
                } catch (error) {
                    alert(error.response.data.message)
                }
            }
        },
        mounted() {
            const token = localStorage.getItem('token')

            if (token != null) {
                this.$router.push('/')
            }
        }
    }
</script>