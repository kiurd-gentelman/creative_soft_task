<template>
    <v-app id="inspire">
        <Sidebar></Sidebar>

        <Header></Header>

        <v-main>

            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>

        <v-footer app>
            <!-- -->
        </v-footer>
    </v-app>

</template>

<script>
    import Header from './components/HeaderComponent'
    import Sidebar from './components/SidebarComponent'
    import Footer from './components/FooterComponent'
    export default {
        props: {
        },
        components:{
            Header,Sidebar,Footer
        }
    };
</script>
