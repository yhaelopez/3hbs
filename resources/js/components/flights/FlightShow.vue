<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="col-12 text-center">
                    <h2>Flight #{{ flight.id }}</h2>
                    <h2><b>Code: </b>{{ flight.attributes.code }}</h2>
                    <h2><b>Type: </b>{{ flight.attributes.type }}</h2>
                    <h2><b>Departure Time: </b>{{ flight.attributes.departure_time }}</h2>
                    <h2><b>Arrival Time: </b>{{ flight.attributes.arrival_time }}</h2>
                    <h2><b>Departure Id: </b>{{ flight.attributes.departure_id }}</h2>
                    <h2><b>Destination Id: </b>{{ flight.attributes.destination_id }}</h2>
                </div>
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
        props: {
            id: {
                required: true,
                type: String
            }
        },

        setup(props) {
            const router = useRouter()
            const { flight, getFlight } = useFlights()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getFlight(props.id))

            return {
                flight
            }
        }
    }
</script>
