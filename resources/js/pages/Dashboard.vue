<template>
    <div class="bg-color-red">
        <v-container color="#75647">
            <v-row>
                <v-col cols="12" md="4">
                    <div class="d-inline-flex w-100 ">
                        <span class="w-100"><h3>To Do ({{to_do.length}})</h3></span>
                        <span class="w-100">
                           <v-btn elevation="0" class="float-right" to="/task/create">
                               <v-icon dark>mdi-plus</v-icon>
                               New Task
                           </v-btn>
                        </span>
                    </div>
                    <v-card class="mx-auto mt-5" color="#f1f1fd"  elevation="0" v-for="(item , index) in to_do " :key="index">
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="text-h5 mb-1">
                                    {{item.task_name}}
                                </v-list-item-title>
                                <v-list-item-subtitle>{{item.description}}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>

                        <div class="d-inline-flex w-100 pl-5 pr-5 pb-2">
                            <span class="w-100">
                                <v-avatar
                                    size="52"
                                >
                                    <img
                                        :src=item.user.avatar
                                        alt="John"
                                        size="52"
                                    >
                                </v-avatar>
                            </span>
                            <span class="w-100">
                               <v-btn elevation="0" class="float-right">
                                   <v-icon dark>mdi-format-list-bulleted-square</v-icon>
                               </v-btn>
                            </span>
                        </div>
                    </v-card>

                </v-col>

                <v-col cols="12" md="4">
                    <div class="d-inline-flex w-100 ">
                        <span class="w-100"><h3>In Progress ({{in_progress.length}})</h3></span>
                        <span class="w-100">
                           <v-btn elevation="0" class="float-right" to="/task/create">
                               <v-icon dark>mdi-plus</v-icon>
                               New Task
                           </v-btn>
                        </span>
                    </div>
                    <v-card class="mx-auto mt-5" color="#f1f1fd"  elevation="0" v-for="(item , index) in in_progress " :key="index">
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="text-h5 mb-1">
                                    {{item.task_name}}
                                </v-list-item-title>
                                <v-list-item-subtitle>{{item.description}}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>

                        <div class="d-inline-flex w-100 pl-5 pr-5 pb-2">
                            <span class="w-100">
                                <v-avatar
                                    size="52"
                                >
                                    <img
                                        :src=item.user.avatar
                                        alt="John"
                                        size="52"
                                    >
                                </v-avatar>
                            </span>
                            <span class="w-100">
                               <v-btn elevation="0" class="float-right">
                                   <v-icon dark>mdi-format-list-bulleted-square</v-icon>
                               </v-btn>
                            </span>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                    <div class="d-inline-flex w-100 ">
                        <span class="w-100"><h3>Done ({{done.length}})</h3></span>
                        <!--<span class="w-100">
                           <v-btn elevation="0" class="float-right" to="/task/create">
                               <v-icon dark>mdi-plus</v-icon>
                               New Task
                           </v-btn>
                        </span>-->
                    </div>
                    <v-card class="mx-auto mt-5" color="#f1f1fd"  elevation="0" v-for="(item , index) in done " :key="index">
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="text-h5 mb-1">
                                    {{item.task_name}}
                                </v-list-item-title>
                                <v-list-item-subtitle>{{item.description}}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>

                        <div class="d-inline-flex w-100 pl-5 pr-5 pb-2">
                            <span class="w-100">
                                <v-avatar
                                    size="52"
                                >
                                    <img
                                        :src=item.user.avatar
                                        alt="John"
                                        size="52"
                                    >
                                </v-avatar>
                            </span>
                            <span class="w-100">
                               <v-btn elevation="0" class="float-right">
                                  <v-icon dark>mdi-format-list-bulleted-square</v-icon>
                               </v-btn>
                            </span>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>





    </div>

</template>
<script>
    export default {
        props: {},
        data(){
            return{
                tasks: JSON.parse(localStorage.getItem('tasks')),
                to_do : '',
                in_progress : '',
                done : '',
            }
        },
        methods:{
            async getTask() {
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
            }

        },
        mounted(){
            this.getTask()
            // console.log(JSON.parse(localStorage.getItem('tasks')));
            this.to_do = this.tasks.filter(task => task.status == 'to_do');
            this.in_progress = this.tasks.filter(task => task.status == 'in_progress');
            this.done = this.tasks.filter(task => task.status == 'done');

            console.log(this.in_progress);
        }
    }
</script>
