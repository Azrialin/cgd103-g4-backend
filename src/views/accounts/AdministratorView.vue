<template>
    <div class="backstage-administrator" >
        <!-- <div class="backstage-name">
            <div>
                <h2 class="font-36" >帳號管理</h2>
            </div>
            <div class="backstage-account">
                <span class="font-18">管理員名稱</span>
                <span class="font-18">登出</span>
            </div>
        </div> -->
        <div class="backstage-content">
            <!-- <div class="backstage-path font-16">帳號管理 / 管理者帳號</div> -->
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
                <!-- <template #action_error="{ row, index }">
                    <Button type="error" size="small" @click="remove(index, row)">刪除</Button>
                </template> -->
                <template #action_error>
                    <span class="icon material-symbols-outlined" style="font-size:26px; margin-top: 5px; cursor: pointer;" @click="isShow = true">delete</span>
                </template>
            </Table>
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
        </div>
    </div>
    <!-- <Page :total="40" size="small" /> -->

    <!-- style="display:none" -->
    <!--新增表單 -->
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
            isShow: false,
            modal_loading: false,
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
    computed: {
        modalStyle(){
            return {
                'display': this.isShow ? '' : 'none'
            };
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
        },
        del(index){
            this.data.splice(index, 1);
            this.modal_loading = true;
            setTimeout(() => {
                this.modal_loading = false;
                this.isShow = false;
                this.$Message.success('已刪除一筆管理者帳號');
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
@import "../../assets//Scss/components/btn.scss";
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
    // height: 45vh;
    // height: calc(100VH - 80px - 19.2px - 32px);
    margin: 30px 40px;
}

/* -------------------新增帳號彈窗 ------------------------*/
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


/* -------------------新增帳號彈窗結束----------------- */
/* -------------------刪除彈窗----------------- */
.modal-mask{
    position: absolute;
    z-index: 10;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: table;
    background-color: rgba(0, 0, 0, 0.3);
    transition: opacity .3s ease;
}
.modal-container{
    display: table-cell;
    vertical-align: middle;
}
.modal-body{
    position: absolute;
    top: 50%;
    left: 50%;
    left: calc(50% - 150px);
    transform: translate(-50%, -50%);
    width: fit-content;
    margin: auto;
    padding: 30px 80px;
    border-radius: 10px;
    background-color: #fff;
    p{
        text-align: center;
        margin-bottom: 10px;
        &:first-child{
            margin-bottom: 5px;
            span{
                vertical-align: top;
            }
        }
        }
    Button+Button{
        margin-left: 30px;
    }
}
</style>