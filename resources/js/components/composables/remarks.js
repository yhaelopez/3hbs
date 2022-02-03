import { ref } from 'vue'
import axios from 'axios'
// import { useRouter } from 'vue-router'

export default function useRemarks() {

    const remarks = ref([])
    const remark = ref([])
    const errors = ref([])
    // const router = useRouter()

    const getRemarks = async () => {
        try {
            const response = await axios.get('/api/v1/remarks', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            remarks.value = response.data.data
            console.log(remarks)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const getRemark = async (id) => {
        try {
            const response = await axios.get(`/api/v1/remarks/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            remark.value = response.data.data
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const storeRemark = async (data) => {
        try {
            const response = await axios.post(`/api/v1/remarks`, data, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            remark.value = response.data.data
            console.log(remark)
            return response.data.data;
        } catch(ex) {
            console.log(ex.error)
            return ex
        }
    }

    const deleteRemark = async (id) => {
        if(confirm("Are you sure you want to delete this record?")){
            await axios.delete(`/api/v1/remarks/${id}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    getRemarks()
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }

    return {
        remarks,
        remark,
        getRemarks,
        getRemark,
        storeRemark,
        deleteRemark,
        errors
    }

}
