<template>
    <!----------------尚未完成---------------------------
        📣 確認鍵所連動的功能還沒寫好，都先暫放toggle
    🔹 tab 資料篩選filter
        想法:
        抓回來的資料filter or map 到另一個陣列，tab v-for篩選過的陣列 (注意點: 資料改動時，內容可否立即更新)   
    🔹 新增消息 
        確認鍵 資料驗證條件
        新增完資料後，表格框刪除資料，關掉表格畫面，彈出新增成功
    🔹 刪除消息(草稿)
    🔹 編輯消息
        上架 按下確認鍵的資料修改(不可有空值欄位)
        草稿 按下確認鍵的資料修改(連動資料本身)
        想法: 先清空表單內容，在把所有的資料新增上去
    🔹 提示彈窗加入
    ( 🔹 各狀態資料筆數顯示於下方)
    🔹 icon (放大鏡)
    🔹 上傳圖片的方法  (為了新增資料正常，先找幾張圖片新增到20.jpg)
    🔹 php放置位置? (後台的有放public嗎 目前我的php是在wwwroot)
    ------------------------------------------------------->
    <!------------------- 筆記
    點擊結果為點擊的內容
    1.按鈕click設定function，並帶參數 編輯 : (row.news_no)  | 刪除 (row)
    2. data新增屬性值 activeIndex:null,
    3-1 刪除函式:
                remove (index) { //草稿 -刪除資料(目前僅畫面上顯示刪除)
                this.dataDraft.splice(index, 1);
                },
    3-2 編輯函式: 
                activeDraftData(){
                return this.dataDraft.find(v=> v.news_no === this.activeIndex) ?? {}
                },
    --------------------->
    <!-- 
    1.移動專案到wwwroot、source tree更改(remove mark原本的，add引進新的((路徑)))
    2.connect books新增一個專題版本，更改連動的資料庫(名稱、路徑) connectG4.php
    3.wwwroot php新增list 小龜的跨域那一段
    4.新增
    // 測試本地資料庫 fetch
            // getFaqData(){
            //     fetch('http://localhost/list.php')
            //     .then(res=>res.json())
            //     .then(json=>{
            //         this.faqList = json;
            //     })
            // },
    5.調整資料結構與套件的資料顯示
    -->
    <!-- 
    目的: 新增資料    
    1. 新增資料function addFaqData 綁定按鈕
            addFaqData(){
                let xhr = new XMLHttpRequest();
                xhr.onload = function(){
                    let result = JSON.parse(xhr.responseText);
                    alert(result.msg);
                    // document.getElementById("btnReset").click();
                    // $id("btnReset").click();
                }
                xhr.open("post", "http://localhost/CGD103_PHP_class/project_books_formData/faq_insert.php", true);
                xhr.send(new FormData(document.getElementById("myForm")));
            },
    2. html Form夾要傳送的資料範圍
    3.有兩個新增資料的方法 project_books_formData(HTML5) 1.js(prod_insert.html) 2.php(此次用的方法) prod_insert.php
    4. 表單對應資料庫新增的欄位 方法有二 1.表單給name(要對照Php)  2.才俊fetch的方法(?)
    5.
     -->
     <!-- 編輯資料 function -->
     <!-- 刪除資料 function 
    1. 刪除資料function removeData 綁定按鈕
    2. removeData(){
        //彈出是否確認刪除彈窗
        //if (確認){
            執行刪除指令
        }else()
    }
    -->
    <div class="backstage-news" >
        <div class="backstage-content">
            <div class="btn-add">
                <button class="font-20 btn-blue" @click="newToggle">新增消息</button>
            </div>
            <div class="news-manager">
                <Tabs  type="card" :animated="false">
                    <TabPane class="scrollBar"  label="上架" >
                        <Table  stripe border :columns="columns" :data="dataOn" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text" v-if="editIndex === index" />
                                <span v-else>{{ row.news_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_last_edit="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_type="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ (row.news_type) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }" >
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else >{{ row.news_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text" v-if="editIndex === index" />
                                <span v-else>{{ row.news_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action="{ row }">
                                <div class="btn-box">
                                    <span class="icon material-symbols-outlined"  @click="editOnData(row.news_no)" >edit_square</span>
                                </div>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="草稿" >
                        <Table class="scrollBar" stripe border :columns="columns" :data="dataDraft" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_last_edit="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_last_edit }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_type="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ (row.news_type) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action="{ row  }">
                                <div class="btn-box">
                                    <Space :size="size">
                                        <span class="icon material-symbols-outlined"   @click="editDraftData(row.news_no)">edit_square</span>
                                        <span class="icon material-symbols-outlined"  @click="remove(row)">delete</span>
                                    </Space>
                                </div>
                            </template>
                        </Table>
                    </TabPane>
                    <TabPane label="下架" >
                        <Table class="scrollBar" stripe border :columns="columns" :data="dataOff" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_last_edit="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_time }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_type="{ row, index }">
                                <Input type="text" v-if="editIndex === index" />
                                <span v-else>{{ (row.news_type) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text"  v-if="editIndex === index" />
                                <span v-else>{{ row.news_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action="{ row }">
                                <div class="btn-box">
                                    <button class="btn-success"  @click="checkOffData(row.news_no)">查看</button>
                                </div>
                            </template>
                        </Table>
                    </TabPane>
                </Tabs>
            </div>
        </div>
    </div>
    <!-- style="display:none" -->
    <!--一張全新表單 -->
    <keep-alive>
        <form method="post" id="addNewsForm" enctype="multipart/form-data">
            <div class="popup " v-show="seenNew" >
                <div class="popup-head font-20">
                    <div class="news-no">
                        <span>公告編號</span>
                        <span name=""></span>
                    </div>
                    <div class="on-date">
                        <span class="date">發布時間</span>
                        <span class="date"></span>
                        <!-- <input type="text" name="news_time" id=""> -->
                    </div>
                    <div class="last-edit-date">
                        <span class="date">最後更新</span>
                        <span class="date"></span>
                        <!-- <input type="text" name="news_last_edit" id=""> -->
                    </div>
                </div>
                <div class="popup-content font-18">
                    <div class="popup-data">
                        <label for="">狀態
                            <select name="news_status" id="">
                                <option value="草稿">草稿</option>
                                <option value="上架">上架</option>
                                <option value="下架">下架</option>
                            </select>
                        </label>
                        <label for="">分類
                            <select name="news_type" id="">
                                <option value="重要">重要</option>
                                <option value="活動">活動</option>
                                <option value="其他">其他</option>
                            </select>
                        </label>
                    </div>
                    <div class="input-txt">
                        <div class="input-title">
                            <label for="">標題：
                                <Input name="news_title" placeholder="請輸入標題" clearable style="width: 500px" />
                            </label>
                        </div>
                        <div class="input-des">
                            <label for="">引文：
                                <Input name="news_text_start" clearable type="textarea" :rows="2" placeholder="前台標題敘述" style="width: 500px"/>
                            </label>
                        </div>
                        <div class="input-des">
                            <label for="">內文：
                                <Input name="news_text_middle" clearable type="textarea" :rows="4" placeholder="詳細內文(承)" style="width: 500px"/>
                            </label>
                        </div>
                        <div class="input-des">
                            <label for="">內文：
                                <Input name="news_text_trans" clearable type="textarea" :rows="4" placeholder="詳細內文(轉)" style="width: 500px"/>
                            </label>
                        </div>
                        <div class="input-des">
                            <label for="">結尾：
                                <Input name="news_text_end" clearable type="textarea" :rows="2" placeholder="請輸入內容" style="width: 500px"/>
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
                            <Input name="news_img_des" placeholder="請輸入圖片敘述" clearable style="width: 500px" />
                        </label>
                    </div>
                    <div class="popup-btn">
                        <button type="button" class="btn-blue_2nd" @click="newToggle">取消</button>
                        <button type="button" class="btn-blue" @click="addNewsData">確認</button>
                        <!-- 確認鍵功能待補，暫放toggle -->
                    </div>
                </div>
            </div>
        </form>
    </keep-alive>

    <!--串聯資料用表單(上架)可繼續上架、下架，無草稿-->
    <div class="popup on" v-show="seeOnData">
        <div class="popup-head font-20">
            <div class="news-no">
                <span>公告編號</span>
                <span >{{activeData.news_no}}</span>
            </div>
            <div class="on-date">
                <span class="date">發布時間</span>
                <span class="date">{{activeData.news_time}}</span>
            </div>
            <div class="last-edit-date">
                <span class="date">最後更新</span>
                <span class="date">{{activeData.news_last_edit}}</span>
            </div>
        </div>
        <div class="popup-content font-18">
            <div class="popup-data">
                <label for="">狀態
                    <select name="" id="" >
                        <option value="上架" >上架</option>
                        <option value="下架" >下架</option>
                    </select>
                </label>
                <label for="">分類
                    <select name="" id="">
                        <option value="重要">重要</option>
                        <option value="活動">活動</option>
                        <option value="其他">其他</option>
                    </select>
                </label>
            </div>
            <div class="input-txt">
                <div class="input-title">
                    <label for="">標題：
                        <Input v-model="activeData.news_title" clearable style="width: 500px" />
                    </label>
                </div>
                <div class="input-des">
                    <label for="">引文：
                        <Input v-model="activeData.news_text_start" clearable type="textarea" :rows="2" placeholder="前台標題敘述" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">內文：
                        <Input v-model="activeData.news_text_middle" clearable type="textarea" :rows="4" placeholder="詳細內文(承)" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">內文：
                        <Input v-model="activeData.news_text_trans" clearable type="textarea" :rows="4" placeholder="詳細內文(轉)" style="width: 500px"/>
                    </label>
                </div>
                <div class="input-des">
                    <label for="">結尾：
                        <Input v-model="activeData.news_text_end" clearable type="textarea" :rows="2" placeholder="請輸入內容" style="width: 500px"/>
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
                    <Input v-model="activeData.news_img_des" placeholder="請輸入圖片敘述" clearable style="width: 500px" />
                </label>
            </div>
            <div class="popup-btn">
                <button class="btn-blue_2nd" @click="editOnData">取消</button>
                <button class="btn-blue" @click="editOnData">確認</button>
                    <!-- 確認鍵功能待補，暫放toggle -->
            </div>
        </div>
    </div>

    <!--串聯資料用表單(草稿)可上架無下架 -->
    <keep-alive>
        <div class="popup used" v-show="seeDraftData">
            <div class="popup-head font-20">
                <div class="news-no">
                    <span>公告編號</span>
                    <span>{{activeDraftData.news_no}}</span>
                </div>
                <div class="on-date">
                    <span class="date">發布時間</span>
                    <span class="date">{{activeDraftData.news_time}}</span>
                </div>
                <div class="last-edit-date">
                    <span class="date">最後更新</span>
                    <span class="date">{{activeDraftData.news_last_edit}}</span>
                </div>
            </div>
            <div class="popup-content font-18">
                <div class="popup-data">
                    <label for="">狀態(必填)
                        <select name="" id="">
                            <option value="草稿">草稿</option>
                            <option value="上架">上架</option>
                        </select>
                    </label>
                    <label for="">分類
                        <select name="" id="">
                            <option value="重要">重要</option>
                            <option value="活動">活動</option>
                            <option value="其他">其他</option>
                        </select>
                    </label>
                </div>
                <div class="input-txt">
                    <div class="input-title">
                        <label for="">標題：
                            <Input v-model="activeDraftData.news_title" placeholder="請輸入標題" clearable style="width: 500px" />
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">引文：
                            <Input v-model="activeDraftData.news_text_start" clearable type="textarea" :rows="2" placeholder="前台標題敘述" style="width: 500px"/>
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">內文：
                            <Input v-model="activeDraftData.news_text_middle" clearable type="textarea" :rows="4" placeholder="詳細內文(承)" style="width: 500px"/>
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">內文：
                            <Input v-model="activeDraftData.news_text_trans" clearable type="textarea" :rows="4" placeholder="詳細內文(轉)" style="width: 500px"/>
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">結尾：
                            <Input v-model="activeDraftData.news_text_end" clearable type="textarea" :rows="2" placeholder="請輸入內容" style="width: 500px"/>
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
                        <Input v-model="activeDraftData.news_img_des"  placeholder="請輸入圖片敘述" clearable style="width: 500px" />
                    </label>
                </div>
                <div class="popup-btn">
                    <button class="btn-blue_2nd" @click="editDraftData">取消</button>
                    <button class="btn-blue" @click="editNewsData">確認</button>
                </div>
            </div>
        </div>
    </keep-alive>

    <!--串聯資料用表單(下架)查看(不可更改內容)，所以無取消鍵，確認僅為回到畫面 -->
    <div class="popup off" v-show="seeOffData">
            <div class="popup-head font-20">
                <div class="news-no">
                    <span>公告編號</span>
                    <span >{{activeOffData.news_no}}</span>
                </div>
                <div class="on-date">
                    <span class="date">發布時間</span>
                    <span class="date">{{activeOffData.news_time}}</span>
                </div>
                <div class="last-edit-date">
                    <span class="date">最後更新</span>
                    <span class="date">{{activeOffData.news_last_edit}}</span>
                </div>
            </div>
            <div class="popup-content font-18">
                <div class="popup-data">
                    <label for="">狀態
                        <select disabled name="" id="">
                            <option value="off">下架</option>
                        </select>
                    </label>
                    <label for="">分類
                        <select name="" id="" disabled>
                            <option value="important">重要</option>
                            <option value="action">活動</option>
                            <option value="other" >其他</option>
                        </select>
                    </label>
                </div>
                <div class="input-txt">
                    <div class="input-title">
                        <label for="">標題：
                            <Input disabled v-model="activeOffData.news_title" clearable style="width: 500px" />
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">引文：
                            <Input disabled v-model="activeOffData.news_text_start" clearable type="textarea" :rows="2" placeholder="前台標題敘述" style="width: 500px"/>
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">內文：
                            <Input disabled v-model="activeOffData.news_text_middle" clearable type="textarea" :rows="4" placeholder="詳細內文(承)" style="width: 500px"/>
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">內文：
                            <Input disabled v-model="activeOffData.news_text_trans" clearable type="textarea" :rows="4" placeholder="詳細內文(轉)" style="width: 500px"/>
                        </label>
                    </div>
                    <div class="input-des">
                        <label for="">結尾：
                            <Input disabled v-model="activeOffData.news_text_end" clearable type="textarea" :rows="2" placeholder="請輸入內容" style="width: 500px"/>
                        </label>
                    </div>
                </div>
                <div class="input-pic">
                    <label class="test" for="">插入圖片：
                        <input disabled type="file">
                    </label>
                </div>
                <div class="input-pic-des">
                    <label for="">圖片敘述：
                        <Input disabled v-model="activeOffData.news_img_des" placeholder="請輸入圖片敘述" clearable style="width: 500px" />
                    </label>
                </div>
                <div class="popup-btn">
                    <button @click="checkOffData" class="btn-blue">確認</button>
                </div>
            </div>
    </div>

    <!-- 新增成功 -->
    <!-- style="display:none" -->
    <div class="popup-box add font-18" v-show="seeCheck">
        <p class="popup-box-close">X</p>
        <p class="check-des">新增資料成功</p>
        <button @click="okToggle" class="btn-success">確認</button>
    </div>


    <!-- 修改成功 -->
    <div class="popup-box fix font-18" v-show="seeCheck" >
        <p class="popup-box-close">X</p>
        <p class="check-des">修改資料成功</p>
        <button @click="okToggle" class="btn-success">確認</button>
    </div>

</template>
<!-- https://run.iviewui.com/4CEEQf1j -->
<script>
    export default {
        data () {
            return {
                seenNew:false, //新表格彈窗，綁新表單v-show、按鈕@click="newToggle"
                seeOnData:false, //上架資料彈窗，綁上架資料v-show、編輯按鈕@click="editOnData"
                seeDraftData:false, //草稿資料彈窗，綁草稿資料v-show、編輯按鈕@click="editDraftData"
                seeOffData:false, //下架資料彈窗，綁下架資料v-show、編輯按鈕@click="checkOffData"
                seeCheck:false, //確認彈窗、v-show="seeCheck" 按鈕@click="okToggle"
                columns: [
            {
                title: '公告編號',
                slot: 'news_no',
                width: 100,
                align: 'center'
            },
            {
                title: '上架日期',
                slot: 'news_time',
                width: 110,
                align: 'center',
                "sortable": true // 排序
            },
            {
                title: '最後修改',
                slot: 'news_last_edit',
                width: 110,
                align: 'center',
                "sortable": true
            },
            {
                title: '分類',
                slot: 'news_type',
                width: 80,
                align: 'center',
                filters: [
                            {
                                label: '重要',
                                value: 1
                            },
                            {
                                label: '活動',
                                value: 2
                            },
                            {
                                label: '其他',
                                value: 3
                            }
                        ],
                        filterMultiple: false, //https://www.iviewui.com/view-ui-plus/component/form/table#Brief_Introduction
                        filterMethod (value,row) { 
                            if (value === 1) {
                                return row.news_type==='重要';
                            } else if (value === 2) {
                                return row.news_type==='活動' ;
                            }else if (value === 3) {
                                return row.news_type==='其他' ;
                            }
                        }
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
                    // {
                    //     news_no: '2022001',
                    //     news_time: '2022/12/01',
                    //     news_last_edit:'2022/12/01',
                    //     news_type: '重要',
                    //     news_title: '「JS 春季行程方案」報名開始',
                    //     news_text_start:'我們已經開始接受 2022 年 11 月至 2022 年 12 月發車的「JS 春季行程方案」...',
                    //     news_text_middle:'此次行程與活動請見網頁詳細介紹',
                    //     news_text_trans:'早鳥訂購優惠4人行響87折優惠。',
                    //     news_text_end:'還在猶豫什麼呢?',
                    //     news_img:'1.jpg',
                    //     news_img_des:'門司港夜景',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022002',
                    //     news_time: '2022/11/31',
                    //     news_last_edit:'2022/11/31',
                    //     news_type: '重要',
                    //     news_title: '列車停駛',
                    //     news_text_start:'因九州地區受台風3號 (台灣名稱 : 桃花颱風)影響，JS列車決定停駛...',
                    //     news_text_middle:'目前九州鐵路有多處毀損，鐵路公司正急速修復中。',
                    //     news_text_trans:'目前公司決策至12月15日前，鐵路列車停止營運。',
                    //     news_text_end:'詳細退票方式，請留意註冊信箱與電話，有專人通知，造成不便，敬請見諒',
                    //     news_img:'2.jpg',
                    //     news_img_des:'颱風路線圖',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022003',
                    //     news_time: '2022/11/15',
                    //     news_last_edit:'2022/11/15',
                    //     news_type: '活動',
                    //     news_title: '高千穗-夜神樂',
                    //     news_text_start:'高千穗知名祭典活動-夜神樂 ，將於今年的11月...',
                    //     news_text_middle:'內頁預設',
                    //     news_text_trans:'內頁預設',
                    //     news_text_end:'內頁預設',
                    //     news_img:'3.jpg',
                    //     news_img_des:'國有文化資產，傳統文藝-高千穗夜神樂',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022004',
                    //     news_time: '2022/08/01',
                    //     news_last_edit:'2022/08/01',
                    //     news_type: '其他',
                    //     news_title: '新商品上市-油封鬼頭刀',
                    //     news_text_start:'受大家喜愛名產-油封鬼頭刀，在JS線上商城上架囉! 線上輕鬆點選...',
                    //     news_text_middle:'商品詳情與內容請建商城分頁',
                    //     news_text_trans:'活動期間，享有免運優惠',
                    //     news_text_end:'趕快來購買吧!',
                    //     news_img:'4.jpg',
                    //     news_img_des:'商品圖',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022005',
                    //     news_time: '2022/06/01',
                    //     news_last_edit:'2022/06/01',
                    //     news_type: '活動',
                    //     news_title: '行程車票票根優惠!',
                    //     news_text_start:'深夜食堂，天神屋台老闆們的款待...',
                    //     news_text_middle:'台灣以夜市響譽國際，但你知道日本的夜市是如何嗎?',
                    //     news_text_trans:'屋台在福岡有著知名的特色，近期屋台的老闆們想讓九州屋台知名度更提升，因此推出許多的活動。',
                    //     news_text_end:'JS集團響應活動，與老闆們談了優惠的合作，只要拿著行程車票的票根，就能領取屋台老闆們神秘的清冰箱料理。',
                    //     news_img:'5.jpg',
                    //     news_img_des:'屋台人情味',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022006',
                    //     news_time: '2022/05/01',
                    //     news_last_edit:'2022/05/01',
                    //     news_type: '活動',
                    //     news_title: '「高千穗峽谷」划船體驗報名優惠',
                    //     news_text_start:'被日本政府列入「名勝」、「天然記念物」的高千穗峽谷，知名活動...',
                    //     news_text_middle:'徜徉大自然，峽谷一線天的感受，宛如置身電影情節。',
                    //     news_text_trans:'徐徐的涼風，清澈的流水，還有對的人。',
                    //     news_text_end:'一起來享受這美好的體驗吧。',
                    //     news_img:'6.jpg',
                    //     news_img_des:'划船體驗',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022007',
                    //     news_time: '2022/04/01',
                    //     news_last_edit:'2022/04/01',
                    //     news_type: '其他',
                    //     news_title: '商城新品上市-福岡名產 努努雞!!',
                    //     news_text_start:'受大家喜愛的博多名產-努努雞，在JS線上商城上架囉! 線上輕鬆點選...',
                    //     news_text_middle:'商品詳情與內容請建商城分頁',
                    //     news_text_trans:'活動期間，享有免運優惠',
                    //     news_text_end:'趕快來購買吧!',
                    //     news_img:'7.jpg',
                    //     news_img_des:'人氣伴手禮-努努雞',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022008',
                    //     news_time: '2022/03/01',
                    //     news_last_edit:'2022/03/01',
                    //     news_type: '其他',
                    //     news_title: '行程車票票根優惠!',
                    //     news_text_start:'JS旗下集團餐廳"唐寶寶"，唐戶河豚饗宴...',
                    //     news_text_middle:'唐戶市場為日本河豚最大的產地，而現在也正是季節。',
                    //     news_text_trans:'JS邀請您一起來享受吃起來沒什麼味道的河豚。',
                    //     news_text_end:'餐廳合作優惠6折起~',
                    //     news_img:'8.jpg',
                    //     news_img_des:'河豚三味',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022009',
                    //     news_time: '2022/02/01',
                    //     news_last_edit:'2022/02/01',
                    //     news_type: '活動',
                    //     news_title: '訂購夏季行程，豪斯登堡門票優惠',
                    //     news_text_start:'如何以最划算的價格，體驗九州行程?...',
                    //     news_text_middle:'即日起訂購夏季行程，活動為期半年。',
                    //     news_text_trans:'即可免費兌換豪斯登堡門票乙張。',
                    //     news_text_end:'贈送門票有限，儘請從速。',
                    //     news_img:'9.jpg',
                    //     news_img_des:'2日優惠JS-PASS',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: '2022010',
                    //     news_time: '2022/01/01',
                    //     news_last_edit:'2022/01/01',
                    //     news_type: '重要',
                    //     news_title: '列車停駛',
                    //     news_text_start:'阿蘇火山爆發，九州各地能見度低，塵埃影響...',
                    //     news_text_middle:'昨日深夜，九州居民想起了50年前的恐懼。',
                    //     news_text_trans:'阿蘇火山噴發，宛如龐貝惡夢。',
                    //     news_text_end:'老闆叫員工擦玻璃。JS列車停駛10日',
                    //     news_img:'10.jpg',
                    //     news_img_des:'阿蘇火山爆發',
                    //     news_status:'上架',
                    // },
                ],
                dataDraft: [
                    {
                        news_no: '2022011',
                        news_time: '',
                        news_last_edit:'2022/12/04',
                        news_type: '活動',
                        news_title: '支援熊本城，協助賑災',
                        news_text_start:'因受地震影響，知名古蹟熊本城倒塌，請支持購買娃娃協助熊本城重現風華...',
                        news_text_middle:'文案還沒寫',
                        news_text_trans:'文案還沒寫',
                        news_text_end:'文案還沒寫',
                        news_img:'11.jpg',
                        news_img_des:'熊本熊娃娃',
                        news_status:'草稿',
                    },
                    {
                        news_no: '2022012',
                        news_time: '',
                        news_last_edit:'2022/12/04',
                        news_type: '其他',
                        news_title: '呼子烏賊來囉!!',
                        news_text_start:'佐賀知名地產，呼子季節來到!...',
                        news_text_middle:'文案還沒寫',
                        news_text_trans:'文案還沒寫',
                        news_text_end:'文案還沒寫',
                        news_img:'12.jpg',
                        news_img_des:'呼子刺身',
                        news_status:'草稿',
                    },
                    {
                        news_no: '2022013',
                        news_time: '',
                        news_last_edit:'2022/12/04',
                        news_type: '重要',
                        news_title: 'JS夏季行程預告',
                        news_text_start:'標題還沒想好',
                        news_text_middle:'文案還沒寫',
                        news_text_trans:'文案還沒寫',
                        news_text_end:'文案還沒寫',
                        news_img:'',
                        news_img_des:'',
                        news_status:'草稿',
                    }
                ],
                dataOff: [
                    {
                        news_no: '2022014',
                        news_time: '2021/12/01',
                        news_last_edit:'2022/04/03',
                        news_type: '其他',
                        news_title: 'JS合作優惠!',
                        news_text_start:'乘著JS，大啖九州美食!憑車票票根...',
                        news_text_middle:'來到九州，怎能不吃當地的美食?',
                        news_text_trans:'九州知名的琉球丼，憑著JS票根，即可下飛機之後，在福岡天神地下街，JJJ食堂兌換免費的琉球丼一碗。',
                        news_text_end:'限量500份。',
                        news_img:'13.jpg',
                        news_img_des:'琉球丼',
                        news_status:'下架',
                    },
                    {
                        news_no: '2022015',
                        news_time: '2021/11/01',
                        news_last_edit:'2022/04/03',
                        news_type: '活動',
                        news_title: '國境之南，蒸氣料理體驗',
                        news_text_start:'火山著名的南九州，有著特色的蒸氣料理方式....',
                        news_text_middle:'憑著JS車票票根，可至以下區域免費體驗蒸氣料理行程。',
                        news_text_trans:'大分地獄溫泉、鹿兒島指宿。',
                        news_text_end:'如果擔心不會操作，會有專門美女店員協助服務。',
                        news_img:'14.jpg',
                        news_img_des:'蒸氣料理',
                        news_status:'下架',
                    },
                    {
                        news_no: '2022016',
                        news_time: '2021/10/10',
                        news_last_edit:'2021/12/11',
                        news_type: '重要',
                        news_title: '行程更改公告',
                        news_text_start:'因最近政治因素，配合政府政策，軍艦島....',
                        news_text_middle:'近期戰爭因素導致國際情勢惡化，為了避免增加恐懼與不安氣氛，政府宣布容易引起不安情緒的景點關閉。',
                        news_text_trans:'直到戰爭結束。',
                        news_text_end:'行程將會配合政策，更改到可愛的貓島，讓大家看可愛的貓咪。',
                        news_img:'15.jpg',
                        news_img_des:'軍艦島',
                        news_status:'下架',
                    },
                    {
                        news_no: '2022017',
                        news_time: '2021/09/05',
                        news_last_edit:'2021/11/05',
                        news_type: '活動',
                        news_title: '探訪篤姬，體驗時代工藝',
                        news_text_start:'日劇-篤姬深受民受喜愛，相信對裡面的工藝器具大家也都不陌生...',
                        news_text_middle:'神奇的玻璃工藝。',
                        news_text_trans:'適合當你家的水果盤。',
                        news_text_end:'趕快來體驗把他帶回家吧。',
                        news_img:'16.jpg',
                        news_img_des:'美麗的切子',
                        news_status:'下架',
                    }
                ],
                // dataDraft:[],
                // daraOff:[],
                editIndex: -1,  // 当前聚焦的输入框的行数
                activeIndex:null,
                }
            },
            methods: {
            // 測試本地資料庫 fetch
            // getFaqData(){
            //     fetch('http://localhost/list.php')
            //     .then(res=>res.json())
            //     .then(json=>{
            //         console.log(4);
            //         console.log(this);
            //         this.dataOn = json;
            //     })
            // },
            getNews(){
			//取得商品資料 XML方法
			    let xhr = new XMLHttpRequest();
                let data = this;
			    xhr.onload = function(){
				    if(xhr.status == 200){ //OK
					    data.dataOn = JSON.parse(xhr.responseText);
				    }
			    }
			    xhr.open("get",'http://localhost/list.php', true);
			    xhr.send(null);
		    },
            // 新增資料 xhr
            addNewsData(){
                let xhr = new XMLHttpRequest();
                xhr.onload = function(){
                let result = JSON.parse(xhr.responseText);
                alert(result.msg);
                // document.getElementById("btnReset").click();
                // $id("btnReset").click();
                }
                xhr.open("post", "http://localhost/news_insert.php", true);
                xhr.send(new FormData(document.getElementById("addNewsForm")));
            },
            // 修改資料 fetch
            editNewsData(){
                fetch('http://localhost/news_update.php',{
                method:'POST', body:new URLSearchParams({
                // faq_no:this.editingFaq.faq_no,
                // faq_type:this.editingFaq.faq_type,
                // faq_q:this.editingFaq.faq_q,
                // faq_a:this.editingFaq.faq_a,
                // faq_status:this.editingFaq.faq_status,

                // news_no:this.news_no // 不給更新?要寫嗎
                // news_time:this.news_time //不給更新?
                // news_last_edit:this.news_last_edit
                // news_type:this.news_type
                // news_title:this.news_title
                // news_text_start:this.news_text_start
                // news_text_middle:this.news_text_middle
                // news_text_trans:this.news_text_trans
                // news_text_end:this.news_text_end
                // news_img:this.news_img  //圖片狀況先不考慮
                // news_img_des:this.news_img_des
                // news_status:this.news_status
                })})
                .then((res) => res.json())
                .then((result)=> { //下面這段求解釋
                // this.alert_Loading = true;
                // setTimeout(() => {
                //     this.alert_Loading = false;
                //     this.show_EditForm = false;
                //     this.$Message.success(result.msg);
                // }, 600);
                })
            },
            // 刪除資料
            delNewsData(){
                fetch('http://localhost/news_delete.php',{
                    method:'POST', body:new URLSearchParams({
                    news_no:this.deleteNo,
                })})
                .then((res) => res.json())
                .then((result)=> { //以下待求解
                    this.alert_Loading = true;
                    setTimeout(() => {
                        this.activeList.splice(this.rowCount, 1);
                        this.alert_Loading = false;
                        this.show_delCheck = false;
                        this.$Message.success(result.msg);
                    }, 600);
                })
            },
            newToggle(){ //新表單
                this.seenNew = !this.seenNew
            },
            editOnData(no){ //上架編輯表單彈窗
                this.seeOnData = !this.seeOnData;
                this.activeIndex = no;
            },
            editDraftData(no){ //草稿編輯表單彈窗
                this.seeDraftData = !this.seeDraftData
                this.activeIndex = no;
            },
            checkOffData(no){ //下架資料彈窗
                this.seeOffData = !this.seeOffData
                this.activeIndex = no;
            },
            remove (index) { //草稿 -刪除資料(目前僅畫面上顯示刪除)
            this.dataDraft.splice(index, 1);
            },
            okToggle () { //確認彈窗
                this.seeCheck = !this.seeCheck
            }
        },
        computed:{
            activeData() {
                return this.dataOn.find(v=> v.news_no === this.activeIndex) ?? {}
            },
            activeDraftData(){
                return this.dataDraft.find(v=> v.news_no === this.activeIndex) ?? {}
            },
            activeOffData(){
                return this.dataOff.find(v=> v.news_no === this.activeIndex) ?? {}
            }
        },
        created(){
            this.getNews();
        },
        mounted(){
        // this.getNews();
    },
    }
</script>

<style scoped lang="scss">
@import "../assets/Scss/components/scrollBar.scss";
/* -------------------彈窗 ------------------------*/
.popup{
    position: absolute;
    top: 5px;
    left: 150px;
    margin: auto;
    z-index: 20;

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




/* 新增按鈕 */
.btn-add{
    text-align: end;
    margin-right: 60px;
}
.btn-add button{
    padding: 8px 16px;

}
/* 確認彈窗按鈕 */
.popup-box .btn-success{
    padding: 8px 32px;
}

/* 確認彈窗文字 */
.popup-box .check-des{
    translate:0 -16px ;
}
// class名稱
// .btn-blue        按鈕:藍色
// .btn-blue_2nd    按鈕:白底藍框
// .btn-gold        按鈕:土色
// .btn-gold_2nd    按鈕:白底土框
// .btn-success     按鈕:綠色
// .btn-success_2nd 按鈕:白底綠框
// .btn-danger      按鈕:紅色
// .btn-danger_2nd  按鈕:白底紅框


</style>