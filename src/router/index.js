import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
{
	path: '/',
	name: 'home',
	component: HomeView,
	meta: { title: '首頁' }
},
{
	path: '/Administrator',
	name: 'Administrator',
	component: () => import('../views/AdministratorView.vue'),
	meta: { title: '管理者帳號' }
},
{
	path: '/Membership',
	name: 'Membership',
	component: () => import('../views/MembershipView.vue'),
	meta: { title: '會員帳號' }
},
{
	path: '/news',
	name: 'news',
	component: () => import('../views/NewsView.vue'),
	meta: { title: '最新消息管理' }
},
{
	path: '/travelcase',
	name: 'travelcase',
	component: () => import('../views/TravelcaseView.vue'),
	meta: { title: '行程方案管理' }
},
{
	path: '/travelmanage',
	name: 'travelmanage',
	component: () => import('../views/TravelmanageView.vue'),
	meta: { title: '行程訂單管理' }
},
{
	path: '/travelopen',
	name: 'travelopen',
	component: () => import('../views/TravelopenView.vue'),
	meta: { title: '開團管理' }
},
{
	path: '/traveladd',
	name: 'traveladd',
	component: () => import('../views/TraveladdView.vue')
},
{
	path: '/QA',
	name: 'QA',
	component: () => import('../views/QAView.vue'),
	meta: { title: 'Q&A 管理' }
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

// router 跳轉畫面後，維持置頂
const scrollBehavior = (to, from, savedPosition) => {
	if(savedPosition && to.meta.keepAlive){
		return savedPosition;
	}
	return {left: 0, top: 0}
}

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior
})

export default router