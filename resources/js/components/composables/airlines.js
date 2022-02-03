import { ref } from 'vue'
import axios from 'axios'
// import { useRouter } from 'vue-router'

export default function useAirlines() {

    const airlines = ref([])
    const airline = ref([])
    const errors = ref([])
    // const router = useRouter()

    const getAirlines = async () => {
        try {
            const response = await axios.get('/api/v1/airlines', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            airlines.value = response.data.data
            console.log(airlines)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const getAirline = async (id) => {
        try {
            const response = await axios.get(`/api/v1/airlines/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            airline.value = response.data.data
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const storeAirline = async (data) => {
        try {
            const response = await axios.post(`/api/v1/airlines`, data, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            airline.value = response.data.data
            console.log(airline)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const deleteAirline = async (id) => {
        if(confirm("Are you sure you want to delete this record?")){
            await axios.delete(`/api/v1/airlines/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    getAirlines()
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }

    return {
        airlines,
        airline,
        getAirlines,
        getAirline,
        storeAirline,
        deleteAirline,
        errors
    }

}
