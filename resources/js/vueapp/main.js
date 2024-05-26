

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import MainPage from './main.vue'
import HomePage from './pages/home.vue'
import ProductPage from './pages/products.vue'
import ModuleIndex from './pages/modules/index.vue'
import ModuleCreate from './pages/modules/index.vue'
import ModuleComp from './pages/modules/index.vue'
import smComp from './pages/modules/create.vue'
import mmComp from './pages/modules/create.vue'
import axios from 'axios'

var module = {};
var moduleRoute = [];
var mainMenus = {};
var mmRoute = [];
var sMenus = {};
var smRoute = [];

async function mounted() {
    try {
        const response = await axios.get("/api/module/path/" + 1);
        module = response.data.module;
        moduleRoute = response.data.moduleRoute;
        mainMenus = response.data.mainMenus;
        mmRoute = response.data.mmRoute;
        sMenus = response.data.sMenus;
        smRoute = response.data.smRoute;

        const routes = [
            {
                name: 'home-page',
                path: '/',
                component: HomePage
            },
            {
                name: 'product-page',
                path: '/products/:pro_name',
                component: ProductPage
            },
            {
                name: 'module-path',
                path: '/module/path/:link',
                component: MainPage
            },
            {
                name: 'module-create',
                path: '/module/create',
                component: ModuleCreate
            }

        ];

        var totalRoute = routes.length;

        routes[totalRoute] = {
            name: moduleRoute.name,
            path: moduleRoute.url,
            component: ModuleComp,
        }
        totalRoute++;

        mmRoute.forEach(function (item, index) {
            routes[totalRoute] = {
                name: item.name,
                path: item.url,
                component: mmComp,
            }
            totalRoute++;
        });

        smRoute.forEach(function (item, index) {
            routes[totalRoute] = {
                name: item.name,
                path: item.url,
                component: smComp,
            }
            totalRoute++;
        });

        const route = createRouter({
            history: createWebHistory(),
            routes,
        });

        const app = createApp(MainPage);
        app.use(route);
        app.mount('#my_app');

    } catch (error) {
        console.log(error);
    }
}

mounted();










