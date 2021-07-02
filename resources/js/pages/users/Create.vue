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
                <v-form v-model="valid" @submit.prevent="registration" @keydown="empForm.onKeydown($event)">
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
                        text
                        color="deep-purple accent-4"
                        type="submit"
                    >
                        Learn More
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
                        text: 'Create',
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
                empForm: new Form({
                    name: '',
                    email: '',
                    type: 'employee'
                })
            }
        },
        methods:{
            async registration() {
                const response = await this.empForm.post('/employee/store').then(({ data }) =>{
                    this.empForm.name = '';
                    this.empForm.email = '';
                    this.$toaster.success('Registration Created Successfully')
                    console.log(data);
                })

            }
        }
    }
</script>
