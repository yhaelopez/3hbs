<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Remarks</h1>
            </div>
            <div class="col-12 mb-4">
                <router-link :to="{ name: 'remarks.create' }" class="btn btn-success">Create</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Remarkable Type</th>
                            <th scope="col">Remarkable Id</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="remark in remarks" :key="remark.id">
                            <th scope="row">{{ remark.id }}</th>
                            <td>{{ remark.attributes.remarkable_type }}</td>
                            <td>{{ remark.attributes.remarkable_id }}</td>
                            <td>{{ remark.attributes.comment }}</td>
                            <td>
                                <router-link :to='{ name: "remarks.show", params: { id: remark.id } }' class="btn btn-success">Show</router-link>
                                <router-link :to='{ name: "remarks.edit", params: { id: remark.id } }' class="btn btn-warning">Edit</router-link>
                                <button @click="deleteRemark(remark.id)" class="btn btn-danger">Delete</button>
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
    import useRemarks from '../composables/remarks'
    import { useRouter } from 'vue-router'
    import { onMounted } from 'vue'

    const { checkAuth } = useAuth()

    export default {
        setup() {
            const router = useRouter()
            const { remarks, getRemarks, deleteRemark } = useRemarks()
            checkAuth().then(res => {
                if(!res) {
                    router.push({ name: 'login' })
                }
            })

            onMounted(getRemarks)

            return {
                remarks,
                deleteRemark
            }
        }
    }
</script>
