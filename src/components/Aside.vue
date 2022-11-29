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

.nav-aside{
  width: 18%;
  height: 90vh; 
  background-color: #2D3740;
  
}

.nav-aside-logo img{
  margin: 10px 0;
  width: 150px;
}

.nav-aside ul{
  
}

.nav-aside li{
  margin: 20px 0;
  color: #fff;
  text-align: start;
  /* 如何消除marker? */
  margin-left: 8px;    
}

.nav-aside a{
  direction: none;
  color: #fff;

}

</style>
