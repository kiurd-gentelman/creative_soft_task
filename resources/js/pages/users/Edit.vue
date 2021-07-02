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
                <v-form v-model="valid" @submit.prevent="update" @keydown="empForm.onKeydown($event)">
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    v-model="empForm.name"
                                    :rules="nameRules"
                                    :counter="15"
                                    label="Employee name"
                                    required
                                ></v-text-field>
                                <div v-if="empForm.errors.has('name')" v-html="empForm.errors.get('name')" />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    v-model="empForm.email"
                                    :rules="emailRules"
                                    label="E-mail"
                                    required
                                ></v-text-field>
                                <div v-if="empForm.errors.has('email')" v-html="empForm.errors.get('email')" />
                            </v-col>
                        </v-row>
                    </v-container>
                    <v-btn
                        color="success"
                        type="submit"
                    >
                        UPDATE
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
                        text: 'Employee',
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
                    v => v.length <= 15 || 'Name must be less than 10 characters',
                ],

                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                ],

                employees : JSON.parse(localStorage.getItem('employees')),
                employee_id: this.$route.params.id,
                employee : '',
                empForm: new Form({
                    name: '',
                    email: '',
                    type: 'employee'
                })
            }
        },
        mounted(){
            this.employee = this.employees.filter(employee => employee.id == this.employee_id);
            this.empForm.name = this.employee[0].name
            this.empForm.email = this.employee[0].email
            // console.log(this.employee[0].name)
        },
        methods:{
            async update() {
                const response = await this.empForm.post('/employee/update/'+this.employee_id).then(({ data }) =>{
                    this.$toaster.success('Employee Updated Successfully')
                    console.log(data);
                })

            }
        }
    }
</script>
