<!-- 問題
    4. 刪除資料
    6. 多選的 SQL 指令
    7. 各個彈窗寫成 component
    8. 進入頁面預設打開"全部"
    9. 新增/編輯資料時，若欄位為空則不能送出
    10.分頁優化寫法
-->
<!-- 小抄
    摺疊快速鍵 Ctrl K 012345
    打開快速鍵 Ctrl K J
    sass ./src/assets/sass/style.scss ./src/assets/css/style.css
 -->
 <template>
    <div class="FAQ">
		<main>
<!-- 按鈕 -->
			<div class="btns">
				<button class="btn-blue_2nd">顯示/隱藏</button>
				<button class="btn-blue" @click="show_NewForm = !show_NewForm">新增</button>
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
            <Table stripe type="selection" border
                :columns="columns"
                :data="activeList"
                @on-select="onSelect"
                @on-select-all="onSelectAll"
            >
                <!-- 編號 -->
                <template #faq_no="{ row, index }">
                    <Input type="text"  v-if="editIndex === index"/>
                    <span v-else>{{ row.faq_no }}</span>
                </template>
                <!-- 分類 -->
                <template #faq_type="{ row, index }">
                    <Input type="text"  v-if="editIndex === index"/>
                    <span v-else>{{ (row.faq_type) }}</span>
                </template>
                <!-- 問題 -->
                <template #faq_q="{ row, index }" >
                    <Input type="text"  v-if="editIndex === index"/>
                    <span v-else >{{ row.faq_q }}</span>
                </template>
                <!-- 回答 -->
                <template #faq_a="{ row, index }" >
                    <Input type="text"  v-if="editIndex === index"/>
                    <span v-else >{{ row.faq_a }}</span>
                </template>
                <!-- 狀態 -->
                <template #faq_state="{ row }" >
                    <Switch size="large"
                        v-model="row.faq_status"
                        :true-value = 1
                        :false-value = 0
                        true-color = "#6C9255"
                        false-color = "#E6E6E6"
                        @click="changeStatus(row.faq_status)"
                    >
                        <template #open><span>ON</span></template>
                        <template #close><span>OFF</span></template>
                    </Switch>
                </template>
                <!-- 編輯 -->
                <template #edit="{ row }">
                    <div class="btn-box">
                        <span class="icon material-symbols-outlined" @click="toggleEditForm(row.faq_no)">edit_square</span>
                    </div>
                </template>
                <!-- 刪除 -->
                <template #delete>
                    <span class="icon material-symbols-outlined"
                        style="font-size:26px; margin-top: 5px;"
                        @click="show_DelAlert=!show_DelAlert"
                    >delete
                    </span>
                </template>
            </Table>
		</main>
