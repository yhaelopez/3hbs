<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="createAirline">
                        <div class="row justify-content-center p-4">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="form.name" type="text" class="form-control" id="floatingInput">
                                    <label for="floatingInput">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="form.code" type="text" class="form-control" id="floatingInput">
                                    <label for="floatingInput">Code</label>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
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
    import useAirlines from '../composables/airlines'
    import { useRouter } from 'vue-router'
    import { reactive } from 'vue'


    export default {

        setup() {
            const { checkAuth } = useAuth()
            const form = reactive({
                'name': '',
                'code': '',
            })
            const router = useRouter()
            const { airline, storeAirline } = useAirlines()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            const createAirline = async () => {

                storeAirline({ ...form }).then(res => {
                    router.push({ name: 'airlines.index' })
                }).catch(e => {
                    console.log(e);
                });
            }

            return {
                form,
                airline,
                createAirline
            }
        }
    }
</script>
