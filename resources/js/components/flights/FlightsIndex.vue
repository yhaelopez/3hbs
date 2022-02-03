<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Flights</h1>
            </div>
            <div class="col-12 mb-4">
                <router-link :to="{ name: 'flights.create' }" class="btn btn-success">Create</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Airline id</th>
                            <th scope="col">Code</th>
                            <th scope="col">Type</th>
                            <th scope="col">Departure id</th>
                            <th scope="col">Destination id</th>
                            <th scope="col">Departure time</th>
                            <th scope="col">Arrival time</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="flight in flights" :key="flight.id">
                            <th scope="row">{{ flight.id }}</th>
                            <td>{{ flight.attributes.airline_id }}</td>
                            <td>{{ flight.attributes.code }}</td>
                            <td>{{ flight.attributes.type }}</td>
                            <td>{{ flight.attributes.departure_id }}</td>
                            <td>{{ flight.attributes.destination_id }}</td>
                            <td>{{ flight.attributes.departure_time }}</td>
                            <td>{{ flight.attributes.arrival_time }}</td>
                            <td>
                                <router-link :to='{ name: "flights.show", params: { id: flight.id } }' class="btn btn-success">Show</router-link>
                                <router-link :to='{ name: "flights.edit", params: { id: flight.id } }' class="btn btn-warning">Edit</router-link>
                                <button @click="deleteFlight(flight.id)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import useAuth from '../composables/auth'
    import useFlights from '../composables/flights'
    import { useRouter } from 'vue-router'
    import { onMounted } from 'vue'

    const { checkAuth } = useAuth()

    export default {
        setup() {
            const router = useRouter()
            const { flights, getFlights, deleteFlight } = useFlights()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getFlights)

            return {
                flights,
                deleteFlight
            }
        }
    }
</script>
