<template>
    <!-- style="display:none" -->
    <div class="backstage-news" >
        <div class="backstage-name">
            <div><h2>最新消息管理</h2></div>
            <div class="backstage-account">
                <span>管理員名稱</span>
                <span>登出</span>
            </div>
        </div>
        <div class="backstage-content">
            <div class="backstage-path">最新消息管理 / 消息列表</div>
            <div class="btn-add">
                <button>新增消息</button>
            </div>
            <div class="news-manage">
                <Tabs type="card" :animated="false">
                    <TabPane label="上架" >
                        <Table border :columns="columns" :data="dataOn" ></Table>
                    </TabPane>
                    <TabPane label="草稿" >
                        <Table border :columns="columns" :data="dataDraft" ></Table>
                    </TabPane>
                    <TabPane label="下架" >
                        <Table border :columns="columns" :data="dataOff" ></Table>
                    </TabPane>
                </Tabs>
            </div>
            <div class="btn-bottom">
                <button>上一頁</button>
                <button>下一頁</button>
            </div>
        </div>
    </div>

    <!-- 彈窗 -->
    <div class="popup " style="display:none" >
        <div class="popup-head">
            <span>公告編號</span>
            <span>A110000</span>
        </div>
        <div class="popup-content">
            <div class="popup-data">
                <label for="">狀態
                    <select name="" id="">
                        <option value="draft">草稿</option>
                        <option value="on">上架</option>
                        <option value="off">下架</option>
                    </select>
                </label>
                <label for="">分類
                    <select name="" id="">
                        <option value="important">重要</option>
                        <option value="action">活動</option>
                        <option value="other">其他</option>
                    </select>
                </label>
                <span class="date">發布時間</span>
                <span class="date">20221120</span>
            </div>
            <div class="input-title">
                <label for="">標題(必填)：
                    <Input placeholder="請輸入標題" clearable style="width: 500px" />
                </label>
            </div>
            <div class="input-des">
                <label for="">內文(必填)：
                    <Input clearable type="textarea" :rows="6" placeholder="請輸入內容" style="width: 500px"/>
                </label>
            </div>
            <div class="input-pic">
                <label class="test" for="">插入圖片：
                    <input type="file">
                </label>
            </div>
            <div class="input-pic-des">
                <label for="">圖片敘述：
                    <Input placeholder="請輸入圖片敘述" clearable style="width: 500px" />
                </label>
            </div>
            <div class="popup-btn">
                <button>取消</button>
                <button>確認</button>
            </div>
        </div>
    </div>

    <!-- 新增成功 -->
    <div class="popup-box add" style="display:none">
        <p class="popup-box-close">X</p>
        <p class="check-des">新增資料成功</p>
        <button>確認</button>
    </div>


    <!-- 修改成功 -->
    <div class="popup-box fix" style="display:none">
        <p class="popup-box-close">X</p>
        <p class="check-des">修改資料成功</p>
        <button>確認</button>
    </div>


