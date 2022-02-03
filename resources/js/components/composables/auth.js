import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useAuth() {

    const auth = ref([])
    const errors = ref([])
    const router = useRouter()

    const logIn = async (data) => {

        let response = await axios.post('/api/v1/login', data, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })

        if(response.status == 200) {
            auth.value = response.data.token
            localStorage.setItem('token', auth.value)
            await router.push({ name: 'home' })
        } else {
            auth.value = response.data
        }

    }

    const checkAuth = async () => {
        let token = localStorage.getItem('token')
        if(!token) {
            console.log('not logged in!')
            return false;
        }
        return true
    }

    return {
        auth,
        logIn,
        checkAuth,
        errors
    }

}
