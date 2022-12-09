<template>
    	<div class="FAQ">
		<main>
			<div class="btns">
				<button class="btn-blue_2nd">顯示/隱藏</button>
				<button class="btn-blue" @click="isShow2 = true">新增</button>
				<button class="btn-blue">刪除</button>
			</div>
            <Tabs class="tabs" type="card" :animated="false">
<!-- 問題：全部 -->
                <TabPane class="scrollBar" label="全部" >
                    <Table stripe border :columns="columns" :data="dataAll" >
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
                        <template #fqa_q="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqa_a="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 狀態 -->
                        <template #faqState>
                            <!-- <Switch true-color="#13ce66" false-color="#E6E6E6" /> -->
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
                            @click="isShow = true">delete</span>
                        </template>
                    </Table>
                </TabPane>
<!-- 問題：會員 -->
                <TabPane label="會員問題" >
                    <Table stripe border :columns="columns" :data="dataM" >
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
                        <template #fqa_q="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqa_a="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 狀態 -->
                        <template #faqState>
                            <!-- <Switch true-color="#13ce66" false-color="#E6E6E6" /> -->
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
                            <span class="icon material-symbols-outlined" style="font-size:26px; margin-top: 5px;" @click="isShow = true">delete</span>
                        </template>
                    </Table>
                </TabPane>
<!-- 問題：行程 -->
                <TabPane label="行程問題" >
                    <Table stripe border :columns="columns" :data="dataT" >
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
                        <template #fqa_q="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqa_a="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 狀態 -->
                        <template #faqState>
                            <!-- <Switch true-color="#13ce66" false-color="#E6E6E6" /> -->
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
                            <span class="icon material-symbols-outlined" style="font-size:26px; margin-top: 5px;" @click="isShow = true">delete</span>
                        </template>
                    </Table>
                </TabPane>
<!-- 問題：商品 -->
                <TabPane label="商品問題" >
                    <Table stripe border :columns="columns" :data="dataP" >
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
                        <template #fqa_q="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqa_a="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqa_q }}</span>
                        </template>
                        <!-- 狀態 -->
                        <template #faqState>
                            <!-- <Switch true-color="#13ce66" false-color="#E6E6E6" /> -->
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
                            <span class="icon material-symbols-outlined" style="font-size:26px; margin-top: 5px;" @click="isShow = true">delete</span>
                        </template>
                    </Table>
                </TabPane>
            </Tabs>
<!-- 彈窗：刪除確認 -->
            <div class="modal-mask" :style="modalStyle">
                <div class="modal-container" @click.self="toggleModal">
                    <div class="modal-body">
                        <p class="font-16-15em">
                            <span class="icon material-symbols-outlined">error</span>
                            <span>Delete confirmation</span>
                        </p>
                        <p class="font-16-15em">確定要刪除嗎？</p>
                        <Button class="btn-danger_2nd" long :loading="modal_loading" @click.self="toggleModal">取消</Button>
                        <Button class="btn-danger" long :loading="modal_loading" @click="del(index)">刪除</Button>
                    </div>
                </div>
            </div>

