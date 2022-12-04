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
                    <p class="nncode font-20">方案編號 A110000</p>
                </div>
                <div class="type travelcode">
                    <p class="nname">狀態 :</p>
                    <div class="choose">
                        <select class="choosein" v-model="selected">
                            <option value="" disabled>-請選擇-</option>
                            <option>上架</option>
                            <option>草稿</option>
                            <option>下架</option>
                        </select>
                    </div>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">前台位置 :</p>
                    <div class="choose">
                        <select class="choosein" v-model="selected">
                            <option value="" disabled>-請選擇-</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                        </select>
                    </div>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">推薦特產 :</p>
                    <Input class="succe" type="text" v-model="value" style="width: 300px" />
                </div>
                <div class="title2 font-18">方案列表區圖文設定 :</div>
                <div class="type travelcode">
                    <p class="nname">標題(必填) :</p>
                    <Input class="succe" type="text" v-model="value" style="width: 300px" />
                </div>
                <div class="type travelcode">
                    <p class="nname">副標題(必填) :</p>
                    <Input class="succe" type="text" v-model="value" style="width: 300px" />
                </div>
                <div class="type travelcode">
                    <p class="nname">介紹頁內文(必填) :</p>
                    <Form :model="formItem">
                        <FormItem label="Text">
                            <Input v-model="formItem.textarea" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." style="width: 300px"></Input>
                        </FormItem>
                    </Form>
                </div>
                <div class="type travelcode">
                    <p class="nname">詳情頁內文(必填) :</p>
                    <Form :model="formItem2">
                        <FormItem label="Text">
                            <Input v-model="formItem2.textarea2" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." style="width: 300px"></Input>
                        </FormItem>
                    </Form>
                </div>
                <div class="type travelcode">
                    <p class="nname">價格 :</p>
                    <Input class="succe" type="text" v-model="value" style="width: 300px" />
                </div>
                <div class="type travelcode">
                    <p class="nname">插入圖片 :</p>
                    <Upload class="succe" action="//jsonplaceholder.typicode.com/posts/">
                        <Button icon="ios-cloud-upload-outline">Upload files</Button>
                    </Upload>
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
                formItem: {
                    textarea: '',
                },
                formItem2: {
                    textarea2: '',
                },
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
        .title2{
            color: #fff;
            padding: 50px;
        }
        .type{
            display: flex;
            color: #fff;
            .nncode{
                width: 100%;
                background-color: #2D3740;
                text-align: left;
                padding: 30px 30px;
            }
            .nname{
                font-size: 16px;
                width: 50%;
                padding: 30px 0px;
            }
            .choose{
                height: 40px;
                display: flex;
                margin: auto auto auto 0px;
                .choosein{
                    width: 300px;
                }
            }
            .succe{
                display: flex;
                align-items: center;
            }
        }
    }
}

</style>