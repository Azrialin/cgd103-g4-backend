<!-- 問題
    1. 新增後，禁止畫面跳轉
    2. 假的下拉選單取資料
    3. 假的下拉選單及狀態切換開關，要怎麼回傳值
    4. 修改資料/刪除資料
    5. 編輯時，表單對應資料顯示
    6. 多選
    7. 各個彈窗寫成 component
    8. 進入頁面預設打開"全部"
-->
<template>
    <div class="FAQ">
		<main>
			<div class="btns">
				<button class="btn-blue_2nd">顯示/隱藏</button>
				<button class="btn-blue" @click="ShowNewForm = true">新增</button>
				<button class="btn-blue">刪除</button>
			</div>
<!-- 分頁標籤 -->
            <ul class="tabs">
                <li id="tabAll" class="tab font-16" @click="clickAll">全部</li>
                <li class="tab font-16"
                    v-for="category in categoryList"
                    :key="category.faq_type"
                    :class="{on: category.faq_type == activeCategory.faq_type}"
                    @click="changeTab(category)"
                >
                    {{category.faq_type}}
                </li>
            </ul>
<!-- 表格欄位 -->
            <Table stripe border :columns="columns" :data="activeList">
                <!-- 多選 -->
                <template #check="{ row, index }">
                    <Input type="text" v-if="editIndex === index" />
                    <span v-else>{{ row.check }}</span>
                </template>
                <!-- 編號 -->
                <template #faq_no="{ row, index }">
                    <Input type="text"  v-if="editIndex === index" />
                    <span v-else>{{ row.faq_no }}</span>
                </template>
                <!-- 分類 -->
                <template #faq_type="{ row, index }">
                    <Input type="text"  v-if="editIndex === index" />
                    <span v-else>{{ (row.faq_type) }}</span>
                </template>
                <!-- 問題 -->
                <template #faq_q="{ row, index }" >
                    <Input type="text"  v-if="editIndex === index" />
                    <span v-else >{{ row.faq_q }}</span>
                </template>
                <!-- 回答 -->
                <template #faq_a="{ row, index }" >
                    <Input type="text"  v-if="editIndex === index" />
                    <span v-else >{{ row.faq_a }}</span>
                </template>
                <!-- 狀態 -->
                <template #faq_State="{ row, index }" >
                    <Switch size="large"
                        :v-model="stateValue"
                        @on-change="changeStatus(index)"
                        true-color="#6C9255"
                        false-color="#E6E6E6"
                    >
                        <template #open><span>ON</span></template>
                        <template #close><span>OFF</span></template>
                    </Switch>
                </template>
                <!-- 編輯 -->
                <template #edit="{ row }">
                    <div class="btn-box">
                        <!-- <span class="icon material-symbols-outlined" @click="show(index)">edit_square</span> -->
                        <span class="icon material-symbols-outlined" @click="toggleEditForm(row.faq_no)">edit_square</span>
                    </div>
                </template>
                <!-- 刪除 -->
                <template #delete>
                    <span class="icon material-symbols-outlined"
                    style="font-size:26px; margin-top: 5px;"
                    @click="ShowDelAlert = true">delete</span>
                </template>
            </Table>
