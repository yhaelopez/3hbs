<template>
    <h1>You are logged in!</h1>
</template>

<script>
    import useAuth from '../composables/auth'
    import { useRouter } from 'vue-router'

    const { checkAuth } = useAuth()

    export default {
        setup() {
            const router = useRouter()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
