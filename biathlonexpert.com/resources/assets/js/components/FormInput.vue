<template>
  <label class="form-field">
    <textarea
      v-if="rows"
      class="form-field__input"
      :class="{
        'form-field__input--reversed': reversed,
        'form-field__input--has-error': error
      }"
      :placeholder="placeholder || title"
      :value="value"
      @input="$emit('input', $event.target.value)"
      :rows="rows"/>

    <the-mask
      v-else-if="mask"
      class="form-field__input"
      :class="{
        'form-field__input--reversed': reversed,
        'form-field__input--has-error': error
      }"
      :placeholder="placeholder || title"
      :value="value"
      @input="$emit('input', $event)"
      :mask="mask"
    />

    <input
        v-else-if="name === 'password'"
        class="form-field__input"
        :class="{
        'form-field__holder--reversed': reversed,
        'form-field__holder--has-error': error,
      }"
        :placeholder="placeholder || title"
        :value="value"
        @input="$emit('input', $event.target.value)"
        type="password"
    >

    <input
      v-else
      class="form-field__input"
      :class="{
        'form-field__input--reversed': reversed,
        'form-field__input--has-error': error
      }"
      :placeholder="placeholder || title"
      :value="value"
      @input="$emit('input', $event.target.value)"
      type="text"
    >

    <span
      class="form-field__error-text"
      v-if="typeof error !== 'boolean'"
    >
      {{ error }}
    </span>
  </label>
</template>

<script>
export default {
  $_veeValidate: {
    value() {
      return this.value;
    }
  },

  props: {
    value: String,
    title: String,
    placeholder: String,
    mask: String,
    rows: String,
    error: [String, Boolean],
    reversed: Boolean,
    name: String,
  }
}
</script>

<style lang="scss">
.form-field {
  display: block;
  margin-bottom: 20px;
  text-align: left;
  width: 100%;

  &:last-child {
    margin-bottom: 0;
  }

  &__error-text {
    color: #ff5f5f;
    font-size: 14px;
  }

  &__input {
    width: 100%;
    font-size: 14px;
    color: black;
    padding: 10px 0;
    background: transparent;
    border: none;
    border-bottom: 1px solid #B0B2BC;
    transition: .3s;

    &::placeholder {
      color: black;
    }

    &--has-error {
      border-color: red;
    }

    &--reversed {
      color: black;

      &.form-field__input::placeholder {
        color: black;
      }

      &.form-field__input--has-error {
        border-color: #ff0000;
      }
    }
  }
}
</style>