<!-- 新增表單 -->
            <form id="newForm" method="post" enctype="multipart/form-data">
                <div class="alert-mask" :style="NewForm">
                    <div class="alert-container">
                        <div class="faq_form">
                            <!-- 標題 -->
                            <div class="form-head">
                                <p class="font-20">新增 FAQ</p>
                                <span class="material-symbols-outlined" @click="ShowCheckAlert = true">close</span>
                            </div>
                            <div class="form-body">
                                <!-- 選單還不能用，先放個測試欄位 -->
                                <input type="text" name="faq_type">
                                <input type="text" name="faq_status">
                                <div>
                                    <p class="font-16">＊類別：</p>
                                    <!-- 下拉選單 -->
                                    <!-- <Dropdown
                                        :dropdownWidth="dropdownWidth"
                                        :activeTxt="activeTxt"
                                        :dropDownList="dropDownList"
                                    /> -->
                                    <div class="dropDown">
                                        <div class="dropdown-select font-16"
                                            :style="{ width: dropdownWidth }"
                                            :class="{'on':toggle}"
                                            @click="toggle=!toggle"
                                        >
                                            <p>{{activeTxt}}</p>
                                            <span class="Icon material-symbols-outlined">expand_more</span>
                                        </div>
                                        <ul class="dropdown-list" :class="{'show':toggle}">
                                            <li class="dropdown-item font-16"
                                                :style="{ width: dropdownWidth }"
                                                v-for="(dropDownItem, index) in dropDownList"
                                                :key="dropDownItem"
                                                @click.self="changeSelect(index)"
                                            >
                                                {{dropDownItem.text}}
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- 狀態開關 -->
                                    <p class="font-16">＊狀態：</p>
                                    <Switch size="large"
                                        true-color="#6C9255"
                                        false-color="#E6E6E6"
                                    >
                                        <template #open><span>ON</span></template>
                                        <template #close><span>OFF</span></template>
                                    </Switch>
                                    <!-- 編號 -->
                                    <p class="font-16">編號：新增後生成</p>
                                </div>
                                <!-- 輸入框 -->
                                <div>
                                    <p class="font-16">＊問題：</p>
                                    <textarea name="faq_q"
                                        showCount
                                        class="font-16"
                                        rows="3"
                                        maxlength="100"
                                        v-model="value1"
                                        placeholder="Enter something..."
                                    >
                                    </textarea>
                                </div>
                                <div>
                                    <p class="font-16">＊回覆：</p>
                                    <textarea name="faq_a"
                                        showCount
                                        class="font-16"
                                        rows="10"
                                        maxlength="100"
                                        v-model="value2"
                                        placeholder="Enter something..."
                                    >
                                    </textarea>
                                </div>
                                <!-- <span class="ivu-input-word-count">0/100</span> -->
                                <!-- <Space class="inputs">
                                    <Input class="input question"
                                        v-model="value1" maxlength="100"
                                        show-word-limit placeholder="Enter something..."
                                        style="width: 200px"/>
                                </Space> -->
                                <!-- 按鈕 -->
                                <div>
                                    <p class="font-16">＊為必填／必選項目</p>
                                    <button class="btn-blue_2nd" @click="ShowCheckAlert = true">取消</button>
                                    <button class="btn-blue" @click="addFaqData">新增</button>
                                    <!-- <button class="btn-blue" @click="add">新增</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
<!-- 編輯表單 -->
            <div class="alert-mask" :style="EditForm">
                <div class="alert-container">
                    <div class="faq_form">
                        <!-- 標題 -->
                        <div class="form-head">
                            <p class="font-20">編輯 FAQ</p>
                            <span class="material-symbols-outlined" @click="ShowCheckAlert = true">close</span>
                        </div>
                        <div class="form-body">
                            <div>
                                <p class="font-16">＊類別：</p>
                                <!-- 下拉選單 -->
                                <!-- <Dropdown
                                    :dropdownWidth="dropdownWidth"
                                    :activeTxt="activeTxt"
                                    :dropDownList="dropDownList"
                                /> -->
                                <div class="dropDown">
                                    <div class="dropdown-select font-16"
                                        :style="{ width: dropdownWidth }"
                                        :class="toggle?'on':''"
                                        @click="toggle=!toggle"
                                    >
                                        <p>{{activeTxt}}</p>
                                        <span class="Icon material-symbols-outlined">expand_more</span>
                                    </div>
                                    <ul class="dropdown-list" :class="toggle?'show':''">
                                        <li class="dropdown-item font-16"
                                            :style="{ width: dropdownWidth }"
                                            v-for="(dropDownItem, index) in dropDownList"
                                            :key="index"
                                            @click.self="changeSelect(index)"
                                        >
                                            {{dropDownItem.text}}
                                        </li>
                                    </ul>
                                </div>
                                <!-- 狀態開關 -->
                                <p class="font-16">＊狀態：</p>
                                <Switch size="large"
                                    true-color="#6C9255"
                                    false-color="#E6E6E6"
                                >
                                    <template #open><span>ON</span></template>
                                    <template #close><span>OFF</span></template>
                                </Switch>
                                <!-- 編號 -->
                                <!-- <p class="font-16">編號：{{activeList.faq_no}}</p> -->
                                <p class="font-16">編號：{{activeDraftData.faq_no}}</p>
                            </div>
                            <!-- 輸入框 -->
                            <div>
                                <p class="font-16">＊問題：</p>
                                <textarea
                                    showCount
                                    class="font-16"
                                    rows="3"
                                    maxlength="100"
                                    v-model="value1"
                                    placeholder="Enter something..."
                                >
                                </textarea>
                            </div>
                            <div>
                                <p class="font-16">＊回覆：</p>
                                <textarea
                                    showCount
                                    class="font-16"
                                    rows="10"
                                    maxlength="100"
                                    v-model="value2"
                                    placeholder="Enter something..."
                                >
                                </textarea>
                            </div>
                            <!-- <span class="ivu-input-word-count">0/100</span> -->
                            <!-- <Space class="inputs">
                                <Input class="input question"
                                    v-model="value1" maxlength="100"
                                    show-word-limit placeholder="Enter something..."
                                    style="width: 200px"/>
                            </Space> -->
                            <!-- 按鈕 -->
                            <div>
                                <p class="font-16">＊為必填／必選項目</p>
                                <button class="btn-blue_2nd" @click="ShowCheckAlert = true">取消</button>
                                <!-- <button class="btn-blue_2nd" @click.self="toggleNewForm">取消</button> -->
                                <button class="btn-blue" @click="set">儲存</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- 彈窗：刪除確認 -->
            <div class="alert-mask" :style="DelAlert">
                <div class="alert-container" @click.self="toggleDelAlert">
                    <div class="faq_alert alert-body">
                        <p class="font-16-15em">
                            <span class="icon material-symbols-outlined">error</span>
                            <span>Delete confirmation</span>
                        </p>
                        <p class="font-16-15em">確定要刪除嗎？</p>
                        <Button class="btn-danger_2nd" long :loading="Alert_loading" @click.self="toggleDelAlert">取消</Button>
                        <Button class="btn-danger" long :loading="Alert_loading" @click="del(index)">刪除</Button>
                    </div>
                </div>
            </div>
