<template>
  <div class="backstage-order">
    <div class="order-table">
      <Table stripe border :columns="columns" :data="dataOn">
        <!-- 訂單編號 -->
        <template #order_no="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.order_no }}</span>
        </template>
        <!-- 訂單日期 -->
        <template #order_date="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.order_date }}</span>
        </template>
        <!-- 會員編號 -->
        <template #mem_no="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.mem_no }}</span>
        </template>
        <!-- 訂單金額 -->
        <template #order_price="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.order_price }}</span>
        </template>
        <!-- 付款狀態 -->
        <template #payment_status="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.payment_status }}</span>
        </template>
        <!-- 出貨狀態 -->
        <template #order_status="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.order_status }}</span>
          <select name="" id="" style="width: 80px">
            <option value="yet">未出貨</option>
            <option value="send">已出貨</option>
            <option value="done">完成訂單</option>
          </select>
        </template>
        <!-- 按鈕訂單明細 -->
        <template #order_action="{ row }">
          <div class="btn-box">
            <button class="btn-success" @click="editOnData(row.order_action)">
              訂單明細
            </button>
          </div>
        </template>
      </Table>
    </div>
    <div class="popup on" v-show="seeOnData">
      <div class="popup-head font-20">
        <div class="order_no">
            <span>訂單編號:{{activeData.order_no}}</span>
        </div>
      </div>
      <div class="popup-content font-18">
        <div class="input-txt">
          <div class="input-title">
            收件人姓名:{{activeData.receive_name}}
          </div>
          <div class="input-title">
            <label for=""
              >商品名稱：
              <Input
                v-model="activeData.product_name"
                clearable
                style="width: 300px"
              />
            </label>
          </div>
          <div class="input-title">
            <label for=""
              >商品價格：
              <Input
                type="number"
                number="true"
                v-model="activeData.product_price"
                style="width: 300px"
              />
            </label>
          </div>
          <div class="input-title">
            <label for=""
              >商品介紹：
              <Input
                clearable
                type="textarea"
                :rows="4"
                v-model="activeData.product_intro"
                style="width: 300px"
              />
            </label>
          </div>
          <div class="input-title">
            <label for=""
              >商品狀態:
              <select name="" id="" style="width: 300px">
                <option value="on">上架</option>
                <option value="off">下架</option>
              </select>
            </label>
          </div>
        </div>
        <div class="pro-pic">
          <div class="input-title">
            <label class="picpic" for=""
              >商品主圖：
              <input type="file" />
            </label>
          </div>
          <div class="input-title">
            <label class="picpic" for=""
              >商品副圖：
              <input type="file" />
            </label>
          </div>
          <div class="input-title">
            <label class="picpic" for=""
              >商品副圖：
              <input type="file" />
            </label>
          </div>
        </div>
      </div>
      <div class="popup-btn">
        <button class="btn-blue_2nd" @click="editOnData">回到列表</button>
        <!-- 確認鍵功能待補，暫放toggle -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ShopOrder",
  props: {},
  components: {},
  data() {
    return {
      seeOnData: false,
      size: "default",
      seeCheck: false,
      columns: [
        {
          title: "訂單編號",
          slot: "order_no",
          align: "center",
        },
        {
          title: "訂單日期",
          slot: "order_date",
          align: "center",
          sortable: true,
        },
        {
          title: "會員編號",
          slot: "mem_no",
          align: "center",
        },
        {
          title: "訂單金額",
          slot: "order_price",
          align: "center",
        },
        {
          title: "付款狀態",
          slot: "payment_status",
          align: "center",
        },
        {
          title: "出貨狀態",
          slot: "order_status",
          align: "center",
        },
        {
          title: "操作",
          slot: "order_action",
          align: "center",
        },
      ],
      dataOn: [
        {
          order_no: "11112120001",
          order_date: "2022-12-12",
          mem_no: "001",
          order_price: "1080",
          payment_status: "未付款",
          receive_name:"曾小足",
          receive_phone:"0912345678",
          receive_address:"台北市信義區忠孝東路四段123號5弄4號3樓之1",
        },
        {
          order_no: "11112120002",
          order_date: "2022-12-12",
          mem_no: "002",
          order_price: "900",
          payment_status: "已付款",
        },
        {
          order_no: "11112130001",
          order_date: "2022-12-13",
          mem_no: "003",
          order_price: "700",
          payment_status: "未付款",
        },
        {
          order_no: "11112130002",
          order_date: "2022-12-13",
          mem_no: "004",
          order_price: "1280",
          payment_status: "未付款",
        },
        {
          order_no: "11112130003",
          order_date: "2022-12-13",
          mem_no: "001",
          order_price: "980",
          payment_status: "未付款",
        },
      ],
      //   editIndex: -1,
      activeIndex: null,
    };
  },
  methods: {
    editOnData(no) {
      //上架編輯表單彈窗
      this.seeOnData = !this.seeOnData;
      this.activeIndex = no;
    },
    okToggle() {
      //確認彈窗
      this.seeCheck = !this.seeCheck;
    },
  },
  computed:{
            activeData() {
                return this.dataOn.find(v=> v.order_no === this.activeIndex) ?? {}
            },
        }
};
</script>

<style scoped lang="scss">
@import "@/assets/Scss/base/color.scss";

/* -------------------彈窗 ------------------------*/
.popup {
  position: absolute;
  top: 100px;
  left: 150px;
  margin: auto;
  z-index: 20;
  width: 80%;
  height: 80%;
  background-color: #4f6573;
}

/* 上方區塊顏色 */
.popup-head {
  background-color: #2d3740;
  height: 50px;
  color: #ccc;
  display: flex;
  justify-content: center;
  align-items: center;
}
.popup-content {
  display: flex;
  padding: 30px;
  justify-content: center;
}
</style>