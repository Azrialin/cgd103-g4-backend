<template>
    <div class="popup" v-show="seenAdd" >
        <div class="popup-head font-20">編輯資料</div>
        <div class="popup-content font-18">
          <div class="input-txt">
              <div class="input-info">
                  <label for="">前台區塊：
                      <Input type="text" clearable style="width: 200px" />
                  </label>
              </div>
              <div class="input-info">
                  <label for="">方案編號：
                      <Input type="text" clearable  style="width: 200px"/>
                  </label>
              </div>
              <div class="input-info">
                  <label for="">上架日期：
                      <Input type="" clearable  style="width: 200px"/>
                  </label>
              </div>
              <div class="input-info">
                  <label for="">標題：
                      <Input type="email" clearable  style="width: 200px"/>
                  </label>
              </div>
              <div class="input-info">
                  <label for="">推薦商品：
                      <Input type="tel" clearable  style="width: 200px"/>
                  </label>
              </div>
              <div class="input-info">
                  <label for="">狀態：
                      <Input type="tel" clearable  style="width: 200px"/>
                  </label>
              </div>
          </div>
        </div> 
        <div class="popup-btn">
            <!-- <Button type="primary">新增帳號</Button> -->
            <Button @click="seenAdd=false">返回</Button>
        </div>
    </div>

    <div class="backstage-newss" v-show="addnew" >
        <form method="post" enctype="multipart/form-data">
        <div class="container" @click.self="dbcheck">
            <div class="content">
                <div class="type opencode">
                    <p class="nncode font-20">方案編號 A110000</p>
                </div>
                <div class="type travelcode">
                    <p class="nname">狀態 :</p>
                    <div class="choose">
                        <select class="choosein" name="package_status" v-model="selected">
                            <option value="" disabled>-請選擇-</option>
                            <option value="0">上架</option>
                            <option value="1">草稿</option>
                            <option value="2">下架</option>
                        </select>
                    </div>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">前台位置 :</p>
                    <div class="choose">
                        <select class="choosein" v-model="selected2">
                            <option value="" disabled>-請選擇-</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                
                <div class="type travelcode">
                    <p class="nname">推薦特產 :</p>
                    <div class="success">
                        <Input class="succe" type="text" v-model="value1" style="width: 300px" placeholder="第一項"/>
                        <Input class="succe" type="text" v-model="value2" style="width: 300px" placeholder="第二項"/>
                        <Input class="succe" type="text" v-model="value3" style="width: 300px" placeholder="第三項"/>
                    </div>
                </div>
                <div class="title2 font-18">方案列表區圖文設定 :</div>
                <div class="type travelcode">
                    <p class="nname">標題(必填) :</p>
                    <Input class="succe" type="text" name="package_title" v-model="value4" style="width: 300px" />
                </div>
                <div class="type travelcode">
                    <p class="nname">副標題(必填) :</p>
                    <Input class="succe" type="text" name="package_name" v-model="value5" style="width: 300px" />
                </div>
                <div class="type travelcode">
                    <p class="nname">介紹頁內文(必填) :</p>
                    <Form :model="formItem">
                        <FormItem label="Text">
                            <Input name="package_des" v-model="formItem.textarea" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." style="width: 300px"></Input>
                        </FormItem>
                    </Form>
                </div>
                <div class="type travelcode">
                    <p class="nname">詳情頁內文(必填) :</p>
                    <Form :model="formItem2">
                        <FormItem label="Text">
                            <Input name="travel_paper" v-model="formItem2.textarea2" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." style="width: 300px"></Input>
                        </FormItem>
                    </Form>
                </div>
                <div class="type travelcode">
                    <p class="nname">價格 :</p>
                    <Input class="succe" type="text" name="package_price" v-model="value6" style="width: 300px" />
                </div>
                <div class="type travelcode">
                    <p class="nname">插入圖片 :</p>
                    <Upload class="succe" action="//jsonplaceholder.typicode.com/posts/">
                        <Button icon="ios-cloud-upload-outline">Upload files</Button>
                    </Upload>
                </div>
                <div class="delcan">
                    <div class="shure">取消</div>
                    <div class="shure" @click="addData">確認</div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="backstage-news" >
        <div class="backstage-content">
            <div class="btn-add">
                <button class="font-20 btn-blue" @click="addnew=!addnew">新增方案</button>
            </div>
            <div class="news-manager">
                <Tabs  type="card" :animated="false">
                    <TabPane label="上架" >
                        <Table stripe border :columns="columns" :data="dataOn" >
                            <!-- 公告編號 -->
                            <template #news_no="{ row, index }">
                                <Input type="text" v-model="editnews_no" v-if="editIndex === index" />
                                <span v-else>{{ row.package_no }}</span>
                            </template>
                            <!-- 上架日期 -->
                            <template #news_time="{ row, index }">
                                <Input type="text" v-model="editnews_time" v-if="editIndex === index" />
                                <span v-else>{{ row.package_create_date }}</span>
                            </template>
                            <!-- 最後編輯 -->
                            <template #news_session="{ row, index }">
                                <Input type="text" v-model="editIndex_session" v-if="editIndex === index" />
                                <span v-else>{{ row.package_price }}</span>
                            </template>
                            <!-- 分類 -->
                            <template #news_class="{ row, index }">
                                <Input type="text" v-model="editnews_class" v-if="editIndex === index" />
                                <span v-else>{{ (row.package_des) }}</span>
                            </template>
                            <!-- 標題 -->
                            <template #news_title="{ row, index }">
                                <Input type="text" v-model="editnews_title" v-if="editIndex === index" />
                                <span v-else>{{ row.package_title }}</span>
                            </template>
                            <!-- 狀態 -->
                            <template #news_status="{ row, index }">
                                <Input type="text" v-model="editnews_status" v-if="editIndex === index" />
                                <span v-else>{{ row.package_status }}</span>
                            </template>
                            <!-- 按鈕 -->
                            <template #action>
                                <div class="btn-box">
                                    <Button @click="seenAdd=!seenAdd">編輯</Button>
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
                                    <Button @click="seenAdd=!seenAdd">編輯</Button>
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
                                    <Button @click="seenAdd=!seenAdd">編輯</Button>
                                </div>
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
                seenAdd:false,
                selected:"",
                selected2:"",
                value:"",
                value2:"",
                value3:"",
                value4:"",
                value5:"",
                value6:"",
                formItem: {
                    textarea: '',
                },
                formItem2: {
                    textarea2: '',
                },
                addnew: false,
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
                    // {
                    //     news_no: 'A1100001',
                    //     news_time: '2022/11/22',
                    //     news_session:'A',
                    //     news_class: '火車佐便當',
                    //     news_title: '「高千穗峽谷」划船體驗報名優惠',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: 'A1100002',
                    //     news_time: '2022/11/23',
                    //     news_session:'B',
                    //     news_class: '火車佐便當',
                    //     news_title: '高千穗-夜神樂',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: 'A1100003',
                    //     news_time: '2022/11/24',
                    //     news_session:'C',
                    //     news_class: '火車佐便當',
                    //     news_title: '「高千穗峽谷」划船體驗報名優惠',
                    //     news_status:'上架',
                    // },
                    // {
                    //     news_no: 'A1100004',
                    //     news_time: '2022/11/25',
                    //     news_session:'D',
                    //     news_class: '火車佐便當',
                    //     news_title: '「鹿兒島沙浴」體驗活動報名',
                    //     news_status:'上架',
                    // },
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
        created(){
            this.getData();
        },
        methods: {
            getData(){
                const gege = new URL('http://localhost/cgd103-g4-backend/public/phpfiles/gettravel.php');
                fetch(gege)
                .then((res)=>res.json())
                .then((json)=>{
                    this.dataOn = json;
                    console.log(this.dataOn);
                })
            },
            addData(){
                const addURL = new URL('http://localhost/cgd103-g4-backend/public/phpfiles/addnew.php');
                fetch(addURL,{ method:'post',body: new URLSearchParams({
                    package_name:this.value5,
                    package_status:this.selected,
                    package_price:this.value6,
                    package_title:this.value4,
                    package_des:this.formItem.textarea,
                    // package_pic:this.package_pic,
                    travel_paper:this.formItem2.textarea2,
                })})
                .then((rt)=>rt.json())
                .then((result)=>{
                    console.log(result);
                })
            },
            handleEdit (row, index) {
                this.editnews_no = row.package_no;
                this.editnews_time = row.package_create_date;
                this.editnews_title = row.package_title;
                this.editnews_class = row.package_des;
                this.editnews_status = row.package_status;
                this.editnews_session = row.package_price;
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
            },
            dbcheck(){
                if(this.addnew == true){
                    this.addnew = false;
                    return this.addnew;
                }
            },
        }
    }
