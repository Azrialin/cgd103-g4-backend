<template>
    	<div class="FAQ">
		<main>
			<div class="btns">
				<button class="btn-blue_2nd">顯示/隱藏</button>
				<button class="btn-blue" @click="ShowNewModal = true">新增</button>
				<button class="btn-blue">刪除</button>
			</div>

            <ul class="tabs">
                <li class="tab font-16"
                    v-for="category in categoryList"
                    :key="category.faq_type"
                    :class="{on: category.faq_type == activeCategory.faq_type}"
                    @click="tabChange(category)"
                >
                    {{category.faq_type}}
                </li>
            </ul>
            <Table stripe border :columns="columns" :data="activeList" >
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
                <template #faqState>
                    <Switch true-color="#6C9255" false-color="#E6E6E6" />
                </template>
                <!-- 編輯 -->
                <template #edit>
                    <div class="btn-box">
                        <span class="icon material-symbols-outlined" @click="show(index)">edit_square</span>
                    </div>
                </template>
                <!-- 刪除 -->
                <template #delete>
                    <span class="icon material-symbols-outlined"
                    style="font-size:26px; margin-top: 5px;"
                    @click="ShowDelModal = true">delete</span>
                </template>
            </Table>

<!-- 彈窗：刪除確認 -->
            <div class="modal-mask" :style="DelModal">
                <div class="modal-container" @click.self="toggleDelModal">
                    <div class="modal-body">
                        <p class="font-16-15em">
                            <span class="icon material-symbols-outlined">error</span>
                            <span>Delete confirmation</span>
                        </p>
                        <p class="font-16-15em">確定要刪除嗎？</p>
                        <Button class="btn-danger_2nd" long :loading="modal_loading" @click.self="toggleDelModal">取消</Button>
                        <Button class="btn-danger" long :loading="modal_loading" @click="del(index)">刪除</Button>
                    </div>
                </div>
            </div>

<!-- 新增表單 -->
            <div class="modal-mask" :style="NewModal">
                <div class="modal-container" @click.self="toggleNewModal">
                    <div class="popup ">
                        <div class="popup-head font-20">新增員工帳號</div>
                        <div class="popup-content font-18">
                            <div class="input-txt">
                                <div class="input-info">
                                    <label for="">員工編號：
                                        <Input type="text" placeholder="" clearable style="width: 200px" />
                                    </label>
                                </div>
                                <div class="input-info">
                                    <label for="">員工帳號：
                                        <Input type="text" placeholder="英數大小寫10個字元以上" clearable  style="width: 200px"/>
                                    </label>
                                </div>
                                <div class="input-info">
                                    <label for="">員工密碼：
                                        <Input type="password" placeholder="英數大小寫8個字元以上" clearable  style="width: 200px"/>
                                    </label>
                                </div>
                                <div class="input-info">
                                    <label for="">員工姓名：
                                        <Input type="text" placeholder="請輸入姓名" clearable  style="width: 200px"/>
                                    </label>
                                </div>
                                <div class="input-info">
                                    <label for="">員工信箱：
                                        <Input type="email" placeholder="請輸入Email" clearable  style="width: 200px"/>
                                    </label>
                                </div>
                            </div>
                            <div class="input-switchs">
                                <label class="state" for="">帳號狀態：
                                    <Switch true-color="#13ce66" false-color="#E6E6E6" />
                                </label>
                            </div>
                            <div class="popup-btn">
                                <Button type="primary">新增帳號</Button>
                                <Button @click="toggleNewModal">取消</Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- 分頁頁碼 -->
            <!-- <Page :total="40" size="small" show-elevator show-sizer /> -->
		</main>
	</div>

