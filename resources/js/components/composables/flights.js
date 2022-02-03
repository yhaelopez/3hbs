import { ref } from 'vue'
import axios from 'axios'
// import { useRouter } from 'vue-router'

export default function useFlights() {

    const flights = ref([])
    const flight = ref([])
    const errors = ref([])
    // const router = useRouter()

    const getFlights = async () => {
        try {
            const response = await axios.get('/api/v1/flights', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            flights.value = response.data.data
            console.log(flights)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const getFlight = async (id) => {
        try {
            const response = await axios.get(`/api/v1/flights/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            flight.value = response.data.data
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const storeFlight = async (data) => {
        try {
            const response = await axios.post(`/api/v1/flights`, data, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            flight.value = response.data.data
            console.log(flight)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const deleteFlight = async (id) => {
        if(confirm("Are you sure you want to delete this record?")){
            await axios.delete(`/api/v1/flights/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    getFlights()
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }

    return {
        flights,
        flight,
        getFlights,
        getFlight,
        storeFlight,
        deleteFlight,
        errors
    }

}
