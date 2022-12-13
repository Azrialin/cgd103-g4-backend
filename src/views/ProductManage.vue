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
        <!-- 主類別 -->
        <template #product_series="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_series }}</span>
        </template>
        <!-- 子類別 -->
        <template #product_type="{ row, index }">
          <Input type="text" v-if="editIndex === index" />
          <span v-else>{{ row.product_type }}</span>
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
    <!--新增商品 -->
    <keep-alive>
      <div class="popup" v-show="seenNew">
        <div class="popup-head font-20">商品資訊</div>
        <div class="popup-content font-18">
          <div class="input-txt">
            <div class="input-title">
              <label for=""
                >商品編號：
                <Input
                  placeholder="預設"
                  clearable
                  style="width: 300px"
                  disabled
                />
              </label>
            </div>
            <div class="input-title">
              <label for=""
                >主類別:
                <select name="" id="" style="width: 300px">
                  <option value="gift">紀念品系列</option>
                  <option value="food">特產系列</option>
                </select>
              </label>
            </div>
            <div class="input-title">
              <label for=""
                >子類別:
                <select name="" id="" style="width: 300px">
                  <option value="bottles">水壺</option>
                  <option value="boxes">便當盒</option>
                  <option value="snacks">零食</option>
                  <option value="sauce">調味料</option>
                </select>
              </label>
            </div>
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
            <div class="input-title">
              <label for=""
                >商品價格：
                <Input
                  type="number"
                  number="true"
                  placeholder="請輸入商品價格"
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
                  placeholder="請輸入商品介紹"
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
            <div class="input-title-pic">
              <label class="picpic" for=""
                >商品主圖：
                <input type="file" @change="previewImage" class="pic-input"/>
                <div v-if="preview" class="pro-pic-preview">
                  <img :src="preview"/>
                </div>
              </label>
            </div>
            
            <div class="input-title-pic">
              <label class="picpic" for=""
                >商品副圖：
                <input type="file" @change="previewImage1" class="pic-input"/>
                <div v-if="preview1" class="pro-pic-preview">
                  <img :src="preview1"/>
                </div>
              </label>
            </div>
            <div class="input-title-pic">
              <label class="picpic" for=""
                >商品副圖：
                <input type="file" @change="previewImage2" class="pic-input"/>
                <div v-if="preview2" class="pro-pic-preview">
                  <img :src="preview2"/>
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="popup-btn">
          <button class="btn-blue_2nd" @click="newToggle">取消</button>
          <button class="btn-blue" @click="newToggle">確認</button>
          <!-- 確認鍵功能待補，暫放toggle -->
        </div>
      </div>
    </keep-alive>

    <!-- 編輯商品 -->
    <div class="popup on" v-show="seeOnData">
      <div class="popup-head font-20">商品資訊</div>
      <div class="popup-content font-18">
        <div class="input-txt">
          <div class="input-title">
            <label for=""
              >商品編號：
              <Input
                v-model="activeData.product_no"
                clearable
                style="width: 300px"
                disabled
              />
            </label>
          </div>
          <div class="input-title">
            <label for=""
              >主類別:
              <select name="" id="" style="width: 300px">
                <option value="gift">紀念品系列</option>
                <option value="food">特產系列</option>
              </select>
            </label>
          </div>
          <div class="input-title">
            <label for=""
              >子類別:
              <select name="" id="" style="width: 300px">
                <option value="bottles">水壺</option>
                <option value="boxes">便當盒</option>
                <option value="snacks">零食</option>
                <option value="sauce">調味料</option>
              </select>
            </label>
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
        <button class="btn-blue_2nd" @click="editOnData">取消</button>
        <button class="btn-blue" @click="editOnData">確認</button>
        <!-- 確認鍵功能待補，暫放toggle -->
      </div>
    </div>
  </div>

  <!-- 新增成功 -->
  <!-- style="display:none" -->
  <!-- <div class="popup-box add font-18" v-show="seeCheck">
    <p class="popup-box-close">X</p>
    <p class="check-des">新增資料成功</p>
    <button @click="okToggle" class="btn-success">確認</button>
  </div> -->

  <!-- 修改成功 -->
  <!-- <div class="popup-box fix font-18" v-show="seeCheck">
    <p class="popup-box-close">X</p>
    <p class="check-des">修改資料成功</p>
    <button @click="okToggle" class="btn-success">確認</button>
  </div> -->
</template>