</template>
<script>
export default {
    data () {
        return {
            components: {

            },
            ShowDelModal: false,
            ShowNewModal: false,
            modal_loading: false,
            activeCategory: '',
            activeList: [],
            categoryList:[
                { faq_type: '全部' },
                { faq_type: '會員問題' },
                { faq_type: '行程問題' },
                { faq_type: '商品問題' },
            ],
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
                    slot: 'faqState',
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
            faqList: [
                {
                    faq_no: '001',
                    faq_type: '會員問題',
                    faq_q: '請問我忘記密碼了怎麼辦？',
                    faq_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: '002',
                    faq_type: '會員問題',
                    faq_q: '請問客服電話是？我找不到。',
                    faq_a: '您好，客服電話是：00-0000-0000',
                },
                {
                    faq_no: '003',
                    faq_type: '會員問題',
                    faq_q: '請問可以不要填寫LINE ID嗎？',
                    faq_a: '可以的，親。',
                },
                {
                    faq_no: '004',
                    faq_type: '行程問題',
                    faq_q: '我不小心訂錯行程了，請問要如何退訂？',
                    faq_a: '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',

                },
                {
                    faq_no: '005',
                    faq_type: '行程問題',
                    faq_q: '我想要刷卡，但我不能填寫安全碼？',
                    faq_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: '006',
                    faq_type: '行程問題',
                    faq_q: '我請問我要如何查詢乘車座位？',
                    faq_a: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                },
                {
                    faq_no: '007',
                    faq_type: '行程問題',
                    faq_q: '我購買了方案A，請問發車時間是？',
                    faq_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: '008',
                    faq_type: '商品問題',
                    faq_q: '請問現貨商品多久會寄出？',
                    faq_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: '009',
                    faq_type: '商品問題',
                    faq_q: '請問我要如何查詢貨況呢？',
                    faq_a: '請撥打客服電話，由專人為您服務。',
                },
            ]
        }
    },
    computed: {
        DelModal(){
            return {
                'display': this.ShowDelModal ? '' : 'none'
            };
        },
        NewModal(){
            return {
                'display': this.ShowNewModal ? '' : 'none'
            };
        }
    },
    methods: {
        del(index){
            this.activeList.splice(index, 1);
            this.modal_loading = true;
            setTimeout(() => {
                this.modal_loading = false;
                this.ShowDelModal = false;
                this.$Message.success('已成功刪除一筆常見問題');
            }, 200);
        },
        toggleDelModal(){
            this.ShowDelModal = !this.ShowDelModal;
            // console.log(this);
        },
        toggleNewModal(){
            this.ShowNewModal = !this.ShowNewModal;
            // console.log(this);
        },
        tabChange(tab){
            this.activeCategory = tab;
            this.activeList = this.faqList.filter(item => {
                return item.faq_type === tab.faq_type;
            });
        }
    },
}

</script>

<style scoped lang="scss">
@import "../assets/Scss/pages/faq.scss";
.popup{
    position: absolute;
    top: 60px;
    left: 300px;
    margin: auto;
    z-index: 10;
    width: 40%;
    background-color: #4F6573;
}
/* 上方區塊顏色 */
.popup-head{
    background-color: #2D3740;
    height: 40px;
    color: #ccc;

    display: flex;
    justify-content: space-around;
    align-items: center;
}
.input-txt{
    margin-top: 50px;
}
.input-info{
    margin-bottom: 40px;
    padding-left: 85px;
}
.input-switchs{
    margin-bottom: 15px;
    padding-left: 85px;
}
.input-txt{
    margin-bottom: 40px;
}
.popup-btn{
    margin: 70px 90px 50px 0 ;
    display: flex;
    justify-content: right;

}

.popup-btn Button{
    margin: 0 20px;
}

/* 彈窗字顏色 */
.popup label{
    color: #fff;
}
.date{
    color: #ccc;
}




// 假的分頁
$lineClr: #DCDEE2;
$inactiveClr: #f8f8f9;
$hvrClr: #2d8cf0;
.tabs{
    position: relative;
    border-bottom: 1px solid $lineClr;
    margin-bottom: 15px;
    text-align: start;
    .tab{
        cursor: pointer;
        position: relative;
        top: 1px;
        display: inline-block;
        margin-left: 4px;
        height: 31px;
        background: $inactiveClr;
        color: $clr_gray_L1;
        border: 1px solid $lineClr;
        border-radius: 5px 5px 0px 0px;
        padding: 5px 14px;
        transition: 0.3s;
        &:hover{
            color: $hvrClr;
            transition: 0.3s;
        }
        &:active{
            background:#fff;
            color: $hvrClr;
        }
        &:focus-visible{
            border-radius: 8px;
        }
        &:focus:not(:focus-visible){
            outline: none;
        }
    }
    .tab.on{
        background:#fff;
        border-bottom: 1px solid #fff;
        color: $hvrClr;
    }
}
</style>