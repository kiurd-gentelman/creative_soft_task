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
                                    :counter="250"
                                    label="Employee name"
                                    required
                                ></v-text-field>
                                <div v-if="empForm.errors.has('name')" v-html="empForm.errors.get('name')" />
                            </v-col>
                            <v-col cols="12" md="6">
<!--                                <input type="file" @change="onFileChange">-->
                                <v-file-input
                                    accept="image/*"
                                    label="File input" @change="onFileChange"
                                ></v-file-input>
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
                        SUBMIT
                    </v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>


</template>
<script>
    import Form from 'vform'
    import { objectToFormData } from 'object-to-formdata'
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
                    v => v.length <= 250 || 'Name must be less than 10 characters',
                ],

                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                ],
                empForm: new Form({
                    name: '',
                    email: '',
                    avatar: '',
                    type: 'employee'
                }),
                input_file :''
            }
        },
        methods:{
            async registration() {
                console.log(this.empForm.avatar)
                const response = await this.empForm.post('/employee/store',
                    {
                        transformRequest: [function (data, headers) {
                            return objectToFormData(data)
                        }],
                        onUploadProgress: e => {
                            // Do whatever you want with the progress event
                            console.log(e)
                        }
                    }
                ).then(({ data }) =>{
                    this.empForm.name = '';
                    this.empForm.email = '';
                    this.$toaster.success('Registration Created Successfully')
                    console.log(data);
                    this.$router.push("/user");
                })
            },
            onFileChange(event){
                console.log(event)
                // this.input_file  = event.target.files[0];
                this.empForm.avatar  = event;
                console.log(this.input_file)
            }
        }
    }
</script>
