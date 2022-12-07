<template>
    <div class="backstage-news" >
        <div class="backstage-name">
            <div>
                <h2 class="font-36">開團管理</h2>
            </div>
            <div class="backstage-account">
                <span class="font-18">管理員名稱</span>
                <span class="font-18">登出</span>
            </div>
        </div>
        <div class="backstage-content">
            <div class="backstage-path font-16">開團管理 / 開團設定</div>
        </div>
        <div class="container">
            <div class="content">
                <div class="type opencode">
                    <p class="nname">開團編號 :</p>
                    <p class="succe">A0001</p>
                </div>
                <div class="type travelcode">
                    <p class="nname">行程方案 :</p>
                    <div class="choose">
                        <select class="choosein" v-model="selected">
                            <option value="" disabled>-請選擇-</option>
                            <option>方案A</option>
                            <option>方案B</option>
                            <option>方案C</option>
                            <option>方案D</option>
                        </select>
                    </div>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">出發日期 :</p>
                    <Space size="large" wrap>
                        <DatePicker type="date" placeholder="Select date" style="width: 300px" />
                    </Space>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">開放報名日期 :</p>
                    <Space size="large" wrap>
                        <DatePicker type="date" placeholder="Select date" style="width: 300px" />
                    </Space>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">截止日期 :</p>
                    <Space size="large" wrap>
                        <DatePicker type="date" placeholder="Select date" style="width: 300px" />
                    </Space>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">人數上限 :</p>
                    <Input class="succe" type="text" v-model="value" style="width: 300px" />
                </div>
                
                <div class="type travelcode">
                    <p class="nname">價格 / 人 :</p>
                    <Input class="succe" type="text" v-model="value2" style="width: 300px" />
                </div>
                <div class="delcan">
                    <div class="shure">取消</div>
                    <div class="shure">確認</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                selected:"",
                value:"",
                value2:"",
            }
        }
    }
</script>

<style scoped lang="scss">
@import "@/assets/Scss/base/color.scss";

// *{
//     outline: solid 1px;
// }

.backstage-name{
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #4F6573;
    color: #fff;
    text-align: start;
    height: 80px;
}
.backstage-name h2{
    margin-left: 40px;
}
.backstage-account span{
    display: inline-block;
    cursor: pointer;
    margin: 0 20px;
}
.backstage-path{
    text-align: start;
    color: #888888;
    margin: 40px 0 0px 40px;
}
.container{
    padding: 40px 0px;
    width: 100%;
    .content{
        width: 100%;
        max-width: 768px;
        margin: auto;
        background-color: $back_color_active;
        .delcan{
            width: 100%;
            max-width: 30%;
            display: flex;
            justify-content: space-between;
            margin: 20px auto;
            .shure{
                background-color: $back_color_main;
                padding: 5px 30px;
                border-radius: 10px;
                color: #fff;
                cursor: pointer;
                font-size: 16px;
            }
            .shure:nth-child(1){
                background-color: #fff;
                color: $back_color_main;
            }
        }
        .type{
            display: flex;
            color: #fff;
            .nname{
                font-size: 16px;
                width: 50%;
                padding: 30px 0px;
            }
            .choose{
                font-size: 16px;
                height: 40px;
                display: flex;
                margin: auto auto auto 0px;
                .choosein{
                    width: 300px;
                    font-size: 16px;
                }
            }
            .succe{
                font-size: 16px;
                display: flex;
                align-items: center;
            }
        }
    }
}

</style>