</template>
<!-- https://run.iviewui.com/4CEEQf1j -->
<script>

    export default {
        data () {
            return {
                columns: [
                    {
                        title: '公告編號',
                        key: 'news_no'
                    },
                    {
                        title: '上架日期',
                        key: 'news_time'
                    },
                    {
                        title: '分類',
                        key: 'news_class'
                    },
                    {
                        title: '標題',
                        key: 'news_title'
                    },
                    {
                        title: '狀態',
                        key: 'news_status'
                    },
                    {
                        title: '修改/刪除',
                        key: 'news_action'
                    }
                ],
                dataOn: [
                    {
                        news_no: 'A1100000',
                        news_time: '2022/11/22',
                        news_class: '重要',
                        news_title: '「高千穗峽谷」划船體驗報名優惠',
                        news_status:'上架',
                        news_action:'新增 刪除'
                    },
                    {
                        news_no: 'A1100001',
                        news_time: '2022/11/23',
                        news_class: '重要',
                        news_title: '高千穗-夜神樂',
                        news_status:'上架',
                        news_action:'新增 刪除'
                    },
                    {
                        news_no: 'A1100002',
                        news_time: '2022/11/24',
                        news_class: '重要',
                        news_title: '列車停駛',
                        news_status:'上架',
                        news_action:'新增 刪除'
                    },
                    {
                        news_no: 'A1100003',
                        news_time: '2022/11/25',
                        news_class: '重要',
                        news_title: '「鹿兒島沙浴」體驗活動報名',
                        news_status:'上架',
                        news_action:'新增 刪除'
                    },
                    {
                        news_no: 'A1100004',
                        news_time: '2022/11/26',
                        news_class: '重要',
                        news_title: '商城新品上市!!',
                        news_status:'上架',
                        news_action:'新增 刪除'
                    }
                ],
                dataDraft: [
                    {
                        news_no: 'A1100005',
                        news_time: '2022/11/23',
                        news_class: '其他',
                        news_title: '高千穗-夜神樂',
                        news_status:'草稿',
                        news_action:'新增 刪除'
                    },
                    {
                        news_no: 'A1100006',
                        news_time: '2022/11/24',
                        news_class: '活動',
                        news_title: '列車停駛',
                        news_status:'草稿',
                        news_action:'新增 刪除'
                    }
                ],
                dataOff: [
                    {
                        news_no: 'A1100007',
                        news_time: '2022/11/25',
                        news_class: '其他',
                        news_title: '「鹿兒島沙浴」體驗活動報名',
                        news_status:'下架',
                        news_action:'新增 刪除'
                    },
                    {
                        news_no: 'A1100008',
                        news_time: '2022/11/26',
                        news_class: '活動',
                        news_title: '商城新品上市!!',
                        news_status:'下架',
                        news_action:'新增 刪除'
                    }
                ]
            }
        },

    }
</script>

<style scoped lang="scss">
/* -------------------彈窗 ------------------------*/
.popup{
    position: absolute;
    top: 20px;
    left: 200px;
    margin: auto;
    z-index: 10;

    width: 60%;
    height: 70Vh;
    background-color: #4F6573;
}

/* 上方區塊顏色 */
.popup-head{
    background-color: #2D3740;
    height: 80px;
    color: #ccc;
}

.popup-data{
    margin: 30px 0;
}
.input-title,
.input-des,
.input-pic,
.input-pic-des{
    margin-bottom: 15px;
}
.popup-btn{
    margin: 30px 0;
}


/* 彈窗字顏色 */
.popup label{
    color: #fff;
}
.date{
    color: #ccc;
}
/* -------------------彈窗結束----------------- */

/* -------------------新增修改box ------------------------*/
.popup-box{
    position: absolute;
    top: 200px;
    left: 400px;
    width: 400px;
    height: 230px;
    border: 1px solid #A3AFBF;
    border-radius: 10px;
    background-color: #e3e7ed;
}   

.popup-box-close{
    text-align: end;
    margin-top: 10px;
    padding-right: 20px;
}

.check-des{
    margin-top: 70px;
}

.popup-box button{
    margin-top: 30px;
}

/* -------------------新增修改結束 ------------------------*/

/* 後台header */
.backstage-name{
    display: flex;
    justify-content: space-between;
    background-color: #4F6573;
    color: #fff;
    text-align: start;
    height: 8vh;
    line-height: 3.5rem;
}
.backstage-name h2{
    margin-left: 10px;
}
/* 帳號狀態 */
.backstage-account span{
    display: inline-block;
    cursor: pointer;
    margin: 0 10px;
}

/* 消息管理 */
/* 麵包屑 */
.backstage-path{
    text-align: start;
    color: #888888;
    margin: 20px 0 0 10px;
}

/* 新增按鈕 */
.btn-add{
    text-align: end;
    margin-right: 20px;
}
/* 管理介面 */
.news-manage{
    height: 45vh;
    margin: 30px 20px;
}

/* 上下頁 */
.btn-bottom{
    text-align: end;
    margin-right: 20px;
}

.btn-bottom button{
    margin-left: 10px;
}
</style>