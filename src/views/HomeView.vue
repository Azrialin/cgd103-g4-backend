<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    <br>
    <button type="button" class="btn-blue">按鈕</button>
    <button type="button" class="btn-blue_2nd">按鈕</button>
    <button type="button" class="btn-gold">按鈕</button>
    <button type="button" class="btn-gold_2nd">按鈕</button>
    <button type="button" class="btn-success">按鈕</button>
    <button type="button" class="btn-success_2nd">按鈕</button>
    <button type="button" class="btn-danger">按鈕</button>
    <button type="button" class="btn-danger_2nd">按鈕</button>
    <br>
    <br>
    <hr>
    <p class="font-48">測試文字font-48</p>
    <p class="font-36">測試文字font-36</p>
    <p class="font-32">測試文字font-32</p>
    <p class="font-28">測試文字font-28</p>
    <p class="font-24">測試文字font-24</p>
    <p class="font-20">測試文字font-20</p>
    <p class="font-18">測試文字font-18</p>
    <p class="font-16">測試文字font-16</p>
    <p class="font-14">測試文字font-14</p>
    <p class="font-16-15em">測試文字font-16-15em</p>
    <p class="font-16-24em">測試文字font-16-24em</p>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'HomeView',
  components: {
    HelloWorld
  }
}
</script>
