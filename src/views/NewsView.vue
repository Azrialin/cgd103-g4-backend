<template>
<!---------------------use case------------------------
<div>
🔹 新增消息 
    "新增消息"，"取消"toggle 新增表格彈窗    ✔
🔹 編輯消息
🔹 刪除消息
🔹 上下頁
🔹 各狀態資料筆數顯示於下方
🔹 排序filter
</div>
------------------------------------------------------->

    <div class="backstage-news" >
        <div class="backstage-name">
            <div>
                <h2 class="font-36" >最新消息管理</h2>
            </div>
            <div class="backstage-account">
                <span class="font-18">管理員名稱</span>
                <span class="font-18">登出</span>
            </div>
        </div>
        <div class="backstage-content">
            <div class="backstage-path font-16">最新消息管理 / 消息列表</div>
            <div class="btn-add">
                <button class="font-20" @click="newToggle">新增消息</button>
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
                            <template #news_last_edit="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
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
                                <!-- <div v-if="editIndex === index">
                                    <Button @click="handleSave(index)">保存</Button>
                                    <Button @click="editIndex = -1">取消</Button>
                                </div> -->
                                <!-- <div v-else>
                                    <Button @click="handleEdit(row, index)">操作</Button>
                                </div> -->
                                <div class="btn-box">
                                    <Button >編輯</Button>
                                    <Button >刪除</Button>
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
                            <template #news_last_edit="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
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
                                <!-- <div v-if="editIndex === index">
                                    <Button @click="handleSave(index)">保存</Button>
                                    <Button @click="editIndex = -1">取消</Button>
                                </div> -->
                                <!-- <div v-else>
                                    <Button @click="handleEdit(row, index)">操作</Button>
                                </div> -->
                                <div class="btn-box">
                                    <Button >編輯</Button>
                                    <Button >刪除</Button>
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
                            <template #news_last_edit="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
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
                                <!-- <div v-if="editIndex === index">
                                    <Button @click="handleSave(index)">保存</Button>
                                    <Button @click="editIndex = -1">取消</Button>
                                </div> -->
                                <!-- <div v-else>
                                    <Button @click="handleEdit(row, index)">操作</Button>
                                </div> -->
                                <div class="btn-box">
                                    <Button >編輯</Button>
                                    <Button >刪除</Button>
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
    <!-- style="display:none" -->
    <!--一張全新表單 -->
    <div class="popup " v-show="seenNew" >
        <div class="popup-head font-20">
            <div class="news-no">
                <span>公告編號</span>
                <span></span>
            </div>
            <div class="on-date">
                <span class="date">發布時間</span>
                <span class="date"></span>
            </div>
            <div class="last-edit-date">
                <span class="date">最後更新</span>
                <span class="date"></span>
            </div>
        </div>
        <div class="popup-content font-18">
            <div class="popup-data">
                <label for="">狀態(必填)
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

            </div>
            <div class="input-txt">
                <div class="input-title">
                    <label for="">標題：
                        <Input placeholder="請輸入標題" clearable style="width: 500px" />
                    </label>
                </div>
                <div class="input-des">
                    <label for="">引文：
                        <Input clearable type="textarea" :rows="2" placeholder="前台標題敘述" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">內文：
                        <Input clearable type="textarea" :rows="4" placeholder="詳細內文(承)" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">內文：
                        <Input clearable type="textarea" :rows="4" placeholder="詳細內文(轉)" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">結尾：
                        <Input clearable type="textarea" :rows="2" placeholder="請輸入內容" style="width: 500px"/>
                    </label>
                </div>
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
                <button @click="newToggle">取消</button>
                <button>確認</button>
            </div>
        </div>
    </div>

    <!--串聯資料用表單 -->
    <div class="popup used" style="display:none" >
        <div class="popup-head font-20">
            <div class="news-no">
                <span>公告編號</span>
                <span>A110000</span>
            </div>
            <div class="on-date">
                <span class="date">發布時間</span>
                <span class="date">20221120</span>
            </div>
            <div class="last-edit-date">
                <span class="date">最後更新</span>
                <span class="date">20221120</span>
            </div>
        </div>
        <div class="popup-content font-18">
            <div class="popup-data">
                <label for="">狀態(必填)
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

            </div>
            <div class="input-txt">
                <div class="input-title">
                    <label for="">標題：
                        <Input placeholder="請輸入標題" clearable style="width: 500px" />
                    </label>
                </div>
                <div class="input-des">
                    <label for="">引文：
                        <Input clearable type="textarea" :rows="2" placeholder="前台標題敘述" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">內文：
                        <Input clearable type="textarea" :rows="4" placeholder="詳細內文(承)" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">內文：
                        <Input clearable type="textarea" :rows="4" placeholder="詳細內文(轉)" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">結尾：
                        <Input clearable type="textarea" :rows="2" placeholder="請輸入內容" style="width: 500px"/>
                    </label>
                </div>
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
    <div class="popup-box add font-18" style="display:none">
        <p class="popup-box-close">X</p>
        <p class="check-des">新增資料成功</p>
        <button >確認</button>
    </div>


    <!-- 修改成功 -->
    <div class="popup-box fix font-18" style="display:none">
        <p class="popup-box-close">X</p>
        <p class="check-des">修改資料成功</p>
        <button >確認</button>
    </div>

