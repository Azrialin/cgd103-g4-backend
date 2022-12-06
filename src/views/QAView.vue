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
                <TabPane label="全部" >
                    <Table stripe border :columns="columns" :data="datas" >
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
                        <template #faqState="{ row, index }">
                            <Switch true-color="#13ce66" false-color="#E6E6E6" />
                        </template>
                        <!-- 編輯 -->
                        <template #edit>
                            <div class="btn-box">
                                <span class="material-symbols-outlined" @click="show(index)">edit_square</span>
                            </div>
                        </template>
                        <!-- 刪除 -->
                        <template #delate>
                            <div class="btn-box">
                                <span class="material-symbols-outlined" style="font-size:26px" @click="remove(index)">delete</span>
                            </div>
                        </template>
                    </Table>
                </TabPane>

            </Tabs>

            <Page :total="40" size="small" show-elevator show-sizer />
		</main>
	</div>
</template>

<script>
import { resolveComponent } from 'vue'
// export default {
// 	name: 'QAView',
// 	components: {

// 	},
// 	data () {
//             return {
//                 columns: [
// 					{
// 						type: 'selection',
//                         width: 60,
//                         align: 'center'
//                     },
//                     {
//                         title: '編號',
//                         key: 'no',
// 						width: 90,
// 		                align: 'center'
//                     },
//                     {
//                         title: '類別',
//                         key: 'type',
// 						width: 150,
// 		                align: 'center'
//                     },
//                     {
//                         title: '問題',
//                         key: 'Q',
// 		                align: 'center'
//                     },
//                     {
//                         title: '回答',
//                         key: 'A',
// 		                align: 'center'
//                     },
//                     {
//                         title: '狀態',
//                         key: 'state',
// 						width: 80,
// 		                align: 'center'
//                     },
//                     {
//                         title: '修改',
//                         key: 'edit',
//                         width: 100,
//                         align: 'center',
//                         render: (h, params) => {
//                             return h('div', [
//                                 h(resolveComponent('Button'), {
//                                     props: {
//                                         type: 'primary',
//                                         size: 'small'
//                                     },
//                                     style: {
//                                         marginRight: '5px'
//                                     },
//                                     onClick: () => {
//                                         // this.show(params.index)
//                                     }
//                                 }, {
//                                     default() {
//                                         return '編輯'
//                                     }
//                                 }),
//                                 // h(resolveComponent('Button'), {
//                                 //     props: {
//                                 //         type: 'error',
//                                 //         size: 'small'
//                                 //     },
//                                 //     onClick: () => {
//                                 //         this.remove(params.index)
//                                 //     }
//                                 // }, {
//                                 //     default() {
//                                 //         return 'Delete'
//                                 //     }
//                                 // })
//                             ]);
//                         }
//                     }
//                 ],
//                 dataS: [
//                     {
//                         no: 'M001',
//                         type: '會員問題',
//                         Q:  '請問我忘記密碼了怎麼辦？',
//                         A:  '請撥打客服電話，由專人為您服務。',
// 						state: '顯示',
//                     },
//                     {
//                         no: 'M002',
//                         type: '會員問題',
//                         Q: '請問客服電話是？我找不到。',
//                         A: '您好，客服電話是：00-0000-0000。',
// 						state: '顯示',
//                     },
//                     {
//                         no: 'M003',
//                         type: '會員問題',
//                         Q:  '請問可以不要填寫LINE ID嗎？',
//                         A:  '可以的，親。',
// 						state: '顯示',
//                     },
//                 ],
//                 dataT: [
//                     {
//                         no: 'T001',
//                         type: '行程訂單問題',
//                         Q:  '我不小心訂錯行程了，請問要如何退訂？',
//                         A:  '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',
// 						state: '顯示',
//                     },
//                     {
//                         no: 'T002',
//                         type: '行程訂單問題',
//                         Q: '我想要刷卡，但我不能填寫安全碼？',
//                         A: '請撥打客服電話，由專人為您服務。',
// 						state: '顯示',
//                     },
//                     {
//                         no: 'T003',
//                         type: '行程訂單問題',
//                         Q:  '我請問我要如何查詢乘車座位？',
//                         A:  '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
// 						state: '隱藏',
//                     },
//                     {
//                         no: 'T004',
//                         type: '行程訂單問題',
//                         Q:  '我購買了方案A，請問發車時間是？',
//                         A:  '請撥打客服電話，由專人為您服務。',
// 						state: '顯示',
//                     },
//                 ],
//                 dataP: [
//                     {
//                         no: 'P001',
//                         type: '商品訂單問題',
//                         Q:  '請問現貨商品多久會寄出？',
//                         A:  '請撥打客服電話，由專人為您服務。',
// 						state: '顯示',
//                     },
//                     {
//                         no: 'P002',
//                         type: '商品訂單問題',
//                         Q: '請問我要如何查詢貨況呢？',
//                         A: '請撥打客服電話，由專人為您服務。',
// 						state: '顯示',
//                     },
//                 ],
//             }
//         },
//         methods: {
// 			handleSelectAll (status) {
//                 this.$refs.selection.selectAll(status);
//             },
//             show (index) {
//                 this.$Modal.info({
//                     title: 'User Info',
//                     content: `Name：${this.data[index].name}<br>Age：${this.data[index].age}<br>Address：${this.data[index].address}`
//                 })
//             },
//             // remove (index) {
//             //     this.data.splice(index, 1);
//             // }
//         }
//     }
export default {
    data () {
        return {
            // seenNew:false, //新表格彈窗，綁新表單v-show、按鈕@click="newToggle"
            // seeOnData:false, //上架資料彈窗，綁上架資料v-show、編輯按鈕@click="editOnData"
            // seeDraftData:false, //草稿資料彈窗，綁草稿資料v-show、編輯按鈕@click="editDraftData"
            // seeOffData:false, //下架資料彈窗，綁下架資料v-show、編輯按鈕@click="checkOffData"
            // size:'default', //按鈕間距，搭配Space，預設small(無間距)， 可自行調整距離px，詳情請看 https://run.iviewui.com/
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
                    slot: 'delate',
                    width: 70,
                    align: 'center'
                }
            ],
            datas: [
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
                    faqNo: 'T001',
                    faqType: '行程問題',
                    fqaQ: '我想要刷卡，但我不能填寫安全碼？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
                {
                    faqNo: 'T001',
                    faqType: '行程問題',
                    fqaQ: '我請問我要如何查詢乘車座位？',
                    fqaA: '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
                },
                {
                    faqNo: 'T001',
                    faqType: '商品問題',
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
                    faqNo: 'P001',
                    faqType: '商品問題',
                    fqaQ: '請問我要如何查詢貨況呢？',
                    fqaA: '請撥打客服電話，由專人為您服務。',
                },
            ],
            // editIndex: -1,  // 当前聚焦的输入框的行数
            }
        },
        methods: {
        newToggle(){ //新表單
            this.seenNew = !this.seenNew
        },
        editOnData(){ //上架編輯表單彈窗
            this.seeOnData = !this.seeOnData
        },
        editDraftData(){ //草稿編輯表單彈窗
            this.seeDraftData = !this.seeDraftData
        },
        checkOffData(){ //下架資料彈窗
            this.seeOffData = !this.seeOffData
        }
        ,
        methods: {
            // show (index) {
            //     this.$Modal.info({
            //         title: 'User Info',
            //         content: `Name：${this.data[index].name}<br>Age：${this.data[index].age}<br>Address：${this.data[index].address}`
            //     })
            // },
            remove (index) {
                this.data.splice(index, 1);
            }
        }
    }
}

</script>

<style scoped lang="scss">
@import "../assets/Css/Reset.css";
@import "../assets/Scss/pages/QA.scss";
.btn-box{
    span{
        cursor: pointer;
        &:hover{
            color: $clr_blue_L3;
        }
    }
}
// #edit{
//     bottom+bottom{
//         // margin-right: 40px;
//     };
// }
</style>