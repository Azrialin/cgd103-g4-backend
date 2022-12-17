<template>
    <!-- style="display:none" -->
    <div class="backstage-news" >
        <div class="backstage-content">
            <div class="news-manager">
                <div class="popup on" v-show="seeOnData">
                    <div class="popup-head font-20">編輯方案</div>
                    <div class="popup-content font-18">
                        <div class="input-txt">
                            <div class="input-title">
                                <label for="">開團編號：
                                    <Input v-model="activeData.news_no" clearable style="width: 300px" disabled/>
                                </label>
                            </div>
                            <div class="input-title">
                                <label for="">方案編號:
                                    <Input v-model="activeData.news_session" clearable style="width: 300px" disabled/>
                                </label>
                            </div>
                            <div class="input-title">
                                <label for="">出發日期:
                                    <DatePicker type="date" placeholder="Edit date" style="width: 300px" />
                                </label>
                            </div>
                            <div class="input-title">
                                <label for="">行程價格：
                                <Input v-model="activeData.news_price" clearable style="width: 300px"/>
                                </label>
                            </div>
                            <div class="input-title">
                                <label for="">人數上限：
                                <Input type="number" number="true" v-model="activeData.news_title" style="width: 300px"/>
                                </label>
                            </div>
                            <div class="input-title">
                                <label for="">開放報名時間：
                                    <DatePicker type="date" placeholder="Edit date" style="width: 300px" />
                                </label>
                            </div>
                            <div class="input-title">
                                <label for="">截止報名時間:
                                    <DatePicker type="date" placeholder="Edit date" style="width: 300px" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="popup-btn">
                        <button class="btn-blue_2nd" @click="editOnData">取消</button>
                        <button class="btn-blue" @click="editOnData">確認</button>
                        <!-- 確認鍵功能待補，暫放toggle -->
                    </div>
                </div>
                <Tabs  type="card" :animated="false">
                    <TabPane label="會員訂單查詢" >
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
                            <template #news_price="{ row, index }">
                                <Input type="text" v-model="editnews_price" v-if="editIndex === index" />
                                <span v-else>{{ row.news_price }}</span>
                            </template>
                            <template #news_number="{ row, index }">
                                <Input type="text" v-model="editnews_number" v-if="editIndex === index" />
                                <span v-else>{{ row.news_number }}</span>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="方案A" >
                        <Table stripe border :columns="others" :data="dataB" >
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
                                <Button @click="editOnData(row.news_no)">編輯</Button>
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
                            <template #news_price="{ row, index }">
                                <Input type="text" v-model="editnews_price" v-if="editIndex === index" />
                                <span v-else>{{ row.news_price }}</span>
                            </template>
                            <template #news_number="{ row, index }">
                                <Input type="text" v-model="editnews_number" v-if="editIndex === index" />
                                <span v-else>{{ row.news_number }}</span>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="方案B" >
                        <Table stripe border :columns="others" :data="dataB" >
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
                                <Button @click="editOnData(row.news_no)">編輯</Button>
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
                            <template #news_price="{ row, index }">
                                <Input type="text" v-model="editnews_price" v-if="editIndex === index" />
                                <span v-else>{{ row.news_price }}</span>
                            </template>
                            <template #news_number="{ row, index }">
                                <Input type="text" v-model="editnews_number" v-if="editIndex === index" />
                                <span v-else>{{ row.news_number }}</span>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="方案C" >
                        <Table stripe border :columns="others" :data="dataC" >
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
                            <template #news_class="{ row }">
                                <Button @click="editOnData(row.news_no)">編輯</Button>
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
                            <template #news_price="{ row, index }">
                                <Input type="text" v-model="editnews_price" v-if="editIndex === index" />
                                <span v-else>{{ row.news_price }}</span>
                            </template>
                            <template #news_number="{ row, index }">
                                <Input type="text" v-model="editnews_number" v-if="editIndex === index" />
                                <span v-else>{{ row.news_number }}</span>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="方案D" >
                        <Table stripe border :columns="others" :data="dataD" >
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
                                <Button @click="editOnData(row.news_no)">編輯</Button>
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
                            <template #news_price="{ row, index }">
                                <Input type="text" v-model="editnews_price" v-if="editIndex === index" />
                                <span v-else>{{ row.news_price }}</span>
                            </template>
                            <template #news_number="{ row, index }">
                                <Input type="text" v-model="editnews_number" v-if="editIndex === index" />
                                <span v-else>{{ row.news_number }}</span>
                            </template>
                        </Table>
                    </TabPane>
                </Tabs>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                seeOnData: false,
                // 分頁的
                others: [
                    
            {
                title: '開團編號',
                slot: 'news_session',
                width: 120,
                align: 'center'
            },
            {
                title: '方案編號',
                slot: 'news_no',
                width: 120,
                align: 'center'
            },
            {
                title: '出發日期',
                slot: 'news_time',
                width: 150,
                align: 'center'
            },
            {
                title: '行程價格',
                slot: 'news_price',
                width: 150,
                align: 'center'
            },
            {
                title: '人數上限',
                slot: 'news_title',
                width: 150,
                align: 'center'
            },
            {
                title: '開放報名日期',
                slot: 'news_number',
                width: 160,
                align: 'center'
            },
            {
                title: '截止報名日期',
                slot: 'news_status',
                width: 160,
                align: 'center'
            },
            {
                title: '編輯',
                slot: 'news_class',
                align: 'center'
            },
                ],
                // 主頁的
                columns: [
                    
            {
                title: '行程訂單編號',
                slot: 'news_session',
                width: 160,
                align: 'center'
            },
            {
                title: '方案編號',
                slot: 'news_no',
                width: 130,
                align: 'center'
            },
            {
                title: '預約會員編號',
                slot: 'news_class',
                width: 130,
                align: 'center'
            },
            {
                title: '會員姓名',
                slot: 'news_title',
                align: 'center'
            },
            {
                title: '行程下訂日期',
                slot: 'news_time',
                width: 160,
                align: 'center'
            },
            {
                title: '訂單金額',
                slot: 'news_price',
                width: 160,
                align: 'center'
            },
            {
                title: '票券購買數量',
                slot: 'news_number',
                width: 130,
                align: 'center'
            },
            {
                title: '付款狀態',
                slot: 'news_status',
                width: 130,
                align: 'center'
            },
                ],
                dataOn: [
                    {
                        news_no: 'A1100001',
                        news_time: '2022/11/22',
                        news_session:'2352',
                        news_class: '123456',
                        news_title: '臣土產',
                        news_status:'已付款',
                        news_price:'699',
                        news_number:'20',

                    },
                    {
                        news_no: 'A1100002',
                        news_time: '2022/11/23',
                        news_session:'2353',
                        news_class: '123456',
                        news_title: '臣土產',
                        news_status:'已付款',
                        news_price:'699',
                        news_number:'20',

                    },
                    {
                        news_no: 'A1100003',
                        news_time: '2022/11/24',
                        news_session:'2354',
                        news_class: '123456',
                        news_title: '臣土產',
                        news_status:'已付款',
                        news_price:'699',
                        news_number:'20',

                    },
                    {
                        news_no: 'A1100004',
                        news_time: '2022/11/25',
                        news_session:'2355',
                        news_class: '123456',
                        news_title: '臣土產',
                        news_status:'已付款',
                        news_price:'699',
                        news_number:'20',

                    },
                ],
                dataA: [
                    {
                        news_no: 'A1100005',
                        news_time: '2022/11/23',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '20',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    },
                    {
                        news_no: 'A1100006',
                        news_time: '2022/11/24',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '20',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    }
                ],
                dataB: [
                    {
                        news_no: 'A1100007',
                        news_time: '2022/11/25',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '30',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    },
                    {
                        news_no: 'A1100008',
                        news_time: '2022/11/26',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '20',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    }
                ],
                dataC: [
                    {
                        news_no: 'A1100007',
                        news_time: '2022/11/25',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '10',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    },
                    {
                        news_no: 'A1100008',
                        news_time: '2022/11/26',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '20',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    },
                    {
                        news_no: 'A1100009',
                        news_time: '2022/11/26',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '40',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    }
                ],
                dataD: [
                    {
                        news_no: 'A1100007',
                        news_time: '2022/11/25',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '20',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    },
                    {
                        news_no: 'A1100008',
                        news_time: '2022/11/26',
                        news_session:'2352',
                        news_class: '火車佐便當',
                        news_title: '20',
                        news_status:'2022/12/27',
                        news_price:'699',
                        news_number:'2022/12/27',
                    }
                ],
                editIndex: -1,  // 当前聚焦的输入框的行数
                editnews_no: '',  // 第一列输入框，当然聚焦的输入框的输入内容，与 data 分离避免重构的闪烁
                editnews_time: '',  // 第二列输入框
                editnews_class: '',  // 第三列输入框
                editnews_title: '',  // 第四列输入框
                editnews_status: '',
                editnews_session: '',
                editnews_price: '',
                editnews_number: '',
                activeIndex: null,
                activeIndexb: null,
                }
            },
            methods: {
                editOnData(no) {
                //上架編輯表單彈窗
                this.seeOnData = !this.seeOnData;
                this.activeIndex = no;
                },
                okToggle() {
                //確認彈窗
                this.seeCheck = !this.seeCheck;
                },
                handleEdit (row, index) {
                    this.editnews_no = row.news_no;
                    this.editnews_time = row.news_time;
                    this.editnews_title = row.news_title;
                    this.editnews_class = row.news_class;
                    this.editnews_status = row.news_status;
                    this.editnews_session = row.news_session;
                    this.editnews_price = row.news_price;
                    this.editnews_number = row.news_number;
                    this.editIndex = index;
                },
                handleSave (index) {
                    this.data[index].news_no = this.editnews_no;
                    this.data[index].news_time = this.editnews_time;
                    this.data[index].news_class = this.editnews_class;
                    this.data[index].news_title = this.editnews_title;
                    this.data[index].news_status = this.editnews_status;
                    this.data[index].news_session = this.editnews_session;
                    this.data[index].news_price = this.editnews_price;
                    this.data[index].news_number = this.editnews_number;
                    this.editIndex = -1;
                }
            },
            computed: {
                activeData() {
                    return this.dataA.find((v) => v.news_no === this.activeIndex) ?? {};
                },
                activeData() {
                    return this.dataB.find((v) => v.news_no === this.activeIndex) ?? {};
                },
                activeData() {
                    return this.dataC.find((v) => v.news_no === this.activeIndex) ?? {};
                },
                activeData() {
                    return this.dataD.find((v) => v.news_no === this.activeIndex) ?? {};
                },
            },
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