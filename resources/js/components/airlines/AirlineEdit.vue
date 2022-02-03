<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="update">
                        <div class="row justify-content-center p-4">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="airline.name" type="text" class="form-control" id="floatingInput">
                                    <label for="floatingInput">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input v-model="airline.code" type="text" class="form-control" id="floatingInput">
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
    export default {
    data(){
        return{
            airline: {
                name: '',
                code: '',
            }
        }
    },
    mounted(){
        this.getAirline()
    },
    methods:{
        update(){
            axios.put(`/api/v1/airlines/${this.$route.params.id}`, this.airline, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                    this.$router.push({name: 'airlines.index'})
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getAirline(){
            axios.get(`/api/v1/airlines/${this.$route.params.id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    // console.log(response.data.data.attributes.name)
                    this.airline.name = response.data.data.attributes.name
                    this.airline.code = response.data.data.attributes.code
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>
