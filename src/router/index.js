import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
{
	path: '/',
	name: 'home',
	component: HomeView
},
{
	path: '/Administrator',
	name: 'Administrator',
	component: () => import('../views/AdministratorView.vue')
},
{
	path: '/news',
	name: 'news',
	component: () => import('../views/NewsView.vue')
},
{
	path: '/travelcase',
	name: 'travelcase',
	component: () => import('../views/TravelcaseView.vue')
},
{
	path: '/travelmanage',
	name: 'travelmanage',
	component: () => import('../views/TravelmanageView.vue')
},
{
	path: '/travelopen',
	name: 'travelopen',
	component: () => import('../views/TravelopenView.vue')
},
{
	path: '/QA',
	name: 'QA',
	component: () => import('../views/QAView.vue')
},
{
	path: '/about',
	name: 'about',
	// route level code-splitting
	// this generates a separate chunk (about.[hash].js) for this route
	// which is lazy-loaded when the route is visited.
	component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
}
]

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes
})

export default router