</script>

<style scoped lang="scss">
/* -------------------彈窗 ------------------------*/
@import "@/assets/Scss/base/color.scss";

.popup{
    .popup-content{
    text-align: center;
        .input-txt{
            .input-info{
                padding: 20px;
            }
        }
    }
}
.backstage-newss{
    width: calc(100vw - 300px);
    background-color: rgba(#000,0.3);
    height: 100vh;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    position: absolute;
    z-index: 99;
}
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
        height: 650px;
        overflow-y: scroll;
        width: 100%;
        max-width: 768px;
        margin: 0px auto;
        background-color: $back_color_active;
        .delcan{
            width: 100%;
            max-width: 30%;
            display: flex;
            justify-content: space-between;
            margin: 0px auto;
            padding: 20px 0px;
            .shure{
                background-color: $back_color_main;
                padding: 5px 30px;
                border-radius: 6px;
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
            align-items: center;
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
                width: 50%;
                height: 40px;
                display: flex;
                margin: auto auto auto 0px;
                .choosein{
                    border-radius: 5px;
                    width: 300px;
                    text-align: center;
                }
            }
            .success{
                gap: 10px;
                .succe{
                    display: flex;
                    align-items: center;
                    margin-bottom: 10px;
                }
            }
        }
    }
}






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
        padding: 8px 16px;
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