<template>
    <div>
        <div>
            <v-breadcrumbs :items="breadcrumbs_items"></v-breadcrumbs>
        </div>
        <v-card
            class="mx-auto"
            max-width="1300"
        >
            <v-card-text>
                <v-form v-model="valid" @submit.prevent="tasks" @keydown="taskForm.onKeydown($event)">
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="12">
                                <v-text-field
                                    v-model="taskForm.name"
                                    :rules="nameRules"
                                    :counter="200"
                                    label="Task name"
                                    required
                                ></v-text-field>
                                <div v-if="taskForm.errors.has('name')" v-html="taskForm.errors.get('name')" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="taskForm.employee_id"
                                    :items="employees"
                                    item-text="name"
                                    item-value="id"
                                    label="Employees"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-select
                                    v-model="taskForm.status"
                                    :items="selectItem"
                                    item-text="name"
                                    item-value="value"
                                    label="Task Status"
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="12">
                                <v-textarea
                                    name="input-7-1"
                                    label="Details"
                                    v-model="taskForm.description"
                                    hint="Hint text"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                    </v-container>
                    <v-btn
                        color="success"
                        type="submit"
                    >
                        SUBMIT
                    </v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>


</template>
<script>
    import Form from 'vform'
    export default {
        props:{},
        data(){
            return{
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
                        text: 'Create',
                        disabled: true,
                        href: 'breadcrumbs_link_2',
                    },
                ],
                valid: false,
                nameRules: [
                    v => !!v || 'Name is required',
                    v => v.length <= 200 || 'Name must be less than 200 characters',
                ],
                selectItem :[
                    { name: 'To Do', value: 'to_do' },
                    { name: 'In Progress', value: 'in_progress' },
                    { name: 'Done', value: 'done' },
                ],
                taskForm: new Form({
                    name: '',
                    employee_id:'',
                    description: 'this is another',
                    status: '',
                    type: 'employee'
                }),
                employees: JSON.parse(localStorage.getItem('employees')),

            }
        },
        methods:{
            async tasks() {
                console.log(this.taskForm);
                await this.taskForm.post('/task/store').then(({ data }) =>{
                    this.taskForm.name = '';
                    this.taskForm.select = '';
                    this.$toaster.success('Registration Created Successfully')
                    console.log(data);
                    this.$router.push("/tasks");
                })
            },
        },
        mounted(){

        }
    }
</script>