</template>
<!-- https://run.iviewui.com/4CEEQf1j -->
<script>
    export default {
        data () {
            return {
                seenNew:false,
                columns: [
            {
                title: '公告標題',
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
                title: '最後修改',
                slot: 'news_last_edit',
                width: 110,
                align: 'center'
            },
            {
                title: '分類',
                slot: 'news_class',
                width: 70,
                align: 'center'
            },
            {
                title: '標題',
                slot: 'news_title',
                align: 'center'
            },
            {
                title: '狀態',
                slot: 'news_status',
                width: 70,
                align: 'center'
            },
            {
                title: '操作',
                slot: 'action',
                width: 180,
                align: 'center'
            }
                ],
                dataOn: [
                    {
                        news_no: 'A1100000',
                        news_time: '2022/11/22',
                        news_last_edit:'',
                        news_class: '重要',
                        news_title: '「高千穗峽谷」划船體驗報名優惠',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100001',
                        news_time: '2022/11/23',
                        news_last_edit:'',
                        news_class: '重要',
                        news_title: '高千穗-夜神樂',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100002',
                        news_time: '2022/11/24',
                        news_last_edit:'',
                        news_class: '重要',
                        news_title: '列車停駛',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100003',
                        news_time: '2022/11/25',
                        news_last_edit:'',
                        news_class: '重要',
                        news_title: '「鹿兒島沙浴」體驗活動報名',
                        news_status:'上架',
                    },
                    {
                        news_no: 'A1100004',
                        news_time: '2022/11/26',
                        news_last_edit:'',
                        news_class: '重要',
                        news_title: '商城新品上市!!',
                        news_status:'上架',
                    }
                ],
                dataDraft: [
                    {
                        news_no: 'A1100005',
                        news_time: '2022/11/23',
                        news_last_edit:'',
                        news_class: '其他',
                        news_title: '高千穗-夜神樂',
                        news_status:'草稿',
                    },
                    {
                        news_no: 'A1100006',
                        news_time: '2022/11/24',
                        news_last_edit:'',
                        news_class: '活動',
                        news_title: '列車停駛',
                        news_status:'草稿',
                    }
                ],
                dataOff: [
                    {
                        news_no: 'A1100007',
                        news_time: '2022/11/25',
                        news_last_edit:'',
                        news_class: '其他',
                        news_title: '「鹿兒島沙浴」體驗活動報名',
                        news_status:'下架',
                    },
                    {
                        news_no: 'A1100008',
                        news_time: '2022/11/26',
                        news_last_edit:'',
                        news_class: '活動',
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
                }
            },
            methods: {
            newToggle(){
                this.seenNew = !this.seenNew
            },
            handleEdit (row, index) {
                this.editnews_no = row.news_no;
                this.editnews_time = row.news_time;
                this.editnews_title = row.news_title;
                this.editnews_class = row.news_class;
                this.editnews_status = row.news_status;
                this.editIndex = index;
            },
            handleSave (index) {
                this.data[index].news_no = this.editnews_no;
                this.data[index].news_time = this.editnews_time;
                this.data[index].news_class = this.editnews_class;
                this.data[index].news_title = this.editnews_title;
                this.data[index].news_status = this.editnews_status;
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