<!-- 新增表單 -->
        <form id="newForm" method="post" enctype="multipart/form-data">
            <div class="alert-mask" v-show="show_NewForm">
                <div class="alert-container faq-form">
                    <!-- 標題 -->
                    <div class="form-head">
                        <p class="font-20">新增 FAQ</p>
                        <span class="material-symbols-outlined" @click="show_CheckAlert=!show_CheckAlert">close</span>
                    </div>
                    <!-- 內容 -->
                    <div class="form-body">
                        <div>
                            <!-- 下拉選單 -->
                            <p class="font-16">＊類別：</p>
                            <Select name="faq_type"
                                v-model="newFaq_type"
                                placeholder="請選擇"
                                style="width: 120px"
                            >
                                <Option v-for="selectItem in selectList"
                                    :value="selectItem.text"
                                    :key="selectItem.text"
                                >
                                    {{selectItem.text}}
                                </Option>
                            </Select>
                            <!-- 狀態開關 -->
                            <p class="font-16">＊狀態：</p>
                            <Switch size="large"
                                name="faq_status"
                                v-model="newFaq_status"
                                :true-value = 1
                                :false-value = 0
                                true-color = "#6C9255"
                                false-color = "#E6E6E6"
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
                                v-model="newFaq_q"
                                showCount
                                class="font-16"
                                rows="3"
                                maxlength="100"
                                placeholder="請輸入問題"
                            >
                            </textarea>
                        </div>
                        <div>
                            <p class="font-16">＊回答：</p>
                            <textarea name="faq_a"
                                v-model="newFaq_a"
                                showCount
                                class="font-16"
                                rows="10"
                                maxlength="100"
                                placeholder="請輸入回答"
                            >
                            </textarea>
                        </div>
                        <!-- <span class="ivu-input-word-count">0/100</span> -->
                        <!-- <Space class="inputs">
                            <Input class="input question"
                                v-model="newFaq_q" maxlength="100"
                                show-word-limit placeholder="Enter something..."
                                style="width: 200px"/>
                        </Space> -->
                        <!-- 按鈕 -->
                        <div>
                            <p class="font-16">＊為必填／必選項目</p>
                            <button type="button" class="btn-blue_2nd" @click="show_CheckAlert=!show_CheckAlert">取消</button>
                            <button type="button" class="btn-blue" @click="addFaqData">新增</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- 編輯表單 -->
        <form id="editForm" method="post" enctype="multipart/form-data">
            <div class="alert-mask" v-show="show_EditForm">
                <div class="alert-container faq-form">
                    <!-- 標題 -->
                    <div class="form-head">
                        <p class="font-20">編輯 FAQ</p>
                        <span class="material-symbols-outlined" @click="show_CheckAlert=!show_CheckAlert">close</span>
                    </div>
                    <!-- 內容 -->
                    <div class="form-body">
                        <!-- 上面那排 -->
                        <div>
                            <p class="font-16">＊類別：</p>
                            <!-- 下拉選單 -->
                            <Select name="faq_type"
                                v-model="editingFaq.faq_type"
                                placeholder="請選擇"
                                style="width: 120px"
                            >
                                <Option v-for="selectItem in selectList"
                                    :value="selectItem.text"
                                    :key="selectItem.text"
                                >
                                    {{selectItem.text}}
                                </Option>
                            </Select>
                            <!-- 狀態開關 -->
                            <p class="font-16">＊狀態：</p>
                            <Switch size="large"
                                name="faq_status"
                                v-model="editingFaq.faq_status"
                                :true-value = 1
                                :false-value = 0
                                true-color = "#6C9255"
                                false-color = "#E6E6E6"
                            >
                                <template #open><span>ON</span></template>
                                <template #close><span>OFF</span></template>
                            </Switch>
                            <!-- 編號 -->
                            <p class="font-16">編號：{{editingFaq.faq_no}}</p>
                        </div>
                        <!-- 輸入框 -->
                        <div>
                            <p class="font-16">＊問題：</p>
                            <textarea name="faq_q"
                                showCount
                                class="font-16"
                                rows="3"
                                maxlength="100"
                                v-model="editingFaq.faq_q"
                                placeholder="請輸入問題"
                            >
                            </textarea>
                        </div>
                        <div>
                            <p class="font-16">＊回答：</p>
                            <textarea name="faq_a"
                                showCount
                                class="font-16"
                                rows="10"
                                maxlength="100"
                                v-model="editingFaq.faq_a"
                                placeholder="請輸入回答"
                                >
                            </textarea>
                        </div>
                        <!-- <span class="ivu-input-word-count">0/100</span> -->
                        <!-- <Space class="inputs">
                            <Input class="input question"
                            v-model="newFaq_q" maxlength="100"
                                show-word-limit placeholder="Enter something..."
                                style="width: 200px"/>
                        </Space> -->
                        <!-- 按鈕 -->
                        <div>
                            <p class="font-16">＊為必填／必選項目</p>
                            <button type="button" class="btn-blue_2nd" @click="show_CheckAlert=!show_CheckAlert">取消</button>
                            <button type="button" class="btn-blue" @click="editFaqData">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- 彈窗：刪除確認 -->
        <div class="alert-mask" v-show="show_DelAlert">
            <div class="alert-container" @click.self="show_DelAlert=!show_DelAlert">
                <div class="faq-check">
                    <p class="font-16-15em">
                        <span class="icon material-symbols-outlined">error</span>
                        <span>Delete confirmation</span>
                    </p>
                    <p class="font-16-15em">確定要刪除嗎？</p>
                    <Button class="btn-danger_2nd"
                        long :loading="alert_Loading"
                        @click.self="show_DelAlert=!show_DelAlert">取消
                    </Button>
                    <Button class="btn-danger"
                        long :loading="alert_Loading"
                        @click="del(index)">刪除
                    </Button>
                </div>
            </div>
        </div>
