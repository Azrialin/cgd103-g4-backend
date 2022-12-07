<template>
	<div class="container">
		<Aside/>
		<div class="main"><router-view/></div>
	</div>
</template>
<!-- <template>
	<div class="container">
		<Aside/>
		<section class="main">
			<header>
				<h1 class="font-32">Q&A 管理</h1>
				<div>
					<span class="font-18">管理員名稱</span>
					<span class="font-18">登出</span>
				</div>
			</header>
			<router-view/>
		</section>
	</div>
</template> -->

<style lang="scss">

@import "../src/assets/Css/Reset.css";
@import "../src/assets/Scss/base/common.scss";
@import "../src/assets/Scss/base/font.scss";
@import "../src/assets/Scss/components/btn.scss";

#app {
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-align: center;
	color: #2c3e50;
}
a{
	text-decoration: none;
}

</style>

<script>
// @ is an alias to /src
import Aside from '@/components/Aside.vue'

export default {
	name: 'App',
	components: {
		Aside
	}
}
</script>