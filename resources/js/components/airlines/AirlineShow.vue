<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2><b>Airline #{{ airline.id }}</b></h2>
                <h2><b>Name:</b> {{ airline.attributes.name }}</h2>
                <h2><b>Code:</b> {{ airline.attributes.code }}</h2>
            </div>
        </div>
    </div>
</template>

<script>
    import useAuth from '../composables/auth'
    import useAirports from '../composables/airlines'
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
            const { airline, getAirline } = useAirports()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getAirline(props.id))

            return {
                airline
            }
        }
    }
</script>
