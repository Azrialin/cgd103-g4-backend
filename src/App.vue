<template>
	<div class="container">
		<Aside/>
		<div class="main"><router-view/></div>
	</div>
</template>

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