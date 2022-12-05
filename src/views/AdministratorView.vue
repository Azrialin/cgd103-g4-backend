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
                <Button type="primary"
                @click="addToggle">新增帳號</Button>
            </div>
        </div>
        <div class="administrator-manager">
            <Table stripe border :columns="columns" :data="data">
                <!-- 員工編號 -->
                <template #staff_no="{ row, index }">
                    <Input type="text" v-if="editIndex === index" />
                        <span v-else>{{ row.staff_no }}</span>
                </template>
                <!-- 員工帳號 -->
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
                    <Button type="error" size="small" @click="remove(index, row)">刪除</Button>
                </template>
            </Table>
        </div>
    </div>
    <Page :total="40" size="small" />

    <!-- style="display:none" -->
    <!--一張全新表單 -->
    <div class="popup " v-show="seenAdd" >
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
                        <Input type="text" placeholder="英數10個字" clearable  style="width: 200px"/>
                    </label>
                </div>
                <div class="input-info">
                    <label for="">員工密碼：
                        <Input type="password" placeholder="英數8個字" clearable  style="width: 200px"/>
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
                <Button @click="addToggle">取消</Button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
	name: 'AdministratorView',
	components: {
		
	},
    data () {
        return {
            seenAdd:false, //新表格彈窗，綁新表單v-show、按鈕@click="seenAdd"
            size:'default', //按鈕間距，搭配Space，預設small(無間距)， 可自行調整距離px，詳情請看 https://run.iviewui.com/
            columns: [
                {
                    title: '員工編號',
                    slot: 'staff_no',
                    align: 'center'
                },
                {
                    title: '員工帳號',
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
        },
        addToggle(){ //新表單
            this.seenAdd = !this.seenAdd
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
    // background-color: #4F6573;
    background-color: #A3AFBF;
}

/* 管理介面 */
.administrator-manager{
    height: 45vh;
    margin: 30px 40px;
}

/* -------------------彈窗 ------------------------*/
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


/* -------------------彈窗結束----------------- */
</style>