<script>
export default {
  name: "ProductManage",
  props: {
    price: Number,
  },
  components: {},
  data() {
    return {
      preview: null,  //預覽主圖片
      preview1: null,  //預覽圖片a
      preview2: null,  //預覽圖片b

      seenNew: false, //新表格彈窗，綁新表單v-show、按鈕@click="newToggle"
      seeOnData: false, //上架資料彈窗，綁上架資料v-show、編輯按鈕@click="editOnData"
      size: "default", //按鈕間距，搭配Space，預設small(無間距)， 可自行調整距離px，詳情請看 https://run.iviewui.com/
      seeCheck: false, //確認彈窗、v-show="seeCheck" 按鈕@click="okToggle"

      columns: [
        {
          title: "商品編號",
          slot: "product_no",
          width: 120,
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
          title: "主類別",
          slot: "product_series",
          width: 120,
          align: "center",
          filters: [
            {
              label: "紀念品",
              value: 1,
            },
            {
              label: "特產",
              value: 2,
            },
          ],
          filterMultiple: false,
          filterMethod(value, row) {
            if (value === 1) {
              return row.product_series === "紀念品";
            } else if (value === 2) {
              return row.product_series === "特產";
            }
          },
        },
        {
          title: "子類別",
          slot: "product_type",
          width: 120,
          align: "center",
          filters: [
            {
              label: "水壺",
              value: 3,
            },
            {
              label: "便當盒",
              value: 4,
            },
            {
              label: "零食",
              value: 5,
            },
            {
              label: "調味料",
              value: 6,
            },
          ],
          filterMultiple: false,
          filterMethod(value, row) {
            if (value === 3) {
              return row.product_type === "水壺";
            } else if (value === 4) {
              return row.product_type === "便當盒";
            } else if (value === 5) {
              return row.product_type === "零食";
            } else if (value === 6) {
              return row.product_type === "調味料";
            }
          },
        },
        {
          title: "商品價格",
          slot: "product_price",
          width: 180,
          align: "center",
        },
        {
          title: "商品狀態",
          slot: "product_status",
          width: 150,
          align: "center",
        },
        {
          title: "操作",
          slot: "product_action",
          width: 150,
          align: "center",
        },
      ],
      dataOn: [
        {
          product_no: "001",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"特產",
          product_type:"零食",
          product_name: "九州福砂屋長崎蛋糕",
          product_price: "460",
          product_intro:
            "採用精選雞蛋、砂糖、糖漿和小麥粉的簡單材料，全程不用攪拌機，完全靠師傅手感攪拌，製作出口味道地且香甜綿潤的蛋糕點心。長崎蛋糕底砂糖結晶顆粒的粗糖，是攪拌蛋糕材料時留下來的，也是福砂屋長崎蛋糕的特徵。作為長崎蛋糕的傑作，特製五三燒長崎蛋糕的風味更濃，且香氣更濃郁。它由技術熟練的糕點師傅以高超技術製成，生量數量少，是福砂屋的特製長崎蛋糕，廣受長崎 蛋糕饕客們喜愛。",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "002",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"特產",
          product_type:"零食",
          product_name: "JS怪奇薯條",
          product_price: "290",
          product_intro:
            "怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃怪奇薯條好好吃哦怎麼這麼好吃",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "003",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"特產",
          product_type:"調味料",
          product_name: "透明醬油",
          product_price: "320",
          product_intro:
            "透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃透明醬油好好吃哦怎麼這麼好吃",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "004",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"特產",
          product_type:"零食",
          product_name: "七彩洋芋片",
          product_price: "250",
          product_intro:
            "七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片七彩洋芋片",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "005",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"紀念品",
          product_type:"水壺",
          product_name: "九州切子",
          product_price: "850",
          product_intro:
            "九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子九州切子",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "006",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"紀念品",
          product_type:"便當盒",
          product_name: "火車便當盒",
          product_price: "480",
          product_intro:
            "火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒火車便當盒",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "007",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"特產",
          product_type:"調味料",
          product_name: "九州昆布湯包",
          product_price: "320",
          product_intro:
            "九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包九州昆布湯包",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
        {
          product_no: "008",
          product_pic: require(`@/assets/img/products/pro4.jpg`),
          product_series:"特產",
          product_type:"調味料",
          product_name: "九州黑醋",
          product_price: "220",
          product_intro:
            "九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋九州黑醋",
          product_status: "上架",
          product_pica: require(`@/assets/img/products/pro5.jpg`),
          product_picb: require(`@/assets/img/products/pro6.jpg`),
        },
      ],
      editIndex: -1,
      activeIndex: null,
    };
  },
  methods: {
    //預覽主圖片
    previewImage: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.preview = e.target.result;
        }
        this.image=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
    //預覽圖片a
    previewImage1: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.preview1 = e.target.result;
        }
        this.image=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
    //預覽圖片b
    previewImage2: function(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.preview2 = e.target.result;
        }
        this.image=input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
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
      return this.dataOn.find((v) => v.product_no === this.activeIndex) ?? {};
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
// .type {
//   display: flex;
//   color: #fff;
//   align-items: center;
// }

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
.input-title {
  margin-bottom: 20px;
}
.input-title-pic {
  margin-bottom: 20px;
}
.input-txt{
  width: 45%;
  margin: 20px;
  text-align: end;
}
.pro-pic{
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
  width: 60%;
  margin: 20px;
}
.picpic{
  display: flex;
  align-items: center;
}
.pic-input{
  width: 40%;
}
.pro-pic-preview{
  width: 30%;
  img{
    width: 70%;
  }
}

.popup-btn {
  width: 100%;
  max-width: 30%;
  display: flex;
  justify-content: space-between;
  margin: auto;
  padding: 20px 0px;
}

.popup-btn button {
  padding: 5px 30px;
}

/* 彈窗字顏色 */
.popup label {
  color: #fff;
}
.date {
  color: #ccc;
}

/* -------------------彈窗結束----------------- */

/* -------------------新增修改box ------------------------*/
.popup-box {
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

.popup-box-close {
  text-align: end;
  margin-top: 10px;
  padding-right: 20px;
}

// .check-des {
//   margin-top: 70px;
// }

.popup-box button {
  margin-top: 30px;
}

/* -------------------新增修改結束 ------------------------*/

/* 確認彈窗按鈕 */
.popup-box .btn-success {
  padding: 8px 32px;
}

/* 確認彈窗文字 */
.popup-box {
  translate: 0 -16px;
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
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.3s ease;
}
</style>