<!-- 彈窗：取消確認 -->
            <div class="alert-mask" :style="CheckAlert">
                <div class="alert-container" @click.self="toggleCheckAlert">
                    <div class="faq_alert alert-body">
                        <p class="font-16-15em">
                            <span class="icon material-symbols-outlined">error</span>
                            <span>Cancel confirmation</span>
                        </p>
                        <p class="font-16-15em">取消後，內容將不會儲存，請問是否取消？</p>
                        <Button class="btn-blue_2nd" long :loading="Alert_loading" @click.self="toggleCheckAlert">繼續編輯</Button>
                        <Button class="btn-blue" long :loading="Alert_loading" @click="cancel">確定取消</Button>
                    </div>
                </div>
            </div>
<!-- 分頁頁碼 -->
            <!-- <Page :total="40" size="small" show-elevator show-sizer/> -->
		</main>
	</div>

</template>
<script>
import faq from '@/assets/js/faq.js'
// import Dropdown from '@/components/Dropdown.vue'

export default {
    components: {
        // Dropdown,
    },
    data(){
        return {
// ----------- 彈窗 ------------
            ShowDelAlert:   false,
            ShowCheckAlert: false,
            ShowNewForm:    false,
            ShowEditForm:   false,
            Alert_loading:  false,
// ----------- 下拉選單 ------------
            toggle: false,
            dropDownList: [
                { text: '會員問題', },
                { text: '行程問題', },
                { text: '商品問題', },
            ],
            activeTxt: '請選擇',
            dropdownWidth: '120px',
// ----------- 狀態開關 ------------
            stateValue: 1,
// ----------- 輸入框 ------------
            value1: '',
            value2: '',
// ----------- 分頁 ------------
            // showAll: true,
            activeCategory: '',
            activeList: [],
            categoryList:[
                { faq_type: '會員問題' },
                { faq_type: '行程問題' },
                { faq_type: '商品問題' },
            ],
// ----------- 表格欄位 ------------
            columns: [
                {
                    type: 'selection',
                    width: 60,
                    align: 'center'
                },
                {
                    title: '編號',
                    slot: 'faq_no',
                    width: 80,
                    align: 'center',
                },
                {
                    title: '分類',
                    slot: 'faq_type',
                    width: 120,
                    align: 'center',
                    // filters: [
                    //             {
                    //                 label: '會員問題',
                    //                 value: 1
                    //             },
                    //             {
                    //                 label: '行程問題',
                    //                 value: 2
                    //             },
                    //             {
                    //                 label: '商品問題',
                    //                 value: 3
                    //             }
                    //         ],
                    //         filterMultiple: false, //https://www.iviewui.com/view-ui-plus/component/form/table#Brief_Introduction
                    //         filterMethod (value,row) { 
                    //             if (value === 1) {
                    //                 return row.faq_type==='會員問題';
                    //             } else if (value === 2) {
                    //                 return row.faq_type==='行程問題' ;
                    //             }else if (value === 3) {
                    //                 return row.faq_type==='商品問題' ;
                    //             }
                    //         }
                },
                {
                    title: '問題',
                    slot: 'faq_q',
                    align: 'center'
                },
                {
                    title: '回答',
                    slot: 'faq_a',
                    align: 'center'
                },
                {
                    title: '狀態',
                    slot: 'faq_State',
                    width: 100,
                    align: 'center'
                },
                {
                    title: '編輯',
                    slot: 'edit',
                    width: 70,
                    align: 'center'
                },
                {
                    title: '刪除',
                    slot: 'delete',
                    width: 70,
                    align: 'center'
                }
            ],
// ----------- 假資料 ------------
            faqList: [
                // {
                //     faq_no: '001',
                //     faq_type: '會員問題',
                //     faq_q: '請問我忘記密碼了怎麼辦？',
                //     faq_a: '請撥打客服電話，由專人為您服務。',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '002',
                //     faq_type: '會員問題',
                //     faq_q: '請問客服電話是？我找不到。',
                //     faq_a: '您好，客服電話是：00-0000-0000',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '003',
                //     faq_type: '會員問題',
                //     faq_q: '請問可以不要填寫LINE ID嗎？',
                //     faq_a: '可以的，親。',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '004',
                //     faq_type: '行程問題',
                //     faq_q: '我不小心訂錯行程了，請問要如何退訂？',
                //     faq_a: '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '005',
                //     faq_type: '行程問題',
                //     faq_q: '我想要刷卡，但我不能填寫安全碼？',
                //     faq_a: '請撥打客服電話，由專人為您服務。',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '006',
                //     faq_type: '行程問題',
                //     faq_q: '我請問我要如何查詢乘車座位？',
                //     faq_a: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                //     faq_status: 0,
                // },
                // {
                //     faq_no: '007',
                //     faq_type: '行程問題',
                //     faq_q: '我購買了方案A，請問發車時間是？',
                //     faq_a: '請撥打客服電話，由專人為您服務。',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '008',
                //     faq_type: '商品問題',
                //     faq_q: '請問現貨商品多久會寄出？',
                //     faq_a: '請撥打客服電話，由專人為您服務。',
                //     faq_status: 1,
                // },
                // {
                //     faq_no: '009',
                //     faq_type: '商品問題',
                //     faq_q: '請問我要如何查詢貨況呢？',
                //     faq_a: '請撥打客服電話，由專人為您服務。',
                //     faq_status: 1,
                // },
            ],
            editIndex: -1,
            activeIndex: null,
        }
    },
    computed: {
        DelAlert(){
            return {
                'display': this.ShowDelAlert ? '' : 'none'
            };
        },
        CheckAlert(){
            return {
                'display': this.ShowCheckAlert ? '' : 'none'
            };
        },
        NewForm(){
            return {
                'display': this.ShowNewForm ? '' : 'none'
            };
        },
        EditForm(no){
            // this.ShowEditForm = !this.ShowEditForm;
            this.activeIndex = no;
            return {
                'display': this.ShowEditForm ? '' : 'none'
            };
        },
        activeDraftData(){
            // return this.dataDraft.find(v=> v.news_no === this.activeIndex) ?? {}
            // return this.activeList.find(v=> v.faq_no === this.activeIndex) ?? {}
            return this.faqList.find(v=> v.faq_no === this.activeIndex) ?? {}
        },
    },
    methods: {
// 測試本地資料庫 fetch
        // getFaqData_Fetch(){
        //     fetch('http://localhost/CGD103_PHP_class/PDO/getFaqData_Fetch.php')
        //     .then(res=>res.json())
        //     .then(json=>{
        //         this.faqList = json;
        //     })
		// },
// 測試本地資料庫 XML
        getFaqData_XML(){
            let faqVue = this;
			let xhr = new XMLHttpRequest();
			xhr.onload = ()=>{
                if(xhr.status == 200){
                    faqVue.faqList = JSON.parse(xhr.responseText);
				}
			}
			xhr.open("get", "http://localhost/CGD103_PHP_class/project_books_formData/getFaqData_XML.php", true);
			xhr.send(null);
		},
// 測試新增資料
        addFaqData(){
            let xhr = new XMLHttpRequest();
            xhr.onload = function(){
                let result = JSON.parse(xhr.responseText);
                alert(result.msg);
            }
            xhr.open("post", "http://localhost/CGD103_PHP_class/project_books_formData/faqInsert.php", true);
            xhr.send(new FormData(document.getElementById("newForm")));
        },
        add(){
            this.Alert_loading = true;
            setTimeout(() => {
                this.Alert_loading = false;
                this.ShowNewForm = false;
                this.$Message.success('已成功新增一筆常見問題');
            }, 800);
        },
        set(){
            this.Alert_loading = true;
            setTimeout(() => {
                this.Alert_loading = false;
                this.ShowEditForm = false;
                this.$Message.success('已成功編輯一筆常見問題');
            }, 800);
        },
        del(index){
            this.activeList.splice(index, 1);
            this.Alert_loading = true;
            setTimeout(() => {
                this.Alert_loading = false;
                this.ShowDelAlert = false;
                this.$Message.success('已成功刪除一筆常見問題');
            }, 200);
        },
        cancel(){
            this.Alert_loading = true;
            setTimeout(() => {
                this.Alert_loading = false;
                this.ShowCheckAlert = false;
                this.ShowNewForm = false;
                this.ShowEditForm = false;
            }, 200);
        },
        toggleDelAlert(){
            this.ShowDelAlert = !this.ShowDelAlert;
        },
        toggleCheckAlert(){
            this.ShowCheckAlert = !this.ShowCheckAlert;
        },
        toggleNewForm(){
            this.ShowNewForm = !this.ShowNewForm;
        },
        toggleEditForm(no){
            this.ShowEditForm = !this.ShowEditForm;
            this.activeIndex = no;
        },
// ----------- 分頁換頁 ------------
        clickAll(e){
            // console.log(this.faqList);
            // console.log(this.activeList);
            // showAll = true;
            // console.log(showAll);
            this.activeList = this.faqList;
            e.target.classList.add('on');
            e.target.parentNode.childNodes[2].classList.remove('on');
            e.target.parentNode.childNodes[3].classList.remove('on');
            e.target.parentNode.childNodes[4].classList.remove('on');
        },
        changeTab(tab){
            // showAll = false;
            this.activeCategory = tab;
            this.activeList = this.faqList.filter(item => {
                return item.faq_type === tab.faq_type;
            });
            // console.log(showAll);
            let tabAll = document.getElementById("tabAll");
            tabAll.classList.remove('on');
        },
// ----------- 下拉選單 ------------
        changeSelect(index){
            this.toggle=!this.toggle;
            this.activeTxt = this.dropDownList[index].text;
            // this.activeTxt = this.faqList[index].faq_type;
            // console.log(event.target.innerHTML);
            // console.log(this);
            // console.log(event);
            // console.log(index);
            // console.log(this.dropDownList);
            // console.log(this.dropDownList[0]);
            // console.log(this.dropDownList[index]);
            // console.log(this.faqList);
            // console.log(this.faqList[index].faq_type);
        },
        changeStatus(index){
            // this.stateValue = this.faqList[index].faq_status;
            // this.stateValue
            // ? this.$Message.info('狀態：顯示')
            // : this.$Message.info('狀態：隱藏');

            if(this.stateValue){
                this.$Message.info('狀態：顯示');
                this.stateValue = 0;
            }else{
                this.$Message.info('狀態：隱藏');
                this.stateValue = 1;
            }
            // console.log(this.faqList[index].faq_status);
        },
        // Instant(){

        // }
    },
    created(){
		// this.getFaqData_Fetch();

	},
	mounted(){
        this.getFaqData_XML();
    },
}

</script>

<style scoped lang="scss">
@import "../assets/Scss/pages/faq.scss";
</style>