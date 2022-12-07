<template>
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
	<div class="nav-aside">
		<h1 class="nav-aside-logo" style="font-size:0;">JET SPEED
			<img src="../assets/logo_WHITE.png" alt="logo">
		</h1>
		<hr>
		<nav>
			<ul class="parent-list">
				<li id="001"
					:key="id"
					:class="{on: id == activeItem.id}"
					@click.stop="tabChange"
				>
					<a href="javascript:void(0);">
						<span class="material-symbols-outlined">manage_accounts</span> 帳號管理
						<div class="plus-minus"><span></span><span></span></div>
					</a>
					<ul class="child-list">
						<li><router-link to="/administrator" @click="listOpen">管理者帳號</router-link></li>
						<li><router-link to="/" @click="listOpen">會員帳號</router-link></li>
					</ul>
				</li>
				<li v-for="item in items"
					:key="item.id"
					:class="{on: item.id == activeItem.id}"
					@click.stop="tabChange(item)"
				>
					<router-link :to="{path:item.source}">
						<span class="material-symbols-outlined">{{item.icon}}</span>
						{{item.name}}
					</router-link>
				</li>
			</ul>
		</nav>
	</div>
</template>

<script>
import QA from "@/assets/js/QA.js"
export default {
	name: 'Aside',
	props: {
	},
	data(){
        return{
			activeItem: '',
            items:[
				{
					id: '002',
					name: '最新消息管理',
					source: '/news',
					icon: 'format_list_bulleted',
				},
				{
					id: '003',
					name: '行程方案管理',
					source: '/travelcase',
					icon: 'edit_calendar',
				},
				{
					id: '004',
					name: '行程訂單管理',
					source: '/travelmanage',
					icon: 'content_paste_search',
				},
				{
					id: '005',
					name: '開團管理',
					source: '/travelopen',
					icon: 'pending_actions',
				},
				{
					id: '006',
					name: '商品管理',
					source: '/',
					icon: 'card_travel',
				},
				{
					id: '007',
					name: '商品訂單管理',
					source: '/',
					icon: 'content_paste_search',
				},
				{
					id: '008',
					name: '意見表管理',
					source: '/',
					icon: 'mark_chat_read',
				},
				{
					id: '009',
					name: 'Q&A 管理',
					source: '/QA',
					icon: 'quiz',
				},
			],
        }
    },
	methods: {
		listOpen(tab){
			this.classList.toggle('show');
			this.activeItem = tab;
		},
		tabChange(tab){
			this.activeItem = tab;
			// console.log( this.activeItem);
			// console.log( this.activeList);
		}
	},
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
@import "../assets/Css/Reset.css";
@import "../assets/Scss/pages/aside.scss";
</style>