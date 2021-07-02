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
    export default {
        props:{},
        data(){
            return{

                employees : JSON.parse(localStorage.getItem('employees')),
                employee_id: this.$route.params.id,
                employee : ''
            }
        },
        mounted(){
            this.employee = this.employees.filter(employee => employee.id == this.employee_id);
            console.log(this.employee[0].name)
        },
        methods:{

        }
    }
</script>