<!-- 彈窗：取消確認 -->
        <div class="alert-mask" v-show="show_CheckAlert">
            <div class="alert-container" @click.self="show_CheckAlert=!show_CheckAlert">
                <div class="faq-check">
                    <p class="font-16-15em">
                        <span class="icon material-symbols-outlined">error</span>
                        <span>Cancel confirmation</span>
                    </p>
                    <p class="font-16-15em">取消後，內容將不會儲存，請問是否取消？</p>
                    <Button class="btn-blue_2nd"
                        long :loading="alert_Loading"
                        @click.self="show_CheckAlert=!show_CheckAlert">繼續編輯
                    </Button>
                    <Button class="btn-blue"
                        long :loading="alert_Loading"
                        @click="cancel">確定取消
                    </Button>
                </div>
            </div>
        </div>
<!-- 分頁頁碼 -->
        <!-- <Page :total="40" size="small" show-elevator show-sizer/> -->
	</div>
</template>
<script>
import faq from '@/assets/js/faq.js'
// import select from '@/components/select.vue'

export default {
    components: {
        // select,
    },
    data(){
        return {
// ----- 分頁 ------
            activeCategory: '',
            activeList: [],
            categoryList:[
                { faq_type: '會員問題' },
                { faq_type: '行程問題' },
                { faq_type: '商品問題' },
            ],
// ----- 表格欄位 ------
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
                    slot: 'faq_state',
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
// ----- 假資料 ------
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
// ----- 表單：新增資料 ------
            newFaq_type: '',
            newFaq_q: '',
            newFaq_a: '',
            newFaq_status: 1,
// ----- 表單：修改資料 ------
            editIndex: -1,
            editingNo: '',  // 正在修改的資料編號
            editingFaq: [], // 要回傳的陣列
// ----- 表單：下拉選單 ------
            selectList: [
                { text: '會員問題', },
                { text: '行程問題', },
                { text: '商品問題', },
            ],
// ----- 彈窗 ------
            show_CheckAlert: false,
            show_DelAlert:   false,
            show_NewForm:    false,
            show_EditForm:   false,
            alert_Loading:   false,
        }
    },
    computed: {

    },
    methods: {
// ----- 撈資料 ------ XML
        // getFaqData_XML(){
        //     let faqVue = this;
		// 	let xhr = new XMLHttpRequest();
		// 	xhr.onload = ()=>{
        //         if(xhr.status == 200){
        //             faqVue.faqList = JSON.parse(xhr.responseText);
		// 		}
		// 	}
		// 	xhr.open("get", "http://localhost/CGD103_G4_back/public/php/getFaqData_02.php", true);
		// 	xhr.send(null);
		// },
// ----- 新增資料 ------ XML
        // addFaqData(){
        //     let xhr = new XMLHttpRequest();
        //     xhr.onload = function(){
        //         let result = JSON.parse(xhr.responseText);
        //         alert(result.msg);
        //     }
        //     xhr.open("post", "http://localhost/CGD103_G4_back/public/php/insertFaq.php", true);
        //     xhr.send(new FormData(document.getElementById("newForm")));
        //     this.show_NewForm = false;
        // },
// ----- 撈資料 ------ fetch
        getFaqData_Fetch(){
            fetch('http://localhost/CGD103_G4_back/public/php/getFaqData.php')
            .then(res=>res.json())
            .then(json=>{
                this.faqList = json;
            })
		},
// ----- 新增資料 ------ fetch
        addFaqData(){
            const myUrl = new URL("http://localhost/CGD103_G4_back/public/php/insertFaq.php");
            fetch(myUrl,{ method:'POST', body:new URLSearchParams({
                faq_type:this.newFaq_type,
                faq_q:this.newFaq_q,
                faq_a:this.newFaq_a,
                faq_status:this.newFaq_status,
            })})
            .then((res) => res.json())
            .then((result)=> {
                // console.log(result)
                this.alert_Loading = true;
                setTimeout(() => {
                    this.alert_Loading = false;
                    this.show_NewForm = false;
                    this.$Message.success(result.msg);
                }, 800);
            })
        },
// ----- 測試修改資料 ------ XML(不能用)
        // editFaqData(){
        //     console.log(this.editingFaq);
        //     let xhr = new XMLHttpRequest();
        //     xhr.onload = function(){
        //         let result = JSON.parse(xhr.responseText);
        //         console.log(result);
        //         alert(result.msg);
        //     }
        //     xhr.open("post", "http://localhost/CGD103_G4_back/public/php/updateFaq.php", true);
        //     xhr.send(new FormData(document.getElementById("editForm")));
        // },
// ----- 修改資料 ------ fetch
        editFaqData(){
            const myUrl = new URL("http://localhost/CGD103_G4_back/public/php/updateFaq.php");
            fetch(myUrl,{ method:'POST', body:new URLSearchParams({
                faq_no:this.editingFaq.faq_no,
                faq_type:this.editingFaq.faq_type,
                faq_q:this.editingFaq.faq_q,
                faq_a:this.editingFaq.faq_a,
                faq_status:this.editingFaq.faq_status,
            })})
            .then((res) => res.json())
            .then((result)=> {
                // console.log(result)
                this.alert_Loading = true;
                setTimeout(() => {
                    this.alert_Loading = false;
                    this.show_EditForm = false;
                    this.$Message.success(result.msg);
                }, 800);
            })
        },
        // del(index){
        //     this.activeList.splice(index, 1);
        //     this.alert_Loading = true;
        //     setTimeout(() => {
        //         this.show_DelAlert = false;
        //         this.alert_Loading = false;
        //         this.$Message.success('已成功刪除一筆常見問題');
        //     }, 200);
        // },
        cancel(){
            this.alert_Loading = true;
            setTimeout(() => {
                this.show_CheckAlert = false;
                this.show_NewForm = false;
                this.show_EditForm = false;
                this.alert_Loading = false;
            }, 200);
        },
        toggleEditForm(edit){
            this.editingNo = edit;
            this.show_EditForm = !this.show_EditForm;
            this.editingFaq = this.activeList.find(v=> v.faq_no === this.editingNo) ?? [];
            console.log(this.editingFaq);
        },
// ----- 分頁換頁 ------
        clickAll(e){
            // console.log(this.faqList);
            // console.log(this.activeList);
            // showAll = true;
            this.activeList = this.faqList;
            e.target.classList.add('on');
            e.target.parentNode.childNodes[2].classList.remove('on');
            e.target.parentNode.childNodes[3].classList.remove('on');
            e.target.parentNode.childNodes[4].classList.remove('on');
        },
        changeTab(tab){
            this.activeCategory = tab;
            this.activeList = this.faqList.filter(item => {
                return item.faq_type === tab.faq_type;
            });
            let tabAll = document.getElementById("tabAll");
            tabAll.classList.remove('on');
        },
        changeStatus(status){
            status
            ? this.$Message.info('狀態：顯示')
            : this.$Message.info('狀態：隱藏');
        },
        onSelect(index){
            console.log(index);
        },
        onSelectAll(index){
            console.log(index);
        },
    },
    created(){
		this.getFaqData_Fetch();
	},
	mounted(){
        // this.getFaqData_XML();
    },
}

</script>

<style scoped lang="scss">
@import "../assets/Scss/pages/faq.scss";
</style>