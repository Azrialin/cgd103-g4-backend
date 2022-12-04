<template>
    <!-- style="display:none" -->
    <div class="backstage-news" >
        <div class="backstage-name">
            <div>
                <h2 class="font-36">行程方案管理</h2>
            </div>
            <div class="backstage-account">
                <span class="font-18">管理員名稱</span>
                <span class="font-18">登出</span>
            </div>
        </div>
        <div class="backstage-content">
            <div class="backstage-path font-16">行程方案管理 / 行程方案列表</div>
            <div class="btn-add">
                <button class="font-20">
                    <router-link class="addc" to="/traveladd">新增方案</router-link>
                </button>
            </div>
            <div class="news-manager">
                <Tabs  type="card" :animated="false">
                    <TabPane label="上架" >
                        <Table stripe border :columns="columns" :data="dataOn" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text" v-model="editnews_no" v-if="editIndex === index" />
                                <span v-else>{{ row.news_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_session="{ row, index }">
                                <Input type="text" v-model="editIndex_session" v-if="editIndex === index" />
                                <span v-else>{{ row.news_session }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_class="{ row, index }">
                                <Input type="text" v-model="editnews_class" v-if="editIndex === index" />
                                <span v-else>{{ (row.news_class) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }">
                                <Input type="text" v-model="editnews_title" v-if="editIndex === index" />
                                <span v-else>{{ row.news_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text" v-model="editnews_status" v-if="editIndex === index" />
                                <span v-else>{{ row.news_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action>
                                <div class="btn-box">
                                    <Button >編輯</Button>
                                </div>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="草稿" >
                        <Table stripe border :columns="columns" :data="dataDraft" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text" v-model="editnews_no" v-if="editIndex === index" />
                                <span v-else>{{ row.news_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_session="{ row, index }">
                                <Input type="text" v-model="editnews_session" v-if="editIndex === index" />
                                <span v-else>{{ row.news_session }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_class="{ row, index }">
                                <Input type="text" v-model="editnews_class" v-if="editIndex === index" />
                                <span v-else>{{ (row.news_class) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }">
                                <Input type="text" v-model="editnews_title" v-if="editIndex === index" />
                                <span v-else>{{ row.news_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text" v-model="editnews_status" v-if="editIndex === index" />
                                <span v-else>{{ row.news_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action>
                                <div class="btn-box">
                                    <Button >編輯</Button>
                                </div>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="下架" >
                        <Table stripe border :columns="columns" :data="dataOff" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text" v-model="editnews_no" v-if="editIndex === index" />
                                <span v-else>{{ row.news_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_session="{ row, index }">
                                <Input type="text" v-model="editnews_session" v-if="editIndex === index" />
                                <span v-else>{{ row.news_session }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_class="{ row, index }">
                                <Input type="text" v-model="editnews_class" v-if="editIndex === index" />
                                <span v-else>{{ (row.news_class) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }">
                                <Input type="text" v-model="editnews_title" v-if="editIndex === index" />
                                <span v-else>{{ row.news_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text" v-model="editnews_status" v-if="editIndex === index" />
                                <span v-else>{{ row.news_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action>
                                <div class="btn-box">
                                    <Button >編輯</Button>
                                </div>
                            </template>
                        </Table>
                    </TabPane>
                </Tabs>
            </div>
            <div class="btn-bottom">
                <button class="font-18">上一頁</button>
                <button class="font-18">下一頁</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                columns: [
                    
            {
                title: '前台區塊',
                slot: 'news_session',
                width: 100,
                align: 'center'
            },
            {
                title: '方案編號',
                slot: 'news_no',
                width: 100,
                align: 'center'
            },
            {
                title: '上架日期',
                slot: 'news_time',
                width: 110,
                align: 'center'
            },
            {
                title: '標題',
                slot: 'news_title',
                align: 'center'
            },
            {
                title: '推薦商品',
                slot: 'news_class',
                width: 150,
                align: 'center'
            },
            {
                title: '操作',
                slot: 'action',
                width: 100,
                align: 'center'
            },
            {
                title: '狀態',
                slot: 'news_status',
                width: 70,
                align: 'center'
            }
                ],
                dataOn: [
                    {
                        news_no: 'A1100001',
                        news_time: '2022/11/22',
                        news_session:'A',
                        news_class: '火車佐便當',
                        news_title: '「高千穗峽谷」划船體驗報名優惠',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100002',
                        news_time: '2022/11/23',
                        news_session:'B',
                        news_class: '火車佐便當',
                        news_title: '高千穗-夜神樂',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100003',
                        news_time: '2022/11/24',
                        news_session:'C',
                        news_class: '火車佐便當',
                        news_title: '「高千穗峽谷」划船體驗報名優惠',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100004',
                        news_time: '2022/11/25',
                        news_session:'D',
                        news_class: '火車佐便當',
                        news_title: '「鹿兒島沙浴」體驗活動報名',
                        news_status:'上架',
                    },
                ],
                dataDraft: [
                    {
                        news_no: 'A1100005',
                        news_time: '2022/11/23',
                        news_session:'E',
                        news_class: '火車佐便當',
                        news_title: '高千穗-夜神樂',
                        news_status:'草稿',
                    },
                    {
                        news_no: 'A1100006',
                        news_time: '2022/11/24',
                        news_session:'F',
                        news_class: '火車佐便當',
                        news_title: '列車停駛',
                        news_status:'草稿',
                    }
                ],
                dataOff: [
                    {
                        news_no: 'A1100007',
                        news_time: '2022/11/25',
                        news_session:'G',
                        news_class: '火車佐便當',
                        news_title: '「鹿兒島沙浴」體驗活動報名',
                        news_status:'下架',
                    },
                    {
                        news_no: 'A1100008',
                        news_time: '2022/11/26',
                        news_session:'H',
                        news_class: '火車佐便當',
                        news_title: '商城新品上市!!',
                        news_status:'下架',
                    }
                ],
                editIndex: -1,  // 当前聚焦的输入框的行数
                editnews_no: '',  // 第一列输入框，当然聚焦的输入框的输入内容，与 data 分离避免重构的闪烁
                editnews_time: '',  // 第二列输入框
                editnews_class: '',  // 第三列输入框
                editnews_title: '',  // 第四列输入框
                editnews_status: '',
                editnews_session: '',
                }
            },
            methods: {
            handleEdit (row, index) {
                this.editnews_no = row.news_no;
                this.editnews_time = row.news_time;
                this.editnews_title = row.news_title;
                this.editnews_class = row.news_class;
                this.editnews_status = row.news_status;
                this.editnews_session = row.news_session;
                this.editIndex = index;
            },
            handleSave (index) {
                this.data[index].news_no = this.editnews_no;
                this.data[index].news_time = this.editnews_time;
                this.data[index].news_class = this.editnews_class;
                this.data[index].news_title = this.editnews_title;
                this.data[index].news_status = this.editnews_status;
                this.data[index].news_session = this.editnews_session;
                this.editIndex = -1;
            }
        }

    }
</script>

<style scoped lang="scss">
/* -------------------彈窗 ------------------------*/
.popup{
    position: absolute;
    top: 5px;
    left: 150px;
    margin: auto;
    z-index: 10;
    width: 70%;
    background-color: #4F6573;
}

/* 上方區塊顏色 */
.popup-head{
    background-color: #2D3740;
    height: 80px;
    color: #ccc;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.popup-data{
    margin: 30px 0;
    display: flex;
    justify-content: space-around;
}
.input-title{
    margin-bottom: 40px;
    padding-left: 85px;
}
.input-des,
.input-pic,
.input-pic-des{
    margin-bottom: 15px;
    padding-left: 85px;

}
.input-txt{
    margin-bottom: 40px;
}
.popup-btn{
    margin: 90px 0 50px 0 ;
    display: flex;
    justify-content: center;

}

.popup-btn button{
    margin: 0 100px;
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
    border: 1px solid #6c9255;
    border-radius: 10px;
    background-color: #ffffff;
    text-align: center;
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
    align-items: center;
    background-color: #4F6573;
    color: #fff;
    text-align: start;
    height: 80px;
}
.backstage-name h2{
    margin-left: 40px;
}
/* 帳號狀態 */
.backstage-account span{
    display: inline-block;
    cursor: pointer;
    margin: 0 20px;
}

/* 消息管理 */
/* 麵包屑 */
.backstage-path{
    text-align: start;
    color: #888888;
    margin: 40px 0 0 40px;
}

/* 新增按鈕 */
.btn-add{
    text-align: end;
    margin-right: 60px;
    .font-20{
        .addc{
            text-decoration: none;
            color: #2D3740;
        }
    }
}
/* 管理介面 */
.news-manager{
    height: 45vh;
    margin: 30px 20px;
}

/* 上下頁 */
.btn-bottom{
    text-align: end;
    margin:100px 60px 0 0 ;
    margin-right: 60px;
}

.btn-bottom button{
    margin-left: 80px;
}
</style>