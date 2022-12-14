<template>
  <div>
    <Table
      :row-class-name="rowClassName"
      :columns="columns1"
      :data="data1"
      border
    >
      <template :slot-scope="props" #table-row>
        <Button @click="open()">更多資訊</Button>
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
            <Button @click="close()">關閉</Button>
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
          no: "A001",
          filltime: "2022-12-13 18:30:00",
          name: "余昕叡",
          cellphone: "0912345678",
          email: "fishray8787@gmail.com",
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
      columns: [
        {
          title: "Name",
          key: "name",
        },
        {
          title: "Age",
          key: "age",
        },
        {
          title: "Address",
          key: "address",
        },
      ],
      data: [
        {
          name: "John Brown",
          age: 18,
          address: "New York No. 1 Lake Park",
          date: "2016-10-03",
        },
        {
          name: "Jim Green",
          age: 24,
          address: "London No. 1 Lake Park",
          date: "2016-10-01",
        },
        {
          name: "Joe Black",
          age: 30,
          address: "Sydney No. 1 Lake Park",
          date: "2016-10-02",
        },
        {
          name: "Jon Snow",
          age: 26,
          address: "Ottawa No. 2 Lake Park",
          date: "2016-10-04",
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
    open() {
      let that = this;
      that.show = true;
    },
    close() {
      let that = this;
      that.show = false;
    },
    handleBeforeChange() {
      return new Promise((resolve) => {
        this.$Modal.confirm({
          title: "切换确认",
          content: "您确认要切换开关状态吗？",
          onOk: () => {
            resolve();
          },
        });
      });
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
      p{
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
    .closebtn{
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
