<template>
  <section class="member-dashboard">
    <div class="container">
      <MyPlan
        :local="locale"
        :expirationData="expirationData"
        :totalBooks="totalBooks"
        :availableBooks="availableBooks"
        :planName="planName"
        btnName="Upgrade"
      />
    </div>
    <div class="dash-block">
      <RecentBooks
        :title="vocab.books"
        :recent-books="recentBooks"
      ></RecentBooks>
    </div>
  </section>
</template>

<script>

import vocab from '../../translates/member_area/dashboard';
import RecentBooks from '../Assets/RecentBooks'
import MyPlan from "../Assets/MyPlan";

export default {
  name: "DashboardComponent",
  props: {
    totalBooks: {
      type: Number,
      require: true
    },
    availableBooks: {
      type: Number,
      require: true
    },
    previewBooks: {
      type: Array,
      require: true
    },
    expirationData: {
      type: String,
      require: true
    },
    locale: {
      type: String,
      require: true
    },
    recentBooks: {},
    topBook: {},
    planTexts: {},
    plans: {},
    user: {},
  },
  components: { MyPlan, RecentBooks},
  data() {
    return {
      info: null,
      vocab: vocab[this.locale],
      planName: this.plans[this.user.plan_id - 1].slug,
      btnUpgrade: "Upgrade",
    }
  },
  mounted() {
    this.btnUpgrade = this.vocab.upgrade;
  },
}
</script>

<style lang="scss" scoped>
.imgEbooks img {
  width: 100%;
}

</style>
