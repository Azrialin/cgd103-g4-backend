<template>
  <div class="backstage-pro">
    <div class="btn-add">
      <button class="font-20 btn-blue" @click="newToggle">新增商品</button>
    </div>
    <div class="pro-table">
      <Table stripe border :columns="columns" :data="dataOn">
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

    <!-- style="display:none" -->
    <!--一張全新表單 -->
    <keep-alive>
      <div class="popup" v-show="seenNew">
        <div class="popup-head font-20">
          <div class="type opencode">
            <p class="font-20">商品編號 001</p>
          </div>
        </div>
        <div class="popup-content font-18">
          <div class="popup-data">
            <label for=""
              >狀態(必填)
              <select name="" id="">
                <option value="on">上架</option>
                <option value="off">下架</option>
              </select>
            </label>
            <label for=""
              >主類別
              <select name="" id="">
                <option value="gift">紀念品系列</option>
                <option value="food">特產系列</option>
              </select>
            </label>
            <label for=""
              >子類別
              <select name="" id="">
                <option value="bottles">水壺</option>
                <option value="boxes">便當盒</option>
                <option value="snacks">零食</option>
                <option value="sauce">調味料</option>
              </select>
            </label>
          </div>
          <div class="input-txt">
            <div class="input-title">
              <label for=""
                >商品名稱：
                <Input
                  placeholder="請輸入商品名稱"
                  clearable
                  style="width: 300px"
                />
              </label>
            </div>
            <div class="input-des">
              <label for=""
                >商品價格：
                <Input
                  type="number"
                  :value="price"
                  placeholder="請輸入商品價格"
                  style="width: 300px"
                />
              </label>
            </div>
            <div class="input-des">
              <label for=""
                >內文：
                <Input
                  clearable
                  type="textarea"
                  :rows="4"
                  placeholder="詳細內文(承)"
                  style="width: 500px"
                />
              </label>
            </div>
            <div class="input-des">
              <label for=""
                >內文：
                <Input
                  clearable
                  type="textarea"
                  :rows="4"
                  placeholder="詳細內文(轉)"
                  style="width: 500px"
                />
              </label>
            </div>
            <div class="input-des">
              <label for=""
                >結尾：
                <Input
                  clearable
                  type="textarea"
                  :rows="2"
                  placeholder="請輸入內容"
                  style="width: 500px"
                />
              </label>
            </div>
          </div>
          <div class="input-pic">
            <label class="test" for=""
              >插入圖片：
              <input type="file" />
            </label>
          </div>
          <div class="input-pic-des">
            <label for=""
              >圖片敘述：
              <Input
                placeholder="請輸入圖片敘述"
                clearable
                style="width: 500px"
              />
            </label>
          </div>
          <div class="popup-btn">
            <button class="btn-blue_2nd" @click="newToggle">取消</button>
            <button class="btn-blue" @click="newToggle">確認</button>
            <!-- 確認鍵功能待補，暫放toggle -->
          </div>
        </div>
      </div>
    </keep-alive>

    <div class="popup on" v-show="seeOnData">
      <div class="popup-head font-20">
        <div class="news-no">
          <span>公告編號</span>
          <span>{{ activeData.news_no }}</span>
        </div>
        <div class="on-date">
          <span class="date">發布時間</span>
          <span class="date">{{ activeData.news_time }}</span>
        </div>
        <div class="last-edit-date">
          <span class="date">最後更新</span>
          <span class="date">{{ activeData.news_last_edit }}</span>
        </div>
      </div>
      <div class="popup-content font-18">
        <div class="popup-data">
          <label for=""
            >狀態
            <select name="" id="">
              <option value="on">上架</option>
              <option value="off">下架</option>
            </select>
          </label>
          <label for=""
            >分類
            <select name="" id="">
              <option value="important">重要</option>
              <option value="action">活動</option>
              <option value="other">其他</option>
            </select>
          </label>
        </div>
        <div class="input-txt">
          <div class="input-title">
            <label for=""
              >標題：
              <Input
                v-model="activeData.news_title"
                clearable
                style="width: 500px"
              />
            </label>
          </div>
          <div class="input-des">
            <label for=""
              >引文：
              <Input
                v-model="activeData.news_text_start"
                clearable
                type="textarea"
                :rows="2"
                placeholder="前台標題敘述"
                style="width: 500px"
              />
            </label>
          </div>
          <div class="input-des">
            <label for=""
              >內文：
              <Input
                v-model="activeData.news_text_middle"
                clearable
                type="textarea"
                :rows="4"
                placeholder="詳細內文(承)"
                style="width: 500px"
              />
            </label>
          </div>
          <div class="input-des">
            <label for=""
              >內文：
              <Input
                v-model="activeData.news_text_trans"
                clearable
                type="textarea"
                :rows="4"
                placeholder="詳細內文(轉)"
                style="width: 500px"
              />
            </label>
          </div>
          <div class="input-des">
            <label for=""
              >結尾：
              <Input
                v-model="activeData.news_text_end"
                clearable
                type="textarea"
                :rows="2"
                placeholder="請輸入內容"
                style="width: 500px"
              />
            </label>
          </div>
        </div>
        <div class="input-pic">
          <label class="test" for=""
            >插入圖片：
            <input type="file" />
          </label>
        </div>
        <div class="input-pic-des">
          <label for=""
            >圖片敘述：
            <Input
              v-model="activeData.news_img_des"
              placeholder="請輸入圖片敘述"
              clearable
              style="width: 500px"
            />
          </label>
        </div>
        <div class="popup-btn">
          <button class="btn-blue_2nd" @click="editOnData">取消</button>
          <button class="btn-blue" @click="editOnData">確認</button>
          <!-- 確認鍵功能待補，暫放toggle -->
        </div>
      </div>
    </div>
  </div>

  <!-- 新增成功 -->
  <!-- style="display:none" -->
  <div class="popup-box add font-18" v-show="seeCheck">
    <p class="popup-box-close">X</p>
    <p class="check-des">新增資料成功</p>
    <button @click="okToggle" class="btn-success">確認</button>
  </div>

  <!-- 修改成功 -->
  <div class="popup-box fix font-18" v-show="seeCheck">
    <p class="popup-box-close">X</p>
    <p class="check-des">修改資料成功</p>
    <button @click="okToggle" class="btn-success">確認</button>
  </div>
