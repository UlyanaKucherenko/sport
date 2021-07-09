<template>
    <form class="form" @submit.prevent="validatePersonalSubmit" :data-vv-scope="'personal'" id="personal"
          name="personal">
      <div class="form__content">
      <div class="form__col">
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.FirstName') }}</span>
          <label class="form__lbl">{{ this.vocab.firstName }}</label>
          <input
              name="FirstName"
              class="form__inp"
              v-validate="'required'"
              :class="{'required': errors.has('personal.FirstName') }"
              v-model="user.first_name"
              :placeholder="this.vocab.firstName">
        </div>
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.LastName') }}</span>
          <label class="form__lbl">{{ this.vocab.lastName }}</label>
          <input
              name="LastName"
              class="form__inp"
              v-validate="'required|alpha'"
              :class="{'required': errors.has('personal.LastName') }"
              v-model="user.last_name"
              :placeholder="this.vocab.lastName">
        </div>
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.Email') }}</span>
          <label class="form__lbl">{{ this.vocab.email }}</label>
          <input
              name="Email"
              class="form__inp"
              v-validate="'required|email'"
              :class="{'required': errors.has('personal.Email') }"
              disabled
              v-model="user.email"
              :placeholder="this.vocab.email">
        </div>
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.Phone') }}</span>
          <label class="form__lbl">{{ this.vocab.phone }}</label>
          <the-mask
              name="Phone"
              class="form__inp"
              v-validate="'required|min:12'"
              :class="{'required': errors.has('personal.Phone') }"
              :mask="'+### (##) ### ## ##'"
              :masked="false"
              v-model="user.phone"
              :placeholder="this.vocab.phone"/>
        </div>
      </div>
      <div class="form__col">
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.City') }}</span>
          <label class="form__lbl">{{ this.vocab.city }}</label>
          <input
              name="City"
              class="form__inp"
              v-validate="'required'"
              :class="{'required': errors.has('personal.City') }"
              v-model="user.city"
              :placeholder="this.vocab.city">
        </div>
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.Address') }}</span>
          <label class="form__lbl">{{ this.vocab.address }}</label>
          <input
              name="Address"
              class="form__inp"
              v-validate="'required'"
              :class="{'required': errors.has('personal.Address') }"
              v-model="user.address"
              :placeholder="this.vocab.address">
        </div>
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.PostalCode') }}</span>
          <label class="form__lbl">{{ this.vocab.postalCode }}</label>
          <input
              name="PostalCode"
              class="form__inp"
              maxlength="6"
              v-validate="'required'"
              :class="{'required': errors.has('personal.PostalCode') }"
              v-model="user.postal_code"
              :placeholder="this.vocab.postalCode"/>
        </div>
        <div class="form__row">
          <span class="required-text">{{ errors.first('personal.Country') }}</span>
          <label class="form__lbl">{{ this.vocab.country }}</label>
          <input
              name="Country"
              class="form__inp"
              v-validate="'required'"
              :class="{'required': errors.has('personal.Country') }"
              v-model="user.country"
              :placeholder="this.vocab.country">
        </div>
      </div>
      </div>
        <button type="submit" class="member-btn form__btn">
          {{ this.vocab.btnSave }}
        </button>
    </form>
</template>
<script>
import vocab from '../../translates/member_area/profile';

export default {
  name: "PersonalProfileForm",
  props: {
    user: {
      type: Object,
      require: true
    },
    routes: {
      type: Object,
      require: true
    },
    data: {
      type: Array,
      require: true
    },
    locale: {
      type: String,
      require: true
    }
  },
  data() {
    return {
      vocab: vocab[this.locale],
    }
  },
  methods: {
    updateUserHandler() {
      console.log("updateUserHandler");
      console.log({...this.user, data: this.data});

      axios({
        method: "post",
        url: this.routes.updateProfile,
        data: {...this.user, data: this.data}
      })
          .then(res => {
            console.log(res.data);
            if (res.data.update === true) {
              location.href = this.routes.profile;
            }
          })
    },
    validatePersonalSubmit() {
      this.$validator.validateAll('personal').then((result) => {
        if (result) {
          console.log('%c Form Submitted!', 'color: green; font-weight: 600;');
          this.updateUserHandler();
          return;
        }

        console.log('%c Correct them errors!', 'color: red; font-weight: 600;');
      });
    },
    validateAnthropometricSubmit() {
      this.$validator.validateAll('body').then((result) => {
        if (result) {
          console.log('%c Form Submitted!', 'color: green; font-weight: 600;');
          this.updateUserHandler();
          return;
        }

        console.log('%c Correct them errors!', 'color: red; font-weight: 600;');
      });
    }
  },
}
</script>
