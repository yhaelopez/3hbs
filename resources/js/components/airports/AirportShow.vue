<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2><b>Airport #{{ airport.id }}</b></h2>
                <h2><b>Name:</b> {{ airport.attributes.name }}</h2>
                <h2><b>Code:</b> {{ airport.attributes.code }}</h2>
                <h2><b>City:</b> {{ airport.attributes.city }}</h2>
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
        props: {
            id: {
                required: true,
                type: String
            }
        },

        setup(props) {
            const router = useRouter()
            const { airport, getAirport } = useAirports()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getAirport(props.id))

            return {
                airport
            }
        }
    }
</script>
