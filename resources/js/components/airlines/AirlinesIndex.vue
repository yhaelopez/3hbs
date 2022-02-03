<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Airlines</h1>
            </div>
            <div class="col-12 mb-4">
                <router-link :to="{ name: 'airlines.create' }" class="btn btn-success">Create</router-link>
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
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="airline in airlines" :key="airline.id">
                            <th scope="row">{{ airline.id }}</th>
                            <td>{{ airline.attributes.name }}</td>
                            <td>{{ airline.attributes.code }}</td>
                            <td>
                                <router-link :to='{ name: "airlines.show", params: { id: airline.id } }' class="btn btn-success">Show</router-link>
                                <router-link :to='{ name: "airlines.edit", params: { id: airline.id } }' class="btn btn-warning">Edit</router-link>
                                <button @click="deleteAirline(airline.id)" class="btn btn-danger">Delete</button>
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
    import useAirlines from '../composables/airlines'
    import { useRouter } from 'vue-router'
    import { onMounted } from 'vue'

    const { checkAuth } = useAuth()

    export default {
        setup() {
            const router = useRouter()
            const { airlines, getAirlines, deleteAirline } = useAirlines()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getAirlines)

            return {
                airlines,
                deleteAirline
            }
        }
    }
</script>