<!-- 新增表單 -->
            <div class="modal-mask" :style="modalStyle2">
                <div class="modal-container" @click.self="toggleModal2">
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
                                <Button @click="toggleModal2">取消</Button>
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
                // Breadcrumb
            },
            isShow: false,
            isShow2: false,
            modal_loading: false,
            columns: [
                {
                    type: 'selection',
                    width: 60,
                    align: 'center'
                },
                {
                    title: '編號',
                    slot: 'faq_no',
                    width: 100,
                    align: 'center',
                },
                {
                    title: '分類',
                    slot: 'faq_type',
                    width: 120,
                    align: 'center',
                    filters: [
                                {
                                    label: '會員問題',
                                    value: 1
                                },
                                {
                                    label: '行程問題',
                                    value: 2
                                },
                                {
                                    label: '商品問題',
                                    value: 3
                                }
                            ],
                            filterMultiple: false, //https://www.iviewui.com/view-ui-plus/component/form/table#Brief_Introduction
                            filterMethod (value,row) { 
                                if (value === 1) {
                                    return row.faq_type==='會員問題';
                                } else if (value === 2) {
                                    return row.faq_type==='行程問題' ;
                                }else if (value === 3) {
                                    return row.faq_type==='商品問題' ;
                                }
                            }
                },
                {
                    title: '問題',
                    slot: 'fqa_q',
                    align: 'center'
                },
                {
                    title: '回答',
                    slot: 'fqa_a',
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
            dataAll: [
                {
                    faq_no: 'M001',
                    faq_type: '會員問題',
                    fqa_q: '請問我忘記密碼了怎麼辦？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'M002',
                    faq_type: '會員問題',
                    fqa_q: '請問客服電話是？我找不到。',
                    fqa_a: '您好，客服電話是：00-0000-0000',
                },
                {
                    faq_no: 'M003',
                    faq_type: '會員問題',
                    fqa_q: '請問可以不要填寫LINE ID嗎？',
                    fqa_a: '可以的，親。',
                },
                {
                    faq_no: 'T001',
                    faq_type: '行程問題',
                    fqa_q: '我不小心訂錯行程了，請問要如何退訂？',
                    fqa_a: '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',

                },
                {
                    faq_no: 'T002',
                    faq_type: '行程問題',
                    fqa_q: '我想要刷卡，但我不能填寫安全碼？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'T003',
                    faq_type: '行程問題',
                    fqa_q: '我請問我要如何查詢乘車座位？',
                    fqa_a: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                },
                {
                    faq_no: 'T004',
                    faq_type: '行程問題',
                    fqa_q: '我購買了方案A，請問發車時間是？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'P001',
                    faq_type: '商品問題',
                    fqa_q: '請問現貨商品多久會寄出？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'P002',
                    faq_type: '商品問題',
                    fqa_q: '請問我要如何查詢貨況呢？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
            ],
            dataM: [
                {
                    faq_no: 'M001',
                    faq_type: '會員問題',
                    fqa_q: '請問我忘記密碼了怎麼辦？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'M002',
                    faq_type: '會員問題',
                    fqa_q: '請問客服電話是？我找不到。',
                    fqa_a: '您好，客服電話是：00-0000-0000',
                },
                {
                    faq_no: 'M003',
                    faq_type: '會員問題',
                    fqa_q: '請問可以不要填寫LINE ID嗎？',
                    fqa_a: '可以的，親。',
                },
            ],
            dataT: [
                {
                    faq_no: 'T001',
                    faq_type: '行程問題',
                    fqa_q: '我不小心訂錯行程了，請問要如何退訂？',
                    fqa_a: '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',

                },
                {
                    faq_no: 'T002',
                    faq_type: '行程問題',
                    fqa_q: '我想要刷卡，但我不能填寫安全碼？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'T003',
                    faq_type: '行程問題',
                    fqa_q: '我請問我要如何查詢乘車座位？',
                    fqa_a: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                },
                {
                    faq_no: 'T004',
                    faq_type: '行程問題',
                    fqa_q: '我購買了方案A，請問發車時間是？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
            ],
            dataP: [
                {
                    faq_no: 'P001',
                    faq_type: '商品問題',
                    fqa_q: '請問現貨商品多久會寄出？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faq_no: 'P002',
                    faq_type: '商品問題',
                    fqa_q: '請問我要如何查詢貨況呢？',
                    fqa_a: '請撥打客服電話，由專人為您服務。',
                },
            ],
        }
    },
    computed: {
        modalStyle(){
            return {
                'display': this.isShow ? '' : 'none'
            };
        },
        modalStyle2(){
            return {
                'display': this.isShow2 ? '' : 'none'
            };
        }
    },
    methods: {
        del(index){
            this.dataAll.splice(index, 1);
            // this.dataM.splice(index, 1);
            // this.dataT.splice(index, 1);
            // this.dataP.splice(index, 1);
            this.modal_loading = true;
            setTimeout(() => {
                this.modal_loading = false;
                this.isShow = false;
                this.$Message.success('已成功刪除一筆常見問題');
            }, 200);
        },
        toggleModal(){
            this.isShow = !this.isShow;
            // console.log(this);
        },
        toggleModal2(){
            this.isShow2 = !this.isShow2;
            // console.log(this);
        }
    }
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

</style>