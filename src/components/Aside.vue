<template>
  <div class="nav-aside">
    <ul>
        <div class="nav-aside-logo">
            <img src="../assets/logo_WHITE.png" alt="logo">
        </div>
        <hr>
        <li><a href="#">帳號管理</a></li>
        <li><a href="#">最新消息管理</a></li>
        <li><a href="#">行程方案管理</a></li>
        <li><a href="#">行程訂單管理</a></li>
        <li><a href="#">開團管理</a></li>
        <li><a href="#">商品管理</a></li>
        <li><a href="#">商品訂單管理</a></li>
        <li><a href="#">意見表管理</a></li>
        <li><a href="#">Q&A 管理</a></li>
    </ul>
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
  ul{
    text-align: start;
    li{
      margin: 30px 75px;
      color: #fff;
      font-size: nth($font-size, 6)+ px;
      /* 如何消除marker? */
      a{
        direction: none;
        color: #fff;
      }
    }
  }
}
</style>
