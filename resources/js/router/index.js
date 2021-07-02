import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from '../pages/Dashboard'
import UserIndex from '../pages/users/Index'
import UserCreate from '../pages/users/Create'
import UserEdit from '../pages/users/Edit'

import TaskIndex from '../pages/task/Index'
import TaskCreate from '../pages/task/Create'
import TaskEdit from '../pages/task/Edit'

const routes = [
    {
        path: '/',
        component: Dashboard
    },
    {
        path: '/user',
        component: UserIndex
    },
    {
        path: '/employee/create',
        component: UserCreate
    },
    {
        path: '/employee/edit/:id',
        component: UserEdit,
        name: 'employee-edit'
    },

    {
        path: '/tasks',
        component: TaskIndex,
        name:'tasks'
    },
    {
        path: '/task/create',
        component: TaskCreate
    },
    {
        path: '/task/Edit/:id',
        component: TaskEdit,
        name: 'task-edit'
    },

];

const router = new VueRouter({
    mode : 'history',
    routes,
});

export default router;
