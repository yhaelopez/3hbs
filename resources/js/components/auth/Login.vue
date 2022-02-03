<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <form @submit.prevent="attemptLogIn">
                        <div class="row justify-content-center p-4">
                            <div class="col-12 text-center">
                                <img class="mb-4" src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="form.email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <div class="form-floating">
                                    <input v-model="form.password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                            </div>
                            <div class="col-12 text-center">
                                <p class="mt-5 mb-3 text-muted">&copy; Bootstrap 2022</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import useAuth from '../composables/auth'
    import { reactive } from 'vue'
    import { useRouter } from 'vue-router'

    export default {
        setup() {
            const { checkAuth, errors, logIn } = useAuth()
            const router = useRouter()

            checkAuth().then(res => {
                if(res) {
                    router.push({ name: 'home' })
                }
            })

            const form = reactive({
                'email': '',
                'password': ''
            })


            const attemptLogIn = async () => {

                logIn({ ...form }).then(res => {
                    // redirect
                }).catch(e => {
                    console.log(e);
                });
            }

            return {
                form,
                errors,
                attemptLogIn
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
