<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="create">
                        <div class="row justify-content-center p-4">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" id="code" v-model="flight.code">
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" v-model="flight.type">
                                        <option value="" selected disabled>Select Option</option>
                                        <option>PASSENGER</option>
                                        <option>FREIGHT</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="departure_time">Departure Time</label>
                                    <input type="datetime-local" class="form-control" id="departure_time" v-model="flight.departure_time">
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="arrival_time">Arrival Time</label>
                                    <input type="datetime-local" class="form-control" id="arrival_time" v-model="flight.arrival_time">
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="departure_id">Departure</label>
                                    <select class="form-control" id="departure_id" v-model="flight.departure_id">
                                        <option value="" selected disabled>Select Option</option>
                                        <option v-for="airport in airports" :key="airport.id" :value="airport.id">{{ airport.attributes.name }}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="destination_id">Destination</label>
                                    <select class="form-control" id="destination_id" v-model="flight.destination_id">
                                        <option value="" selected disabled>Select Option</option>
                                        <option v-for="airport in airports" :key="airport.id" :value="airport.id">{{ airport.attributes.name }}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="airline_id">Airlines</label>
                                    <select class="form-control" id="airline_id" v-model="flight.airline_id">
                                        <option value="" selected disabled>Select Option</option>
                                        <option v-for="airline in airlines" :key="airline.id" :value="airline.id">{{ airline.attributes.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

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
            flight: {
                code: '',
                type: '',
                departure_time: '',
                arrival_time: '',
                departure_id: '',
                destination_id: '',
                airline_id: '',
            },
            airports: [],
            airlines: [],
        }
    },
    mounted(){
        this.getAirports()
        this.getAirlines()
    },
    methods:{
        create(){
            axios.post('/api/v1/flights', this.flight, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                     this.$router.push({name: 'flights.index'})
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getAirports(){
            axios.get('/api/v1/airports', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    this.airports = response.data.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getAirlines(){
            axios.get('/api/v1/airlines', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    this.airlines = response.data.data
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>

<style>

</style>
