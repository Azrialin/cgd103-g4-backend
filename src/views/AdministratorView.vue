<template>
    <div class="backstage-administrator" >
        <div class="backstage-name">
            <div>
                <h2 class="font-36" >帳號管理</h2>
            </div>
            <div class="backstage-account">
                <span class="font-18">管理員名稱</span>
                <span class="font-18">登出</span>
            </div>
        </div>
        <div class="backstage-content">
            <div class="backstage-path font-16">帳號管理 / 管理者帳號</div>
            <div class="btn-add">
                <Button type="primary">新增帳號</Button>
            </div>
        </div>
        <div class="administrator-manager">
            <Table stripe border :columns="columns" :data="data">
                <!-- 員工編號 -->
                <template #staff_no="{ row, index }">
                    <Input type="text" v-if="editIndex === index" />
                        <span v-else>{{ row.staff_no }}</span>
                </template>
                <!-- 帳號 -->
                <template #staff_number="{ row, index }">
                    <Input type="text" v-if="editIndex === index" />
                        <span v-else>{{ row.staff_number }}</span>
                </template>
                <!-- 員工姓名 -->
                <template #staff_name="{ row, index }">
                    <Input type="text" v-if="editIndex === index" />
                        <span v-else>{{ row.staff_name }}</span>
                </template>
                <!-- 員工信箱 -->
                <template #staff_email="{ row, index }">
                    <Input type="text" v-if="editIndex === index" />
                        <span v-else>{{ row.staff_email }}</span>
                </template>
                <!-- 帳號狀態 -->
                <template #staff_state="{ row, index }">
                    <Switch true-color="#13ce66" false-color="#E6E6E6" />
                </template>
                <!-- 刪除帳號 -->
                <template #action_error="{ row, index }">
                    <Button type="error" size="small" @click="remove(index)">刪除</Button>
                </template>
            </Table>
        </div>
    </div>
    <Page :total="40" size="small" />
</template>

<script>
export default {
	name: 'AdministratorView',
	components: {
		
	},
    data () {
        return {
            columns: [
                {
                    title: '員工編號',
                    slot: 'staff_no',
                    align: 'center'
                },
                {
                    title: '帳號',
                    slot: 'staff_number',
                    align: 'center'
                },
                {
                    title: '員工姓名',
                    slot: 'staff_name',
                    align: 'center'
                },
                {
                    title: '員工信箱',
                    slot: 'staff_email',
                    align: 'center'
                },
                {
                    title: '帳號狀態',
                    slot: 'staff_state',
                    width: 120,
                    align: 'center'
                },
                {
                    title: '刪除帳號',
                    slot: 'action_error',
                    width: 120,
                    align: 'center'
                }
            ],
            data: [
                {
                    staff_no: '001',
                    staff_number: 'A12367',
                    staff_name: '三個字',
                    staff_email: 'abc@gmail.com'
                },
                {
                    staff_no: '002',
                    staff_number: 'B12367',
                    staff_name: '三個字',
                    staff_email: 'abc@gmail.com'
                },
                {
                    staff_no: '003',
                    staff_number: 'C12367',
                    staff_name: '三個字',
                    staff_email: 'abc@gmail.com'
                },
                {
                    staff_no: '004',
                    staff_number: 'A12367',
                    staff_name: '三個字',
                    staff_email: 'abc@gmail.com'
                }
            ]
        }
    },
    methods: {
        show (index) {
            this.$Modal.info({
                title: 'User Info',
                content: `Name：${this.data[index].name}<br>Age：${this.data[index].age}<br>Address：${this.data[index].address}`
            })
        },
        remove (index) {
            this.data.splice(index, 1);
        }
    }
}
</script>

<style scoped lang="scss">
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

/* 帳號管理 */
/* 麵包屑 */
.backstage-path{
    text-align: start;
    color: #888888;
    margin: 40px 0 0 40px;
}

/* 新增帳號按鈕 */
.btn-add{
    text-align: end;
}

.ivu-btn-primary{
    text-align: end;
    margin-right: 40px;
    background-color: #0C3B59;
    border: #0C3B59;
    color: #fff;
}

.ivu-btn-primary:hover{
    background-color: #A3AFBF;
    border: #A3AFBF;
}

/* 管理介面 */
.administrator-manager{
    height: 45vh;
    margin: 30px 40px;
}
</style>