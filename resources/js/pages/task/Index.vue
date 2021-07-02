<template>
    <div>
        <v-breadcrumbs :items="breadcrumbs_items"></v-breadcrumbs>
        <v-card class="mx-auto" max-width="1300" tile>
            <v-btn
                elevation="1"
                small
                class="mt-3 ml-3"
                color="success" to="/task/create"
            >Create</v-btn>
            <v-divider></v-divider>

            <div  class="mt-3">
                <v-list-item three-line v-for="(item , index) in tasks" :key=index >
                    <v-list-item-content >
                        <v-list-item-title>{{item.user.name}}</v-list-item-title>
                        <v-list-item-subtitle>{{item.task_name}}</v-list-item-subtitle>
                        <v-list-item-subtitle>{{item.description}}</v-list-item-subtitle>
                        <v-list-item-subtitle v-if="(item.status == 'to_do')">To Do</v-list-item-subtitle>
                        <v-list-item-subtitle v-else-if="(item.status == 'in_progress')">In Progress</v-list-item-subtitle>
                        <v-list-item-subtitle v-else>Done</v-list-item-subtitle>
                        <v-list-item-subtitle>{{item.created_at}}</v-list-item-subtitle>
                        <v-list-item-subtitle class="d-flex justify-end">
                            <v-btn  color="warning"
                                    elevation="1"
                                    small
                                    class="mt-3 ml-3" :to="{ name: 'task-edit', params: { id: item.id }}">
                                Edit
                            </v-btn>
                            <v-btn elevation="1" small class="mt-3 ml-3" color="error" @click="taskDelete(item.id)" >
                                Delete
                            </v-btn>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

            </div>

        </v-card>
    </div>

</template>

<script>
    export default {
        props:{},
        data(){
            return{
                tasks:'',
                breadcrumbs_items: [
                    {
                        text: 'Dashboard',
                        disabled: false,
                        href: 'breadcrumbs_dashboard',
                    },
                    {
                        text: 'Task',
                        disabled: false,
                        href: 'breadcrumbs_link_1',
                    },
                    {
                        text: 'List',
                        disabled: true,
                        href: 'breadcrumbs_link_2',
                    },
                ],
            }
        },
        methods:{
            async fetchData() {

                let self = this;
                // Make a request for a user with a given ID
                await axios.get('/get-tasks')
                    .then(function (response) {
                        // handle success
                        self.tasks = response.data
                        // console.log( response.data);
                        localStorage.setItem('tasks', JSON.stringify(self.tasks));

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

            },
            async taskDelete(id) {
                this.tasks = this.tasks.filter(function (ele) {
                    return ele.id != id;
                });
                await axios.get('/task/delete/' + id)
                    .then(function (response) {
                        console.log(response);
                        this.$toaster.success('Employee Updated Successfully')
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        mounted(){
            this.fetchData()
            // console.log(this.employees)
        }
    }
</script>
