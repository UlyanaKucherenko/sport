<template>
  <section class="member-manage">
    <div class="container">
      <MyPlan
          :local="locale"
          :totalBooks="totalBooks"
          :expirationData="expirationData"
          :availableBooks="availableBooks"
          @upgrade="upgrade"
          :planName="planName"
          btnName="Unsubscribe"
      />
<<<<<<< HEAD
      <div class="member-manage__subtitle">{{vocab.title}}</div>
      <div class="member-manage__plans" v-if="currentPlan < 2">
=======
      <div class="member-manage__subtitle">Available plans</div>
      <div class="member-manage__plans" v-if="currentPlan<2">
>>>>>>> 3762fcf9d4294606746b45467f52d3c8442afeae
        <div class="member-manage__plan" v-for="(text, index) in planTexts" v-if="currentPlan < index">
          <div class="member-manage__plan-title">{{text.title}}</div>
          <div class="member-manage__plan-price">{{plans[index].price}} €</div>
          <div class="member-manage__plan-text">
            {{text.text1}}<br>
            {{text.text2}}<br>
          </div>
          <button @click="upgrade(index+1)" class="member-manage__plan-btn member-btn">{{ btnUpgrade }}</button>
        </div>
      </div>

      <transition name="modal-error">
        <div class="modal-error" v-if="modalError">
          <div class="modal-error__text">{{ modalErrorText }}</div>
        </div>
      </transition>
      <section id="cart-modal-iframe" :class="{'cart-modal-iframe':showSelectPlanIframe}"></section>

      <popup-success
        :msgText="popup_text"
        :popup-type="popup_type"
        :show-popup="show_popup"
        @closePopup="closePopup"
      ></popup-success>
      <confirm
        :unsubscribe_route="routes.unsubscribe"
        :show-confirm="show_confirm"
        @closeConfirm="closeConfirm"
      ></confirm>
    </div>
  </section>
</template>

<script>

import vocab from '../../translates/member_area/manage';
import confirm from '../Popup/PopupConfirm';
import MyPlan from "../Assets/MyPlan";

export default {
  name: "MembershipComponent",
  components: {MyPlan, confirm},
  props: {
    totalBooks: {
      type: Number,
      require: true
    },
    availableBooks: {
      type: Number,
      require: true
    },
    data: {
      type: Object,
      require: true
    },
    locale: {
      type: String,
      require: true
    },
    expirationData: {
      type: String,
      require: true
    },
    routes: {
      type: Object,
      require: true
    },
    planTexts: {},
    plans: {},
    user: {},
    unsubscribeErrors: {
      type: String
    }
  },
  data() {
    return {
      vocab: vocab[this.locale],
      currentPlan: this.user.plan_id - 1,
      // plans: ['Beginner', 'Basic', 'Pro'],
      showSelectPlan: false,
      modalError: false,
      modalErrorText: '',
      api_url: 'https://mmsafecheckout.com',
      show_popup: false,
      showSelectPlanIframe: false,
      popup_type: 'error',
      popup_text: 'error',
      show_confirm: false,
      upgradingToPLan: 0,
      btnUpgrade: "Upgrade",
      descriptor: "https://lmarkbill.com",

    }
  },
  created() {
    console.log(this.unsubscribeErrors);
    if (this.unsubscribeErrors.length > 2) {
      this.showPopup(this.unsubscribeErrors, "error");
    }
    window.addEventListener('message', this.detectIframeEvent, false);
  },
  destroyed() {
    window.removeEventListener('message', this.detectIframeEvent);
  },
  computed: {
    planName() {
      return this.plans[this.currentPlan].slug;
    }
  },
  mounted() {
  },
  methods: {
    async detectIframeEvent(e) {
      if ("origin" in e && "data" in e && e.origin === this.api_url) {

        const {status, action} = e.data;

        switch (true) {
          case (status === "ok" && action === "close"):
            this.closeIframeHandel();
            break;
          case (status === "ok" && action === "payment_success"):

            this.closeIframeHandel();
            // console.log('e=',e.data);
            const makePayment = await axios({
              method: 'post',
              data: {
                order_id: e.data.order_id,
                plan_id: this.upgradingToPLan,
              },
              url: this.routes.set_confirm,
            })
              .then(res => {
                console.log(res);
                return res.data;
              });

            if (makePayment.status === "updated") {
              console.log(makePayment.user);
              location.href = this.routes.dashboard;
            }
            break;
        }
      }
    },
    closeIframeHandel() {
      this.showSelectPlanIframe = false;
      const cardIframeSection = document.getElementById("cart-modal-iframe");
      cardIframeSection.innerHTML = "";
    },
    setInitPlan() {
      const currentPlan = _.find(this.plans, (el) => el.currentPlan) ? _.find(this.plans, (el) => el.currentPlan) : this.plans[0];
      this.currentPlan = currentPlan - 1;
      return {
        id: currentPlan.id,
        price: currentPlan.price,
        title: currentPlan.plan_text[0].title,
        text1: currentPlan.plan_text[0].text1,
        text2: currentPlan.plan_text[0].text2,
      };
    },
    createdIframe(user = null, toPlan = 2) {
      this.showSelectPlanIframe = true;
      const data = {
          email: user.email,
          first_name: user.first_name,
          last_name: user.last_name,
          address: user.address,
          city: user.city,
          //TODO add real Country!
          country: 'UnitedStates',//user.country,
          phone: user.phone,
          postal_code: user.postal_code,
          plan_id: toPlan,
          plan_name: this.plans[toPlan - 1].slug,
          plan_price: this.plans[toPlan - 1].price,
          // home: window.location.hostname,
          home: 'https://biathlonexpert.com',
          contact_phone: '+48 71 881 00 24',
          descriptor: "https://lmarkbill.com",
        }
      ;
      const cardIframeSection = document.getElementById("cart-modal-iframe");
      const cardIframe = document.createElement("iframe");
      const queryString = data ? Object.keys(data).map(key => key + '=' + data[key]).join('&') : "";

      cardIframe.setAttribute("src", this.api_url + "/card?" + queryString);

      cardIframeSection.appendChild(cardIframe);
    },

    upgrade(toPlan) {

      if (this.user) {
        this.upgradingToPLan = toPlan;
        this.createdIframe(this.user, toPlan);
      }
    },
    showPopup(text, type) {
      this.popup_text = text;
      this.popup_type = type;
      this.show_popup = true;
    },
    showConfirm() {
      this.show_confirm = true;
    },
    closePopup() {
      this.show_popup = false;
    },
    closeConfirm() {
      this.show_confirm = false;
    },
  }
}
</script>

<style lang="scss">

.alert {
  position: relative;
  padding: .75rem 2rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: .25rem;
  font-family: RobotoRegular, sans-serif;
  font-weight: 600;
  font-size: 18px;
}

.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
}
</style>
