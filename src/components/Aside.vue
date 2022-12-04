<template>
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
	<div class="nav-aside">
		<div class="nav-aside-logo">
			<img src="../assets/logo_WHITE.png" alt="logo">
		</div>
		<hr>
		<nav>
			<ul class="parent-list">
				<li>
					<a href="javascript:void(0);" @click="toggle = !toggle">
						<span class="material-symbols-outlined">manage_accounts</span> 帳號管理
					</a>
					<ul class="child-list" :class="toggle?'show':''">
						<li><router-link to="/administrator">管理者帳號</router-link></li>
						<li><router-link to="/">會員帳號</router-link></li>
					</ul>
				</li>
				<li><router-link to="/news">
					<span class="material-symbols-outlined">format_list_bulleted</span> 最新消息管理
				</router-link></li>
				<li><router-link to="/travelcase">
					<span class="material-symbols-outlined">edit_calendar</span> 行程方案管理
				</router-link></li>
				<li><router-link to="/travelmanage">
					<span class="material-symbols-outlined">content_paste_search</span> 行程訂單管理
				</router-link></li>
				<li><router-link to="/travelopen">
					<span class="material-symbols-outlined">pending_actions</span> 開團管理
				</router-link></li>
				<li><router-link to="/">
					<span class="material-symbols-outlined">card_travel</span> 商品管理
				</router-link></li>
				<li><router-link to="/">
					<span class="material-symbols-outlined">content_paste_search</span> 商品訂單管理
				</router-link></li>
				<li><router-link to="/">
					<span class="material-symbols-outlined">mark_chat_read</span> 意見表管理
				</router-link></li>
				<li><router-link to="/QA">
					<span class="material-symbols-outlined">quiz</span> Q&A 管理
				</router-link></li>
			</ul>
		</nav>
	</div>
</template>

<script>
export default {
	name: 'Aside',
	props: {
		msg: String
	}
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
@import "../assets/Css/Reset.css";
@import "../assets/Scss/base/font.scss";
@import "../assets/Scss/components/btn.scss";
.nav-aside{
	position: fixed;
	width: 300px;
	height: 100vh;
	background-color: $clr_blue_L0;
	.nav-aside-logo{
		padding: 50px 50px 20px;
		text-align: start;
		img{
			width: 150px;
		}
	}
	nav{
		height: calc(100vh - 135px);
		padding: 35px 50px;
		overflow-y: scroll;
		&::-webkit-scrollbar-track{
			background-color: $clr_blue_L3;
		}
		&::-webkit-scrollbar{
			width: 6px;
		}
		&::-webkit-scrollbar-thumb{
			background-color: $clr_blue_L2;
			border-radius: 4px;
		}
		.parent-list{
			height: calc(100vh - 235px);
			// height: calc(100vh - 200px);
			// display: flex;
			// flex-direction: column;
			// justify-content: space-between;
			.child-list{
				>li{
					a{
						@include font(18px);
						color: $clr_blue_L3;
						position: relative;
						&:hover::before{
							content: '>';
							position: absolute;
							left: -15px;
						}
					}
					padding: 15px 32px 0;
				}
			}
			>li{
				padding: 15px 0;
			}
			a{
				@include font(20px);
				display: block;
				color: #fff;
				&:hover{
					color: $clr_blue_L3;
				}
				span{
					color: inherit;
					vertical-align: top;
				}
			}
		}
	}
}


</style>