</template>

<script>
export default {
  name: "ProductManage",
  props:{
    price: Number,
  },
  components: {},
  data() {
    return {
      seenNew: false, //新表格彈窗，綁新表單v-show、按鈕@click="newToggle"
      seeOnData:false, //上架資料彈窗，綁上架資料v-show、編輯按鈕@click="editOnData"
      size: "default", //按鈕間距，搭配Space，預設small(無間距)， 可自行調整距離px，詳情請看 https://run.iviewui.com/
      seeCheck: false, //確認彈窗、v-show="seeCheck" 按鈕@click="okToggle"
      // 以下for全新表單(好像可以把它變成陣列)
      input_new_no: "",
      input_new_time: "",
      input_new_last_edit: "",
      input_new_type: "",
      input_new_title: "",
      input_new_text_start: "",
      input_new_text_middle: "",
      input_new_text_trans: "",
      input_new_text_end: "",
      input_new_img: "",
      input_new_img_des: "",
      input_new_status: "",
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
      dataOn: [
        {
          product_no: "001",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_name: "九州福砂屋長崎蛋糕",
          product_price: "460",
          product_status: "上架",
        },
        {
          product_no: "002",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_name: "JS怪奇薯條",
          product_price: "290",
          product_status: "上架",
        },
        {
          product_no: "003",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_name: "透明醬油",
          product_price: "320",
          product_status: "上架",
        },
        {
          product_no: "004",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_name: "七彩洋芋片",
          product_price: "250",
          product_status: "上架",
        },
      ],
    };
  },
  methods: {
    newToggle() {
      //新表單
      this.seenNew = !this.seenNew;
    },
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
  computed: {
    activeData() {
      return this.dataOn.find((v) => v.news_no === this.activeIndex) ?? {};
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
.pro-table {
  height: 45vh;
  margin: 30px 20px;
}
.type {
  display: flex;
  color: #fff;
  align-items: center;
}

/* -------------------彈窗 ------------------------*/
.popup {
  position: absolute;
  top: 5px;
  left: 150px;
  margin: auto;
  z-index: 20;
  width: 80%;
  background-color: #4f6573;
}

/* 上方區塊顏色 */
.popup-head {
  background-color: #2d3740;
  height: 80px;
  color: #ccc;

  display: flex;
  justify-content: space-around;
  align-items: center;
}

.popup-data{
    margin: 30px 0;
    display: flex;
    justify-content: space-around;
}
.input-title{
    margin-bottom: 40px;
    padding-left: 85px;
}
.input-des,
.input-pic,
.input-pic-des{
    margin-bottom: 15px;
    padding-left: 85px;

}
.input-txt{
    margin-bottom: 40px;
}
.popup-btn{
    margin: 90px 0 50px 0 ;
    display: flex;
    justify-content: center;

}

.popup-btn button{
    margin: 0 100px;
}

/* 彈窗字顏色 */
.popup label{
    color: #fff;
}
.date{
    color: #ccc;
}


/* -------------------彈窗結束----------------- */

/* -------------------新增修改box ------------------------*/
.popup-box{
    position: absolute;
    top: 200px;
    left: 400px;
    width: 400px;
    height: 230px;
    border: 1px solid #6c9255;
    border-radius: 10px;
    background-color: #ffffff;
    text-align: center;
}   

.popup-box-close{
    text-align: end;
    margin-top: 10px;
    padding-right: 20px;
}

.check-des{
    margin-top: 70px;
}

.popup-box button{
    margin-top: 30px;
}

/* -------------------新增修改結束 ------------------------*/


/* 確認彈窗按鈕 */
.popup-box .btn-success{
    padding: 8px 32px;
}

/* 確認彈窗文字 */
.popup-box .check-des{
    translate:0 -16px ;
}

/* 彈窗背景 */

.modal-mask {
    position: absolute;
    z-index: 10;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: table;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .3s ease;
}

</style>