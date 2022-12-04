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
			<div class="backstage-path font-16">Q&A 管理 /</div>
			<div class="btns">
				<button class="btn-blue_2nd">顯示/隱藏</button>
				<button class="btn-blue">新增</button>
				<button class="btn-blue">刪除</button>
			</div>

			<!-- <div class="container"> -->
				<Tabs  class="tabs" type="card" :animated="false">
					<TabPane label="會員問題">
						<Table stripe border ref="selection" :columns="columns" :data="dataM"></Table>
					</TabPane>
					<TabPane label="行程訂單問題">
						<Table stripe border ref="selection" :columns="columns" :data="dataT"></Table>
					</TabPane>
					<TabPane label="商品訂單問題">
						<Table stripe border ref="selection" :columns="columns" :data="dataP"></Table>
					</TabPane>
				</Tabs>
				<Page :total="40" size="small" show-elevator show-sizer />
			<!-- </div> -->

		</main>
	</div>
</template>

<script>
import { resolveComponent } from 'vue'
export default {
	name: 'QAView',
	components: {

	},
	data () {
            return {
                columns: [
					{
						type: 'selection',
                        width: 60,
                        align: 'center'
                    },
                    // {
                    //     title: 'Name',
                    //     key: 'name',
                    //     render: (h, params) => {
                    //         return h('div', [
                    //             h('Icon', {
                    //                 props: {
                    //                     type: 'person'
                    //                 }
                    //             }),
                    //             h('strong', params.row.name)
                    //         ]);
                    //     }
                    // },
                    {
                        title: '編號',
                        key: 'no',
						width: 90,
		                align: 'center'
                    },
                    {
                        title: '類別',
                        key: 'type',
						width: 150,
		                align: 'center'
                    },
                    {
                        title: '問題',
                        key: 'Q',
		                align: 'center'
                    },
                    {
                        title: '回答',
                        key: 'A',
		                align: 'center'
                    },
                    {
                        title: '狀態',
                        key: 'state',
						width: 80,
		                align: 'center'
                    },
                    {
                        title: '修改',
                        key: 'edit',
                        width: 100,
                        align: 'center',
                        render: (h, params) => {
                            return h('div', [
                                h(resolveComponent('Button'), {
                                    props: {
                                        type: 'primary',
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    onClick: () => {
                                        // this.show(params.index)
                                    }
                                }, {
                                    default() {
                                        return '編輯'
                                    }
                                }),
                                // h(resolveComponent('Button'), {
                                //     props: {
                                //         type: 'error',
                                //         size: 'small'
                                //     },
                                //     onClick: () => {
                                //         this.remove(params.index)
                                //     }
                                // }, {
                                //     default() {
                                //         return 'Delete'
                                //     }
                                // })
                            ]);
                        }
                    }
                ],
                dataM: [
                    {
                        no: 'M001',
                        type: '會員問題',
                        Q:  '請問我忘記密碼了怎麼辦？',
                        A:  '請撥打客服電話，由專人為您服務。',
						state: '顯示',
                    },
                    {
                        no: 'M002',
                        type: '會員問題',
                        Q: '請問客服電話是？我找不到。',
                        A: '您好，客服電話是：00-0000-0000。',
						state: '顯示',
                    },
                    {
                        no: 'M003',
                        type: '會員問題',
                        Q:  '請問可以不要填寫LINE ID嗎？',
                        A:  '可以的，親。',
						state: '顯示',
                    },
                ],
                dataT: [
                    {
                        no: 'T001',
                        type: '行程訂單問題',
                        Q:  '我不小心訂錯行程了，請問要如何退訂？',
                        A:  '請至【會員專區】>【行程訂單查詢】，點擊【取消行程】',
						state: '顯示',
                    },
                    {
                        no: 'T002',
                        type: '行程訂單問題',
                        Q: '我想要刷卡，但我不能填寫安全碼？',
                        A: '請撥打客服電話，由專人為您服務。',
						state: '顯示',
                    },
                    {
                        no: 'T003',
                        type: '行程訂單問題',
                        Q:  '我請問我要如何查詢乘車座位？',
                        A:  '您好，我們不提供劃位服務，建議您提早上車，先搶先贏。',
						state: '隱藏',
                    },
                    {
                        no: 'T004',
                        type: '行程訂單問題',
                        Q:  '我購買了方案A，請問發車時間是？',
                        A:  '請撥打客服電話，由專人為您服務。',
						state: '顯示',
                    },
                ],
                dataP: [
                    {
                        no: 'P001',
                        type: '商品訂單問題',
                        Q:  '請問現貨商品多久會寄出？',
                        A:  '請撥打客服電話，由專人為您服務。',
						state: '顯示',
                    },
                    {
                        no: 'P002',
                        type: '商品訂單問題',
                        Q: '請問我要如何查詢貨況呢？',
                        A: '請撥打客服電話，由專人為您服務。',
						state: '顯示',
                    },
                ],
            }
        },
        methods: {
			handleSelectAll (status) {
                this.$refs.selection.selectAll(status);
            },
            show (index) {
                this.$Modal.info({
                    title: 'User Info',
                    content: `Name：${this.data[index].name}<br>Age：${this.data[index].age}<br>Address：${this.data[index].address}`
                })
            },
            // remove (index) {
            //     this.data.splice(index, 1);
            // }
        }
    }
</script>

<style scoped lang="scss">
@import "../assets/Css/Reset.css";
@import "../assets/Scss/pages/QA.scss";
</style>