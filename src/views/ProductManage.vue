<template>
  <div class="backstage-pro">
    <div class="btn-add">
      <button class="font-20 btn-blue" @click="newToggle">新增商品</button>
    </div>
    <div class="pro-table">
      <Table stripe border :columns="columns" :data="data">
        <!-- 商品編號 -->
        <template #product_no="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_no }}</span>
        </template>
        <!-- 商品圖片 -->
        <template #product_pic="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_pic }}</span>
        </template>
        <!-- 商品名稱 -->
        <template #product_name="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_name }}</span>
        </template>
        <!-- 商品價格 -->
        <template #product_price="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_price }}</span>
        </template>
        <!-- 商品狀態 -->
        <template #product_status="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_status }}</span>
        </template>
        <!-- 按鈕 -->
        <template #product_action="{ row }">
          <div class="btn-box">
            <button class="btn-success" @click="editOnData(row.product_no)">
              編輯
            </button>
          </div>
        </template>
      </Table>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductManage",
  components: {},
  data() {
    return {
      seenNew: false, //新表格彈窗，綁新表單v-show、按鈕@click="newToggle"
      size: "default", //按鈕間距，搭配Space，預設small(無間距)， 可自行調整距離px，詳情請看 https://run.iviewui.com/
      columns: [
        {
          title: "商品編號",
          slot: "product_no",
          align: "center",
        },
        {
          title: "商品圖片",
          slot: "product_pic",
          align: "center",
        },
        {
          title: "商品名稱",
          slot: "product_name",
          align: "center",
        },
        {
          title: "商品價格",
          slot: "product_price",
          align: "center",
        },
        {
          title: "商品狀態",
          slot: "product_status",
          width: 120,
          align: "center",
        },
        {
          title: "操作",
          slot: "product_action",
          width: 120,
          align: "center",
        },
      ],
      data: [
        {
          product_no: "TA0001",
          product_pic: require(`@/assets/img/products/pro4.jpg`) ,
          product_name: "三個字",
          product_price: "abc@gmail.com",
        },
        {
          product_no: "TA0002",
          product_pic: "B12367",
          product_name: "三個字",
          product_price: "abc@gmail.com",
        },
        {
          product_no: "FA0001",
          product_pic: "C12367",
          product_name: "三個字",
          product_price: "abc@gmail.com",
        },
        {
          product_no: "FA0002",
          product_pic: "A12367",
          product_name: "三個字",
          product_price: "abc@gmail.com",
        },
      ],
    };
  },
  methods: {
    addToggle() {
      //新表單
      this.seenAdd = !this.seenAdd;
    },
  },
};
</script>

<style scoped lang="scss">
@import "@/assets/Scss/base/color.scss";

/* 新增按鈕 */
.btn-add {
  text-align: end;
  margin-right: 60px;
}
.btn-add button {
  padding: 8px 16px;
}
</style>