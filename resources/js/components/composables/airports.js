import { ref } from 'vue'
import axios from 'axios'
// import { useRouter } from 'vue-router'

export default function useAirports() {

    const airports = ref([])
    const airport = ref([])
    const errors = ref([])
    // const router = useRouter()

    const getAirports = async () => {
        try {
            const response = await axios.get('/api/v1/airports', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            airports.value = response.data.data
            console.log(airports)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const getAirport = async (id) => {
        try {
            const response = await axios.get(`/api/v1/airports/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            airport.value = response.data.data
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const storeAirport = async (data) => {
        try {
            const response = await axios.post(`/api/v1/airports`, data, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            airport.value = response.data.data
            console.log(airport)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const deleteAirport = async (id) => {
        if(confirm("Are you sure you want to delete this record?")){
            await axios.delete(`/api/v1/airports/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    getAirports()
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }

    return {
        airports,
        airport,
        getAirports,
        getAirport,
        storeAirport,
        deleteAirport,
        errors
    }

}
