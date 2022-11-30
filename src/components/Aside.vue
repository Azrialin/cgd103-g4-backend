<template>
  <div class="nav-aside">
        <div class="nav-aside-logo">
            <img src="../assets/logo_WHITE.png" alt="logo">
        </div>
        <hr>
        <nav>
          <!-- <router-link to="/">初始歡迎頁</router-link> -->
          <router-link to="/">帳號管理</router-link>
          <router-link to="/news">最新消息管理</router-link>
          <router-link to="/">行程方案管理</router-link>
          <router-link to="/">行程訂單管理</router-link>
          <router-link to="/">開團管理</router-link>
          <router-link to="/">商品管理</router-link>
          <router-link to="/">商品訂單管理</router-link>
          <router-link to="/">意見表管理</router-link>
          <router-link to="/">Q&A 管理</router-link>
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
.nav-aside{
  position: fixed;
  width: 300px;
  height: 100vh; 
  background-color: #2D3740;
  .nav-aside-logo img{
    margin: 10px 60px;
    width: 150px;
  }
}
  nav{
    text-align: start;
  }

  nav a{
    display: block;
    margin: 30px 75px;
    font-size: nth($font-size, 6)+ px;
    direction: none;
    color: #fff;
  }


</style>
