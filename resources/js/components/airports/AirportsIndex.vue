<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <router-link :to="{ name: 'airports.create' }" class="btn btn-success">Create</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">City</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="airport in airports" :key="airport.id">
                            <th scope="row">{{ airport.id }}</th>
                            <td>{{ airport.attributes.name }}</td>
                            <td>{{ airport.attributes.code }}</td>
                            <td>{{ airport.attributes.city }}</td>
                            <td>
                                <router-link :to='{ name: "airports.show", params: { id: airport.id } }' class="btn btn-success">Show</router-link>
                                <router-link :to='{ name: "airports.edit", params: { id: airport.id } }' class="btn btn-warning">Edit</router-link>
                                <button @click="deleteAirport(airport.id)" class="btn btn-danger">Delete</button>
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
    import useAirports from '../composables/airports'
    import { useRouter } from 'vue-router'
    import { onMounted } from 'vue'

    const { checkAuth } = useAuth()

    export default {
        setup() {
            const router = useRouter()
            const { airports, getAirports, deleteAirport } = useAirports()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getAirports)

            return {
                airports,
                deleteAirport
            }
        }
    }
</script>
