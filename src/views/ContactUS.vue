<template>
  <div>
    <Table
      :row-class-name="rowClassName"
      :columns="columns1"
      :data="data1"
      border
    >
      <!-- 意見表編號 -->
      <template #opinion_no="{ row, index }">
        <Input type="text" v-if="editIndex === index" />
        <span v-else>{{ row.opinion_no }}</span>
      </template>
      <!-- 填寫日期 -->
      <template #order_date="{ row, index }">
        <Input type="text" v-if="editIndex === index" />
        <span v-else>{{ row.order_date }}</span>
      </template>
      <!-- 填寫人姓名 -->
      <template #mem_no="{ row, index }">
        <Input type="text" v-if="editIndex === index" />
        <span v-else>{{ row.mem_no }}</span>
      </template>
      <!-- 連絡電話 -->
      <template #order_price="{ row, index }">
        <Input type="text" v-if="editIndex === index" />
        <span v-else>{{ row.order_price }}</span>
      </template>
      <!-- 信箱 -->
      <template #payment_status="{ row, index }">
        <Input type="text" v-if="editIndex === index" />
        <span v-else>{{ row.payment_status }}</span>
      </template>
      <!-- 意見表詳情 -->
      <template #table-row="{ row }">
        <Button @click="editOnData(row.opinion_no)">更多資訊</Button>
      </template>
    </Table>
    <div class="morecontent" v-show="show">
      <div class="content">
        <div class="content-header">
          <p>意見表詳情</p>
        </div>
        <div class="content-text">
          <p>意見表編號：{{ opinion_no }}</p>
          <p>填寫日期：{{ opinion_date }}</p>
          <p>填寫人名字：{{ opinion_name }}</p>
          <p>填寫人電話：{{ opinion_num }}</p>
          <p>填寫人信箱：{{ opinion_mail }}</p>
          <p>意見詳情：{{ opinion_detail }}</p>
        </div>
        <div class="closebtn">
          <Button @click="editOnData()">關閉</Button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      show: false,
      activeIndex: null,
      columns1: [
        {
          title: "意見表編號",
          key: "no",
          width: 120,
        },
        {
          title: "填寫時間",
          key: "filltime",
        },
        {
          title: "填寫人姓名",
          key: "name",
        },
        {
          title: "連絡電話",
          key: "cellphone",
        },
        {
          title: "信箱",
          key: "email",
        },
        {
          title: "意見表詳情",
          key: "content",
          slot: "table-row",
        },
      ],
      data1: [
        {
          opion_no: "A001",
          opion_filltime: "2022-12-13 18:30:00",
          opion_name: "余昕叡",
          opion_cellphone: "0912345678",
          opion_email: "fishray8787@gmail.com",
        },
        {
          no: "A002",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A003",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A004",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A005",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A007",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A008",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A009",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A010",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
        {
          no: "A011",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
        },
      ],
    };
  },
  methods: {
    rowClassName(row, index) {
      if (index % 2 === 0) {
        return "demo-table-info-row";
      } else if (!index % 2 === 0) {
        return "demo-table-error-row";
      }
      return "";
    },
    editOnData(no) {
      this.show = !this.show;
      this.activeIndex = no;
    },
    activeData() {
      return this.data1.find((v) => v.order_no === this.activeIndex) ?? {};
    },
  },
};
</script>

<style lang="scss" scope>
.ivu-table-header th {
  text-align: center;
}
.ivu-table-cell {
  text-align: center;
}
.ivu-btn {
  background-color: #0c3b59;
  color: #fff;
}
.morecontent {
  width: 100%;
  position: absolute;
  width: 100%;
  z-index: 100;
  top: 17%;
  left: 0;
  padding: 40px;
  .content {
    width: 100%;
    height: 100vh;
    background-color: #4f6573;
    .content-header {
      width: 100%;
      height: 80px;
      background-color: #2d3740;
      line-height: 80px;
      p {
        font-size: 32px;
        font-weight: 900;
        color: #fff;
      }
    }
    .content-text {
      margin: auto;
      font-size: 20px;
      color: #fff;
      padding: 60px 200px;
      p {
        margin: 30px auto;
        text-align: left;
        display: flex;
        flex-wrap: wrap;
      }
    }
    .closebtn {
      padding: 60px 200px;
      text-align: end;
    }
  }
}
.ivu-table .demo-table-info-row td {
  background-color: #e2e9f2;
  color: #444444;
}
.ivu-table .demo-table-error-row td {
  background-color: #ffffff;
  color: #444444;
}
</style>
