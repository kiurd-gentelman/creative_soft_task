<template>
    <v-card>
        <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent app>
            <v-list-item class="px-2">
                <v-list-item-avatar>
                    <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
                </v-list-item-avatar>

                <v-list-item-title>John Leider</v-list-item-title>

                <v-btn icon @click.stop="mini = !mini">
                    <v-icon>mdi-chevron-left</v-icon>
                </v-btn>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense>
                <v-list-item
                    v-for="item in items" :key="item.title" link :to=item.link>
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                        </v-list-item-content>

                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
    export default {
        props: {
        },
        data () {
            return {
                drawer: true,
                items: [
                    {title: 'Dashboard', icon: 'mdi-account',  link:'/'},
                    {title: 'Users', icon: 'mdi-account-group-outline' , link:'/user'},
                    {title: 'Task', icon: 'mdi-home-city' , link:'/tasks'},


                ],
                mini: false,
            }
        }
    };
</script>
