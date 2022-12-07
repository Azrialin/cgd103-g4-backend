<template>
    <header>
        <h2 class="font-32"
            v-for="(item, i) in breadcrumbList" :key="i">{{ item.meta.title }}</h2>
        <div>
            <span class="font-18">管理員名稱</span>
            <span class="font-18">登出</span>
        </div>
    </header>
</template>

<script>
import { ref, watch } from 'vue'
import { useRoute } from 'vue-router'
export default {
    name: 'Header',
    setup(){
        const route = useRoute()
        const breadcrumbList = ref([])
        const getBreadcrumbs = () => {
            let matched = route.matched;
            breadcrumbList.value = matched;
        }
        watch(route, () => {
            getBreadcrumbs()
        })
        return {
            breadcrumbList,
        }
    }
}
</script>

<style scoped lang="scss">
@import "../assets/Scss/base/font.scss";
@import "../assets/Scss/components/btn.scss";

header{
        width: 100%;
        padding: 20px 40px;
        min-height: 80px;
        background: $clr_blue_L2;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        span{
            &:last-child{
                cursor: pointer;
                margin-left: 20px;
                &:hover{
                    color: $clr_blue_L3;
                }
            }
        }
    }
</style>