<template>
    <v-card class="mx-auto" max-width="1300" tile>
        <v-btn
            elevation="1"
            small
            class="mt-3 ml-3"
            color="success" to="/employee/create"
        >Create</v-btn>
        <v-divider></v-divider>

        <div  class="mt-3">
            <v-list-item three-line v-for="(item , index) in employees" :key=index >
                <v-list-item-content >
                    <v-list-item-title>{{item.name}}</v-list-item-title>
                    <v-list-item-subtitle>
                        {{item.email}}
                    </v-list-item-subtitle>
                    <v-list-item-subtitle>
                        {{item.created_at}}
                    </v-list-item-subtitle>
                    <v-list-item-subtitle class="d-flex justify-end">
                        <v-btn  color="warning" elevation="1" small class="mt-3 ml-3" :to="{ name: 'employee-edit', params: { id: item.id }}">Edit</v-btn>
                        <v-btn elevation="1" small class="mt-3 ml-3" color="error" @click="userDelete(item.id)" >Delete</v-btn>
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

        </div>

    </v-card>
</template>

<script>
    export default {
        props:{},
        data(){
            return{
                employees:'',
            }
        },
        methods:{
            async fetchData() {

                let self = this;
                // Make a request for a user with a given ID
                await axios.get('/employees')
                    .then(function (response) {
                        // handle success
                        self.employees = response.data
                        // console.log( response);
                        // console.log( response.data);
                        // console.log( self.employees);
                        localStorage.setItem('employees', JSON.stringify(self.employees));
                        // console.log(result)
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

            },
            async userDelete(id) {
                // console.log(id)
                // console.log(this.employees)
                this.employees = this.employees.filter(function (ele) {
                    return ele.id != id;
                });
                await axios.get('/employee/delete/' + id)
                    .then(function (response) {
                        console.log(response);
                        this.$toaster.success('Employee Updated Successfully')
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                // this.$toaster.success('Employee Updated Successfully')
            }
        },
        mounted(){
            this.fetchData()
            // console.log(this.employees)
        }
    }
</script>
