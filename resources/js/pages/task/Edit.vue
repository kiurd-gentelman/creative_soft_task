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
                <v-form v-model="valid" @submit.prevent="update" @keydown="taskForm.onKeydown($event)">
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
                        text: 'Edit',
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
                task_id: this.$route.params.id,
                employees: JSON.parse(localStorage.getItem('employees')),
                tasks: JSON.parse(localStorage.getItem('tasks')),

            }
        },
        methods:{
            async update() {
                // console.log(this.taskForm);
                // this.taskForm.employee_id = this.select_employee;
                console.log(this.taskForm);
                await this.taskForm.post('/task/update/'+this.task_id).then(({ data }) =>{
                    // this.taskForm.name = '';
                    // this.taskForm.employee_id = '';
                    // this.taskForm.description = '';
                    // this.taskForm.status = '';
                    // this.taskForm.type = '';
                    this.$toaster.success('Registration Created Successfully')
                    // console.log(data);
                })
            },
        },
        mounted(){
            let task = this.tasks.filter(task => task.id == this.task_id);
            this.taskForm.name = task[0].task_name
            // this.select_employee = {name:task[0].user.name, id:task[0].user.id}
            this.taskForm.employee_id = task[0].user.id
            this.taskForm.description = task[0].description
            this.taskForm.status = task[0].status
            this.taskForm.type = task[0].type
            console.log(task[0].user)

        }
    }
</script>
