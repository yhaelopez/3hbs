<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="update">
                        <div class="row justify-content-center p-4">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="airport.name" type="text" class="form-control" id="floatingInput">
                                    <label for="floatingInput">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="airport.code" type="text" class="form-control" id="floatingInput">
                                    <label for="floatingInput">Code</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="airport.city" type="text" class="form-control" id="floatingInput">
                                    <label for="floatingInput">City</label>
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
    // import useAuth from '../composables/auth'
    // import useAirports from '../composables/airports'
    // import { useRouter } from 'vue-router'
    // import { reactive } from 'vue'
    // import { onMounted } from 'vue'

    // export default {
    //     props: {
    //         id: {
    //             required: true,
    //             type: String
    //         }
    //     },

    //     setup(props) {
    //         const { checkAuth } = useAuth()
    //         checkAuth().then(res => {
    //             if(!res) {
    //                 router.push({ name: 'login' })
    //             }
    //         })

    //         const router = useRouter()
    //         const { airport, getAirport, updateAirport } = useAirports()
    //         const form = reactive({
    //             'name': '',
    //             'code': '',
    //             'city': '',
    //         })

    //         onMounted(getAirport(props.id))

    //         const editAirport = async () => {

    //             updateAirport({ ...form }).then(res => {
    //                 router.push({ name: 'airports.index' })
    //             }).catch(e => {
    //                 console.log(e);
    //             });

    //         }

    //         console.log('airport', airport.value)

    //         return {
    //             form,
    //             airport,
    //             editAirport
    //         }
    //     }
    // }

    export default {
    data(){
        return{
            airport: {
                name: '',
                code: '',
                city: '',
            }
        }
    },
    mounted(){
        this.getAirport()
    },
    methods:{
        update(){
            axios.put(`/api/v1/airports/${this.$route.params.id}`, this.airport, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                    this.$router.push({name: 'airports.index'})
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getAirport(){
            axios.get(`/api/v1/airports/${this.$route.params.id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    // console.log(response.data.data.attributes.name)
                    this.airport.name = response.data.data.attributes.name
                    this.airport.code = response.data.data.attributes.code
                    this.airport.city = response.data.data.attributes.city
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>
