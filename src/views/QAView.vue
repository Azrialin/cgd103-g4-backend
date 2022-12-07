<template>
    	<div class="QA">
		<header>
			<h1 class="font-32">Q&A 管理</h1>
			<div>
				<span class="font-18">管理員名稱</span>
                <span class="font-18">登出</span>
			</div>
		</header>
		<main>
			<div class="font-16">Q&A 管理 /</div>
			<div class="btns">
				<button class="btn-blue_2nd">顯示/隱藏</button>
				<button class="btn-blue">新增</button>
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
                        <template #faqNo="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ row.faqNo }}</span>
                        </template>
                        <!-- 分類 -->
                        <template #faqType="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ (row.faqType) }}</span>
                        </template>
                        <!-- 問題 -->
                        <template #fqaQ="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqaA="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
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
<!-- 問題：會員 -->
                <TabPane label="會員問題" >
                    <Table stripe border :columns="columns" :data="dataM" >
                        <!-- 多選 -->
                        <template #check="{ row, index }">
                            <Input type="text" v-if="editIndex === index" />
                            <span v-else>{{ row.check }}</span>
                        </template>
                        <!-- 編號 -->
                        <template #faqNo="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ row.faqNo }}</span>
                        </template>
                        <!-- 分類 -->
                        <template #faqType="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ (row.faqType) }}</span>
                        </template>
                        <!-- 問題 -->
                        <template #fqaQ="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqaA="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
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
                        <template #faqNo="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ row.faqNo }}</span>
                        </template>
                        <!-- 分類 -->
                        <template #faqType="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ (row.faqType) }}</span>
                        </template>
                        <!-- 問題 -->
                        <template #fqaQ="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqaA="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
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
                        <template #faqNo="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ row.faqNo }}</span>
                        </template>
                        <!-- 分類 -->
                        <template #faqType="{ row, index }">
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else>{{ (row.faqType) }}</span>
                        </template>
                        <!-- 問題 -->
                        <template #fqaQ="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
                        </template>
                        <!-- 回答 -->
                        <template #fqaA="{ row, index }" >
                            <Input type="text"  v-if="editIndex === index" />
                            <span v-else >{{ row.fqaQ }}</span>
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
                        <Button class="btn-danger_2nd" long :loading="modal_loading" @click="toggleModal">取消</Button>
                        <Button class="btn-danger" long :loading="modal_loading" @click="del(index)">刪除</Button>
                    </div>
                </div>
            </div>
<!-- 分頁頁碼 -->
            <Page :total="40" size="small" show-elevator show-sizer />
		</main>
	</div>

</template>
<script>
// import { resolveComponent } from 'vue'
export default {
    data () {
        return {
            isShow: false,
            modal_loading: false,
            columns: [
                {
                    type: 'selection',
                    width: 60,
                    align: 'center'
                },
                {
                    title: '編號',
                    slot: 'faqNo',
                    width: 100,
                    align: 'center',
                },
                {
                    title: '分類',
                    slot: 'faqType',
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
                                    return row.faqType==='會員問題';
                                } else if (value === 2) {
                                    return row.faqType==='行程問題' ;
                                }else if (value === 3) {
                                    return row.faqType==='商品問題' ;
                                }
                            }
                },
                {
                    title: '問題',
                    slot: 'fqaQ',
                    align: 'center'
                },
                {
                    title: '回答',
                    slot: 'fqaA',
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
                    faqNo: 'M001',
                    faqType: '會員問題',
                    fqaQ: '請問我忘記密碼了怎麼辦？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'M002',
                    faqType: '會員問題',
                    fqaQ: '請問客服電話是？我找不到。',
                    fqaA: '您好，客服電話是：00-0000-0000',
                },
                {
                    faqNo: 'M003',
                    faqType: '會員問題',
                    fqaQ: '請問可以不要填寫LINE ID嗎？',
                    fqaA: '可以的，親。',
                },
                {
                    faqNo: 'T001',
                    faqType: '行程問題',
                    fqaQ: '我不小心訂錯行程了，請問要如何退訂？',
                    fqaA: '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',

                },
                {
                    faqNo: 'T002',
                    faqType: '行程問題',
                    fqaQ: '我想要刷卡，但我不能填寫安全碼？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'T003',
                    faqType: '行程問題',
                    fqaQ: '我請問我要如何查詢乘車座位？',
                    fqaA: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                },
                {
                    faqNo: 'T004',
                    faqType: '行程問題',
                    fqaQ: '我購買了方案A，請問發車時間是？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'P001',
                    faqType: '商品問題',
                    fqaQ: '請問現貨商品多久會寄出？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'P002',
                    faqType: '商品問題',
                    fqaQ: '請問我要如何查詢貨況呢？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
            ],
            dataM: [
                {
                    faqNo: 'M001',
                    faqType: '會員問題',
                    fqaQ: '請問我忘記密碼了怎麼辦？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'M002',
                    faqType: '會員問題',
                    fqaQ: '請問客服電話是？我找不到。',
                    fqaA: '您好，客服電話是：00-0000-0000',
                },
                {
                    faqNo: 'M003',
                    faqType: '會員問題',
                    fqaQ: '請問可以不要填寫LINE ID嗎？',
                    fqaA: '可以的，親。',
                },
            ],
            dataT: [
                {
                    faqNo: 'T001',
                    faqType: '行程問題',
                    fqaQ: '我不小心訂錯行程了，請問要如何退訂？',
                    fqaA: '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',

                },
                {
                    faqNo: 'T002',
                    faqType: '行程問題',
                    fqaQ: '我想要刷卡，但我不能填寫安全碼？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'T003',
                    faqType: '行程問題',
                    fqaQ: '我請問我要如何查詢乘車座位？',
                    fqaA: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                },
                {
                    faqNo: 'T004',
                    faqType: '行程問題',
                    fqaQ: '我購買了方案A，請問發車時間是？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
            ],
            dataP: [
                {
                    faqNo: 'P001',
                    faqType: '商品問題',
                    fqaQ: '請問現貨商品多久會寄出？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'P002',
                    faqType: '商品問題',
                    fqaQ: '請問我要如何查詢貨況呢？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
            ],
        }
    },
    computed: {
        modalStyle(){
            return {
                'display': this.isShow ? '' : 'none'
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
            console.log(this);
        }
    }
}
</script>

<style scoped lang="scss">
@import "../assets/Scss/pages/QA.scss";


</style>